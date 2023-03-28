<?php include('../partials/menu.php'); ?>

    <div class="main-content" style="margin-bottom: 10px;">
        <div class="wrapper">
            <h1>Manage Rooms</h1>

            <br /><br /><br />

            <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br><br>
            <div ><a href="./add-room.php" class="btn-primary">Add Room</a></div>

            <div class="wrapper" style="display: flex;flex-wrap: wrap">



                <?php
                //Get all the orders from database
                $sql = "SELECT * FROM tblroom "; // DIsplay the Latest Order at First
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count the Rows
                $count = mysqli_num_rows($res);

                $sn = 1; //Create a Serial Number and set its initail value as 1

                if($count>0)
                {

                    //Order Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $roomNo = $row['roomNo'];
                        $stdRmSQL="SELECT * FROM studentroom where roomNo='$roomNo' ";
                        $stdRmRes =mysqli_query($conn,$stdRmSQL);
                        $occupantCount=mysqli_num_rows($stdRmRes);
                        $stdRmRow=mysqli_fetch_assoc($stdRmRes);
                        $roomCapacity=$row['capacity'];
                        if($occupantCount/$roomCapacity==1){$style="red";}
                        elseif($occupantCount/$roomCapacity<1 &&$occupantCount/$roomCapacity>0 ){$style="yellow";}
                        elseif ($occupantCount==0){$style="green";}
                        elseif($occupantCount/$roomCapacity==0){$style="limegreen";}

                        //Get all the order details

                        $nominalNo = $row['nominalNo'];
                        $roomFloor = $row['roomFloor'];
//                                $semNo=$stdRmRow['semNo'];



                        ?>

                        <div class="col-4 text-center" style="background-color: <?php echo "$style" ?>; width:auto;">
                            <a  href="./manage-room.php?id=<?php echo $roomNo ?>"><img src="../images/logo/X-logos_transparent.png" alt="" style="width: 90px;"></a>
                            <h4> Room No:</h4>
                            <p><?php echo $nominalNo?></p>
                        </div>

                        <?php

                    }
                }
                else
                {
                    //Order not Available
                    echo "<div><div colspan='12' class='error'>Rooms not added</div></div>";
                }
                ?>


            </div>
        </div>

    </div>





<?php include('../partials/footer.php'); ?>