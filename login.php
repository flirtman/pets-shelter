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
                <h2>Log In</h2>
            </div>
            <section class="pets-form">
                <form>
                    <div class="input-area">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" value="admin" readonly>
                    </div>
                    <div class="input-area">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="text" value="*******" readonly>
                    </div>
                    <br>

                    <div style="text-align: center">
                        <a class="btn btn-general" href="list.php">Continue</a>
                    </div>
                </form>
            </section>

        </div>
    </section>


</main>

<?php include_once "components/footer.php"; ?>

</body>
</html>