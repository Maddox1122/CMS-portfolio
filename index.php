<?php
require("./require/require.php");

if (!isset($_SESSION['login'])) {
  $_SESSION['login'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfilio-Jan Pieter Hallaman</title>
  <link rel="stylesheet" href="./CSS/style.css" />
  <link rel="stylesheet" href="./CSS/backgound.css" />
  <script src="https://kit.fontawesome.com/15e3ed1574.js" crossorigin="anonymous"></script>
</head>

<body class="indexpage">
  <header>
    <nav>
      <li><a class="active" href="">Home</a></li>
      <li><a href="./Pages/projects.php">Projects</a></li>
      <li><a href="./Pages/about.php">About/CV</a></li>
      <li><a href="./Pages/contact.php">Contact</a></li>
      <li>
        <?php if ($_SESSION['login'] == true) { ?>
          <a href="./Pages/profile.php">Admin</a>
        <?php } else { ?>
          <a href="./Pages/login.php">Login</a>
        <?php } ?>
      </li>
    </nav>
  </header>
  <main>
    <div class="introduction">
      <h1>Ik ben <span>Jan</span> Pieter Hallaman - Bedrijfleider Manager Plastics</h1>
      <h4>
        <a class="contacteermij" href="./Pages/contact.php">Contacteer Mij</a>
      </h4>
      <img src="./IMAGES/profile.jpg" alt="ProfilePicture" width="300px" class="bounce-image" />
    </div>
  </main>
</body>
<script>
  document.body.classList.add('slide-in');
</script>

</html>