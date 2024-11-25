<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: l_11.php");
    exit();
}

if (isset($_POST['submit_complaint'])) {
    $description = $_POST['description'];
    $name = $_POST['name'];
    $id = $_SESSION['id'];

    
    $conn = new mysqli("localhost", "mysql", "utkarsh12@", "student");

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO complain (id, name, description) VALUES ('$id', '$name', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    
    $conn->close();
}
?>

<!-- Complaint Form -->
<form method="POST">
    Name: <input type="text" name="name" required><br>
    Complaint: <textarea name="description" required></textarea><br>
    <button type="submit" name="submit_complaint">Submit Complaint</button>
</form>
