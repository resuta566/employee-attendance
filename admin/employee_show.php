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
                <h3>Create Employee</h3> <a class="btn btn-sm btn-outline-primary" href="../">Back</a>
            </div>
            <div class='card-body'>
            <?php
                try {
                        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            $id=$_GET['id'];
                            $sql = "SELECT * from employee WHERE id=$id ";
                            $employee = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);   
                            foreach ($employee as $key=>$data){
                                echo "
                                <div class='mb-3'>
                                    <label for='fname' class='form-label text-capitalize'>$key</label>
                                    <input type='text' value='$data' readonly name='fname' class='form-control' id='fname' />
                                </div>";
                            }   

                            $attendancesql = "SELECT * from attendance WHERE e_id = $id";
                            $employeeAttendaces = $conn->query($attendancesql)->fetchAll();
                            
                            echo '<table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time In</th>
                                        <th scope="col">Time In Date</th>
                                        <th scope="col">Time Out</th>
                                        <th scope="col">Time Out Date</th>
                                        </tr>
                                    </thead>
                                <tbody>';
                            foreach($employeeAttendaces as $employeeAttendace)   
                            {
                                    echo "<tr>
                                    <th scope='row'>{$employeeAttendace['created_date']}</th>
                                    <td>{$employeeAttendace['time_in']}</td>
                                    <td>{$employeeAttendace['time_in_date']}</td>
                                    <td>{$employeeAttendace['time_out']}</td>
                                    <td>{$employeeAttendace['time_out_date']}</td>
                                    </tr>";

                            }
                            echo "</tbody>";
                            echo '</table>';
                        }
                    }catch(PDOException $e)
                    {
                
                        echo $sql . '<br>' . $e->getMessage();
                    }
                ?>

                
            </div>
        </div>
    </div>
</body>

</html>