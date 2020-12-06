<?php
require('top.inc.php');



$sql="select tbl_purchase_master.* from tbl_purchase_master order by Mpurchase_id desc";
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="manage_purchase.php">Manage Purchase</a> <a href="view_purchase.php">View added items</a> <a href="purchase_details.php">Purchase Details</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>							 
							   <th>Staff</th>
							   <th>Total Items</th>					
							   <th>Total Amount</th>
							   <th>Date</th>
							   <th>Items</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Mpurchase_id']?></td>
							   <?php 
							   $st=$row['Staff_id'];
							   if($st==0)
							   {
							   	$nm='Admin';
							   }
							   else{
                               $sw="select *from tbl_staff where Staff_id='$st'";
                                $e=mysqli_query($con,$sw);
                                $d=mysqli_fetch_assoc($e);
                                $nm=$d['Staff_fname'];
                            }
							   ?>						 
							   <td><?php echo $nm;?></td>
							   <td><?php echo $row['Purchase_qty']?></td>
							 							   
							   <td><?php echo number_format($row['Purchase_total'])." Rs"?></td>
							 <td><?php echo $row['Purchase_date'];
							 $pur_id=$row['Mpurchase_id'];?></td>
							   <td>												
								<span class='badge badge-edit'><a href='view_items.php?id=<?php echo $pur_id?>'>items</a></span>																														
   					           </td></form>
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