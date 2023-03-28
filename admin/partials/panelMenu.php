<?php

include('../config/constants.php');
include('login-check.php');

?>


<html>
<head>
    <title>Group X Hostels</title>

    <link rel="stylesheet" href="../css/admin.css">
    <script defer="true" onload="">
        const Today = new Date();
        const Hour= Today.getHours()
        function getTime(){
            if(Hour>=12)
            {
                console.log("works")
                return ("Good Afternoon")
            }
            if(Hour<12)
            {
                console.log("works")
                return ("Good Morning")
            }
            if(Hour>16)
            {
                console.log("works")
                return ("Good Evening")
            }
            //console.log(x)
        }


            const x = getTime();
            // console.log(x);
            document.getElementById("greetings").innerHTML = x;

        ;
    </script>
</head>

<body>
<!-- Menu Section Starts -->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="./Admin/">Admin</a></li>
            <li><a href="./Student/">Students</a></li>
            <li><a href="./Worker/">Workers</a></li>
            <li><a href="./Rooms/">Rooms</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<!-- Menu Section Ends -->
