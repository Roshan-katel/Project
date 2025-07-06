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
        form{
            width: 40%;
            height: 50%;
            border: 4px solid;
            padding:20px;
            background-color: aqua;
            box-shadow: 10px 10px 20px  10px aqua;
            margin: 0 auto;;
        }
        body{
            background-color: black;
        }
    </style>
</head>
<body>
    <H1>My form</H1>
    <form action="" method="POST" enctype="multipart/form-data">
       
    Name:
        <input type="text" name="Name" id="">
        <br>
        Email:
        <input type="Email" name="Email" id="">
        <br>
        Gender:
        <input type="radio" name="Gender" id="" value="Male">Male
         <input type="radio" name="Gender" id="" value="Female">Female
         <input type="radio" name="Gender" id="" value="Other">Other
         <br>
         Dob:
         <input type="date" name="Dob" id="">
         <br>
         Address:<select name="Address" id="">
            <option value="Kathmandu">Kathmandu</option>
            <option value="Chitwan">Chitwan</option>
            <option value="Pokhara">Pokhara</option>
         </select>
         <br>
         Hobby:
         <input type="checkbox" name="Hobby[]" id="" value="Cricket">Cricket 
            <input type="checkbox" name="Hobby[]" id="" value="Singing">Singing 
               <input type="checkbox" name="Hobby[]" id="" value="Travelling">Travelling 
               <br>
               Age:
               <input type="number" name="Age" id="">
               <br>
               Photo:<input type="file" name="Image" id="" accept="Image/*">
               <br>
               CV: <input type="file" name="Cv" id="">
               <br>
               <input type="submit" name="Submit" id="">
               <input type="reset" name="Reset" id="">
               <button>
                <a href="view.php">view records</a>
               </button>

    </form>
<?php
if(isset($_POST['Submit']))
{
    $Name=$_POST['Name'];
     $Email=$_POST['Email'];
     $Gender=$_POST['Gender'];
    $Dob=date('Y-m-d',strtotime($_POST['Dob']));
    $Address=$_POST['Address'];
    $Hobby=implode(',',$_POST['Hobby']);
    $Age=$_POST['Age'];
    $Pic=$_FILES['Image']['name'];
    $temp1=$_FILES['Image']['tmp_name'];
    $folder1='Pic/'.$Pic;
    move_uploaded_file($temp1,$folder1);
    $Cv=$_FILES['Cv']['name'];
    $temp2=$_FILES['Cv']['tmp_name'];
    $folder2='Cv/'.$Cv;
    move_uploaded_file($temp2,$folder2);
    $sql="Insert into student (Name,Email,Gender,Dob,Address,Hobby,Age,Picture,Cv) values
    ('$Name','$Email','$Gender','$Dob','$Address','$Hobby','$Age','$folder1','$folder2')";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        echo "<script>
        alert('records were inserted succesfully')
        </script>";
    }
    else{
        echo "<script>
        alert('Error in inserting records')
        </script>";
    }
}
?>
</body>
</html>