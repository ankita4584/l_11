<?php
// Database connection
$db_server = "localhost";
$db_user = "mysql";
$db_pass = "utkarsh12@";
$db_database = "student";
$conn = new mysqli($db_server, $db_user, $db_pass, $db_database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // SQL Query
    $sql = "SELECT * FROM std_login WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $student = mysqli_fetch_assoc($result);
        if ($password === $student['password']) {
            session_start();
            $_SESSION['id'] = $student['id'];
            echo "<script>alert('Login successful! Welcome, " . htmlspecialchars($student['name']) . ".');</script>";
            header("Location: complaint_page.php");
            exit;
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.');</script>";
    }
}

$conn->close();
?>

<!-- Login Form -->
<form action="" method="post" autocomplete="off">
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" placeholder="e.g., abc@gmail.com" required><br><br>
    <label for="pass">Password:</label><br>
    <input type="password" name="pass" id="pass" required><br><br>
    <button type="submit">Login</button>
</form>