<?php

  $errors = array('field' =>'', 'user'=>'');

  include('Library DB/db_connect.php');
  if(session_start()){
    session_destroy();
  }

  if(isset($_POST['login'])){

    if(empty($_POST['user'])){
      $errors['field'] = "This field cannot be left empty.";
    }else{
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $sql = "SELECT * from Member where MemberID = $user";
      $result = mysqli_query($conn, $sql);
      if ($result == false) {
        $errors['user'] = "Unknown User, please try again.";
      }elseif(mysqli_num_rows($result) == 0){
        $errors['user'] = "Unknown User, please try again.";
      }else{
        session_unset();
        $id = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        session_start();
        $_SESSION['id'] = $id;
        header('Location: account.php');
      }
    }
  }


?>
<!DOCTYPE html>

<head>
  <html lang="en" dir="ltr">
  <title>Library Catalogue Login</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link rel="stylesheet" href="css/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
var elems = document.querySelectorAll('.sidenav');
var instances = M.Sidenav.init(elems, {});
});
</script>

<nav>
  <div class="nav-wrapper purple darken-4">
    <!-- <a href="#!" class="brand-logo center">Logo</a> -->
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="left hide-on-med-and-down">
      <li><a href="index.php">Home</a></li>
      <li><a href="accessibility.php">Accessibility</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="#LibraryWeb">Library Website</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="help.php">Help</a></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li class="active"><a id="account">My Account</a></li>
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
  <li class="active"><a>Home</a></li>
  <li><a href="accessibility.php">Accessibility</a></li>
  <li><a href="feedback.php">Feedback</a></li>
  <li><a href="#LibraryWeb">Library Website</a></li>
  <li><a href="#contact">Contact Us</a></li>
  <li><a href="help.php">Help</a></li>
  <li class="active"><a id="account">My Account</a></li>
 </ul>
<div class="container">

  <div class="row">

    <h1>Library Catalogue - My Account</h1>

    <p>Enter your Library Number to log in and access your information.</p>

    <form class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="helper-text red-text"><?php echo $errors['field']; ?></div>
      <div class="helper-text red-text"><?php echo $errors['user'];  ?></div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" name="user">
          <label for="user" class="active">Library Number</label>
        </div>
      </div>
      <button type="submit" name="login" class="waves-effect waves-light btn purple darken-4">Login</button>
    </form>
  </div>
</div>



</body>

</html>
