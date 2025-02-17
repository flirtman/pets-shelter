<?php
global $conn;
include_once "./configs.php";
include_once "./utils/helpers.php";
$default_img = "media/default.jpg";

 if(isset($_GET["t"])){
     $type = $_GET["t"];
     $request = $conn->prepare("SELECT * FROM pets WHERE type = ?");
     $request->bind_param("s", $type);
 } else {
     $request = $conn->prepare("SELECT * FROM pets");
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
        <?php include_once "sections/pet-choice.php"; ?>


        <section class="latest" id="latest">
            <div class="container">

                <div class="section-header" id="section-header">
                    <h2><?= isset($_GET["t"]) ? strtoupper($_GET["t"] . 's') : "Latest Arrivals" ?></h2>
                    <p>Meet our newest shelter pets! Each one has received thorough health checks, vaccinations, and necessary medical care, ensuring they are ready for a happy and healthy start in their forever home.</p>
                </div>

                <div class="pets-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <a class="card-pet-link" href="pet.php?pet=<?= $row['id'] ?>#section-header">
                                <div class="card-pet">
                                    <div class="card-pet-image" style="background-image:url(<?= $row['image'] ?>);">
                                        <span class="animal-type"><img src="<?= animalType($row['type']) ?>" alt=""/></span>
                                    </div>

                                    <div class="card-info">
                                        <h3><?= $row['name'] ?></h3>
                                        <p><?= $row['breed'] ?></p>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    } else {
                        echo "No results found!";
                    }
                    ?>


                </div>

            </div>
        </section>
    </main>

    <?php include_once "components/footer.php"; ?>

</body>
</html>