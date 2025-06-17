<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #111;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #FFD700; /* Yellow border */
        }
        h1, h2 {
            color: #FFD700; /* Yellow */
        }
        input, button {
            padding: 8px;
            margin: 5px;
            border: none;
            border-radius: 5px;
        }
        input {
            width: 200px;
        }
        button {
            background-color: #FFD700;
            color: #000;
            cursor: pointer;
        }
        button:hover {
            background-color: #e0c000;
        }
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #444;
            text-align: center;
        }
        th {
            color: #FFD700;
        }
        .user-count-box {
            background-color: #222;
            border: 2px solid #FFD700;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Panel</h1>

    <?php
    $result = $conn->query("SELECT * FROM users");
    $total = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
    ?>

    <div class="user-count-box">
        <h2>Total Users: <?= $total ?></h2>
    </div>

    <h2>Add New User</h2>
    <form method="POST" action="add_user.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="number" name="points" placeholder="Points" required>
        <button type="submit">Add User</button>
    </form>

    <h2>User List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
            <th>Points</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['password']) ?></td>
            <td><?= $row['points'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
                <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')"><button>Delete</button></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
