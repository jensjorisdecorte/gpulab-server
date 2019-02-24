<?php

file_put_contents("/etc/jobs/job.json", $json, LOCK_EX);

$command = "export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli submit --wait-run --project=".getenv("GPULAB_SERVER_PROJECT")." < /etc/jobs/job.json 2>&1";

$out = array();
exec($command, $out);
echo $out;
foreach($out as $line) {
    echo $line;
}
?>

<div class="alert alert-success" role="alert">
  Wait while the job is submitted..
</div>

<script type="text/javascript">setTimeout("window.close();", 2000);</script>
