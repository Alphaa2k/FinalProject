<?php

  $errors = array('search' =>'', 'results'=>'');

  include('Library DB/db_connect.php');

  if(session_start()){
    session_destroy();
  }

  if(isset($_POST['searchbtn'])) {
    if(empty($_POST['search'])){
      $errors['search'] = "<p>This field cannot be left empty.</p>";
    }else{
      $schqry = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT b.*, a.fName, a.lName from Author a JOIN Book b on a.`AUID` = b.`AUID` where b.title LIKE '%$schqry%'";
      $query = mysqli_query($conn, $sql);
      $resultsnum = mysqli_num_rows($query);

      if($resultsnum == 0){
        $errors['results'] = "<p>Your Search Query has returned no results </p>";
      }else{
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        session_start();
        $_SESSION['results'] = $results;
        $_SESSION['schqry'] = $schqry;
        $_SESSION['resultnum'] = $resultsnum;

        header('Location: search.php');
      }
    }
  }

  if(isset($_POST['searchbtndb'])) {
    if(empty($_POST['search'])){
      $errors['search'] = "<p>This field cannot be left empty.</p>";
    }else{
      $schqry = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT * from academicdb WHERE Name LIKE '%$schqry%'";
      $query = mysqli_query($conn, $sql);
      $resultsnum = mysqli_num_rows($query);

      if($resultsnum == 0){
        $errors['results'] = "<p>Your Search Query has returned no results </p>";
      }else{
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        session_start();
        $_SESSION['results'] = $results;
        $_SESSION['schqry'] = $schqry;
        $_SESSION['resultnum'] = $resultsnum;

        header('Location: searchdb.php');
      }
    }
  }

  if(isset($_POST['advbtn'])) {
    if(empty($_POST['allnames']) && empty($_POST['author'])){
      $errors['search'] = "<p>At least one field must be filled.</p>";
    }else{
      if(!empty($_POST['allnames'])){
        $schqry = mysqli_real_escape_string($conn, $_POST['allnames']);
      }else{
          $schqry = NULL;
      }

      if(!empty($_POST['author'])){
        $authorqry = mysqli_real_escape_string($conn, $_POST['author']);
      }else{
        $authorqry = NULL;
      }

      $sql = "SELECT b.*, a.fName, a.lName from Author a JOIN Book b on a.`AUID` = b.`AUID` where b.title LIKE '%$schqry%' AND a.lName LIKE '$authorqry'";
      $query = mysqli_query($conn, $sql);
      $resultsnum = mysqli_num_rows($query);

      if($resultsnum == 0){
        $errors['results'] = "<p>Your Search Query has returned no results </p>";
      }else{
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        session_start();
        $_SESSION['results'] = $results;
        $_SESSION['schqry'] = $schqry;
        $_SESSION['resultnum'] = $resultsnum;
        $_SESSION['authorqry'] = $authorqry;

        header('Location: search.php');
      }
    }
  }?>

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

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });
</script>

<body>

<nav>
  <div class="nav-wrapper purple darken-4">
    <!-- <a href="#!" class="brand-logo center">Logo</a> -->
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="left hide-on-med-and-down">
      <li class="active"><a>Home</a></li>
      <li><a href="accessibility.php">Accessibility</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="#LibraryWeb">Library Website</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="help.php">Help</a></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li><a href="login.php" id="account">My Account</a></li>
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
  <li><a href="login.php" id="account">My Account</a></li>
</ul>


<div class="container">
  <h1>Library Catalogue</h1>

  <p class="welcome">Welcome to the Catalogue Home Page. In here you can search for books, eBooks and Academic Databases free for you to access.
  Please note that if you wish to search for Academic Databases, enter the name of the Database you're looking for (i.e. Engineering Village)
  and click "Search Databases". Otherwise click "Search" or "Advanced Search Books" to find books. If you need help navigating the catalogue,
  please click "Help" on the navigation for a guide on how to use the catalogue.</p>

  <div class="searchcontent">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="helper-text red-text"><?php echo $errors['search'] ?></div>
        <div class="helper-text red-text"><?php echo $errors['results'] ?></div>
        <div class="row">
          <input type="input" class="searchbar" name="search" placeholder="Search Books in the Catalogue">
          <button type="submit" name="searchbtn" id="search" class="waves-effect waves-light btn purple darken-4">Search</button>
          <button type="submit" name="searchbtndb" id="search" class="waves-effect waves-light btn purple darken-4">Search Databases</button>
        </div>
    </form>
    <button data-target="modal1" class="btn modal-trigger purple darken-4">Advanced Search Books</button>

  </div>


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Advanced Search</h4>
      <form class="col s12" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h6 class="left-align">Find Books With...</h6>

        <div class="row">
          <div class="input-field col s12">
            <input id="allnames" type="text" name="allnames">
            <label for="allnames">All of these words:</label>
            <span class="helper-text left-align">Put spaces between words</span>
          </div>

          <div class="input-field col s12">
            <input id="author" type="text" name="author">
            <label for="author">By this Author</label>
            <span class="helper-text left-align">For better results, search for the last name of the author you are looking for.</span>
          </div>

        </div>
    </div>
    <div class="modal-footer">
      <button type="submit" name="advbtn" class="modal-close waves-effect waves-green btn-flat">Search</button>
      </form>
    </div>
  </div>


  <footer>
    <h4>Opening Times</h4>
    <div class="row">

      <div class="col s4 center-align">
        <h6>Library:</h6>
        <p>Monday to Sunday: 24 Hours</p>
      </div>

      <div class="col s4 center-align">
        <h6>Library Help Desk:</h6>
        <p>Monday to Friday: 9am - 9pm</p>
        <p>Saturday and Sunday: 10am - 4pm</p>
      </div>

      <div class="col s4 center-align">
        <h6>IT Help Desk:</h6>
        <p>Monday to Sunday: 8am - Midnight</>
      </div>

    </div>
  </footer>
</div>
</body>

</html>
