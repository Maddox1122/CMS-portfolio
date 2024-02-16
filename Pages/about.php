<?php
require("../require/require.php");
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
        <a href='../IMAGES/CV.png' download>Bekijk mijn CV</a>
      </li>
      <li>
        <?php if ($_SESSION['login'] == true) { ?>
          <a href="./profile.php">Admin <img src="assets/images/profile.jpg" alt="" /></a>
        <?php } else { ?>
          <a href="./login.php">Login <img style="filter: brightness(0) invert(1);" src="assets/images/login-header.png" alt="" /></a>
        <?php } ?>
      </li>
    </nav>
  </header>
  <main class="about-grid">
    <section class="about">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
    <section class="about">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
  </main>
  <main clas="about-full-grid">
    <section class="about-full">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
  </main>
  <main class="about-grid">
    <section class="about">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
    <section class="about">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
  </main>
  <main clas="about-full-grid">
    <section class="about-full">
      <h3>Title</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga vel exercitationem eum dignissimos voluptatem. Similique facere dignissimos veniam at. Suscipit inventore quas omnis laudantium, cupiditate nesciunt pariatur sapiente ad distinctio.
      </p>
    </section>
  </main>

</body>
<script src="../Js/about.js"></script>
<script>
  document.body.classList.add('slide-in');
</script>

</html>