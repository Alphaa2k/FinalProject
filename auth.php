<?php

  include('Library DB/db_connect.php');
  session_start();

  if(isset($_POST['login'])){

    if(empty($_POST['user'])){
      echo "This field cannot be left empty.";
    }else{
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $sql = "SELECT * from Member where MemberID = $user";
      $result = mysqli_query($conn, $sql);
      if ($result == false) {
        echo "Unknown User, please try again.";
      }elseif(mysqli_num_rows($result) == 0){
        echo "Unknown User, please try again.";
      }else{
        $id = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $_SESSION['id'] = $id;
        header('Location: ' . $_SESSION['referer']);
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<nav>
  <div class="nav-wrapper purple darken-4">
    <!-- <a href="#!" class="brand-logo center">Logo</a> -->
    <ul class="left hide-on-med-and-down">
      <li><a href="index.php">Home</a></li>
      <li><a href="accessibility.php">Accessibility</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="#LibraryWeb">Library Website</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="#help">Help</a></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li><a href="login.php" class="active" id="account">My Account</a></li>
    </ul>
  </div>
</nav>

<div class="container">

  <div class="row">

    <h1>You will need to Login First</h1>

    <p>Please enter your Library Number before continuing.</p>

    <form class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input type="text" name="user">
          <label for="user" class="active">Library Number</label>
        </div>
      </div>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</div>



</body>

</html>
