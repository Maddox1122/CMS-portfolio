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

    $fileContent = file_get_contents($_FILES['file-upload']['tmp_name']);

    if ($fileContent !== false) {
        $stmt = $db->prepare("INSERT INTO projects (Naam, IMG, Beschrijving, Datum, link) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $projectName, SQLITE3_TEXT);
        $stmt->bindParam(2, $fileContent, SQLITE3_BLOB);
        $stmt->bindParam(3, $projectBeschrijving, SQLITE3_TEXT);
        $stmt->bindParam(4, $Datum, SQLITE3_TEXT);
        $stmt->bindParam(5, $link, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "Project inserted successfully.";
        } else {
            echo "Error inserting project.";
        }
    } else {
        echo "Error: Unable to read file.";
    }
}

if (isset($_POST['Delete'])) {
    $selectedRow = $_POST["delete"];

    if (isset($selectedRow)) {
        $stmt = $db->prepare("DELETE FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $selectedRow, SQLITE3_NUM);

        if ($stmt->execute()) {
            echo "Project deleted successfully.";
        } else {
            echo "Error deleting project.";
        }
    }
}


$selectQuery = "SELECT Naam, id FROM projects";
$result = $db->query($selectQuery);

if (isset($_POST['Update'])) {
    $updateid = $_POST["update"];
    $newNaam = $_POST["naam"];
    $newBeschrijving = $_POST["beschrijving"];
    $newDatum = $_POST["datum"];
    $newLink = $_POST["link"];

    $stmt = $db->prepare("UPDATE projects SET Naam = :naam, Beschrijving = :beschrijving, Datum = :datum, link = :link WHERE id = :id");
    $stmt->bindParam(':naam', $newNaam, SQLITE3_TEXT);
    $stmt->bindParam(':beschrijving', $newBeschrijving, SQLITE3_TEXT);
    $stmt->bindParam(':datum', $newDatum, SQLITE3_TEXT);
    $stmt->bindParam(':link', $newLink, SQLITE3_TEXT);
    $stmt->bindParam(':id', $updateid, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Project updated successfully.";
    } else {
        echo "Error updating project.";
    }
}


$selectupdate = "SELECT * FROM projects";
$resultupdate = $db->query($selectupdate);

if (isset($_POST['upload-about-item'])) {
    $aboutTitle = $_POST['title'];
    $aboutDescription = $_POST['desc'];


    $stmt = $db->prepare("INSERT INTO aboutpage (title, desc) VALUES (?, ?)");
    $stmt->bindParam(1, $aboutTitle, SQLITE3_TEXT);
    $stmt->bindParam(2, $aboutDescription, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "About item uploaded successfully.";
    } else {
        echo "Error uploading about item.";
    }
}

if (isset($_POST['DeleteAboutPost'])) {
    $selectedRow = $_POST["deleteAbout"];

    if (isset($selectedRow)) {
        $stmt = $db->prepare("DELETE FROM aboutpage WHERE id = :id");
        $stmt->bindParam(':id', $selectedRow, SQLITE3_NUM);

        if ($stmt->execute()) {
            echo "Project deleted successfully.";
        } else {
            echo "Error deleting project.";
        }
    }
}

$selectUpdateAbout = "SELECT * FROM aboutpage";
$reslutUpdateAbout = $db->query($selectUpdateAbout);

if (isset($_POST['UpdateAbout'])) {
    $updateid = $_POST["update-about"];
    $newTitle = $_POST["title"];
    $newDesc = $_POST["desc"];

    $stmt = $db->prepare("UPDATE aboutpage SET title = :title, `desc` = :desc WHERE id = :id");
    $stmt->bindParam(':title', $newTitle, SQLITE3_TEXT);
    $stmt->bindParam(':desc', $newDesc, SQLITE3_TEXT);
    $stmt->bindParam(':id', $updateid, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "About item updated successfully.";
    } else {
        echo "Error updating about item.";
    }
}

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
        <div class="form-selector">
            <label for="formType">Select Action:</label>
            <select id="formType" name="formType">
                <option value="uploadProject">Upload Project</option>
                <option value="deleteProject">Delete Project</option>
                <option value="updateProject">Update Project</option>
                <option value="uploadAboutItem">Upload About Item</option>
                <option value="deleteAboutItem">Delete About Item</option>
                <option value="updateAboutItem">Update About Item</option>
            </select>
        </div>
        <section class="insert">
            <div class="form-container" id="deleteProjectForm">
                <h3>Delete a About Item</h3>
                <form method="post" enctype="multipart/form-data">
                    <label for="delete">Selecteer a project to delete:</label>
                    <select name="deleteAbout">
                        <?php
                        while ($row = $reslutUpdateAbout->fetchArray(SQLITE3_ASSOC)) {
                            echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" name='DeleteAboutPost' class='btn'>Delete</button>
                </form>
            </div>
        </section>
        <section class="delete">
            <div class="form-container" id="updateProjectForm">
                <h3>Delete a project</h3>
                <form method="post" enctype="multipart/form-data">
                    <label for="delete">Selecteer a project to delete:</label>
                    <select name="delete">
                        <?php
                        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                            echo "<option value='" . $row["id"] . "'>" . $row["Naam"] . "</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" name='Delete' class='btn'>Delete</button>
                </form>
            </div>
            <div class="form-container" id="uploadAboutItemForm">
                <h3>Update a project</h3>
                <form method="post" enctype="multipart/form-data">
                    <label for="update">Select project to update</label>
                    <select name="update" onchange="DataNeerZetten()">
                        <option value="">Select a project</option>
                        <?php
                        while ($row = $resultupdate->fetchArray(SQLITE3_ASSOC)) {
                            echo "<option value='" . $row["id"] . "' data-naam='" . $row["Naam"] . "' data-beschrijving='" . $row["Beschrijving"] . "' data-datum='" . $row["Datum"] . "' " . "data-link='" . $row['link'] . "'>" . $row["Naam"] . "</option>";
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
                    <input type="date" name="datum" id="datumField">
                    <br><br>
                    <label for="Link">New Link:</label>
                    <input type="text" name="link" id="linkField">
                    <br><br>
                    <button type="submit" name='Update' class='btn'>Update</button>
                </form>
            </div>
        </section>
        <section class="insert">
            <div class="form-container" id="deleteAboutItemForm">
                <h3>Upload About Item</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="inputbox">
                        <span>About Item Title</span>
                        <input required="required" type="text" name="title" placeholder='About Item Title'>
                        <i></i>
                    </div>
                    <div class="inputbox">
                        <span>About Item Description</span>
                        <input required="required" type="text" name="desc" placeholder='About Item Description'>
                        <i></i>
                    </div>
                    <button type='submit' class='btn' name='upload-about-item'>
                        Upload About Item
                    </button>
                </form>
            </div>
        </section>
        <div class="form-container" id="updateAboutItemForm">
            <h3>Update an about item</h3>
            <form method="post" enctype="multipart/form-data">
                <label for="update-about">Select about item to update</label>
                <select name="update-about" onchange="DataNeerZettenAbout()">
                    <?php
                    while ($row = $reslutUpdateAbout->fetchArray(SQLITE3_ASSOC)) {
                        echo "<option value='" . $row["id"] . "' data-title='" . $row["title"] . "' data-desc='" . $row["desc"] . "'>" . $row['title'] . "</option>";
                    }
                    ?>
                </select>
                <br><br>
                <label for="Title">New Title:</label>
                <input type="text" name="title" id="titleField">
                <br><br>
                <label for="Description">New Description:</label>
                <input type="text" name="desc" id="descField">
                <br><br>
                <button type="submit" name='UpdateAbout' class='btn'>Update About Item</button>
            </form>
        </div>
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

        if (selectedOption) {
            let naam = selectedOption.getAttribute("data-naam");
            let beschrijving = selectedOption.getAttribute("data-beschrijving");
            let datum = selectedOption.getAttribute("data-datum");
            let link = selectedOption.getAttribute("data-link");

            naamField.value = naam;
            beschrijvingField.value = beschrijving;
            datumField.value = datum;
            linkField.value = link;
        } else {
            naamField.value = "";
            beschrijvingField.value = "";
            datumField.value = "";
            linkField.value = "";
        }
    }

    function DataNeerZettenAbout() {
        let select = document.getElementsByName("update-about")[0];
        let selectedOption = select.options[select.selectedIndex];
        let titleField = document.getElementById("titleField");
        let descField = document.getElementById("descField");

        if (selectedOption) {
            let title = selectedOption.getAttribute("data-title");
            let desc = selectedOption.getAttribute("data-desc");

            titleField.value = title;
            descField.value = desc;
        } else {
            titleField.value = "";
            descField.value = "";
        }
    }

    function validateFormInsertProject() {
        let emailInput = document.getElementsByName("email")[0];
        let dateInput = document.getElementsByName("datum")[0];

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            alert("Invalid email format");
            return false;
        }

        let dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(dateInput.value)) {
            alert("Invalid date format (YYYY-MM-DD)");
            return false;
        }

        return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const formSelector = document.querySelector('.form-selector');
        const forms = document.querySelectorAll('.form-container');

        forms.forEach(form => {
            form.style.display = 'none';
        });

        formSelector.addEventListener('change', function(event) {
            const selectedValue = event.target.value;

            forms.forEach(form => {
                form.style.display = 'none';
            });

            const selectedForm = document.getElementById(`${selectedValue}Form`);
            if (selectedForm) {
                selectedForm.style.display = 'block';
            }
        });
    });
</script>
<script>
    document.body.classList.add('slide-in');
</script>

</html>