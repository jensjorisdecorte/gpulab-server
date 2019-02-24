<?php
$out = array();
echo $name;
echo $descr;
exec("export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli cancel ".$id." 2>&1", $out);
foreach($out as $line) {
    echo $line;
    echo '</br>';
}
?>

<div class="alert alert-success" role="alert">
  Wait while the job is canceled..
</div>

<script type="text/javascript">setTimeout("window.close();", 2000);</script>
