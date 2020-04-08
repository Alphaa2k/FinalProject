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
        <li><a href="help.php">Help</a></li>
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
    <li><a href="help.php">Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
   </ul>

  <a class="waves-effect waves-light btn purple darken-4" href="index.php"><i class="material-icons left">arrow_back</i>Back to Search</a>
  <div class="row">
    <div class="col s3 grey lighten-3">
      <!-- Grey navigation panel -->
      <h5 class="sidetitle">Search Filters</h5>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="divider"></div>
        <div class="section">

          <h5>Academic Datbase</h5>
          <p>
            <label>
              <input class="with-gap" name="group1" type="radio" value="Y" disabled/>
              <span>All</span>
            </label>
          </p>
        </div>
          <button type="submit" name="apply" class="waves-effect waves-light btn purple darken-4" disabled>Apply Filters</button>
          <button type="submit" name="apply" class="waves-effect waves-light btn purple darken-4" disabled>Clear Filters</button>
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
