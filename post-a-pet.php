<?php
global $conn;
include_once "./configs.php";
include_once "./utils/helpers.php";
$default_img = "media/default.jpg";


if(isset($_POST["submit-btn"])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $desc = $_POST['desc'];
    $image = $default_img;

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            $image = $targetFilePath;
        }
    }

    $request = $conn->prepare("INSERT INTO pets (name, age, type, sex, breed, image, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $request->bind_param("sisssss", $name, $age, $type, $sex, $breed, $image, $desc);

    if (!$request->execute()) {
        echo "Error!<br/>" . $request->error;
    }

    $request->close();
    header("Location: " . $_SERVER["PHP_SELF"] . "?submit=true");
    exit();
}

$conn->close();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include_once "components/header.php"; ?>

    <main>
        <?php include_once "components/banner-home.php"; ?>

        <section class="latest">
            <div class="container">

                <div class="section-header">
                    <h2>Submit a Pet</h2>
                    <p>Give a loving home to a pet in need. Every animal deserves care, kindness, and a second chance at happiness!</p>
                </div>

                
                <section class="pets-form">
                    <?php if(isset($_GET['submit']) && $_GET['submit'] === "true") { ?>
                    <div class="submitted-msg">Pet submitted successfully!</div>
                    <?php } else { ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="input-area">
                            <label for="name">Pet's Name</label>
                            <input id="name" name="name" type="text" value="">
                        </div>
                        <div class="input-area">
                            <label for="type">Animal Type</label>
                            <select name="type" id="type">
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                                <option value="bird">Bird</option>
                                <option value="rabbit">Rabbit</option>
                            </select>
                        </div>
                        <div class="input-area">
                            <label for="breed">Breed</label>
                            <input name="breed" id="breed" type="text" value="">
                        </div>
                        <div class="input-area">
                            <label for="age">Age (years)</label>
                            <input name="age" id="age" type="number" value="">
                        </div>
                        <div class="input-area">
                            <label for="sex">Sex</label>
                            <select name="sex" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="input-area">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="desc"></textarea>
                        </div>
                        <div class="input-area-image">
                            <label for="photo" id="photo-label">Upload Photo</label>
                            <input name="photo" id="photo" type="file" value="">
                        </div>
                        <br>
                        <button type="submit" name="submit-btn" class="btn btn-general">Submit The Pet</button>
                    </form>
                    <?php } ?>
                </section>

            </div>
        </section>


        <?php include_once "sections/pet-choice.php"; ?>
    </main>

    <?php include_once "components/footer.php"; ?>

</body>
</html>