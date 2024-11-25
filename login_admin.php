<?php

if (isset($_POST['login'])) {
    $conn = new mysqli("localhost", "mysql", "utkarsh12@", "student");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows === 1) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['id']=$admin['id'];
        if ($password == $admin['password']) {  // Consider using password_verify for hashed passwords
            echo "<script>alert('Login successful! Welcome, " . htmlspecialchars($admin['name']) . ".');</script>";
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>alert('No account found with this email. Please register.');</script>";
    }
}
?>

<form method="POST">
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>
