<?php
require('top.inc.php');
$subcategories='';
$categories_id='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);

	$res4=mysqli_query($con,"select * from tbl_Payment where Payment_id='$id'");
	if(!$res4)
	{
		echo "error".mysqli_error($con);
		die();
	}

		$row1=mysqli_fetch_assoc($res4);
	 	$oid=$row1['Order_id'];


}


if(isset($_POST['submit'])){
	
	$status=get_safe_value($con,$_POST['status']);
	$Staff_id=get_safe_value($con,$_POST['staff_id']);
	$date=get_safe_value($con,$_POST['del_date']);
	
	$res=mysqli_query($con,"update tbl_delivery set Delivery_status='$status', Delivery_date='$date', Staff_id='$Staff_id' where Payment_id='$id'");
	if(!$res)
	{
		echo "error".mysqli_error($con);
	}
	$res2=mysqli_query($con,"update tbl_Payment set Payment_status='Successful' where Payment_id='$id'");
	if(!$res2)
	{
		echo "error".mysqli_error($con);
	}


	$res3=mysqli_query($con,"update tbl_order_master set Order_status='Deliverd' where Order_id='$oid'");
	if(!$res2)
	{
		echo "error".mysqli_error($con);
	}
	else{

	header("location:delivery.php");
}

	
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" style="background:#D0D0D0;">
                        <div class="card-header"><strong>Order</strong><small>status Update </small></div>
                        <form method="post">
							<div class="card-body card-block">
							  		 <div class="form-group">
									<label for="categories" class=" form-control-label">Staff</label>
									<select class="form-control" name="staff_id">
										<option>Select staff</option>
										<?php
									         $sq="select *from tbl_staff where Staff_des='Delivery Agent' ";
									         $st=mysqli_query($con,$sq);
									         while($row=mysqli_fetch_assoc($st)){


									         	$id=$row['Staff_id'];
									         	$name=$row['Staff_fname'];
												echo "<option value='".$id."'>".$name."</option>";
												
												/*echo "<option value='Cancelled'>Cancelled</option>";*/
											
											
										}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<label for="Subcategories" class=" form-control-label">Delivery date</label>
									<input type="date" name="del_date" placeholder="select date" class="form-control"  >
								</div>
								 <div class="form-group">
									<label for="categories" class=" form-control-label">Status</label>
									<select class="form-control" name="status">
										<option>Select status</option>
										<?php
									
												echo "<option value='Deliverd'>Deliverd</option>";
												
												/*echo "<option value='Cancelled'>Cancelled</option>";*/
											
											
										
										?>
									</select>
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>