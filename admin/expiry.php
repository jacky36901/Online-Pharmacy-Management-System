<?php
require('top.inc.php');

// if(isset($_GET['type']) && $_GET['type']!=''){
// 	$type=get_safe_value($con,$_GET['type']);
// 	if($type=='status'){
// 		$operation=get_safe_value($con,$_GET['operation']);
// 		$id=get_safe_value($con,$_GET['id']);
// 		if($operation=='active'){
// 			$status='1';
// 		}else{
// 			$status='0';
// 		}
// 		$update_status_sql="update tbl_Category set status='$status' where cat_id='$id'";
// 		mysqli_query($con,$update_status_sql);
// 	}
	
// 	if($type=='delete'){
// 		$id=get_safe_value($con,$_GET['id']);
// 		$delete_sql="delete from tbl_Category where cat_id='$id'";
// 		mysqli_query($con,$delete_sql);
// 	}
// }

$sql="SELECT Item_id, Cpurchase_id,Batch_no,Date_exp, DATEDIFF( Date_exp, CURDATE( ) ) AS days FROM tbl_purchase_child WHERE DATEDIFF( Date_exp, CURDATE( ) ) <60 and status!='check'";
$res=mysqli_query($con,$sql);
 // $p=mysqli_fetch_array($res);
	
	//  $days=$p['days'];
	//  echo $days;

?>
<head>



</head>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">MEDICINES TO BE DISPOSED</h4>
				   
                      <h4 class="box-link"><a href="expiryreport.php">Expiry</a></h4>
      
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   
							   <th>Item Name</th>
							   <th>Expiry Date</th>
							   <th>Days till expiry</th>
							   <th>Rack number</th>
							   <th>Batch number</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){
							   
                                        $item_id=$row['Item_id']; 
                                        $r3=mysqli_query($con,"select *from tbl_item where item_id='$item_id'");
	                                    $y=mysqli_fetch_assoc($r3);
	                                    $name=$y['Item_name'];
	                                    $rack=$y['Rack_no'];


								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							  
							   <td><?php echo $name?></td>
							   <td><?php echo $row['Date_exp']?></td>
							   <td><?php echo $row['days']?></td>
							   <td><?php echo $rack?></td>
							   <td><?php echo $row['Batch_no']?></td>
						 <td>	   
                     <?php
                        
                      
                        

                       echo "<span class='badge badge-edit'><a href='manage_expiry.php?id=".$row['Item_id'].'&b='.$row['Batch_no']."'>Edit</a></span>&nbsp;";
                        
                        ?>
                        </td>
							   </td>
							   
							>
							</tr>
							<?php $i+=1; } ?> 
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