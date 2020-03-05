<?php

  include('Library DB/db_connect.php');

  if(isset($_POST['searchbtn'])) {
    if(empty($_POST['search'])){
      echo "<p>This field cannot be left empty.</p>";
    }else{
      $schqry = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT b.Title, b.ISBN, b.Genre, b.Paperback, b.Published, b.Description, a.fName, a.lName from `author` a JOIN `book` b on a.`AUID` = b.`AUID` where b.title LIKE '%$schqry%' OR a.fname LIKE '%$schqry%' OR a.lname LIKE '%$schqry%'";
      $query = mysqli_query($conn, $sql);
      $resultsnum = mysqli_num_rows($query);

      if($resultsnum == 0){
        echo "<p>Your Search Query has returned no results </p>";
      }else{
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        session_start();
        $_SESSION['results'] = $results;
        $_SESSION['schqry'] = $schqry;
        $_SESSION['resultnum'] = $resultsnum;

        mysqli_free_result($results);
        header('Location: search.php');
      }
    }
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>University of Portsmouth - Library Catalogue</title>
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/main.css" type="text/css">
</head>

<body>
  <header>
    <div class="nav">
      <a class="live">Home</a>
      <a href="accessibility.php">Accessibility</a>
      <a href="feedback.php">Feedback</a>
      <a href="#LibraryWeb">Library Website</a>
      <a href="#contact">Contact Us</a>
      <a href="#help">Help</a>
      <a href="login.php" id="account">My Account</a>
    </div>
  </header>

  <h1>Library Catalogue</h1>

  <div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="input" class="searchbar" name="search" placeholder="Search the Catalogue">
      <button type="submit" name="searchbtn" id="search">Search</button>

      <button type="button" name="button" id="Adv">Advanced Search</button>
    </form>
  </div>

  <footer>
    <h2>Opening Times</h2>

    <h3>Library:</h3>
    <li>Monday to Sunday: 24 Hours</li>

    <h3>Library Help Desk:</h3>
    <li>Monday to Friday: 9am - 9pm</li>
    <li>Saturday and Sunday: 10am - 4pm</li>

    <h3>IT Help Desk:</h3>
    <li>Monday to Sunday: 8am - Midnight</li>

  </footer>
</body>

</html>
