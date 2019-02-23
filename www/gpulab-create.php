<?php
$out = array();
$job_prefix = getenv("GPULAB_SERVER_JOB_PREFIX");
exec("/etc/scripts/submit_job.sh '".$job_prefix.$name."' '".$descr."' 2>&1", $out);
foreach($out as $line) {
    echo $line;
}
?>

<div class="alert alert-success" role="alert">
  Wait while the job is submitted..
</div>

<script type="text/javascript">setTimeout("window.close();", 2000);</script>
