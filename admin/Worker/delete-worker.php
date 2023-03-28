<?php 
    //Include COnstants Page
    include('../../config/constants.php');

    //echo "Delete Worker Page";

    if(isset($_GET['id'])) //Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
//        $image_name = $_GET['image_name'];
        
        //3. Delete Worker from Database
        $sql = "DELETE FROM tblworker WHERE workerNo=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage Worker with Session Message
        if($res==true)
        {
            //Worker Deleted
            $_SESSION['delete'] = "<div class='success'>Worker Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/Worker/');
        }
        else
        {
            //Failed to Delete Worker
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Worker.</div>";
            header('location:'.SITEURL.'admin/Worker/');
        }

        

    }
    else
    {
        //Redirect to Manage Worker Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-worker.php');
    }

?>