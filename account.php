<?php

  include('Library DB/db_connect.php');
  session_start();

  $account = $_SESSION['id'];

  $sqlfine = 'INSERT INTO Fine(IssueID, BookID, MemberID, Amount) SELECT IssueID, BookID, MemberID, 0.5 from Issue where ExpiryDate < CURRENT_DATE()';
  $update = mysqli_query($conn, $sqlfine);

  if (!$update) {
    echo "Query Failed";
  }else{
    echo "Query Complete";
}
  $sqldelete = 'DELETE FROM Issue where ExpiryDate < CURRENT_DATE()';
  $update2 = mysqli_query($conn, $sqldelete);

  if (!$update2) {
    echo "Query Failed";
    echo "error " . mysqli_error($conn);
  }else{
    echo "Issued Book Moved successfully";
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Your Account</title>
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/account.css" type="text/css">
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

  <div class="welcome">
    <?php if($account): ?>
    <h4>
      <?php echo "Hello, " . htmlspecialchars($account['fName']) . " " . htmlspecialchars($account['lName'] . "!"); ?>
    </h4>
    <?php else: ?>
    <h4>
      <?php echo "Hello World!"; ?>
    </h4>
    <?php endif; ?>
  </div>

  <div class="tab">
    <button type="tablink">Loans</button>
    <button type="tablink">Charges</button>
    <button type="tablink">Reservations</button>
    <button type="tablink">Loan History</button>
  </div>

  <div id="Loans" class="tabcontent">
    <h5>Loans</h5>

    <div class="row">
      <?php
        $sql1 = "SELECT b.BookID, b.Title, b.ISBN, i.IssueDate, i.ExpiryDate FROM book b, issue i WHERE b.BookID = i.BookID AND MemberID ='".$account['MemberID']."' ";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) == 0) {
          echo "You have no loans.";
        } else{
          $loans = mysqli_fetch_all($result1, MYSQLI_ASSOC);
          mysqli_free_result($result1);
          foreach ($loans as $loan) {
          if(isset($loan['BookID'])){

        ?>

      <label>Book Title:</label>
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
  </div>


  <div id="Charges" class="tabcontent">
    <h5>Charges</h5>

    <div class="row">

      <?php

        $sql2 = "SELECT f.BookID, f.MemberID, f.Amount, b.BookID, b.ISBN from Fine f, Book b where f.BookID = b.BookID and f.MemberID = '".$account['MemberID']."' ";
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
        <?php echo htmlspecialchars($afine['BookID']); ?>
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
  </div>

  <div id="Reservations" class="tabcontent">
    <h5>Reservations</h5>

    <div class="row">

      <?php

        $sql3 = "SELECT * FROM Reservation WHERE MemberID='".$account['MemberID']."' ";
        $result3 = mysqli_query($conn, $sql3);

        if (mysqli_num_rows($result3) == 0) {
          echo "You have no Reservations.";
        } else{
          $reservations = mysqli_fetch_all($result3, MYSQLI_ASSOC);
          mysqli_free_result($result3);
          foreach ($reservations as $areservation) {
          if(isset($areservation['BookID'])){?>

      <div class="s1">
        <?php echo htmlspecialchars($areservation['BookID']); ?>
      </div>
      <div class="s2">
        <?php echo htmlspecialchars($areservation['ResExpire']); ?>
      </div>

      <?php }
              }
                }?>

    </div>
  </div>

  <div id="History" class="tabcontent">
    <h5>Loan History</h5>

    <div class="row">

      <?php

        $sql4 = "SELECT MemberID, BookID, ReturnDate FROM `return` WHERE MemberID='".$account['MemberID']."' ";
        $result4 = mysqli_query($conn, $sql4);

        if (mysqli_num_rows($result4) == 0) {
          echo "You have no returns.";
        } else{
          $returns = mysqli_fetch_all($result4, MYSQLI_ASSOC);
          mysqli_free_result($result4);
          foreach ($returns as $return) {
          if(isset($return['BookID'])){?>

      <div class="s1">
        <?php echo htmlspecialchars($loan['BookID']); ?>
      </div>
      <div class="s2">
        <?php echo htmlspecialchars($loan['MemberID']); ?>
      </div>
      <div class="s3">
        <?php echo htmlspecialchars($loan['ReturnDate']); ?>
      </div>

      <?php }
              }
                }?>

    </div>
  </div>

</body>

</html>
