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

$sql="select * from tbl_order_master order by Order_date desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title"> </h4>
				   <h4 class="box-link">Manage Order </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Order ID</th>
							   <th>Cust_name</th>
							   <th>Order Date</th>
							   <th>Order Amount</th>
							   <th>Ordered Items</th>
							   <th>Order Status</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){
								$ccid=$row['cust_id'];
							$sql1="select * from tbl_cust where cust_id='$ccid'";
                             $res1=mysqli_query($con,$sql1);
                             $row1=mysqli_fetch_assoc($res1);
                             $cname=$row1['cust_fname'];
?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Order_id'];   $or=$row['Order_id'];?></td>
							   <td><?php echo $cname?></td>
							   <td><?php echo $row['Order_date']?></td>
							   <td><?php echo number_format($row['Order_amt'])." Rs";?></td>
							   <td> <span class='badge badge-pending'><a href="order_item.php?id=<?php  echo $row['Order_id']?>">Items</a></span></td>
							   <td><?php echo $row['Order_status']?></td>
							   
							   <td>
								<?php
							
								echo "<span class='badge badge-edit'><a href='manage_order.php?id=".$row['Order_id']."'>Status</a></span>&nbsp;";
								
							
								
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