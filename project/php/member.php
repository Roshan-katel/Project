<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);

    if ($name && $email && $contact && $address) {
        $stmt = $conn->prepare("INSERT INTO members (name, email, contact, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $contact, $address);

        if ($stmt->execute()) {
            $message = "✅ Member registered successfully!";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "⚠️ Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Become a Member - RK Bookstore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #3f51b5;
        }

        form {
            max-width: 500px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .message {
            text-align: center;
            font-weight: bold;
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>🧑 Become a Member</h2>

    <?php if ($message): ?>
        <p class="message <?= str_starts_with($message, '❌') || str_starts_with($message, '⚠️') ? 'error' : '' ?>">
            <?= $message ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" id="contact" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
