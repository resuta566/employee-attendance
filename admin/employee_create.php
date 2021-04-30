<?php
    require_once "../db/connect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include('header.php') ?>
    <title>Employee</title>
</head>

<body>
    <?php include('../admin/navbar.php') ?>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Create Employee</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" id="fname" />
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="lname" />
                    </div>
                    <div class="mb-3">
                        <label for="pos" class="form-label">Position</label>
                        <input type="text" name="pos" class="form-control" id="pos" />
                    </div>                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="number" step="1" name="status" class="form-control" id="status" />
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">
                            Address
                        </label>
                        <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-md btn-outline-success" type="submit">Submit</button>
                    </div>
                </form>

                <?php
                try {
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            date_default_timezone_set("Asia/Manila");
                            $insertdate = date("Y-m-d H:i:s");
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $pos = $_POST['pos'];
                            $e_status = $_POST['status'];
                            $e_address = $_POST['address'];

                            $sql = "INSERT INTO employee (lastname,firstname,position,address,status,created_at)
                            VALUES ('$lname', '$fname','$pos','$e_address','$e_status', '$insertdate')";
                            $conn->exec($sql);
                            echo "New record created successfully";
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