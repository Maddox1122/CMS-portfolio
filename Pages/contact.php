<?php
require("../require/require.php");
require("../PHP/contact.php");

if (!isset($_SESSION['login'])) {
  $_SESSION['login'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="../CSS/style.css" />
  <link rel="stylesheet" href="../CSS/backgound.css" />
</head>

<body>
  <header>
    <nav>
      <li><a href="../index.php">Home</a></li>
      <li><a href="./projects.php">Projects</a></li>
      <li><a href="./about.php">About/CV</a></li>
      <li><a class="active" href="#">Contact</a></li>
      <li>
        <?php if ($_SESSION['login'] == true) { ?>
          <a href="./profile.php">Admin <img src="assets/images/profile.jpg" alt="" /></a>
        <?php } else { ?>
          <a href="./login.php">Login <img style="filter: brightness(0) invert(1);" src="assets/images/login-header.png" alt="" /></a>
        <?php } ?>
      </li>
    </nav>
  </header>
  <main class="contact">
    <section class="contact-info">
      <div class='contact-inside'>
        <h3>Stuur mij een Mail</h3>
        <hr />
        <p>Email: </p>
        <hr />
        <h3>Bel mij</h3>
        <hr />
        <p>Telefoon: </p>
        <hr />
      </div>
    </section>
    <section class="formulier">
      <h2>Contacteer mij</h2>
      <form method="post" class='contact-form'>
        <label for="name">Naam:*</label><br />
        <input type="text" id="name" name="name" required /><br /><br />

        <label for="email">Email:*</label><br />
        <input type="email" id="email" name="email" required /><br /><br />

        <label for="phone">Telefoonnummer: <span class="Optioneel">Optioneel</span></label><br />
        <input type="tel" id="phone" name="phone" /><br /><br />

        <label for="company">Bedrijfsnaam: <span class="Optioneel">Optioneel</span></label><br />
        <input type="text" id="company" name="company" /><br /><br />

        <label for="message">Bericht:*</label><br />
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br /><br />
        <input type="submit" value="Verzenden" name="submit" />
      </form>
    </section>
  </main>
</body>
<script>
  document.body.classList.add('slide-in');
</script>

</html>