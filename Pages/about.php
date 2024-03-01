<?php
require("../require/require.php");

if (!isset($_SESSION['login'])) {
  $_SESSION['login'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About</title>
  <link rel="stylesheet" href="../CSS/style.css" />
  <link rel="stylesheet" href="../CSS/backgound.css" />
</head>

<body>
  <header>
    <nav>
      <li><a href="../index.php">Home</a></li>
      <li><a href="./projects.php">Projects</a></li>
      <li><a class="active" href="#">About/CV</a></li>
      <li><a href="./contact.php">Contact</a></li>
      <li>
        <?php if ($_SESSION['login'] == true) { ?>
          <a href="./profile.php">Admin <img src="assets/images/profile.jpg" alt="" /></a>
        <?php } else { ?>
          <a href="./login.php">Login <img style="filter: brightness(0) invert(1);" src="assets/images/login-header.png" alt="" /></a>
        <?php } ?>
      </li>
      <li class='cv'><a href='../IMAGES/CV.png' download>CV</a></li>
    </nav>
  </header>
  <main class="main-container clearfix">
    <?php
    $query = $db->query('SELECT * FROM aboutpage');

    if (!$query) {
      echo "Error executing query: " . $db->lastErrorMsg();
      exit;
    }

    if ($query->numColumns() == 0) {
      echo "<p>No Projects Found.</p>";
    } else {

      while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
        $title = $result['title'];
        $beschrijving = $result['desc'];

        echo "<div class='half-row'>";
        echo "<h2>$title</h2>";
        echo "<p>$beschrijving</p>";
        echo "</div>";
      }

      echo "</main>";
    }
    ?>
  </main>
</body>
<script src="../Js/about.js"></script>
<script>
  document.body.classList.add('slide-in');
</script>

</html>