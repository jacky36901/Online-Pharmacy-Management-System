<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update tbl_Category set status='$status' where cat_id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from tbl_Category where cat_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select tbl_delivery.*,tbl_order_master.*,tbl_payment.Payment_mode from tbl_delivery,tbl_order_master,tbl_payment where tbl_delivery.Payment_id=tbl_payment.Payment_id and tbl_order_master.Order_id=tbl_payment.Order_id order by tbl_order_master.Order_date ";
$res=mysqli_query($con,$sql);

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title"> </h4>
				   <h4 class="box-link">DELIVERY MANAGEMENT </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Delivery ID</th>
							   <th>Payment ID</th>
							   
							   <th>Staff name</th>
							   <th>Order_id</th>
							   <th>Amount</th>
							   <th>Payment mode</th>
							   <th>Delivery Status</th>
							   <th>Delivery Date</th>
							   <th></th>
							   
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;

							while($row=mysqli_fetch_assoc($res)){
								$sid= $row['Staff_id'];
								$sql1="select * from tbl_staff where Staff_id='$sid' ";
                                 $res1=mysqli_query($con,$sql1);
                                 $row1=mysqli_fetch_assoc($res1)
								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Delivery_id']?></td>
							   <td><?php echo $row['Payment_id']?></td>
							   <td><?php echo $row1['Staff_fname']?></td>
                               <td><?php echo $row['Order_id']?></td>
                                <td><?php echo $row['Order_amt']?></td>
							   <td><?php echo $row['Payment_mode']?></td>
							   <td><?php echo $row['Delivery_status']?></td>
							   
							   <td><?php echo $row['Delivery_date']?></td>
							   
							   <td>
								<?php
							
								echo "<span class='badge badge-edit'><a href='manage_delivery.php?id=".$row['Payment_id']."'>Status</a></span>&nbsp;";
								
							
								
								?>
							   </td>
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