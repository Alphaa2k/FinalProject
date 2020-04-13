<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Library Catalogue - Help</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/index.css">
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
        <li><a href="index.php">Home</a></li>
        <li><a href="accessibility.php">Accessibility</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="#LibraryWeb">Library Website</a></li>
        <li><a href="#contact">Contact Us</a></li>
        <li class="active"><a>Help</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php" id="account">My Account</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li class="active"><a>Home</a></li>
    <li><a href="accessibility.php">Accessibility</a></li>
    <li><a href="feedback.php">Feedback</a></li>
    <li><a href="#LibraryWeb">Library Website</a></li>
    <li><a href="#contact">Contact Us</a></li>
    <li class="active"><a>Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
  </ul>

  <div class="container">
    <div class="row">

      <div class="col s3 m3 l4">
        <h5>Table of Contents</h5>
        <div class="section">
          <a href="#howtouse">Home Page</a>
        </div>
        <div class="section">
          <a href="#results">Search Results and Filters</a>
        </div>
        <div class="section">
          <a href="#details">Book and Database Details</a>
        </div>
        <div class="section">
          <a href="#youraccount">Your Account</a>
        </div>
        <div class="section">
          <a href="#feedback">Feedback</a>
        </div>
      </div>

      <div class="col s9 m9 l8">

        <h1>How to use the Catalogue</h1>

        <div class="row">
          <h3 id="howtouse">Home Page</h3>
          <p>The Home page allows you to search for books and academic databases currently in the catalogue database. From here, you can
            search for books by title, or academic databases by name.</p>

          <p>You can also perform an advanced search to search for specific words or an author to find the books they have written.
            this is done by clicking the advanced search button which opens up a form on the modal.</p>

          <p>There are two different buttons on the home page. There's "Search" which is to search for books and the "Search for Databases"
            which looks for databases, make sure you click the right button otherwise you will get no search results.</p>

          <div class="right-align">
            <img src="DB Images/index.png" alt="Image of Home Page" class="responsive-img" width="550">
            <span>Catalogue Home Page</span>
          </div>
        </div>

        <div class="row">

          <h3 id="results">Search Results and Filters</h3>
          <p>After searching you are able to go through the results that can be selected to look at its entry, or use filters
            to find what you are looking for faster.</p>

            <div class="right-align">
              <img src="DB Images/filter.png" alt="Image of Search Filters" class="responsive-img" width="150">
              <span>Catalogue Search Filters</span>
            </div>

          <p>You can filter results by whether they have a paperback, by author, year they were published, whether it's a Book or an eBook
            and its genre. Click apply for a fresh set of results.</p>


          <p>To search for something else, click back to search on the top left part of the page. Under the navigation.</p>

          <div class="left-align">
            <img src="DB Images/search.png" alt="Image of Search Page" class="responsive-img" width="350">
            <span>Catalogue Search Results</span>
            </div>
          </div>

        <div class="row">
          <h3 id="details">Book and Database Details</h3>
          <p>When looking at entires for a book, you can look at the entire details about the book, such as the author, title, ISBN etc.
            You can also reserve a book as long as you are logged in and the book has not been reserved. You will be informed whether
            reserving the book was done successfully.</p>

          <p>For academic databases, they're online therefore reserving is not a possible. Instead, you can click a link to take you to the
            website.</p>

          <div class="right-align">
            <img src="DB Images/details.png" alt="Image of a Book's Details" class="responsive-img" width="400">
            <span>Details of a Book</span>
            </div>
          </div>

        <div class="row">
          <h3 id="youraccount">Your Account</h3>
          <p>You will only need to log in with your library number in order to access your account.</p>

          <p>Upon signing in, users can see all their relevant information in relation to them, such as the books they have loaned,
            books that are overdue, books they have reserved and a history of the booked they have previously loaned.</p>

          <p>While logged in, you can also reserve books that have not already been reserved.</p>
        </div>

        <div class="row">
          <h3 id="feedback">Feedback</h3>
          <p>If there are any issues with the catalogue or you have any queries please consider giving us <a href="feedback.php">Feedback Here</a>.</p>
        </div>

        </div>
      </div>
  </div>
</body>

</html>
