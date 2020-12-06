<?php
require('top.inc.php');
// $username="";
if(isset($_GET['type']) && $_GET['type']!=''){
   $type=get_safe_value($con,$_GET['type']);
   // if($type=='status'){
   //    $operation=get_safe_value($con,$_GET['operation']);
   //    $id=get_safe_value($con,$_GET['id']);
   //    if($operation=='active'){
   //       $status='1';
   //    }else{
   //       $status='0';
   //    }
   //    $update_status_sql="update tbl_staff set status='$status' where Staff_id='$id'";
   //    mysqli_query($con,$update_status_sql);
   // }
   
   if($type=='delete'){
      $id=get_safe_value($con,$_GET['id']);
      $username=get_safe_value($con,$_GET['username']);
      $delete_sql="delete from tbl_staff where Staff_id='$id'";
      $delete_sql1="delete from login where username='$username'";
      mysqli_query($con,$delete_sql);
       mysqli_query($con,$delete_sql1);
   }
}

$sql="select * from tbl_staff";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">STAFF</h4>
               <h4 class="box-link"><a href="manage_staff.php">Add Staff</a> </h4>
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        
                        <th class="serial">ID</th>
                        <th>username</th>
                        <th>fname</th>
                        <th>lname</th>
                        <th>DOB</th>
                        <th>Number</th>
                       <th>Address</th>
                        <th>DOJ</th>
                        <th>Desc</th>
                        <th></th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php 
                     $i=1;
                     while($row=mysqli_fetch_assoc($res)){?>
                     <tr>
                        
                        <td class="serial"><?php echo $row['Staff_id']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['Staff_fname']?></td>
                        <td><?php echo $row['Staff_lname']?></td>
                        <td><?php echo $row['Staff_dob']?></td>
                        <td><?php echo $row['Staff_num']?></td>
                        <td><span class='badge badge-pending'><a href=
                    "staff_address.php?id=<?php echo $row['Staff_id'];?>">Address</a></span>&nbsp;</td>
                        <td><?php echo $row['Staff_doj']?></td>
                        <td><?php echo $row['Staff_des']?></td>

                        <td>
                        <?php
                        
                        echo "<span class='badge badge-edit'><a href='manage_staff.php?id=".$row['Staff_id']."'>Edit</a></span>&nbsp;";
                        
                       // echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['Staff_id']."&username=".$row['username']."'>Delete</a></span>";
                        
                        ?>
                        </td>
                     </tr>
                     <?php } ?>
                   </tbody>
                 </table>
               </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>
<?php
require('footer.inc.php');
?>