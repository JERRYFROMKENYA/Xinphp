<?php include('../partials/menu.php'); ?>


    <div class="main-content">
    <div class="wrapper">
        <h1>Add Student</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add Student Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="Fname" placeholder="First Name">
                        <input type="text" name="Mname" placeholder="Middle Name">
                        <input type="text" name="Lname" placeholder="Last Name">
                    </td>
                </tr>


                <tr>
                    <td>Select Passport Photo: </td>
                    <td>
                        <input type="file" name="stdImage">
                    </td>
                </tr>

                <tr>
                    <td>ID No: </td>
                    <td>
                        <input type="text" name="idNo" placeholder="ID Number">
                    </td>
                </tr>

                <tr>
                    <td>Contacts: </td>
                    <td>
                        <input type="text" name="email" PLACEHOLDER="email">
                        <input type="text" name="phoneNo" placeholder="Phone Number">
                        <input type="textarea" name="address" placeholder="address" >
                    </td>
                </tr>
                <tr>
                    <td>School Information: </td>
                    <td>
                    <select name="schoolNo" id=""><?php //To get school information
                    $schSQL="SELECT schoolNo, schoolName, schoolAbbr from tblschools";
                    $schRes=mysqli_query($conn,$schSQL);
                    while($schRow= mysqli_fetch_assoc(($schRes)))
                    {
                        $schid=$schRow['schoolNo'];
                        $name=$schRow['schoolName']." ".$schRow['schoolAbbr'];

                            echo "<option value='$schid'>$name <option>  ";
                        } ?></select>
                        <input type="text" name="schoolID" placeholder="School Id">
                    </td>
                </tr>
                <tr>
                    <td>Gender: </td>
                    <td>
                        <input type="radio" name="sex" value="M">Male
                        <input type="radio" name="sex" value="F">Female
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth: </td>
                    <td>
                        <input type="date" name="dob">

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Student" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Student Form Ends -->

        <?php 
        
            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from Student Form
                $Fname = $_POST['Fname'];
                $Mname = $_POST['Mname'];
                $Lname = $_POST['Lname'];
                $idNo = $_POST['idNo'];
                $email= $_POST['email'];
                $phoneNo= $_POST['phoneNo'];
                $schoolNo=$_POST['schoolNo'];
                $dob=$_POST['dob'];
                $active=true;
                $address=$_POST['address'];
                $dateRegistered=date('Y-m-d H:i:s');


                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['sex']))
                {
                    //Get the VAlue from form
                    $sex = $_POST['sex'];
                }
                else
                {
                    $sex=null;
                }




                //Check whether the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['stdImage']['name']))
                {
                    //Upload the Image
                    //To upload image we need image name, source path and destination path
                    $stdImage = $_FILES['stdImage']['name'];
                    
                    // Upload the Image only if image is selected
                    if($stdImage != "")
                    {

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. .jpg"
                        $var = explode('.', $stdImage);
                        $ext = end($var);

                        //Rename the Image
                        $stdImage = "Student_".rand(000, 999).'.'.$ext; // e.g. Student_834.jpg
                        

                        $source_path = $_FILES['stdImage']['tmp_name'];

                        $destination_path = "../images/student/".$stdImage;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //Redirect to Add Student Page
                            header('location:'.SITEURL.'admin/Student/add-student');
                            //Stop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image and set the image_name value as blank
                    $stdImage="";
                }

                //2. Create SQL Query to Insert Student into Database
                $sql = "INSERT INTO tblstudent SET 
                    Fname='$Fname',
                    Mname='$Mname',
                    Lname='$Lname',
                    idNo='$idNo'
                    ,email='$email',
                    phoneNo='$phoneNo',
                    address='$address',
                    schoolNo='$schoolNo',
                    schoolID='$schid',
                    sex='$sex',
                    dob='$dob',
                    dateRegistered='$dateRegistered',
                    active='$active'
                ";
                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);
                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    $stdIDquery="SELECT studentID from tblstudent where Lname='$Lname' AND dob='$dob'";
                    $IDqueryRes= mysqli_query($conn,$stdIDquery);
                    $IDrow=mysqli_fetch_assoc($IDqueryRes);
                    $stdID=$IDrow['studentID'];
                    $imgSQL="INSERT INTO tblstdimg SET imgName='$stdImage', studentID='$stdID', dateUploaded='$dateRegistered'";
                    $imgRes=mysqli_query($conn, $imgSQL);
                    if($imgRes==true)
                    {
                        //Query Executed and Student Added
                        $_SESSION['add'] = "<div class='success'>Student Added Successfully.</div>";
                        //Redirect to Manage Student Page
                        header('location:'.SITEURL.'admin/Student');
                    }
                    else{
                        $_SESSION['add'] = "<div class='error'>No Image Provided</div>";
                    }
                    }


                else
                {

                    //Failed to Add Student
                    $_SESSION['add'] = "<div class='error'>Failed to Add Student.</div>";
                    //Redirect to Manage Student Page
                    header('location:'.SITEURL.'admin/Student/');
                }
            }
        
        ?>

    </div>
</div>

<?php include('../partials/footer.php'); ?>