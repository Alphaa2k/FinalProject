<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Library Catalogue - Accessibility</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/access.css">
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
      <li class="active"><a>Accessibility</a></li>
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
  <li class="active"><a>Accessibility</a></li>
  <li><a href="feedback.php">Feedback</a></li>
  <li><a href="#LibraryWeb">Library Website</a></li>
  <li><a href="#contact">Contact Us</a></li>
  <li><a href="help.php">Help</a></li>
  <li><a href="login.php" id="account">My Account</a></li>
</ul>

<div class="container">
  <div class="row">
    <div class="col s4 m3 l4">
      <h5>Table of Contents</h5>
      <div class="section">
        <a href="#committedtoaccessibility">Committed to Accessibility</a>
      </div>
      <div class="section">
        <a href="#skiptocontent">'Skip to Content'</a>
      </div>
      <div class="section">
        <a href="#textsizeandstyle">Text Size and Style</a>
      </div>
      <div class="section">
        <a href="#movingaround">Moving Around</a>
      </div>
      <div class="section">
        <a href="#assistivetechnology">Assistive Technology</a>
      </div>
      <div class="section">
        <a href="#feedback">Feedback</a>
      </div>
    </div>

    <div class="col s8 m9 l8">
      <h3>Library Catalogue Accessibility</h3>

      <h4 id="committedtoaccessibility">Committed to Accessibility</h4>
      <p>We are committed to improving the accessibility of the library catalogue to all users. Accessibility is reviewed as part of the continual development of the catalogue,
        and feedback from users is welcomed via the link at the top of the page. The catalogue is developed to conform to the
        World Wide Web Consortium (W3C) Web Accessibility Initiative (WAI) Web Content Accessibility Guidelines version 2.0 (WCAG 2.0),
        with compliance at level double-A. This page describes the key accessibility features of the library catalogue to help
        those who wish to make use of them.</p>

      <h4 id="skiptocontent">‘Skip to content’ link</h4>
      <p>Each page of the site includes a hidden link that enables assistive technology such as screen readers to jump directly to the main content of that page.</p>

      <h4 id="textsizeandstyle">Text size and style</h4>
      <p>You can customise your browser settings to make changes to the site appearance to suit your needs. This may include text size, text colour and background colour.
        Usually these settings can be found via the “Tools” or “View” menus, under "Internet Options", “Options” or “Text size”.
        It is likely that you will be able to increase and decrease text size by holding down Ctrl and pressing + or -.</p>

      <h4 id="movingaround">Moving around</h4>
      <p>If you have difficulty using a mouse, you can use the Tab key to move around all the links, input boxes and buttons on each page.
        To move back, hold the Shift key and press Tab. To activate a link or a button, press the Enter key.
        You can also use the Page Up and Page Down keys to move the page to the area you want to read.</p>

      <h4 id="assistivetechnology">Assistive technology</h4>
      <p>Assistive technology can help if you have a visual impairment. Screen readers are software programs that present images and text as speech.
        A screen reader will speak everything on the screen, including buttons and menus. The catalogue has not yet been tested with any
        screen reader software. Compliance with the Web Content Accessibility Guidelines will mean that it should work with most screen readers.
        Other assistive technologies include screen enlargers or magnifiers, speech or voice recognition, speech synthesisers,
        refreshable braille displays and braille embossers. You can find more information about these technologies and other aspects of
        accessibility at the RNIB Web Access Centre.</p>

      <h4 id="feedback">Feedback</h4>
      <p>We welcome <a href="feedback.html" title="Click on this link to give us feedback">feedback</a> from any user to help us continue to improve the accessibility of the library catalogue.</p>
    </div>
  </div>
</div>

<footer>

</footer>
</body>

</html>
