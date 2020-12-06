<?php
require('top.inc.php');
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from tbl_cust where cust_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$cust_id=$row['cust_id'];
	   
	    $house_no=$row['cust_house'];
	    
		$cust_city=$row['cust_city'];
		
		$cust_state=$row['cust_state'];
		$cust_pin=$row['cust_pin'];

	}else{
		header('location:user.php');
		die();
	}
}



?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                     	<div class="card-body">
				   
				   <h4 class="box-link" align="right"><a href="user.php">back</a> </h4>
				</div>
                        <div class="card-header"><strong>Address</strong><small> Form</small></div>
                        <form method="post">
                        	&nbsp;&nbsp;<b>Custer Id:</b> <?php echo $cust_id;?>
							<div class="card-body card-block">
								 <div class="form-group">
									<label for="categories" class=" form-control-label">House name</label>
									<input type="text" name="vendor_city" placeholder="Enter City" class="form-control" required value="<?php echo $house_no;?>" readonly>
								</div>
								 
							
								 <div class="form-group">
									<label for="categories" class=" form-control-label">City</label>
									<input type="text" name="vendor_city" placeholder="Enter City" class="form-control" required value="<?php echo $cust_city;?>" readonly>
								</div>
								
								 <div class="form-group">
									<label for="categories" class=" form-control-label">State</label>
									<input type="text" name="vendor_state" placeholder="Enter State" class="form-control" required value="<?php echo $cust_state;?>" readonly>
								</div>
								 <div class="form-group">
									<label for="categories" class=" form-control-label">Pincode</label>
									<input type="text" name="vendor_pin" placeholder="Enter Pincode" class="form-control" required value="<?php echo $cust_pin;?>" readonly>
								</div>
							
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