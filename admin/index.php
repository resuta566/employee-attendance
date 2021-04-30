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
        <div class="card">
            <div class="card-header">
                <h3>Employee Table </h3> <a href="../admin/employee_create.php" class="btn btn-sm btn-outline-success">Create</a>
            </div>
            <div class="card-body">
                <form action="../admin/index.php" method="get">
                    <input type="text" class="form-control" name="query">
                    <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = ''; 
                            if( isset($_GET['query'])){
                                $query = $_GET['query'];
                            }
                            $employees = $conn->query("SELECT * from `employee`
                             WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%')  OR (`id` LIKE '%".$query."%')")->fetchAll();
                            
                            foreach($employees as $employee): ?>       
                                <tr>
                                    <th scope="row"><a href="../admin/employee_show.php?id=<?php echo $employee['id']?>" ><?= $employee['id'] ?></th></a> 
                                    <td><?= $employee['firstname'] ?></td>
                                    <td><?= $employee['lastname'] ?></td>
                                    <td><?= $employee['position'] ?></td>
                                    <td><?= $employee['address'] ?></td>
                                    <td><?= $employee['status'] ?></td>
                                    <td><?= $employee['created_at'] ?></td>
                                    <td>
                                        <center>
                                        <a  
                                            class="btn btn-sm btn-outline-primary show_employee" 
                                            href="../admin/employee_show.php?id=<?php echo $employee['id']?>" 
                                            type="button">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a  
                                            class="btn btn-sm btn-outline-primary edit_employee" 
                                            href="../admin/employee_edit.php?id=<?php echo $employee['id']?>" 
                                            type="button">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button
                                            class="delete btn btn-sm btn-outline-danger remove_employee" 
                                            id="<?php echo $employee['id']?>"
                                            onclick="myDelete(<?php echo $employee['id']?>)"
                                            type="button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </center>
							        </td>
                                </tr>
                        <?php  endforeach; ?>
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
    <script type="application/javascript">
        function myDelete(id) {
            
            if(confirm('Are you sure to delete this?') == true){
                window.location.href = `http://localhost/employee-attendance/admin/employee_delete.php?id=${id}`;
            }
            return;
        }
    </script>
</body>
</html>

