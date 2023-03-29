<?php
include("../../partials/menu.php");

$sql="select * from fees";
$res=mysqli_query($conn,$sql);
//while ($row=mysqli_fetch_assoc($res));
//{
//
//}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Fees</h1>
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


        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }



        ?>
        <br><br><!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/Student/add-student.php" class="btn-primary">Add student</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Balance</th>


            <?php
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
                   $name=$row['fullName'];
                   $balance=row['balance'];
                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $name; ?>. </td>
                        <td><?php echo $balance; ?>. </td>
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

<?php include('../../partials/footer.php'); ?>
