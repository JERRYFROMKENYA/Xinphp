<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Worker</h1>

        <br /><br />

                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/Worker/add-worker.php" class="btn-primary">Add Worker</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Contact</th>
                        <th>Role</th>
<!--                        <th>Featured</th>-->
<!--                        <th>Active</th>-->
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Worker
                        $sql = "SELECT * FROM tblworker";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows to check whether we have workers or not
                        $count = mysqli_num_rows($res);
                        //Create Serial Number Variable and Set Default VAlue as 1
                        $sn=1;
                        if($count>0)
                        {
                            //We have worker in Database
                            //Get the Workers from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $workerNo = $row['workerNo'];
                                $FName = $row['FName'];
                                $MName = $row['MName'];
                                $LName = $row['LName'];
                                $idNo = $row['idNo'];
                                $workRole=$row['workRole'];
                                $email=$row['email'];
                                $phoneNumber=$row['phoneNumber'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $FName." ".$MName." ".$LName; ?></td>
                                    <td><?php echo $idNo; ?></td>
                                    <td>
                                        <?php echo"Phone Number: <br> ".$phoneNumber." email: ".$email ?>
                                    </td>
                                    <td><?php echo $workRole; ?></td>

                                    <td>

                                        <a href="<?php echo SITEURL; ?>admin/Worker/update-worker.php?id=<?php echo $workerNo; ?>" class="btn-secondary">Update Worker</a>
                                        <br><br><a href="<?php echo SITEURL; ?>admin/Worker/delete-worker.php?id=<?php echo $workerNo; ?>" class="btn-danger">Delete Worker</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Worker not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Worker not Added Yet. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>

<?php include('../partials/footer.php'); ?>