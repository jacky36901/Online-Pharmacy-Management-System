
<?php
require('top.inc.php');
if(isset($_GET['id'])){
	
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from tbl_purchase_child where Mpurchase_id='$id'");
	

		
		
	}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="purchase_details.php">Back</a></h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Item Name</th>							 
							   <th>Quantity</th>
							   <th>Total Amount</th>					
							   <th>Vendor</th>
							   <th>Batch.No</th>
							   <th>Date_MFD</th>
							   <th>Date_EXP</th>
							   
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){

                                $cid=$row['Cpurchase_id'];
		                        $vid=$row['Vendor_id'];
	                            $item_id=$row['Item_id']; 
	                            $qty=$row['Units_pur']; 
	                            $amt=$row['tot_amt']; 
	                            $batch=$row['Batch_no']; 
	                            $Date_MFD=$row['Date_mfd']; 
	                            $Date_EXP=$row['Date_exp']; 
	                            $r3=mysqli_query($con,"select *from tbl_item where Item_id='$item_id'");
	                            $y=mysqli_fetch_assoc($r3);
	                            $name=$y['Item_name'];

	                            $r4=mysqli_query($con,"select *from tbl_vendor where vendor_id='$vid'");
	                            $y1=mysqli_fetch_assoc($r4);
	                            $vn=$y1['vendor_name'];



								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $name?></td>
												 
							   <td><?php echo $qty;?></td>
							  
							 							   
							   <td><?php echo number_format($amt)." Rs"?></td>
							     <td><?php echo $vn;
							 ?></td>
							 <td><?php echo $batch;?></td>
							 <td><?php echo $Date_MFD;?></td>
							 <td><?php echo $Date_EXP;?></td>
							  
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