<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "bookstore";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Add Book ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $book_name = $_POST['book_name'] ?? '';
    $author_name = $_POST['author_name'] ?? '';
    $price = $_POST['price'] ?? 0;

    $stmt = $conn->prepare("INSERT INTO book (book_name, author_name, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $book_name, $author_name, $price);
    $stmt->execute();
    $stmt->close();
}

// --- Delete Book ---
if (isset($_GET['delete_book'])) {
    $id = (int)$_GET['delete_book'];
    $stmt = $conn->prepare("DELETE FROM book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
}

// --- Delete Feedback ---
if (isset($_GET['delete_feedback'])) {
    $id = (int)$_GET['delete_feedback'];
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
}

// --- Delete Member ---
if (isset($_GET['delete_member'])) {
    $id = (int)$_GET['delete_member'];
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
}

// Fetch books
$books = $conn->query("SELECT * FROM book ORDER BY id DESC");

// Fetch feedback
$feedbacks = $conn->query("SELECT * FROM feedback ORDER BY id DESC");

// Fetch members
$members = $conn->query("SELECT * FROM members ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - RK Bookstore</title>
    <style>
        body { font-family: Arial; margin:20px; background:#f9f9f9; }
        h2 { color:#3f51b5; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; background:#fff; box-shadow: 0 0 5px rgba(0,0,0,0.1);}
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #3f51b5; color: white; }
        form { background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        input[type=text], input[type=number] { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { background: #3f51b5; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
        a.delete-btn { color: red; font-weight: bold; text-decoration: none; }
        .logout { float: right; margin-top: -40px; }
    </style>
</head>
<body>

<h1>Admin Dashboard <a href="admin_login.php?logout=1" class="logout">Logout</a></h1>

<!-- Add Book Form -->
<h2>Add New Book</h2>
<form method="POST">
    <input type="text" name="book_name" placeholder="Book Name" required />
    <input type="text" name="author_name" placeholder="Author Name" required />
    <input type="number" step="0.01" min="0" name="price" placeholder="Price" required />
    <button type="submit" name="add_book">Add Book</button>
</form>

<!-- Books List -->
<h2>Books</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Author</th><th>Price</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php while($row = $books->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['book_name']) ?></td>
                <td><?= htmlspecialchars($row['author_name']) ?></td>
                <td>Rs. <?= number_format($row['price'], 2) ?></td>
                <td><a class="delete-btn" href="admin.php?delete_book=<?= $row['id'] ?>" onclick="return confirm('Delete this book?')">Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Feedback List -->
<h2>Feedback</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php while($fb = $feedbacks->fetch_assoc()): ?>
            <tr>
                <td><?= $fb['id'] ?></td>
                <td><?= htmlspecialchars($fb['name']) ?></td>
                <td><?= htmlspecialchars($fb['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($fb['message'])) ?></td>
                <td><a class="delete-btn" href="admin.php?delete_feedback=<?= $fb['id'] ?>" onclick="return confirm('Delete this feedback?')">Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Members List -->
<h2>Members</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php while($mem = $members->fetch_assoc()): ?>
            <tr>
                <td><?= $mem['id'] ?></td>
                <td><?= htmlspecialchars($mem['name']) ?></td>
                <td><?= htmlspecialchars($mem['email']) ?></td>
                <td><?= htmlspecialchars($mem['phone']) ?></td>
                <td><a class="delete-btn" href="admin.php?delete_member=<?= $mem['id'] ?>" onclick="return confirm('Remove this member?')">Remove</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
<?php $conn->close(); ?>
