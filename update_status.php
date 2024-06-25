<?php
include 'connection.php'; // Ensure this file exists and correctly sets up the $conn variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE kegiatan SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        header("Location: admin.php"); // Redirect back to the dashboard after update
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request method.";
}
$conn->close();
?>