<?php

  include('Library DB/db_connect.php');
  session_start();

      $schqry = $_SESSION['schqry'];
      $resultsnum = $_SESSION['resultnum'];
      $results = $_SESSION['results'];

  if(isset($_POST['apply'])){
    if (isset($_POST['genre'])) {
      $newgenre = $_POST['genre'];
    }else{
    $newgenre = NULL;
   }
   if ($newgenre != NULL) {
    $newgenre = $_POST['genre'];
   }

   if (isset($_POST['author'])) {
     $author = $_POST['author'];
    }else{
     $author = NULL;
    }

    if ($author != NULL) {
     $author = $_POST['author'];
    }

      if($newgenre != "" || $author != ""){
      echo $sql = "SELECT b.BookID, b.Title, b.ISBN, b.Genre, b.Paperback, b.Published, b.Description, a.fName, a.lName from `author` a JOIN `book` b on a.`AUID` = b.`AUID` where b.title LIKE '%$schqry%' AND CONCAT(a.fName, ' ', a.lName) LIKE '%$author%' AND b.Genre LIKE '%$newgenre%'";
      $fltres = mysqli_query($conn, $sql);
      $_SESSION['results'] = array();
      if(mysqli_num_rows($fltres) > 0){
      unset($_SESSION['results']);
      while ($results = mysqli_fetch_all($fltres, MYSQLI_ASSOC)){
            $_SESSION['results'] = $results;
            $_SESSION['resultnum'] = mysqli_num_rows($fltres);

            header('Refresh:0');
      }

      }else{

          echo "<p>Your Search Query has no results</p>";

          }
        mysqli_free_result($fltres);
        }
      }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>
    <?php echo "Search Results for ". $schqry;  ?>
  </title>
  <link rel="stylesheet" href="css/main.css" type="text/css">
  <link rel="stylesheet" href="css/search.css" type="text/css">
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
      <a href="login.php" id="account">My Account</a>
    </div>
  </header>

  <!-- Side Content -->
  <div class="sidecontent">
    <h5 class="sidetitle">Search Filters</h5>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

      <div class="column">
        <label>Paperback</label>
        <select class="section">
          <option>Select a filter...</option>
          <option value="Y">Yes</option>
          <option value="N">No</option>
        </select>
      </div>

      <div class="column">
        <label>Author</label>
        <div class="section">
          <label class="radio-inline">
          <?php
              $sqlauthor = "SELECT DISTINCT fName, lName from `author` JOIN `book` on `author`.AUID = `book`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query = mysqli_query($conn, $sqlauthor);
              $authors = mysqli_fetch_all($query, MYSQLI_ASSOC);
              mysqli_free_result($query);
              foreach($authors as $author) {
              if(isset($author['fName'])){ ?>
          <input type="radio" name="author" value="<?php echo htmlspecialchars($author['fName']) . ' ' . htmlspecialchars($author['lName']) ?>">
          <?php echo htmlspecialchars($author['fName']) . " " . htmlspecialchars($author['lName']) ?>
        </label>
          <?php }
  }?>
        </div>
      </div>

      <div class="column">
        <label>Genre</label>
        <div class="section">
          <?php
            $sqlgenre = "SELECT DISTINCT b.Genre from `book` b JOIN `author` a on b.`AUID` = a.`AUID` where b.title LIKE '%$schqry%' OR a.fname LIKE '%$schqry%' OR a.lname LIKE '%$schqry%'";
            $query = mysqli_query($conn, $sqlgenre);
            $genres = mysqli_fetch_all($query, MYSQLI_ASSOC);
            mysqli_free_result($query);
            foreach ($genres as $genre) {
            if(isset($genre['Genre'])){ ?>
          <input type="radio" name="genre" value="<?php echo htmlspecialchars($genre['Genre']); ?>">
          <?php echo htmlspecialchars($genre['Genre']); ?>
          </input>
          <?php }
          }?>
          </select>
        </div>
      </div>

      <div class="column">
        <label>Year</label>
        <div class="section">

          <?php
              $sqlminyear = "SELECT DISTINCT MIN(Published) from `book` JOIN `author` on `book`.AUID = `Author`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query1 = mysqli_query($conn, $sqlminyear);
              $minyear = mysqli_fetch_row($query1);
              $sqlmaxyear = "SELECT DISTINCT MAX(Published) from `book` JOIN `author` on `book`.AUID = `Author`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query2 = mysqli_query($conn, $sqlmaxyear);
              $maxyear = mysqli_fetch_row($query2);?>

          <input type="range" min"<?php echo htmlspecialchars($minyear[0]) ?>" max ="
          <?php echo htmlspecialchars($maxyear[0]) ?>">
        </div>
      </div>

      <div class="column">
        <button type="submit" name="apply">Apply Filters</button>
      </div>

    </form>


  </div>

  <!-- End Side Content -->

  <div class="content">
    <h2>
      <?php echo "Your search query returned ".$resultsnum." results."; ?>
    </h2>



    <?php

  if(is_array($results)){

      foreach ($results as $result) {
      if(isset($result['BookID'])){ ?>

    <div class="row">
      <h4><a href="details.php?id=<?php echo $result['BookID'];?>">
        <?php echo htmlspecialchars($result['Title']);?>
      </a></h4>
      <h5><i>
          <?php echo "By " . htmlspecialchars($result['fName']) . " " . htmlspecialchars($result['lName']);; ?></i></h5>
      <p>
        <?php echo "ISBN: " . htmlspecialchars($result['ISBN']); ?>
      </p>
      <p>
        <?php echo "[" . htmlspecialchars($result['Published']) . "]"; ?>
      </p>

      <?php  }
    }
}
?>
    </div>

  </div>

</body>

</html>
