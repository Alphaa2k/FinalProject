<?php

  include('Library DB/db_connect.php');

  if(isset($_POST['login'])){

    if(empty($_POST['user'])){
      echo "This field cannot be left empty.";
    }else{
      $user =  ($_POST['user']);
      $sql = "SELECT * from Member where MemberID = $user";
      $result = mysqli_query($conn, $sql);

        if ($result == false) {
          echo "Unknown User, please try again.";
        }elseif(mysqli_num_rows($result) == 0){
          echo "Unknown User, please try again.";
        }else{
        $id = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        print_r($id);
        session_start();
        $_SESSION['id'] = $id;
        header('Location: account.php');
      }
    }
  }


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="stylesheet" href="css/login.css" type="text/css">
<head>
  <meta charset="utf-8">
  <title>Library Catalogue Login</title>
</head>

<body>

  <header>
    <div class="nav">
      <a href="index.php">Home</a>
      <a href="accessibility.php">Accessibility</a>
      <a href="feedback.php">Feedback</a>
      <a href="#LibraryWeb">Library Website</a>
      <a href="#contact">Contact Us</a>
      <a href="#help">Help</a>
      <a class="live" id="account">My Account</a>
    </div>
  </header>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div>
      <label for="user">Username</label>
      <input type="text" placeholder="Student Number" name="user" id="user">
    </div>
    <button type="submit" name="login">Login</button>
  </form>

</body>

</html>
