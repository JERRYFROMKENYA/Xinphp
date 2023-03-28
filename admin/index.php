
<?php include('./partials/panelMenu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <h2><div id="greetings"></div></h2>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    echo $_SESSION['user'];
                ?>
                <br><br>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM tblstudent";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    STUDENTS
                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM tblworker";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    WORKERS
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM tbladmin";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    ADMINISTRATORS
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(amount) AS Total FROM tblcredit";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>Ksh. <?php echo $total_revenue; ?></h1>
                    <br />
                    FEES PAID THIS SEM
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>