<html>
<?php include("../start_script.php") ?>
<?php include("../header.php"); ?>

<body>

<?php include("../navbar.php"); ?>

<div class="container-fluid">

<?php 
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
<?php } ?>

</div>

<?php include("../footer.php"); ?>
</body>
</html>