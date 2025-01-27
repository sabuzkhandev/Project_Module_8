<?php
include 'db.php';

$sql = "SELECT * FROM photos ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>
                <img src='" . $row['image_path'] . "' alt='" . $row['title'] . "' width='100'>
                <p>" . $row['title'] . "</p>
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
              </div>";
    }
} else {
    echo "No photos uploaded yet.";
}
?>
