<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Student</h1>
        <br/><br/><?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-student-found']))
            {
                echo $_SESSION['no-student-found'];
                unset($_SESSION['no-student-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>
        <br><br><!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/Student/add-student.php" class="btn-primary">Add student</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th></th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>

                    <?php 

                        //Query to Get all CAtegories from Database
                        $sql = "SELECT * FROM tblstudent";


                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows
                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable and assign value as 1
                        $sn=1;

                        //Check whether we have data in database or not
                        if($count>0)
                        {
                            //We have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $studentID = $row['studentID'];
                                $name = $row['Fname']." ".$row['Mname']." ".$row['Lname'];
                                $contact = "Email: ".$row['email']."\n
                                 <br>
                                 \n"."Phone No: ".$row['phoneNo'];
                                $dateRegistered = $row['dateRegistered'];
                                $gender = $row['sex'];
                                $imageSQL="SELECT imgName from tblstdimg where studentID=$studentID";
                                $imageRes=mysqli_query($conn,$imageSQL);
                                $imageRow=mysqli_fetch_assoc($imageRes);
                                $imageTitle=$imageRow['imgName'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td>

                                            <?php
                                            //Chcek whether image name is available or not
                                            if($imageTitle!="")
                                            {
                                                //Display the Image
                                                ?>

                                                <img src="<?php echo SITEURL; ?>admin/images/student/<?php echo $imageTitle; ?>" width="100px" >

                                                <?php
                                            }
                                            else
                                            {
                                                //DIsplay the MEssage
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            ?>

                                        </td>
                                        <td><?php echo $name; ?></td>



                                        <td><?php echo $contact; ?></td>
                                        <td><?php echo $dateRegistered; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/Student/studentInfo.php?id=<?php echo $studentID; ?>" class="btn-secondary">More About Student</a>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>admin/Student/update-student.php?id=<?php echo $studentID; ?>" class="btn-secondary">Update student</a>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>admin/Student/delete-student.php?id=<?php echo $studentID; ?>&image_name=<?php echo $imageTitle; ?>" class="btn-danger">Delete student</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //WE do not have data
                            //We'll display the message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No student Added.</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('../partials/footer.php'); ?>