<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Student</h1>

        <br><br>


        <?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tblstudent WHERE studentID=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $studentID = $row['studentID'];
                    $fname = $row['Fname']." ";
                   $mname= $row['Mname'];
                   $lname=$row['Lname'];
                    $email=$row['email'];
                    $phoneNo=$row['phoneNo'];
                    $dateRegistered = $row['dateRegistered'];
                    $gender = $row['sex'];
                    $currImageSQL="SELECT imgName from tblstdimg where studentID=$studentID";
                    $currImageRes=mysqli_query($conn,$currImageSQL);
                    $currImageRow=mysqli_fetch_assoc($currImageRes);
                    $currImageTitle=$currImageRow['imgName'];
                }
                else
                {
                    //redirect to manage sTudent with session message
                    $_SESSION['no-sTudent-found'] = "<div class='error'>STudent not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-student.php');
                }

            }
            else
            {
                //redirect to Manage STudent
                header('location:'.SITEURL.'admin/manage-sTudent.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($currImageTitle != "")
                            {
                                //Display the Image?>
                                <img src="<?php echo SITEURL; ?>admin/images/student/<?php echo $currImageTitle; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update STudent" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. UPload the New Image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_STudent_".rand(000, 999).'.'.$ext; // e.g. Food_STudent_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/sTudent/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add STudent Page
                            header('location:'.SITEURL.'admin/manage-sTudent.php');
                            //STop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/sTudent/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-sTudent.php');
                                die();//Stop the Process
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE tbl_sTudent SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage STudent with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //STudent Updated
                    $_SESSION['update'] = "<div class='success'>STudent Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-sTudent.php');
                }
                else
                {
                    //failed to update sTudent
                    $_SESSION['update'] = "<div class='error'>Failed to Update STudent.</div>";
                    header('location:'.SITEURL.'admin/manage-sTudent.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>