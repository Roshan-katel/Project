<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$purchaseMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_book_id'])) {
    $book_id = (int)$_POST['buy_book_id'];
 $stmt = $conn->prepare("SELECT book_name, price FROM book WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $book = $result->fetch_assoc();

        $purchaseMessage = "Thank you for purchasing <strong>" . htmlspecialchars($book['book_name']) . "</strong> for Rs. " . number_format($book['price'], 2) . ".";
    } else {
        $purchaseMessage = "Book not found.";
    }
    $stmt->close();
}
$sql = "SELECT id, book_name, author_name, price FROM book";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Books - RK Bookstore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #3f51b5;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            color: green;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #3f51b5;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        button.buy-btn {
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        button.buy-btn:hover {
            background-color: #2c387e;
        }
    </style>
</head>
<body>
    <h2>📚 Available Books</h2>

    <?php if ($purchaseMessage): ?>
        <p class="message"><?= $purchaseMessage ?></p>
    <?php endif; ?>

    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Price (Rs.)</th>
                <th>Buy</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['book_name']) ?></td>
                <td><?= htmlspecialchars($row['author_name']) ?></td>
                <td><?= number_format($row['price'], 2) ?></td>
                <td>
                    <form method="POST" style="margin:0;">
                        <input type="hidden" name="buy_book_id" value="<?= $row['id'] ?>" />
                        <button type="submit" class="buy-btn">Buy</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p style="text-align:center;">No books found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
