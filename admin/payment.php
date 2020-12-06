<?php
require('top.inc.php');
$sql="select * from tbl_order_master";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				<!-- <?php echo $_SESSION['ADMIN_USERNAME']; ?> -->
				   <h4 class="box-title">PAYMENT<hr>
				   <!-- <a href="manage_categories.php"><button class="btn" style="border-color:#75B239;background-color: white;color: black">Add Category</button></a> </h4>  -->
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>PAYMENT ID</th>
							   <th>ORDER ID</th>
                               <th>Payment Date</th>
                               <th>PAYMENT AMOUNT</th>
                               <th>PAYMENT MODE</th>
                               <th>CARD ID</th>
                               <th>PAYMENT STATUS</th>
							  <!-- <th>     </th> -->
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
                            
                               
							while($row=mysqli_fetch_assoc($res)){
						    $or=$row['Order_id'];
							$sql1="select * from tbl_payment where Order_id='$or' ";
                             $r3=mysqli_query($con,$sql1);
                              $y=mysqli_fetch_assoc($r3);
	                           
                             ?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $y['Payment_id']?></td>
							   <td><?php echo $y['Order_id']?></td>
							   <td><?php echo $y['Payment_date']?></td>
                               <td><?php echo $row['Order_amt']?></td>
                               <td><?php echo $y['Payment_mode']?></td>
                               <td><?php echo $y['Card_id']?></td>
							   <td><?php echo $y['Payment_status']?></td>
                               <!-- <td><?php echo "<span class='badge badge-edit'><a href='show_order.php?id=".$row['om_id']."'>STATUS</a></span>&nbsp;"; ?> </td> -->
                              
							</tr>
							<?php $i=$i+1;} ?>
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