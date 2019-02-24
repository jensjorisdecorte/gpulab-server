<?php
$out = array();
exec("export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli jobs ".$id." 2>&1", $out);
#foreach($out as $line) {
#    echo $line;
#    echo '</br>';
#}
$host = "";
$port = "";

foreach($out as $line) {
    $line = preg_replace('!\s+!', ' ', $line);
    $matches = array();
    preg_match('/(?<=Worker Host: )[^ ]+/', $line, $matches);
    if (count($matches) > 0){
        $host = $matches[0];
    }
    $matches = array();
    preg_match('/(?<=tcp -> )([0-9]+)/', $line, $matches);
    if (count($matches) > 0){
        $port = $matches[0];
    }
}

$url = "http://".$host.":".$port;

$out = array();
exec("export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli log ".$id." 2>&1", $out);

$token_string = "";

foreach($out as $line) {
    $line = preg_replace('!\s+!', ' ', $line);
    $matches = array();
    preg_match('/\?token=[^ ]+/', $line, $matches);
    if (count($matches) > 0){
        $token_string = $matches[0];
        break;
    }
}

$full_url = $url.$token_string;
$full_url = filter_var($full_url, FILTER_SANITIZE_URL);

if (filter_var($full_url, FILTER_VALIDATE_URL) !== false) {
    header("Location: ".$full_url);
    exit;
} else { ?>
    <div class="alert alert-danger" role="alert">
      No permissions
    </div>
    <script type="text/javascript">setTimeout("window.close();", 2000);</script>
<?php } 
?>
