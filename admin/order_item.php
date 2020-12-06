<?php
require('top.inc.php');
if(isset($_GET['id'])){
	
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from tbl_order_child where Order_id='$id'");
	

		
		
	}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="order.php">Back</a></h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Item Name</th>							 
							   <th>Quantity</th>
							   
							   
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){

                               
	                            $item_id=$row['Item_id']; 
	                            $qty=$row['Corder_qty']; 
	                           // $Item_pres=$row['Item_pres'];
	                            $r3=mysqli_query($con,"select *from tbl_item where item_id='$item_id'");
	                            $y=mysqli_fetch_assoc($r3);
	                            $name=$y['Item_name'];

	                           



								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $name?></td>
												 
							   <td><?php echo $qty;?></td>
							  
							 	 <td> <span class='badge badge-pending'><a href="Item_pres.php?id=<?php  echo $row['Order_id']?>&b=<?php  echo $row['Corder_id']?>">Prescription</a></span></td>
							  
							</tr>
							<tr>
                            
                              
                                 
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