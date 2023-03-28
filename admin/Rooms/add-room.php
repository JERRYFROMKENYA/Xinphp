<?php include('../partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>New Room</h1>

        <br><br>

        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }



        ?>

        <br><br>

        <!-- Add Student Form Starts -->
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Room Details: </td>
                    <td>
                        <input type="number" name="capacity" placeholder="Room Capacity">
                        <input type="number" name="floor" placeholder="Floor Room is Located">
                        <input type="text" name="nominalNo" placeholder="Nominal Number eg. 'A4'"><br>
                        <input type="number" name="price" placeholder="Ksh. 40,000">
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
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
            $capacity = $_POST['capacity'];
            $roomFloor = $_POST['floor'];
            $nominalNo = $_POST['nominalNo'];
            $price = $_POST['price'];



            //2. Create SQL Query to Insert Student into Database
            $sql = "INSERT INTO tblroom SET 
                    capacity='$capacity',
                    nominalNo='$nominalNo',
                    roomFloor='$roomFloor',
                    price='$price'
                    
                ";
            //3. Execute the Query and Save in Database
            $res = mysqli_query($conn, $sql);
            //4. Check whether the query executed or not and data added or not
            if($res==true)
            {
                $_SESSION['add'] = "<div class='success'>Room Added Successfully</div>";
                    header('location:'.SITEURL.'admin/Rooms');
                }
                else{
                    $_SESSION['add'] = "<div class='error'>Room Did Not add</div>";
                }
            }


        ?>

    </div>
</div>

<?php include('../partials/footer.php'); ?>
