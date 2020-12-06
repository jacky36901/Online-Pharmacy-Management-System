<?php
require('top.inc.php');
if(isset($_GET['b'])){
	
	$b=get_safe_value($con,$_GET['b']);
	$res=mysqli_query($con,"select * from tbl_order_child where Corder_id='$b'");
	

		
		
	}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Prescription </h4>
				   <h4 class="box-link"><a href="order.php">Back</a></h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							  <center><th>Item Prescription</th></center>							 
							   
							   
							   
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){

                               
	                          
	                           



								?>
							<tr>
							   <td><?php echo '<img src="prescription/'.$row['Item_pres'].'"  width="100px" height="500px" alt="image">'?></td>
							
							  
							
					
                            
                              
                                 
							</tr>
							<?php $i+=1; } ?>
							<tr>
                             
                             
                              

                                
							</tr>
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