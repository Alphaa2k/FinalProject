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

<head>
  <html lang="en" dir="ltr">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/search.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php echo "Search Results for ". $schqry;?>
  </title>
</head>

<body>

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
        <li><a href="login.php" id="account">My Account</a></li>
      </ul>
    </div>
  </nav>



  <div class="row">
    <div class="col s3">
      <!-- Grey navigation panel -->
      <h5 class="sidetitle">Search Filters</h5>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="divider"></div>
        <div class="section">
          <h5>Paperback</h5>
          <p>
            <label>
              <input class="with-gap" name="group1" type="radio" value="Y" />
              <span>Yes</span>
            </label>
          </p>
          <p>
            <label>
              <input class="with-gap" name="group1" type="radio" value="N" />
              <span>No</span>
            </label>
          </p>
        </div>
        <div class="divider"></div>
        <div class="section">
          <h5>Author</h5>
          <label class="radio-inline">
            <?php
              $sqlauthor = "SELECT DISTINCT fName, lName from `author` JOIN `book` on `author`.AUID = `book`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query = mysqli_query($conn, $sqlauthor);
              $authors = mysqli_fetch_all($query, MYSQLI_ASSOC);
              mysqli_free_result($query);
              foreach($authors as $author) {
              if(isset($author['fName'])){ ?>

                <p>
                  <label>
                    <input class="with-gap" name="group2" type="radio" value="<?php echo htmlspecialchars($author['fName']) . " " . htmlspecialchars($author['lName']) ?>"/>
                      <span><?php echo htmlspecialchars($author['fName']) . " " . htmlspecialchars($author['lName']) ?></span>
                  </label>
                </p>

          <?php }
                }?>
        </div>
        <div class="divider"></div>
        <div class="section">
          <h5>Genre</h5>
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

        <div class="divider"></div>
        <div class="section">
          <h5>Year</h5>
          <div data-role="form-price-range-filter">
            <?php
              $sqlminyear = "SELECT DISTINCT MIN(Published) from `book` JOIN `author` on `book`.AUID = `Author`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query1 = mysqli_query($conn, $sqlminyear);
              $min = mysqli_fetch_row($query1);
              $sqlmaxyear = "SELECT DISTINCT MAX(Published) from `book` JOIN `author` on `book`.AUID = `Author`.AUID where `book`.Title LIKE '%$schqry%' OR `author`.fName LIKE '%$schqry%' OR `author`.`lName` LIKE '%$schqry%'";
              $query2 = mysqli_query($conn, $sqlmaxyear);
              $max = mysqli_fetch_row($query2);?>
          </div>
          <button type="submit" name="apply">Apply Filters</button>
        </div>
      </form>
    </div>

    <div class="col s9">
      <div class="content">
        <h2>
          <?php echo "Your search query returned ".$resultsnum." results."; ?>
        </h2>

        <?php

  if(is_array($results)){

      foreach ($results as $result) {
      if(isset($result['BookID'])){ ?>

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
    </div>

</body>

</html>
