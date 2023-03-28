<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login Hostel X</title>
        <link rel="stylesheet" href="../css/admin.css">
     
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

            <p class="text-center">Created By - <a href="X">Group X</a></p>
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbladmin WHERE username='$username'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $rows=mysqli_fetch_assoc($res);
        $count = mysqli_num_rows($res);
        if($rows==true)
        {
            $adminID= $rows['adminID'];
        }


        if($count==1)
        {
            $sql1= "SELECT * FROM adminpasswd WHERE adminID=$adminID and passwd ='$password'";
            $res1= mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_assoc($res1);
            $inuse=1;
            $count1 = mysqli_num_rows($res1);
            if($count1==1)
            {
                if($inuse==1)
                {
                    //User AVailable and Login Success
                $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it
                //REdirect to HOme Page/Dashboard
                header('location:'.SITEURL.'admin/');
                }
                else
                $_SESSION['login'] = "<div class='error center'>Account Disabled.</div>";
                //REdirect to HOme Page/Dashboard
               // header('location:'.SITEURL.'admin/login.php');}

            }
            else
            $_SESSION['login'] = "<div class='error'> Wrong Password</div>";
            //REdirect to HOme Page/Dashboard
            //header('location:'.SITEURL.'admin/login.php');
           
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>User does not exist.</div>";
            //REdirect to HOme Page/Dashboard
            //header('location:'.SITEURL.'admin/login.php');
        }


    }

?>