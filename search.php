<?php

  session_start();

  $schqry = $_SESSION['schqry'];
  $resultsnum = $_SESSION['resultnum'];
  $results = $_SESSION['results'];

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>
    <?php echo "Search Results for ". $schqry;  ?>
  </title>
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
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


  <h2>
    <?php echo "Your search query returned ".$resultsnum." results."; ?>
  </h2>

      <?php

      foreach ($results as $result) {
        if(isset($result['Title'])){ ?>

        <div class="section">
          <h4><?php echo htmlspecialchars($result['Title']);?></h4>
          <h5><i><?php echo "By " . htmlspecialchars($result['fName']) . " " . htmlspecialchars($result['lName']);; ?></i></h5>
          <p><?php echo "ISBN: " . htmlspecialchars($result['ISBN']); ?></p>
          <p><?php echo "[" . htmlspecialchars($result['Published']) . "]"; ?></p>

    <?php  }
    } ?>


</body>

</html>
