<html>

<?php include("../header.php") ?>

<body>

<?php include("../navbar.php") ?>

<div class="container-fluid">

<?php 
  if (empty($_SERVER['HTTPS'])) {
    include("../gpulab-unsafe.php");
  } else {
    if($_POST["user"] == getenv("GPULAB_SERVER_USER") && password_verify($_POST["pass"], fgets(fopen("/etc/pass/pass.txt", 'r')))) {
      session_set_cookie_params ( $lifetime = 5 * 24 * 60 * 60 );
      session_start();
      $_SESSION["user"] = $_POST["user"];
      include("../gpulab-index.php");
    } else { ?>
      <form method="POST" action="index.php">
              User <input type="text" name="user"/><br/>
              Pass <input type="password" name="pass"/><br/>
              <input type="submit" name="submit" value="Go"/>
              </form>
<?php }
  } ?>

</div>

<?php include("../footer.php"); ?>
</body>
</html>