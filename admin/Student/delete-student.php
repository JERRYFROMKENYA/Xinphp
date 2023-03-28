<?php 
    //Include Constants File
    include('../../config/constants.php');

    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is Available. So remove it
            $path = "../images/student/".$image_name;
            //Remove the Image
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process
//            if($remove==false)
//            {
//                //Set the SEssion Message
//                $_SESSION['remove'] = "<div class='error'>Failed to Remove Student Image.</div>";
//                //REdirect to Manage Student page
//                header('location:'.SITEURL.'admin/Student');
//                //Stop the Process
//                die();
//            }
        }

        //Delete Data from Database
        //SQL Query to Delete Data from Database
        $imgsql = "DELETE FROM tblstdimg WHERE studentID=$id ";
        $sql = "DELETE FROM tblstudent WHERE studentID=$id ";

        //Execute the Query
        $imgres= mysqli_query($conn,$imgsql);

        if($imgres == true)
        {
            $res = mysqli_query($conn, $sql);
        }
        else{
            //SEt Fail MEssage and Redirects
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Student.</div>";
            //Redirect to Manage Student
            header('location:'.SITEURL.'admin/Student');

        }


        //Check whether the data is delete from database or not
        if($res==true)
        {
            //SEt Success MEssage and REdirect
            $_SESSION['delete'] = "<div class='success'>Student Deleted Successfully.</div>";
            //Redirect to Manage Student
            header('location:'.SITEURL.'admin/Student');
        }
        else
        {
            //SEt Fail MEssage and Redirecs
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Student.</div>";
            //Redirect to Manage Student
            header('location:'.SITEURL.'admin/Student');
        }

 

    }
    else
    {
        //redirect to Manage Student Page
        header('location:'.SITEURL.'admin/Student');
    }?>