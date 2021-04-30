<?php
    require_once '../db/connect.php';

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <?php include('header.php') ?>
    <title>Employee</title>
</head>

<body>
    <?php include('../admin/navbar.php') ?>
    <br>
    <div class='container'>
        <div class='card'>
            <div class='card-header'>
                <h3>Edit Employee</h3> <a class="btn btn-sm btn-outline-primary" href="../">Back</a>
            </div>
            <div class='card-body'>
            <?php
                $id=$_GET['id'];
                try {
                        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            $id=$_GET['id'];
                            $sql = "SELECT * from employee WHERE id=$id ";
                            $employee = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);   
                            foreach ($employee as $key=>$data){
                               
                                echo "<form action='' method='post'>";
                                echo "<div class='mb-3'>";
                                echo "<label for='fname' class='form-label text-capitalize'>$key</label>";
                                if($key == 'id' || $key =='created_at')
                                {                                    
                                    echo '<input type="text" value="'.$data.'" readonly name="'.$key.'" class="form-control" id="'.$key.'" />';
                                }else{                                    
                                    echo '<input type="text" value="'.$data.'" name="'.$key.'" class="form-control" id="'.$key.'" />';
                                }
                                echo "</div>";
                            }   
                            echo '
                            <div class="mb-3">
                                <button class="btn btn-md btn-outline-success" type="submit">Submit</button>
                            </div>';
                        }
                    }catch(PDOException $e)
                    {
                
                        echo $sql . '<br>' . $e->getMessage();
                    }

                    try {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $lastname = $_POST['lastname'];
                            $firstname = $_POST['firstname'];
                            $position = $_POST['position'];
                            $status = $_POST['status'];
                            $address = $_POST['address'];

                            $sql = "UPDATE employee 
                                SET lastname = '$lastname' , firstname = '$firstname' ,position = '$position' ,address = '$address', status = '$status'
                                WHERE id=$id";
                            $conn->exec($sql);
                            echo "Update record created successfully";
                        }
                    }catch(PDOException $e)
                    {
                
                        echo $sql . "<br>" . $e->getMessage();
                    }
                ?>

                
            </div>
        </div>
    </div>
</body>

</html>