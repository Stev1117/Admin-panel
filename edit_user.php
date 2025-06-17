<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $points = $_POST['points'];

    if ($password) {
        $stmt = $conn->prepare("UPDATE users SET name=?, password=?, points=? WHERE id=?");
        $stmt->bind_param("ssii", $name, $password, $points, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, points=? WHERE id=?");
        $stmt->bind_param("sii", $name, $points, $id);
    }
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Edit User</h1>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        <input type="password" name="password" placeholder="Password">
        <input type="number" name="points" value="<?= $user['points'] ?>" required>
        <button type="submit">Save</button>
    </form>
    <a href="index.php"><button>Back</button></a>
</div>
</body>
</html>
