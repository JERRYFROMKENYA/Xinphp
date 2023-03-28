<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the Session is Set of Not
            {
                echo $_SESSION['add']; //Display the Session Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="Fname" placeholder="Enter Your First Name">
                    </td>
                    <td>
                        <input type="text" name="Lname" placeholder="Enter Your Last Name">
                    </td>
                </tr>
                <tr>
                    <td>Identification: </td>
                    <td>
                        <input type="text" name="idNo" placeholder="Your Identification">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('../partials/footer.php'); ?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $Fname = $_POST['Fname'];
        $Lname=$_POST['Lname'];
        $username = $_POST['username'];
        $idNo=$_POST['idNo'];
        $password = md5($_POST['password']);
         //Password Encryption with MD5
        $date= date("Y-m-d h:i:sa");

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbladmin SET 
            Fname='$Fname',Lname='$Lname',
            username='$username',
            dateTimeCreated='$date',
            role='admin',
            idNo='$idNo'
        ";
 
        //3. Executing Query and Saving Data into Database
        $res = mysqli_query($conn, $sql);
       

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        { 
        $sql2="SELECT * from tbladmin where username='$username'";
        $res2=mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($res2);
        if($count==1)
        {
            //Get all the data
            $row2 = mysqli_fetch_assoc($res2);
            $adminID = $row2['adminID']; 
        $sql3="INSERT into adminpasswd SET
        dateTimeCreated='$date',
        adminID='$adminID',
        passwd='$password'";
        $res2=mysqli_query($conn, $sql3);


        }


   
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/Admin');
        }
        
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/Admin/add-admin.php');
        }

    }
    
?>