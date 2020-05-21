<?php

  include('Library DB/db_connect.php');
  session_start();

  $account = $_SESSION['id'];

  $sqlfine = 'INSERT INTO Fine(IssueID, BookID, MemberID, Amount) (SELECT IssueID, BookID, MemberID, 0.5 from Issue where ExpiryDate < CURRENT_DATE())';
  $update = mysqli_query($conn, $sqlfine);

  $sqldelete = 'DELETE FROM Issue where ExpiryDate < CURRENT_DATE()';
  $update2 = mysqli_query($conn, $sqldelete);

  $sqlremoveres = "DELETE FROM Reservation where ResExpire < CURRENT_DATE()";
  $update3 = mysqli_query($conn, $sqlremoveres);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Your Account</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
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
      <li class="active"><a href="login.php" id="account">My Account</a></li>
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
  <li class="active"><a href="login.php" id="account">My Account</a></li>
</ul>

<div class="container">

  <?php if($account): ?>
  <h4>
    <?php echo "Hello, " . htmlspecialchars($account['fName']) . " " . htmlspecialchars($account['lName'] . "!"); ?>
  </h4>
  <?php else: ?>
  <h4>
    <?php echo "Hello World!"; ?>
  </h4>
  <?php endif; ?>





  <div class="divider"></div>
  <div class="section">
    <h5>Loans</h5>
    <?php
        $sql1 = "SELECT b.BookID, b.Title, b.ISBN, b.Image, i.IssueDate, i.ExpiryDate FROM Book b, Issue i WHERE b.BookID = i.BookID AND MemberID ='".$account['MemberID']."' ";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) == 0) {
          echo "You have no loans.";
        } else{
          $loans = mysqli_fetch_all($result1, MYSQLI_ASSOC);
          mysqli_free_result($result1);
          foreach ($loans as $loan) {
          if(isset($loan['BookID'])){?>

    <div class="row">
      <div class="col s2">
        <img src="<?php echo " DB Images/" . htmlspecialchars($loan['Image']);?>" alt="Book Image" class="responsive-img">
      </div>

      <div class="col s10">
        <label>Title:</label>
        <h6><a href="details.php?id=<?php echo $loan['BookID'];?>">
            <?php echo htmlspecialchars($loan['Title']);?>
          </a></h6>

        <label>ISBN:</label>
        <p>
          <?php echo htmlspecialchars($loan['ISBN']); ?>
        </p>

        <label>Issue Date:</label>
        <p>
          <?php echo htmlspecialchars($loan['IssueDate']); ?>
        </p>

        <label>Return By:</label>
        <p>
          <?php echo htmlspecialchars($loan['ExpiryDate']); ?>
        </p>
      </div>
    </div>

    <?php }
            }
              }?>
  </div>

  <div class="divider"></div>
  <div class="section">
    <h5>Fines</h5>
    <?php $sql2 = "SELECT f.BookID, b.Title, b.ISBN, b.Image, i.ExpiryDate, f.Amount from Fine f, Book b, Issue i where i.IssueID = f.IssueID and f.BookID = b.BookID and f.MemberID = i.MemberID and f.MemberID = '".$account['MemberID']."' ";
      $result2 = mysqli_query($conn, $sql2);
      if(mysqli_num_rows($result2) == 0) {
        echo "You have no Fines.";
      }else{
        $fines = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        mysqli_free_result($result2);
        foreach ($fines as $afine) {
        if(isset($afine['BookID'])){?>

    <div class="row">
      <div class="col s2">
        <img src="<?php echo " DB Images/" . htmlspecialchars($afine['Image']);?>" class="responsive-img" alt="Book Image">
      </div>

      <div class="col s10">

        <label>Title</label>
        <h6><a href="details.php?id=<?php echo $afine['BookID'];?>">
            <?php echo htmlspecialchars($afine['Title']);?>
          </a></h6>

        <label>ISBN:</label>
        <p>
          <?php echo htmlspecialchars($afine['ISBN']); ?>
        </p>

        <label>Amount Owed:</label>
        <p>
          <?php echo "£ " . round(htmlspecialchars($afine['Amount']),2); ?>
        </p>

        <label>Return Date:</label>
        <p>
          <?php echo htmlspecialchars($afine['ExpiryDate']); ?>
        </p>

      </div>
    </div>
    <?php }
              }
                }?>

    <div class="divider"></div>
    <div class="section">
      <h5>Reservations</h5>
      <?php
        $sql3 = "SELECT b.BookID, b.Title, b.Image, b.ISBN, a.fName, a.lName, r.ResExpire FROM Book b, Author a, Reservation r WHERE b.BookID = r.BookID and b.AUID = a.AUID and MemberID='".$account['MemberID']."' ";
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3) == 0) {
          echo "You have no Reservations.";
        }else{
          $reservations = mysqli_fetch_all($result3, MYSQLI_ASSOC);
          mysqli_free_result($result3);
          foreach ($reservations as $areservation) {
          if(isset($areservation['BookID'])){?>
      <div class="row">
        <div class="col s2">
          <img src="<?php echo " DB Images/" . htmlspecialchars($areservation['Image']);?>" alt="Book Image" class="responsive-img">
        </div>

        <div class="col s10">

          <label>Title:</label>
          <h6><a href="details.php?id=<?php echo $areservation['BookID'];?>">
              <?php echo htmlspecialchars($areservation['Title']); ?>
          </h6></a>

          <label>ISBN:</label>
          <p>
            <?php echo htmlspecialchars($areservation['ISBN']); ?>
          </p>

          <label>By:</label>
          <p>
            <?php echo htmlspecialchars($areservation['fName']) . " " . htmlspecialchars($areservation['lName']) ; ?>
          </p>

          <label>Reservation Expires on:</label>
          <p>
            <?php echo htmlspecialchars($areservation['ResExpire']); ?>
          </p>

        </div>
      </div>
      <?php }
              }
                }?>

    </div>
    <div class="divider"></div>
    <div class="section">
      <h5>Loan History</h5>
      <?php
      $sql4 = "SELECT b.BookID, b.Title, b.Image, b.ISBN, a.fName, a.lName, h.ReturnDate FROM Book b, Author a, History h WHERE b.BookID = h.BookID AND b.AUID = a.AUID AND h.MemberID='".$account['MemberID']."' ";
      $result4 = mysqli_query($conn, $sql4);
      if (mysqli_num_rows($result4) == 0) {
        echo "You have not returned any loaned books.";
      }else{
        $returns = mysqli_fetch_all($result4, MYSQLI_ASSOC);
        mysqli_free_result($result4);
        foreach ($returns as $return) {
        if(isset($return['BookID'])){?>


      <div class="row">
        <div class="col s2">
          <img src="<?php echo " DB Images/" . htmlspecialchars($return['Image']);?>" alt="Book Image" class="responsive-img">
        </div>

        <div class="col s10">

          <label>Title:</label>
          <h6><a href="details.php?id=<?php echo $return['BookID'];?>">
              <?php echo htmlspecialchars($return['Title']); ?>
          </h6></a>
          <p>
          </p>

          <label>ISBN:</label>
          <p>
            <?php echo htmlspecialchars($return['ISBN']); ?>
          </p>

          <label>By:</label>

          <p>
            <?php echo htmlspecialchars($return['fName']) . " " . htmlspecialchars($return['lName']) ; ?>
          </p>

          <label>Date Returned:</label>
          <p>
            <?php echo htmlspecialchars($return['ReturnDate']); ?>
          </p>

        </div>
      </div>
      <?php }
              }
                }?>


    </div>
    </body>

</html>
