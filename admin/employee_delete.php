<?php
    require_once "../db/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php') ?>
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include('../admin/navbar.php') ?>
    
    <div class="container">
        <?php
            $id=$_GET['id'];
            try {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // sql to delete a record
                $sql = "DELETE FROM employee WHERE id=$id";
                
                // use exec() because no results are returned
                $conn->exec($sql);
                    echo "Record deleted successfully";
                    echo "<a class='btn btn-lg btn-outline-primary' href='../admin'>BACK</a>";
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        ?>
    </div>
</body>
</html>

