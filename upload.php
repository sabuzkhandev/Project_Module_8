<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $title = $_POST['title'];
    $image = $_FILES['image'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    
    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $sql = "INSERT INTO photos (title, image_path) VALUES ('$title', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Only image files are allowed.";
    }
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title" required>
    Select image to upload: <input type="file" name="image" required>
    <input type="submit" value="Upload Image" name="submit">
</form>
