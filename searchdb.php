<?php

  include('Library DB/db_connect.php');
  session_start();

      $resultsnum = $_SESSION['resultnum'];
      $results = $_SESSION['results'];

      if(!isset($_SESSION['schqry'])){
        $schqry = 'NULL';
      }else{
        $schqry = $_SESSION['schqry'];
      }
?>
<!DOCTYPE html>

<head>
  <html lang="en" dir="ltr">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/search.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php if($schqry=='NULL'){echo "Search Results";} else {echo "Search Results for " . $schqry;} ;?>
  </title>
</head>

<body>

  <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, {});
  });

  document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems, {});
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
        <li><a href="#help">Help</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php" id="account">My Account</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="index.php">Home</a></li>
    <li><a href="accessibility.php">Accessibility</a></li>
    <li><a href="feedback.php">Feedback</a></li>
    <li><a href="#LibraryWeb">Library Website</a></li>
    <li><a href="#contact">Contact Us</a></li>
    <li><a href="#help">Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
   </ul>


  <a class="waves-effect waves-light btn" href="index.php"><i class="material-icons left">arrow_back</i>Back to Search</a>
  <div class="row">
    <div class="col s3 grey lighten-3">
      <!-- Grey navigation panel -->
      <h5 class="sidetitle">Search Filters</h5>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="divider"></div>
        <div class="section">
        <?php
          $sqlpaperback = "SELECT DISTINCT b.Paperback from Book b JOIN Author a on b.AUID = a.AUID where b.title LIKE '%$schqry%' OR a.lName LIKE '$authorqry'";
          $query = mysqli_query($conn, $sqlpaperback);
          $paperback = mysqli_fetch_all($query, MYSQLI_ASSOC);
          ?>
          <h5>Paperback</h5>
          <p>
            <label>
              <input class="with-gap" name="group1" type="radio" value="Y" <?php if(mysqli_num_rows($query)==1){echo "disabled";}; ?> />
              <span>Yes</span>
            </label>
          </p>
          <p>
            <label>
              <input class="with-gap" name="group1" type="radio" value="N" <?php if(mysqli_num_rows($query)==1){echo "disabled";}; ?> />
              <span>No</span>
            </label>
          </p>
        <?php mysqli_free_result($query); ?>
        </div>
        <div class="divider"></div>
        <div class="section">
          <h5>Book Type</h5>
          <?php
            $sqlformat = "SELECT DISTINCT b.Format from `book` b JOIN `author` a on b.`AUID` = a.`AUID` where b.title LIKE '%$schqry%' OR a.lName LIKE '$authorqry'";
            $query = mysqli_query($conn, $sqlformat);
            $formats = mysqli_fetch_all($query, MYSQLI_ASSOC);
            foreach ($formats as $format) {
            if(isset($format['Format'])){ ?>

            <p>
              <label>
                <input class="with-gap" name="group4" type="radio" value="<?php echo htmlspecialchars($format['Format'])?>" <?php if(mysqli_num_rows($query)==1){ echo "disabled";}; ?>/>
                  <span><?php echo htmlspecialchars($format['Format'])?></span>
              </label>
            </p>

          <?php }
            }
          mysqli_free_result($query);?>

        </div>
        <div class="divider"></div>
        <div class="section">
          <h5>Author</h5>
          <label class="radio-inline">
            <?php
              $sqlauthor = "SELECT DISTINCT fName, lName from `author` JOIN `book` on `author`.AUID = `book`.AUID where `book`.Title LIKE '%$schqry%' OR lName LIKE '$authorqry'";
              $query = mysqli_query($conn, $sqlauthor);
              $authors = mysqli_fetch_all($query, MYSQLI_ASSOC);

              foreach($authors as $author) {
              if(isset($author['fName'])){ ?>

                <p>
                  <label>
                    <input class="with-gap" name="group2" type="radio" value="<?php echo htmlspecialchars($author['fName']) . " " . htmlspecialchars($author['lName']) ?>" <?php if(mysqli_num_rows($query)==1){ echo "disabled";}; ?> />
                      <span><?php echo htmlspecialchars($author['fName']) . " " . htmlspecialchars($author['lName']) ?></span>
                  </label>
                </p>

            <?php }
                }
            mysqli_free_result($query);?>

        </div>
        <div class="divider"></div>
        <div class="section">
          <h5>Genre</h5>
          <?php
            $sqlgenre = "SELECT DISTINCT b.Genre from `book` b JOIN `author` a on b.`AUID` = a.`AUID` where b.title LIKE '%$schqry%' OR a.lName LIKE '$authorqry'";
            $query = mysqli_query($conn, $sqlgenre);
            $genres = mysqli_fetch_all($query, MYSQLI_ASSOC);

            foreach ($genres as $genre) {
            if(isset($genre['Genre'])){ ?>

            <p>
              <label>
                <input class="with-gap" name="group3" type="radio" value="<?php echo htmlspecialchars($genre['Genre'])?>" <?php if(mysqli_num_rows($query)==1){ echo "disabled";}; ?>/>
                  <span><?php echo htmlspecialchars($genre['Genre'])?></span>
              </label>
            </p>

          <?php }
            }
          mysqli_free_result($query);?>
        </div>

        <div class="divider"></div>
        <div class="section">
          <h5>Year</h5>
          <div class="input-field col s12">
            <select>
              <option value="" disabled selected>Choose your option</option>
            <?php
              $sqlyear = "SELECT DISTINCT b.Published FROM `book` b JOIN author a on b.AUID=a.AUID where `book`.Title LIKE '%$schqry%' OR a.lName LIKE '$authorqry' ORDER BY Published DESC";
              $query = mysqli_query($conn, $sqlyear);
              $years = mysqli_fetch_all($query, MYSQLI_ASSOC);

              foreach($years as $year) {
              if(isset($year['Published'])){ ?>
                <option name="year" value="<?php echo htmlspecialchars($year['Published']); ?>"  <?php if(mysqli_num_rows($query)==1){ echo "disabled";}; ?>><?php echo htmlspecialchars($year['Published']); ?></option>
            <?php }
                }
            mysqli_free_result($query);?>
            </select>
          </div>
          <button type="submit" name="apply">Apply Filters</button>
        </div>
      </form>
    </div>


    <div class="col s9">
        <h3>
          <?php echo "Your search query returned ".$resultsnum." results."; ?>
        </h3>

        <?php

  if(is_array($results)){

      foreach ($results as $result) {
      if(isset($result['ID'])){ ?>


    <div class="row">

        <div class="col s2">
          <img src="<?php echo " DB Images/" . htmlspecialchars($result['Image']);?>" class="responsive-img" alt="Book Image">
        </div>

        <div class="col s10">
          <h4><a href="detailsdb.php?id=<?php echo $result['ID'];?>">
            <?php echo htmlspecialchars($result['Name']);?>
          </a></h4>
          <p><?php echo htmlspecialchars($result['Description']); ?></p>
        </div>
      </div>
          <?php  }
                  }
                    }?>
    </div>
  </div>

</body>
</html>
