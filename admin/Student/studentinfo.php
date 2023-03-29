<?php
include('../partials/menu.php');
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

    $psql="select * from tblparent where studentID='$id'";
    $pres=mysqli_query($conn,$psql);
    if($prow=mysqli_fetch_assoc($pres))
    {
        $parentName=$prow["Fname"]." ".$prow["Mname"]." ".$prow["Lname"];
        $parentContact=$prow["email"]." "." ".$prow["phone"];
    }
    $feesql="select * from fees where studentID='$id'";
    $feeres=mysqli_query($conn,$feesql);
    if($feerow=mysqli_fetch_assoc($feeres))
    {
        $feeBalance=$feerow['balance'];
    }




}

?>
<div class="wrapper">
    <div class="main-content" style="padding-left: 30%">
        <div class="student-info">
            <main>
                <h2>Account Details</h2>
                <section class="student-details">
                    <h3>Personal Information</h3>
                    <ul style="list-style-type:none; margin: 10px;">
                        <li><strong>Name:</strong><?php echo $name;?></li>
                        <li><strong>Email:</strong><?php echo $email;?></li>
                        <li><strong>Mobile:</strong><?php echo $phoneNo?></li>
                    </ul>
                    <h3>Parent Information</h3>
                    <ul style="list-style-type:none; margin: 10px;">
                        <li><strong>Name:</strong><?php echo $parentName?></li>
                        <li><strong>Contact:</strong><?php echo $parentContact?></li>
                    </ul>
                    <h3>Room Information</h3>
                    <ul style="list-style-type:none; margin: 10px;">
                        <li><strong>Room Type:</strong> Single Room - Large</li>
                        <li><strong>Campus:</strong><?php echo $schoolName?></li>
                        <li><strong>Registration Number:</strong><?php echo $schoolID?></li>
                        <br>
                        <li style="align-self: center"><strong>Photo: <br></strong> <img style="width: 100px;" src="../images/student/<?php echo $pic?>" alt="Profile Photo"></li>
                        <br><li><strong>Fee Balance:</strong> Ksh.<?php echo $feeBalance ?></li>
                    </ul>
                </section>
            </main>
        </div>

    </div>

</div>

</body>
</html><?php
include("../partials/footer.php");
?>
