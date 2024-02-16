<?php
require("../require/require.php");
if ($_SESSION['login'] == false) {
    header("Location: ../index.php");
}

if (isset($_POST['voerin'])) {
    $projectName = $_POST['name'];
    $projectBeschrijving = $_POST['beschrijving'];
    $Datum = $_POST['datum'];
    $link = $_POST['link'];
    $technieken = $_POST['techniek'];

    $fileContent = file_get_contents($_FILES['file-upload']['tmp_name']);

    if ($fileContent !== false) {
        $stmt = $con->prepare("INSERT INTO projects (Naam, IMG, Beschrijving, Technieken, Datum, link) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $projectName, $fileContent, $projectBeschrijving, $technieken, $Datum, $link);

        if ($stmt->execute()) {
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Unable to read file.";
    }
}

if (isset($_POST['Delete'])) {
    $selectedRow = $_POST["delete"];

    if (isset($selectedRow)) {
        $sql = "DELETE FROM projects WHERE ID = '$selectedRow'";
    }

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error deleting row: " . $conn->error;
    }
}

$selectQuery = "SELECT Naam, ID FROM projects";
$result = $con->query($selectQuery);

if (isset($_POST['Update'])) {
    $updateid = $_POST["update"];
    $newNaam = $_POST["naam"];
    $newBeschrijving = $_POST["beschrijving"];
    $newDatum = $_POST["datum"];
    $newLink = $_POST["link"];
    $newTechniek = $_POST['techniek'];

    $sql = "UPDATE `projects` SET `Naam` = '$newNaam', `Beschrijving` = '$newBeschrijving', `Datum` = '$newDatum', `link` = '$newLink', `Technieken` = '$newTechniek' WHERE `ID` = '$updateid'";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error: " . $con->error;
    }
}

$selectupdate = "SELECT * FROM projects";
$resultupdate = $con->query($selectupdate);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <link rel="stylesheet" href="../CSS/profile.css" />
    <link rel="stylesheet" href="../CSS/backgound.css" />
</head>

<body>
    <header>
        <nav>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../Pages/projects.php">Projects</a></li>
            <li><a href="./about.php">About/CV</a></li>
            <li><a href="./contact.php">Contact</a></li>
            <li>
                <?php if ($_SESSION['login'] == true) { ?>
                    <a class="active" href="./profile.php">Admin <img src="assets/images/profile.jpg" alt="" /></a>
                <?php } else { ?>
                    <a href="./login.php">Login <img style="filter: brightness(0) invert(1);" src="assets/images/login-header.png" alt="" /></a>
                <?php } ?>
            </li>
            <li><a href="./logout.php">Logout</a></li>
        </nav>
    </header>
    <main class="admin">
        <section class="insert">
            <div class="form-container">
                <h3>Upload a project</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class=" inputbox">
                        <span>Project Name</span>
                        <input required="required" type="text" name="name" placeholder='Project Name'>
                        <i></i>
                    </div>
                    <div class="inputbox">
                        <span>Project Beschrijving</span>
                        <input required="required" type="text" name="beschrijving" placeholder='Project Beschrijving'>
                        <i></i>
                    </div>
                    <div class="inputbox">
                        <span>Project Datum</span>
                        <input required="required" type="text" name="datum" placeholder='Project Datum'>
                        <i></i>
                    </div>
                    <div class="inputbox">
                        <span>Project Link</span>
                        <input required="required" type="text" name="link" placeholder='Project Link'>
                        <i></i>
                    </div>
                    <div class="inputbox">
                        <span>Project Technieken</span>
                        <input required="required" type="text" name="techniek" placeholder='Project Techniek'>
                        <i></i>
                    </div>
                    <div class="file-input-container">
                        <label for="file-upload" class="custom-file-upload">
                            Choose a file
                        </label>
                        <input type="file" name="file-upload" id="file-upload" class="actual-file-input" accept="image/*">
                    </div>
                    <button type='submit' class='btn' name='voerin'>
                        Place Project
                    </button>
                </form>
            </div>
        </section>
        <section class="delete">
            <div class="form-container">
                <h3>Delete a project</h3>
                <form method="post" enctype="multipart/form-data">
                    <label for="delete">Selecteer a project to delete:</label>
                    <select name="delete">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ID"] . "'>" . $row["Naam"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" name='Delete' class='btn'>Delete</button>
                </form>
            </div>
            <div class="form-container">
                <h3>Update a project</h3>
                <form method="post" enctype="multipart/form-data">
                    <label for="update">Select project to update</label>
                    <select name="update" onchange="DataNeerZetten()">
                        <option value="">Select a project</option>
                        <?php
                        if ($resultupdate->num_rows > 0) {
                            while ($row = $resultupdate->fetch_assoc()) {
                                echo "<option value='" . $row["ID"] . "' data-naam='" . $row["Naam"] . "' data-beschrijving='" . $row["Beschrijving"] . "' data-datum='" . $row["Datum"] . "' " . "data-link='" . $row['link'] . "'data-techniek='" . $row['Technieken'] . "'>" . $row["Naam"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="Naam">New Naam:</label>
                    <input type="text" name="naam" id="naamField">
                    <br><br>
                    <label for="Beschrijving">New Beschrijving:</label>
                    <input type="text" name="beschrijving" id="beschrijvingField">
                    <br><br>
                    <label for="Datum">New Datum:</label>
                    <input type="text" name="datum" id="datumField">
                    <br><br>
                    <label for="Link">New Link:</label>
                    <input type="text" name="link" id="linkField">
                    <br><br>
                    <label for="Techniek">New Techniek:</label>
                    <input type="text" name="techniek" id="techniekField">
                    <br><br>
                    <button type="submit" name='Update' class='btn'>Update</button>
                </form>
            </div>
        </section>
    </main>
</body>
<script>
    function DataNeerZetten() {
        let select = document.getElementsByName("update")[0];
        let selectedOption = select.options[select.selectedIndex];
        let naamField = document.getElementById("naamField");
        let beschrijvingField = document.getElementById("beschrijvingField");
        let datumField = document.getElementById("datumField");
        let linkField = document.getElementById("linkField");
        let techniekField = document.getElementById("techniekField");

        if (selectedOption) {
            let naam = selectedOption.getAttribute("data-naam");
            let beschrijving = selectedOption.getAttribute("data-beschrijving");
            let datum = selectedOption.getAttribute("data-datum");
            let link = selectedOption.getAttribute("data-link");
            let techniek = selectedOption.getAttribute("data-techniek");

            naamField.value = naam;
            beschrijvingField.value = beschrijving;
            datumField.value = datum;
            linkField.value = link;
            techniekField.value = techniek;
        } else {
            naamField.value = "";
            beschrijvingField.value = "";
            datumField.value = "";
            linkField.value = "";
            techniekField.value = "";
        }
    }
</script>
<script>
    document.body.classList.add('slide-in');
</script>

</html>