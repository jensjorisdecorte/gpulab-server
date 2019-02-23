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
      $name = $_POST["name"];
      $descr = $_POST["description"];
      include("../gpulab-create.php");
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