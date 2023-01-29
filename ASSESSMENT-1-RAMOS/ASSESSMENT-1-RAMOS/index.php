<?php
require("Config/Connect.php");

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contactNum = $_POST['contactNum'];

    $sql = "INSERT INTO `userinfo`(`fname`, `lname`, `contactNum`) VALUES ('$fname', '$lname', $contactNum)";
    $insert = mysqli_query($conn,$sql);
    if(!$insert){
        $em = "Failed to submit data";
        header("Location:index.php?error=$em");
    }
    else{
        header('Location:index.php');
    }
}if(isset($_GET['deleteId'])){
    $deleteId = $_GET['deleteId'];
    $sql = "DELETE from userinfo WHERE userID = '$deleteId'";
    $insert = mysqli_query($conn,$sql);
    if(!$insert){
        $em = "Failed to delete data";
        header("Location:index.php?error=$em");
    }
    else{
        header('Location:index.php');
    }
}if(isset($_POST['update'])){
    $updateId = $_GET['updateId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contactNum = $_POST['contactNum'];

    $sql = "UPDATE userinfo SET fname = '$fname', lname = '$lname', contactNum = '$contactNum' where userID = '$updateId'";
    $insert = mysqli_query($conn,$sql);
    if(!$insert){
        $em = "Failed to submit data";
        header("Location:index.php?error=$em");
    }
    else{
        header('Location:index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ASSESSMENT 1 - Ramos</title>
</head>

<body>
    <div class="container">
        <div class="table-container">
            <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Action</th>
            </tr>
        <?php
        $sql= "SELECT * FROM userinfo";
        $return = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_array($return)){
        ?>
            <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['contactNum']; ?></td>
                <td>
                <button class = "update" type="button" name="update"><a href = <?php echo "index.php?&updateId=".$row['userID'].""; ?>>Edit</button>
                <button class = "delete" type="button" name="delete"><a href = <?php echo "index.php?&deleteId=".$row['userID'].""; ?>>Delete</button>
                </td>
            </tr>
        <?php
        }
        ?>
            </table>
        
        </div>
        
        <?php
        if(isset($_GET['updateId'])){
        $updateId = $_GET['updateId'];
        $sql = "SELECT * from userinfo WHERE userID = '$updateId'";
        $return = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_array($return)){
        
        ?>
        <div class="form-container">
            <form action="" method = "POST">
                <label for="fname">First Name
                    <input type="text" name="fname" value =<?php echo $row['fname']; ?> required>
                </label>
                <label for="lname">Last Name
                    <input type="text" name="lname" value =<?php echo $row['lname']; ?> required>
                </label>
                <label for="contactNum">Contact Number
                    <input type="number" name="contactNum" value =<?php echo $row['contactNum']; ?> required>
                </label>
                <button class = "submit" type="submit" name = "update" >Update</button>
                <button class = "reset" type="reset" name = "reset" ><a href = "index.php">Cancel</button>
            </form>
            <?php
        }
        }   
        else{
            ?>
            <form action="" method = "POST">
                <label for="fname">First Name
                    <input type="text" name="fname" required>
                </label>
                <label for="lname">Last Name
                    <input type="text" name="lname" required>
                </label>
                <label for="contactNum">Contact Number
                    <input type="number" name="contactNum" required>
                </label>
                <button class = "submit" type="submit" name = "submit" >Submit</button>
            </form>

            <?php
        }
            ?>
        </div>
    </div>
</body>
</html>