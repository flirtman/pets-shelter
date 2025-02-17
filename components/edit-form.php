<?php
global $conn;
include_once "./configs.php";
include_once "./utils/helpers.php";
$default_img = "media/default.jpg";


if (isset($_POST["submit-btn"]) && !empty($_POST['pet_id'])) {
    $id = $_POST['pet_id']; // Ensure ID is set for the update
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    $sex = $_POST['sex'];
    $breed = $_POST['breed'];
    $desc = $_POST['desc'];

    // Fetch existing image from the database if no new file is uploaded
    $query = $conn->prepare("SELECT image FROM pets WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $image = $row['image'] ?? ''; // Keep existing image if no new one is uploaded

    // Check if a new file is uploaded
    if (!empty($_FILES["photo"]["name"]) && $_FILES["photo"]["error"] === 0) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Create directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file and update the image path
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            $image = $targetFilePath; // Set new image path
        }
    }

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE pets SET name = ?, age = ?, type = ?, sex = ?, breed = ?, image = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sisssssi", $name, $age, $type, $sex, $breed, $image, $desc, $id);

    // Execute and handle redirection properly
    if ($stmt->execute()) {
        // Only redirect if no output is sent
        if (!headers_sent()) {
            header("Location: listing.php");
            exit();
        } else {
            echo "<script>window.location.href='list.php';</script>";
            exit();
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

if(isset($_GET["edit"])) {
    $petId = $_GET["edit"];
    $request = $conn->prepare("SELECT * FROM pets WHERE id = ?");
    $request->bind_param("i", $petId);
    $request->execute();
    $result = $request->get_result();
}

$conn->close();
?>

<section class="pets-form">
    <?php
    if ($result->num_rows > 0) { $row = $result->fetch_assoc() ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="number" name="pet_id" hidden="hidden" value="<?= $row['id'] ?>">
            <div class="input-area">
                <label for="name">Pet's Name</label>
                <input id="name" name="name" type="text" value="<?= $row['name'] ?>">
            </div>
            <div class="input-area">
                <label for="type">Animal Type</label>
                <select name="type" id="type">
                    <option value="dog" <?= ($row['type'] === "dog") ? "selected" : "" ?>>Dog</option>
                    <option value="cat" <?= ($row['type'] === "cat") ? "selected" : "" ?>>Cat</option>
                    <option value="bird" <?= ($row['type'] === "bird") ? "selected" : "" ?>>Bird</option>
                    <option value="rabbit" <?= ($row['type'] === "rabbit") ? "selected" : "" ?>>Rabbit</option>
                </select>
            </div>
            <div class="input-area">
                <label for="breed">Breed</label>
                <input name="breed" id="breed" type="text" value="<?= $row['breed'] ?>">
            </div>
            <div class="input-area">
                <label for="age">Age (years)</label>
                <input name="age" id="age" type="number" value="<?= $row['age'] ?>">
            </div>
            <div class="input-area">
                <label for="sex">Sex</label>
                <select name="sex" required>
                    <option value="Male" <?= ($row['sex'] === "Male") ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= ($row['sex'] === "Female") ? "selected" : "" ?>>Female</option>
                </select>
            </div>
            <div class="input-area">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc"><?= $row['description'] ?></textarea>
            </div>
            <div style="display: flex; width: 100%; gap: 15px">
                <img src="<?= $row['image'] ?>" alt="" style="max-width: 100px; border-radius: 8px" class="input-area-image-thumb">
                <div class="input-area-image" style="width: 100%">
                    <label for="photo" id="photo-label">Upload Photo</label>
                    <input name="photo" id="photo" type="file" value="<?= $row['image'] ?>">
                </div>
            </div>
            <br>
            <button type="submit" name="submit-btn" class="btn btn-general">Submit The Pet</button>
        </form>
    <?php } ?>
</section>

<script type="text/javascript">
    const imgInput = document.getElementById('photo');
    const inputAreaImageThumb = document.querySelector('.input-area-image-thumb');
    imgInput.addEventListener('change', function (e) {
        if (e.target.files.length > 0) {
            inputAreaImageThumb.src = URL.createObjectURL(e.target.files[0]);
        }
    })
</script>