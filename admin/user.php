<?php
require('top.inc.php');

// if(isset($_GET['type']) && $_GET['type']!=''){
//   $type=get_safe_value($con,$_GET['type']);
//    if($type=='status'){
//       $operation=get_safe_value($con,$_GET['operation']);
//       $id=get_safe_value($con,$_GET['id']);
//       if($operation=='active'){
//          $status='1';
//       }else{
//          $status='0';
//       }
//       $update_status_sql="update tbl_category set status='$status' where Cat_id='$id'";
//       mysqli_query($con,$update_status_sql);
//    }
   
   //  //if($type=='delete'){
   //     $id=get_safe_value($con,$_GET['id']);
   //     $delete_sql="delete from tbl_category where Cat_id='$id'";
   //    mysqli_query($con,$delete_sql);
   // }
if(isset($_GET['type']) && isset($_GET['id'])){
	   $type=get_safe_value($con,$_GET['type']);

		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="update login set status='$type' where username='$id'";
		mysqli_query($con,$delete_sql);
	
}
  
$sql="select * from tbl_cust";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">Customers</h4>
               
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        <th class="serial">#</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>FName</th>
                        <th>Lname</th>
                        <th>Phone no</th>
                        <th>Address</th>
                        <th>       </th>
                        
                     </tr>
                   </thead>
                   <tbody>
                     <?php 
                     $i=1;
                     while($row=mysqli_fetch_assoc($res)){?>
                     <tr>
                        <td class="serial"><?php echo $i?></td>
                        <td><?php echo $row['cust_id']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['cust_fname']?></td>
                        <td><?php echo $row['cust_lname']?></td>
                        <td><?php echo $row['cust_num']?></td>
                        <td><span class='badge badge-pending'><a href=
                    "user_address.php?id=<?php echo $row['cust_id'];?>">Address</a></span>&nbsp;</td>
                      <td>
								<?php
								$f=$row['username'];
                                  $e="select *from login where username='$f'";
                                  $tp=mysqli_query($con,$e);
                                  $u=mysqli_fetch_assoc($tp);


								
								if($u['status']==0){
								echo "<span class='badge badge-edit'><a href='?type=1&id=".$row['username']."'>Block</a></span>&nbsp;";
							}else{
								
								echo "<span class='badge badge-delete'><a href='?type=0&id=".$row['username']."'>Unblock</a></span>";
							}
								
								?>
							   </td> 


                      <!--   <td>
                        <?php
                        // if($row['status']==1){
                        //    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['Cat_id']."'>Active</a></span>&nbsp;";
                        // }else{
                        //    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['Cat_id']."'>Deactive</a></span>&nbsp;";
                        // }
                        // echo "<span class='badge badge-edit'><a href='manage_categories.php?id=".$row['cust_id']."'>Edit</a></span>&nbsp;";
                        
                        // echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['cust_id']."'>Delete</a></span>";
                        
                        ?>
                        </td> -->
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