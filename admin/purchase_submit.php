<?php
require('top.inc.php');

$name='';
$mrp='';
$price='';
$qty='';


$msg='';

if(isset($_GET['tot'])&&isset($_GET['qty'])&&isset($_GET['staff_id'])){
	
	$tot=get_safe_value($con,$_GET['tot']);
	$qty=get_safe_value($con,$_GET['qty']);
	$staff_id=get_safe_value($con,$_GET['staff_id']);
}else
{
	echo "<center>Expected values are not Passed</center>";
	die();
}

      
                                     if($a=='staff')
                                    {
                                    $v=$_SESSION['IS_LOGIN'];                                    
                                    $sql2 = "select * from tbl_staff where username='$v'";
                                    $res1 = mysqli_query($con,$sql2);
                                    $row1 = mysqli_fetch_array($res1);
                                    $stf=$row1['Staff_fname'];

                                    }
                                    if($a=='admin')
                                    {
                                        $stf='Admin';
                                    }

/*	$res=mysqli_query($con,"select * from tbl_item where item_id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$name=$row['item_name'];
		$price=$row['buying_price'];
		$qt=$row['qty'];
	    $item_id=$row['item_id']; 
		
	}else{
		header('location:purchase.php');
		die();
	}*/


if(isset($_POST['submit'])){

	/*$tot=get_safe_value($con,$_POST['tot']);*/

	$qty=get_safe_value($con,$_POST['qty']);
	$date=get_safe_value($con,$_POST['date']);

	$se="insert into tbl_purchase_master(Staff_id,Purchase_qty,Purchase_total,Purchase_date) values('$staff_id','$qty','$tot','$date')";
	$q=mysqli_query($con,$se);
	if(!$q)
	{
		echo "error".mysqli_error($con);
		die();
	}
	$sq="select MAX(Mpurchase_id) as small from tbl_purchase_master where Staff_id='$staff_id'";
	$rq=mysqli_query($con,$sq);
	if(!$rq)
	{
		echo "error".mysqli_error($con);
		die();
	}
	 $p=mysqli_fetch_array($rq);
	
	 $pur_id=$p['small'];


	  if(isset($_SESSION['cart'])){
							  	
		                      foreach ($_SESSION['cart'] as $key => $value) {
		                       	  	      
                                          
		                       	  	      $item_id=$value[0];
		                       	  	      $qty=$value[1];
		                       	  	      $vendor_id=$value[2];
		                       	  	      $batch=$value[3];
		                       	  	      $Date_MFD=$value[4];
		                       	  	      $Date_EXP=$value[5];
		                       	  	      $sql="select *from tbl_item where Item_id='$item_id'";
                                          $res=mysqli_query($con,$sql);
                                          $row=mysqli_fetch_assoc($res);
                                          $sub=$qty*$row['Item_price'];
                                         
                                          $uqty=$qty+$row['Item_qty'];
                                          // echo  $sub;
                                          


	 $ss="insert into tbl_purchase_child(Mpurchase_id,Vendor_id,Item_id,Units_pur,tot_amt,Batch_no,Date_mfd,Date_exp,status)values('$pur_id','$vendor_id','$item_id','$qty','$sub','$batch','$Date_MFD','$Date_EXP','yes')";
	$qq=mysqli_query($con,$ss);
		if(!$qq)
	{
		echo "error".mysqli_error($con);
		die();
	}

	$up="update tbl_item set Item_qty='$uqty' where Item_id='$item_id'";
	$us=mysqli_query($con,$up);

	if(!$us)
	{
		echo "error".mysqli_error($con);
		die();
	}

}


        unset($_SESSION['cart']);	
			header("location:purchase.php");
	
		}
	}
		
	

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" style="background:#D0D0D0;">
                        <div class="card-header"><strong>Purchase</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
								<div class="form-group">
									<label for="categories" class=" form-control-label">Staff</label>
									<input type="text" name="staff" placeholder=" product name" class="form-control" required value="<?php echo $stf?>" readonly>
								</div>
								
							
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Total Items</label>
									<input type="text" name="qty" placeholder=" Buying price" class="form-control" required value="<?php echo $qty?>" required readonly>
								</div>
									<div class="form-group">
									<label for="categories" class=" form-control-label">Total Amount</label>
									<input type="text" name="tot" placeholder=" quantity" class="form-control" required value="<?php echo number_format($tot).' Rs'?>" readonly>
								</div>
										<div class="form-group">
									<label for="categories" class=" form-control-label">Date</label>
									<input type="Date" name="date" max='2020-11-27' min='2020-11-27' placeholder=" quantity" class="form-control"  required >
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