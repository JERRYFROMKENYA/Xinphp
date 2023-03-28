<?php
include("../partials/menu.php");
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    //initialize db variables
    $SRsql="SELECT * from studentroom where roomNo=$id";
    $sql="SELECT * from tblroom where roomNo=$id";
    $SRres=mysqli_query($conn,$SRsql);
    $SRcount=mysqli_num_rows($SRres);
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    //rows for SR
   $SRrow=mysqli_fetch_assoc($SRres);
//      Semester
       $row=mysqli_fetch_assoc($res);
    $nominalNo=$row['nominalNo'];
       if(isset($SRrow['semNo'])){$semNo = $SRrow['semNo'];
           $semSQL = "SELECT * from tblsem where semNo='$semNo'";
           $semRes = mysqli_query($conn, $semSQL);
           $semRow = mysqli_fetch_assoc($semRes);
           $semester = $semRow['semester'];

       }









}
?>


       <div class="main-content">
           <div class="wrapper" style="display: flex; flex-wrap: wrap">
               <div class="col-4 text-center" style="background-color: <?php echo "white" ?>">
                   <div><img src="../images/logo/X-logos_transparent.png" alt="" style="width: 100px;"></div>

           </div>
               <div>
                   <fieldset><legend style="padding: 5px">Room No:</legend>
                   <p class="text-center text-white" style="font-weight: bold ;font-size: 42px"><?php echo $nominalNo ?></p>
                   </fieldset>
                   <fieldset style="margin-top: 15px">
                       <Legend style="padding: 5px; margin-top: 15px; ">
                           Occupants
                       </Legend>
                       <table>
                           <tr><th>No.</th> <th>Name</th><th>Actions</th></tr>
                           <?php
                           $SRsql="SELECT * from studentroom where roomNo=$id";
                           $SRres=mysqli_query($conn,$SRsql);

                           $no=0;
                           while($SRrow=mysqli_fetch_assoc($SRres)) {

                               $no++;
                               if (isset($SRrow['studentID'])) {
//
                                   $stdID = $SRrow['studentID'];


                                   $namesql = "SELECT concat(Fname, ' ', Lname) as fullName  from tblstudent where studentID='$stdID'";
                                   $nameres = mysqli_query($conn, $namesql);
                                   $namearr = mysqli_fetch_assoc($nameres);
                                   $stdname = $namearr['fullName'];
//                                   echo  "Hi";
                                   echo "<tr>" . "<td>" . $no . "</td>" . "<td>" . $stdname . "</td>" . "<td>" . "<button class='btn-danger'><a style='text-decoration: none; color: white;' href='/unadd-occupant.php?id=$id'>Unadd Occupant</a></button> " . "</td>" . "</tr>";

                               }


                               else {
                                   echo "<tr class='error'><td>No Occupants</td><tr>";

                               }
                           }




                           ?>
                       </table>
                   </fieldset>

               </div>
       </div>


       </div>

<?php include('../partials/footer.php'); ?>
