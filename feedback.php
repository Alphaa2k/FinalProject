<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Library Catalogue - Feedback</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
  });
</script>

<body>

  <nav>
    <div class="nav-wrapper purple darken-4">
      <!-- <a href="#!" class="brand-logo center">Logo</a> -->
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="left hide-on-med-and-down">
        <li><a class="active">Home</a></li>
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
    <li class="active"><a>Feedback</a></li>
    <li><a href="#LibraryWeb">Library Website</a></li>
    <li><a href="#contact">Contact Us</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
  </ul>

  <div class="container">
    <h3>Feedback on Library Catalogue</h3>

    <div class="row">
      <form class="col s12" action="mailto:up848130@myport.ac.uk?subject=Feedback on Library Catalogue&body=You have recieved the following Feedback below." method="POST">
        <div class="row">
          <div class="input-field col s6">
            <input id="full_name" type="text" class="validate" name="full_name">
            <label for="full_name">Full Name</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <input id="email" type="email" class="validate" name="email">
            <label for="email">Email</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea" name="comment"></textarea>
            <label for="textarea1">Your Feedback</label>
          </div>
        </div>

        <button type="submit" name="button" class="waves-effect waves-light btn purple darken-4">Submit Feedback</button>
        <button type="reset" name="button" class="waves-effect waves-light btn purple darken-4">Clear Form</button>
      </form>
    </div>

    <footer>
    </footer>


</body>

</html>
