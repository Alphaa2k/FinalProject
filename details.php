<?php

  include('Library DB/db_connect.php');
  session_start();


  $account = $_SESSION['id']['MemberID'];

  echo $account;
  echo $_GET['id'];

  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM `book` join `author` on `book`.`AUID`= `author`.`AUID` where `book`.`BookID` = $id";

    $query = mysqli_query($conn, $sql);

    $book = mysqli_fetch_assoc($query);

    mysqli_free_result($query);

  }

  if(isset($_POST['reserve'])){
    if(isset($_GET['id']) && empty($account) == false){
      $bookid = $_GET['id'];
      $sql = "INSERT INTO reservation (MemberID, BookID, ResExpire) SELECT * FROM (SELECT $account, $bookid , CURRENT_DATE() + 10) as tmp WHERE NOT EXISTS(SELECT BookID from reservation where BookID = $bookid)";
      if(mysqli_query($conn, $sql)){
        if(mysqli_affected_rows($conn) == 0){
          echo "This book has already been reserved.";
          }else{
            echo "Book reserved successfully.";
          }
        }else{
          echo "Error: " . mysqli_error($conn);
        }
      }else{
        echo "Nothing happened.";
        $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        // header('Location: auth.php');
        exit;
      }
    }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Details</title>
  </head>
  <body>
    <h1>Details on Book</h1>

      <?php if($book): ?>
    <form class="" action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'];?>" method="POST">
        <h4><?php echo htmlspecialchars($book['Title']); ?></h4>
        <p>Author: <?php echo htmlspecialchars($book['fName']) . htmlspecialchars($book['lName']) ?></p>
        <p><?php echo htmlspecialchars($book['Description']) ?></p>
        <button type="submit" name="reserve">Reserve</button>
    </form>

      <?php else: ?>
        <p>Hello World</p>

      <?php endif; ?>


  </body>
</html>
