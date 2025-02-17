<?php
global $conn;
include_once "./configs.php";
include_once "./utils/helpers.php";
$default_img = "media/default.jpg";

if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $img_path = $_GET["p"];

    print $img_path;

    // here i delete image from server
    if ($img_path && $img_path !== $default_img && file_exists($img_path)) {
        unlink($img_path);
    }

    $request = $conn->prepare("DELETE FROM pets WHERE id = ?");
    $request->bind_param("i", $delete_id);
    $request->execute();
    $request->close();
} else {
    $request = $conn->prepare("SELECT * FROM pets");
    $request->execute();
    $result = $request->get_result();
}
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


    <section class="latest" id="pets-stock">
        <div class="container">

            <div class="section-header" id="section-header">
                <h2>Pets Stock</h2>
            </div>

            <?php if ($result->num_rows > 0) { ?>
            <table class="pets-stock">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Img</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                <?php  while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <th><?= $row['id']; ?></th>
                    <th><img class="thumb" src="<?= $row['image']; ?>" alt=""></th>
                    <th><?= $row['name']; ?></th>
                    <th><?= $row['type']; ?></th>
                    <th><?= $row['breed']; ?></th>
                    <th><?= $row['age']; ?></th>
                    <th><?= $row['sex']; ?></th>
                    <th>
                        <button class="edit-btn" onclick="editAction('<?= $row['id']; ?>')">
                            <img class="icon" src="media/icons/edit.svg" alt="Edit">
                        </button>
                    </th>
                    <th>
                        <button class="delete-btn" onclick="deleteAction('<?= $row['id']; ?>', '<?= $row['image']; ?>')">
                            <img class="icon" src="media/icons/delete.svg" alt="Delete">
                        </button>
                    </th>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } else { echo "No results found!"; } ?>
        </div>
    </section>
</main>

<?php include_once "components/footer.php"; ?>

<?php if (isset($_GET['edit'])) { ?>
    <div class="overlay" onclick="closeOverlay(event)">
        <div class="overlay-content">
            <div class="overlay-header">
                <img class="icon close" src="media/icons/close.svg" alt="Close" onclick="closeOverlay(event)"/>
            </div>
            <?php include_once "components/edit-form.php"?>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    function deleteAction(id, imgPath) {
        if (confirm("Are you sure you want to delete this pet?")) {
            window.location.href = "?delete=" + id + "&p=" + imgPath + "#pets-stock";
        }
    }

    function editAction (id) {
        window.location.href = "?edit=" + id + "#pets-stock";
    }

    function closeOverlay(e) {
        if (e.target.classList.contains("overlay") || e.target.classList.contains("close")) {
            window.location.href = "list.php#pets-stock";
        }
    }
</script>
</body>
</html>