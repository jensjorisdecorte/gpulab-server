<?php
echo "<p>Logs for task with id <strong>".$id."</strong>:</p>";
echo "</br>";

$out = array();
exec("export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli log ".$id." 2>&1", $out);
foreach($out as $line) {
    echo $line;
    echo '</br>';
}
?>
