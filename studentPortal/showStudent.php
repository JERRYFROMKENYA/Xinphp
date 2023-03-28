<?php
include('./config/constants.php');
$id=$_GET['id'];

$sql="Select * from tblstudent where studentID='$id'";

$res=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($res))
{
    $studentID=$row['studentID'];
    $name=$row['Fname']." ".$row['Mname']." ".$row['Lname'];
    $email=$row['email'];
    $phoneNo=$row['phoneNo'];
    $schoolNo=$row['schoolNo'];
    $schsql="select * from tblschools where schoolNo='$schoolNo'";
    $schres=mysqli_query($conn,$schsql);
    if($schrow=mysqli_fetch_assoc($schres))
    {
        $schoolName=$schrow['schoolName']." - ".$schrow['schoolAbbr'];
    }
    $schoolID=$row['schoolID'];

    $picsql="select * from tblstdimg where studentID='$id'";
    $picres=mysqli_query($conn,$picsql);
    if($picrow=mysqli_fetch_assoc($picres))
    {
        $pic=$picrow['imgName'];
    }




}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Account</title>
    <link rel="stylesheet" href="studentshow.css">
    <script src="studentshow.js"></script>
</head>
<body>
<header>
    <h1>Student Account</h1>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Log Out</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Account Details</h2>
    <section class="student-details">
        <h3>Personal Information</h3>
        <ul>
            <li><strong>Name:</strong><?php echo $name;?></li>
            <li><strong>Email:</strong><?php echo $email;?></li>
            <li><strong>Mobile:</strong><?php echo $phoneNo?></li>
        </ul>
        <h3>Parent Information</h3>
        <ul>
            <li><strong>Name:</strong> Yvonne Oyugi</li>
            <li><strong>Contact:</strong> 555-555-5555</li>
        </ul>
        <h3>Room Information</h3>
        <ul>
            <li><strong>Room Type:</strong> Single Room - Large</li>
            <li><strong>Campus:</strong><?php echo $schoolName?></li>
            <li><strong>Registration Number:</strong><?php echo $schoolID?></li>
            <li><strong>Photo:</strong> <img src="../admin/images/student/<?php echo $pic?>" alt="Profile Photo"></li>
<!--            <li><strong>Deposit:</strong> sh.10,000</li>-->
        </ul>
    </section>
</main>
</body>
</html>
