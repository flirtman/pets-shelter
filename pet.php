<?php
global $conn;
include_once "./configs.php";
include_once "./utils/helpers.php";
$default_img = "media/default.jpg";

/** SELECT */
 if(isset($_GET["pet"])){
     $petId = $_GET["pet"];
     $request = $conn->prepare("SELECT * FROM pets WHERE id = ?");
     $request->bind_param("i", $petId);
 }
$request->execute();
$result = $request->get_result();
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
                <?php
                if ($result->num_rows > 0) {
                $row = $result->fetch_assoc()
                ?>
                <div class="section-header" id="section-header">
                    <h2><?= $row['name'] ?></h2>
                    <p><?= $row['description'] ?></p>
                </div>

                <ul class="pet-details">
                    <li>Type: <?= $row['type'] ?></li>
                    <li>Breed: <?= $row['breed'] ?></li>
                    <li>Age: <?= $row['age'] ?></li>
                    <li>Sex: <?= $row['sex'] ?></li>
                </ul>

                <div class="pet-img">
                    <img src="<?= $row['image'] ?>" alt=""/>
                </div>
                    <?php
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
        </section>


        <?php include_once "sections/pet-choice.php"; ?>
    </main>

    <?php include_once "components/footer.php"; ?>

</body>
</html>