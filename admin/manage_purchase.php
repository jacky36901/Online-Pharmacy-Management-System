<?php
require('top.inc.php');

$name='';
$mrp='';
$price='';
$qty='';


$msg='';

if(isset($_GET['pid'])){
	
	$id=get_safe_value($con,$_GET['pid']);
	$res=mysqli_query($con,"select * from tbl_item where Item_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$name=$row['Item_name'];
		$price=$row['Item_price'];
		$qt=$row['Item_qty'];
	    $item_id=$row['Item_id']; 
		
	}else{
		header('location:purchase.php');
		die();
	}
}

if(isset($_POST['submit'])){

	$vendor_id=get_safe_value($con,$_POST['vendor_id']);
	$name=get_safe_value($con,$_POST['name']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$batch=get_safe_value($con,$_POST['batch']);
	$Date_mfd=get_safe_value($con,$_POST['Date_mfd']);
	$Date_exp=get_safe_value($con,$_POST['Date_exp']);

	$tot=$price*$qty;
	$q=$qty+$qt;
	

       if(isset($_SESSION['usertype'])&&isset($_SESSION['IS_LOGIN']))
		{
			$stf=$_SESSION['IS_LOGIN'];
			$s="select *from tbl_staff where username='$stf'";
		    $rp=mysqli_query($con,$s);
		    $f=mysqli_fetch_assoc($rp);
	        $staff_id=$f['Staff_id'];
		}
		else
		{
			$stf='Admin';
			$staff_id='0';
		}
		
	
	$pro=array($item_id,$qty,$vendor_id,$batch,$Date_mfd,$Date_exp);

     $_SESSION['cart'][$item_id]=$pro;

  
       
      /*      $sql="insert into tbl_cart(cust_username,item_id,product_qty,status) values('$vendor_id','$item_id','$qty','$staff_id')";
			$rz=mysqli_query($con,$sql);
			if(!$rz)
			{
				echo "error".mysqli_error($con);
				die();
			}*/
	
			header("location:purchase.php");
		die();
		}
		
	

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" style="background:#D0D0D0;">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder=" product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
							
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Buying Price</label>
									<input type="text" name="price" placeholder=" Buying price" class="form-control" required value="<?php echo $price?>" required >
								</div>
									
									<div class="form-group">
									<label for="categories" class=" form-control-label">Batch.No</label>
									<input type="text" name="batch" placeholder="Batch number" class="form-control" required >
								
									</div>
									<div class="form-group">
									<label for="categories" class=" form-control-label">Manufacturing Date</label>
									<input type="date" name="Date_mfd" max="2020-11-26" placeholder="Manufacturing date" class="form-control" required >
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Expiry Date</label>
									<input type="date" name="Date_exp"  min="2021-03-01" placeholder="Expiry date" class="form-control" required >
								</div>
									<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="number" name="qty" placeholder=" quantity" class="form-control" required >
								</div>
							
								<div class="form-group">
									<label for="categories" class=" form-control-label">Vendor</label>
									<select class="form-control" name="vendor_id" required>
										<option>Select Vendor</option>
										<?php
										$res=mysqli_query($con,"select vendor_id,vendor_name from tbl_vendor order by vendor_name asc");
										if(!$res)
										{
											echo "error".mysqli_error($con);
										}
										while($row=mysqli_fetch_assoc($res)){
										
												echo "<option value=".$row['vendor_id'].">".$row['vendor_name']."</option>";
											
											
										}
										?>
									</select>

								</div>
								
																							
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">ADD</span>
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