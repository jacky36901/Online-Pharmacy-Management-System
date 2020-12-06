<?php
require('top.inc.php');
$subcategories='';
$categories_id='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
$res=mysqli_query($con,"select * from tbl_Order_master where Order_id='$id'");
$row=mysqli_fetch_assoc($res);
}
/*else
{
	header("location:order.php");
	die();
}*/

if(isset($_POST['submit'])){
	
	$status=get_safe_value($con,$_POST['status']);
	if(isset($_GET['id'])){
	$d=$id;	
	}
	else{
		$d=get_safe_value($con,$_POST['Order_id']);
	}
	
	$res=mysqli_query($con,"update tbl_Order_master set Order_status='$status' where Order_id='$d'");
	if(!$res)
	{
		echo "error".mysqli_error($con);
	}
	else
	{
	header("location:order.php");	
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
									<label for="Subcategories" class=" form-control-label">Order_id</label>
									<input type="text" name="Order_id" placeholder="Order Id" class="form-control" required value="<?php if(isset($row)){echo $row['Order_id'];}?>">
								</div>
								 <div class="form-group">
									<label for="categories" class=" form-control-label">Status</label>
									<select class="form-control" name="status" >
										<option>Select status</option>
										<?php
									
												// echo "<option value='Deliverd'>Deliverd</option>";
												echo "<option value='Shipped'>Shipped</option>";
												echo "<option value='Approved.Waiting for dispatch'>Approved.Waiting for dispatch</option>";
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