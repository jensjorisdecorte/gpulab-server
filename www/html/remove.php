<html>

<?php include("../header.php") ?>

<body>

<?php include("../navbar.php") ?>

<div class="container-fluid">

<?php 
  if (empty($_SERVER['HTTPS'])) {
    include("../gpulab-unsafe.php");
  } else {
    session_start();
    if( isset( $_SESSION["user"] ) ) {
      $id = $_POST["id"];
    include("../gpulab-remove.php");
    } else { 
      session_destroy(); ?>
      <div class="alert alert-warning" role="alert">
        Not authenticated..
      </div>
<?php }
  } ?>

</div>

<?php include("../footer.php"); ?>
</body>
</html>