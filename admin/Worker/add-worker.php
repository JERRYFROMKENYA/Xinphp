<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Worker</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="FName" placeholder="First Name">
                        <input type="text" name="MName" placeholder="Middle Name">
                        <input type="text" name="LName" placeholder="Last Name">
                    </td>
                </tr>

                <tr>
                    <td>Identification: </td>
                    <td>
                        <input type="text" name="idNo" placeholder="Identification Number">
                    </td>
                </tr>

                <tr>
                    <td>Contacts: </td>
                    <td>
                        <input type="email" name="email" placeholder="email">
                        <input type="text" name="phoneNumber" placeholder="Phone Number">
                    </td>
                </tr>

                <tr>
                    <td>Work Role: </td>
                    <td>
                        <input type="radio" name="workRole" value="Cleaner">Cleaner
                        <input type="radio" name="workRole" value="Cook">Cook
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Worker" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Worker in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $FName = $_POST['FName'];
                $MName = $_POST['MName'];
                $LName = $_POST['LName'];
                $idNo = $_POST['idNo'];
                $phoneNumber = $_POST['phoneNumber'];
                $email=$_POST['email'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['workRole']))
                {
                    $workRole = $_POST['workRole'];
                }
                else
                {
                    $workRole = "Pending"; //SEtting the Default Value
                }



                //3. Insert Into Database

                //Create a SQL Query to Save or Add worker
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql = "INSERT INTO tblworker SET 
                    FName='$FName',MName='$MName',LName='$LName',
                      idNo='$idNo',phoneNumber='$phoneNumber',email='$email',
                      workRole='$workRole'
                ";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Worker page
                if($res == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Worker Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/Worker/');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Worker.</div>";
                    header('location:'.SITEURL.'admin/Worker/');
                }

                
            }

        ?>


    </div>
</div>

<?php include('../partials/footer.php'); ?>