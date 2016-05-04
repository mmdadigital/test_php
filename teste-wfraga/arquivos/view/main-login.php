<?php
  session_start();

  if(isset($_SESSION['username'])){
    header("location:/index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
    
<?php include '../includes/head.inc';?>

  <body>
    <div class="container">

      <form class="form-signin" name="form1" method="post" action="/controller/checklogin.php">
        <h2 class="form-signin-heading">Formulário de login</h2>
        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <!-- The checkbox remember me is not implemented yet...
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
  </body>
</html>
