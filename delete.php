<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get the file path to delete it from the server
    $sql = "SELECT image_path FROM photos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $image_path = $row['image_path'];

    // Delete the file from the server
    if (unlink($image_path)) {
        // Delete the file's metadata from the database
        $sql = "DELETE FROM photos WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "File deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error deleting the file.";
    }
}
?>
