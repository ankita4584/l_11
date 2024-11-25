<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login_admin.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "mysql", "utkarsh12@", "student");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch complaints
$sql = "SELECT * FROM complain";
$result = mysqli_query($conn,$sql);
?>

<h1>Admin Dashboard</h1>
<table >
    <thead>
        <tr>
            <th>Complaint ID</th>
            <th>Student Name</th>
            <th>Complaint</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php $conn->close(); ?>
