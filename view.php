<?php
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            text-align: center;
        }

        img {
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Hobby</th>
            <th>Age</th>
            <th>Picture</th>
            <th>Cv</th>
        </tr>
        <?php
        $sql = "select * from student";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['Id'] ?></td>
                    <td><?php echo $row['Name'] ?></td>
                    <td><?php echo $row['Email'] ?></td>
                    <td><?php echo $row['Gender'] ?></td>
                    <td><?php echo $row['Dob'] ?></td>
                    <td><?php echo $row['Address'] ?></td>
                    <td><?php echo $row['Hobby'] ?></td>
                    <td><?php echo $row['Age'] ?></td>
                    <td>
                        <img src="<?php echo $row['Picture'] ?>" alt="">
                    </td>
                    <td>
                        <a href="<?php echo $row['Cv'] ?>">View CV</a>
                    </td>

                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>
</html>