<html>
<?php include("../start_script.php") ?>
<?php include("../header.php"); ?>
<script>
  // Set the default CSS theme and icon library globally
  JSONEditor.defaults.theme = 'bootstrap4';
  JSONEditor.defaults.iconlib = 'fontawesome5';
</script>

<body>

<?php include("../navbar.php"); ?>

<div class="container-fluid">

<?php 
  session_start();
  if( isset( $_SESSION["user"] ) ) {
    include("../gpulab-new.php");
  } else { 
    session_destroy(); ?>
    <div class="alert alert-warning" role="alert">
      Not authenticated..
    </div>
<?php } ?>

</div>

<?php include("../footer.php"); ?>
</body>
</html>