<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bookstore";

$conn = new mysqli($host, $user, $pass, $db);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../index.php");
        exit();
    } else {
        $status = "Error submitting feedback.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - RK Bookstore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        .contact-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-section h2 {
            color: #3f51b5;
            margin-bottom: 10px;
        }

        .contact-section p {
            margin: 5px 0;
            font-size: 16px;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form h3 {
            color: #3f51b5;
            text-align: center;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #3f51b5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .status {
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>

<div class="contact-section">
    <h2>📞 Contact Us</h2>
    <p><strong>Email:</strong> rkbookstore@gmail.com</p>
    <p><strong>Phone:</strong> +977-9761779966</p>
</div>

<?php if (!empty($status)) echo "<p class='status'>$status</p>"; ?>

<form method="POST" action="">
    <h3>📝 Send Us Your Feedback</h3>
    <input type="text" name="name" placeholder="Your name" required />
    <input type="email" name="email" placeholder="Your email" required />
    <textarea name="message" placeholder="Your message..." rows="5" required></textarea>
    <button type="submit">Submit Feedback</button>
</form>

</body>
</html>
