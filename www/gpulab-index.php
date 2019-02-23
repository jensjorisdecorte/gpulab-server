<?php
$out = array();
exec("export LC_ALL=C.UTF-8; export LANG=C.UTF-8; GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli jobs 2>&1", $out);

$jobcount = count($out)-1;
?>

<script type="text/javascript">
  function openContainer(id) {
    var url = '/open.php';
    var form = $('<form action="' + url + '" method="post" target="_blank">' +
      '<input type="text" name="id" value="' + id + '" />' +
      '</form>');
    $('body').append(form);
    form.submit();
    $('form').remove();
  }

  function cancelContainer(id) {
    var url = '/cancel.php';
    var form = $('<form action="' + url + '" method="post" target="_blank">' +
      '<input type="text" name="id" value="' + id + '" />' +
      '</form>');
    $('body').append(form);
    form.submit();
    $('form').remove();
  }

  function removeContainer(id) {
    var url = '/remove.php';
    var form = $('<form action="' + url + '" method="post" target="_blank">' +
      '<input type="text" name="id" value="' + id + '" />' +
      '</form>');
    $('body').append(form);
    form.submit();
    $('form').remove();
  }


  function openNewContainer() {
    var url = '/new.php';
    var form = $('<form class="temporary" action="' + url + '" method="post" target="_blank"></form>');
    $('body').append(form);
    form.submit();
    $('form').remove();
  }

</script>

<button type="button" class="btn btn-primary" style="margin:10px;">
  <span class="badge badge-light"><?php echo $jobcount;?></span> jobs
</button>

<table class="table table-hover	">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Task ID</th>
      <th scope="col">Name</th>
      <th scope="col">Command</th>
      <th scope="col">Created</th>
      <th scope="col">User</th>
      <th scope="col">Project</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach(array_slice($out,1) as $line) {
        $line = preg_replace('!\s+!', ' ', $line);
        $parts = explode(" ", $line);?>
    <tr>
      <th scope="row"><?php echo $parts[0]; ?></th>
      <td><?php echo $parts[1]; ?></td>
      <td><?php echo $parts[2]; ?></td>
      <td><?php echo $parts[3]; ?></td>
      <td><?php echo $parts[4]; ?></td>
      <td><?php echo $parts[5]; ?></td>
      <td><?php echo $parts[6]; ?></td>
      <td>
       <div class="btn-group" role="group" aria-label="actions">
         <button type="button" onclick="openContainer('<?php echo $parts[0]; ?>')"class="btn btn-success" <?php if(!in_array($parts[6], array("RUNNING", "STARTING"))) echo "disabled"; ?>>Open</button>
         <button type="button" onclick="cancelContainer('<?php echo $parts[0]; ?>')"class="btn btn-warning" <?php if(!in_array($parts[6], array("RUNNING", "STARTING"))) echo "disabled"; ?>>Cancel</button>
         <button type="button" onclick="removeContainer('<?php echo $parts[0]; ?>')"class="btn btn-danger" <?php if(in_array($parts[6], array("RUNNING", "STARTING"))) echo "disabled"; ?>>Remove</button>
        </div>
      </td>
    </tr>
    <?php  }
    ?>
  </tbody>
</table>

<button type="button" onclick="openNewContainer()" class="btn btn-success" style="margin:10px;">
  New container
</button>

<script>
var blurred = false;
window.onblur = function() { blurred = true; };
window.onfocus = function() { blurred && (location.reload()); };
</script>

