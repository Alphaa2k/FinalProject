<?php

  include('Library DB/db_connect.php');

  if(isset($_POST['searchbtn'])) {
    if(empty($_POST['search'])){
      echo "<p>This field cannot be left empty.</p>";
    }else{
      $schqry = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT b.BookID, b.Title, b.ISBN, b.Genre, b.Paperback, b.Published, b.Description, a.fName, a.lName from `author` a JOIN `book` b on a.`AUID` = b.`AUID` where b.title LIKE '%$schqry%'";
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
  <title>University of Portsmouth - Library Catalogue</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/index.css">
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
    <ul class="left hide-on-med-and-down">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <li><a class="active">Home</a></li>
      <li><a href="accessibility.php">Accessibility</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="#LibraryWeb">Library Website</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="#help">Help</a></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li><a href="login.php" id="account">My Account</a></li>
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
  <li><a class="active">Home</a></li>
  <li><a href="accessibility.php">Accessibility</a></li>
  <li><a href="feedback.php">Feedback</a></li>
  <li><a href="#LibraryWeb">Library Website</a></li>
  <li><a href="#contact">Contact Us</a></li>
  <li><a href="#help">Help</a></li>
  <li><a href="login.php" id="account">My Account</a></li>
 </ul>


<div class="container">


  <h1>Library Catalogue</h1>

  <div class="searchcontent">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="input" class="searchbar" name="search" placeholder="Search Books in the Catalogue">
      <button type="submit" name="searchbtn" id="search">Search</button>

      <button type="button" name="button" id="Adv">Advanced Search</button>
    </form>
  </div>

  <footer>
    <h4>Opening Times</h4>
    <div class="row">

    <div class="col s4">
      <h6>Library:</h6>
      <p>Monday to Sunday: 24 Hours</p>
    </div>

    <div class="col s4">
      <h6>Library Help Desk:</h6>
      <p>Monday to Friday: 9am - 9pm</p>
      <p>Saturday and Sunday: 10am - 4pm</p>
    </div>

    <div class="col s4">
      <h6>IT Help Desk:</h6>
      <li>Monday to Sunday: 8am - Midnight</li>
    </div>

      </div>
  </footer>
    </div>
</body>

</html>
