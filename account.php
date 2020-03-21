<?php

  include('Library DB/db_connect.php');
  session_start();

  $account = $_SESSION['id'];

  $sqlfine = 'INSERT INTO Fine(IssueID, BookID, MemberID, Amount) (SELECT IssueID, BookID, MemberID, 0.5 from Issue where ExpiryDate < CURRENT_DATE())';
  $update = mysqli_query($conn, $sqlfine);

  $sqldelete = 'DELETE FROM Issue where ExpiryDate < CURRENT_DATE()';
  $update2 = mysqli_query($conn, $sqldelete);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Your Account</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link rel="stylesheet" href="css/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

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
      <li><a href="login.php" class="active" id="account">My Account</a></li>
    </ul>
  </div>
</nav>

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
        $sql1 = "SELECT b.BookID, b.Title, b.ISBN, b.Image, i.IssueDate, i.ExpiryDate FROM book b, issue i WHERE b.BookID = i.BookID AND MemberID ='".$account['MemberID']."' ";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) == 0) {
          echo "You have no loans.";
        } else{
          $loans = mysqli_fetch_all($result1, MYSQLI_ASSOC);
          mysqli_free_result($result1);
          foreach ($loans as $loan) {
          if(isset($loan['BookID'])){?>

    <label>Book Title:</label>

    <?php echo "<img src='".$loan['image']."' />"; ?>
    <p>
      <?php echo htmlspecialchars($loan['Title']); ?>
    </p>

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

    <?php }?>
    <?php }?>
    <?php }?>
  </div>

  <div class="divider"></div>
  <div class="section">
    <h5>Fines</h5>
    <?php $sql2 = "SELECT f.BookID, f.MemberID, f.Amount, i.ExpiryDate, b.BookID, b.ISBN from Fine f, Book b, issue i where f.BookID = b.BookID and f.BookID = i.BookID and f.MemberID = '".$account['MemberID']."' ";
      $result2 = mysqli_query($conn, $sql2);
      if (mysqli_num_rows($result2) == 0) {
        echo "You have no Fines.";
      } else{
        $fines = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        mysqli_free_result($result2);
        foreach ($fines as $afine) {
        if(isset($afine['BookID'])){?>
    <label>Book Title:</label>
    <p>
      <?php echo htmlspecialchars($afine['BookID']);?>
    </p>

    <label>ISBN:</label>
    <p>
      <?php echo htmlspecialchars($afine['ISBN']); ?>
    </p>

    <label>Issue Date:</label>
    <p>
      <?php echo htmlspecialchars($afine['Amount']); ?>
    </p>

    <label>Return By:</label>
    <p>
      <?php echo htmlspecialchars($afine['ExpiryDate']); ?>
    </p>

    <?php }
              }
                }?>
  </div>
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
    <div>
      <img src="<?php echo " DB Images/" . htmlspecialchars($areservation['Image']);?>" alt="Book Image" width="100" height="150">
    </div>

    <p><a href="details.php?id=<?php echo $areservation['BookID'];?>">
        <?php echo htmlspecialchars($areservation['Title']); ?>
    </p></a>
    <p>
      <?php echo htmlspecialchars($areservation['ISBN']); ?>
    </p>
    <p>
      <?php echo htmlspecialchars($areservation['fName']) . " " . htmlspecialchars($areservation['lName']) ; ?>
    </p>
    <p>
      <?php echo htmlspecialchars($areservation['ResExpire']); ?>
    </p>

    <?php }
              }
                }?>

  </div>
  <div class="divider"></div>
  <div class="section">
    <h5>Loan History</h5>
    <?php
      $sql4 = "SELECT b.BookID, b.Title, b.Image, b.ISBN, a.fName, a.lName, r.ReturnDate FROM `book` b, `author` a, `return` r WHERE b.BookID = r.BookID AND b.AUID = a.AUID AND MemberID='".$account['MemberID']."' ";
      $result4 = mysqli_query($conn, $sql4);
      if (mysqli_num_rows($result4) == 0) {
        echo "You have no returns.";
      }else{
        $returns = mysqli_fetch_all($result4, MYSQLI_ASSOC);
        mysqli_free_result($result4);
        foreach ($returns as $return) {
        if(isset($return['BookID'])){?>
    <div>
      <img src="<?php echo " DB Images/" . htmlspecialchars($return['Image']);?>" alt="Book Image" width="100" height="150">
    </div>
    <p><a href="details.php?id=<?php echo $return['BookID'];?>">>
        <?php echo htmlspecialchars($return['BookID']); ?>
    </p></a>
    <p>
      <?php echo htmlspecialchars($return['Title']); ?>
    </p>
    <p>
      <?php echo htmlspecialchars($return['ISBN']); ?>
    </p>
    <p>
      <?php echo htmlspecialchars($return['fName']) . " " . htmlspecialchars($return['lName']) ; ?>
    </p>
    <p>
      <?php echo htmlspecialchars($return['ResExpire']); ?>
    </p>
    <?php }
              }
                }?>

  </div>

</div>
</body>

</html>
