<?php
if (isset($_POST['submit'])) {
    $naam = $_POST['name'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['phone'];
    $bedrijfsnaam = $_POST['company'];
    $bericht = $_POST['message'];
    $sql = "INSERT INTO `contact`(`naam`, `email`, `telefoonnummer`, `bedrijfnaam`, `bericht`) VALUES ('$naam','$email','$telefoonnummer','$bedrijfsnaam','$bericht')";
    if ($con->query($sql) == TRUE) {
        header("Location: ../index.php");
    } else {
        header("Location: contact.php?error");
    }
}
