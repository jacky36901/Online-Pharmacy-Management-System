<?php
require('top.inc.php');
date_default_timezone_set('Asia/Kolkata');
$categories='';
$msg='';
$from='';
$to='';
if(isset($_POST['submit'])){
	$from=get_safe_value($con,$_POST['from']);
	$to=get_safe_value($con,$_POST['to']);
	$ds=date("Y-m-d");
	if($to <= $ds){
	if($to=='')
	{
		$to=date("Y-m-d");
		
	}
$sql="select tbl_order_master.*,tbl_order_child.* from tbl_order_master,tbl_order_child where tbl_order_master.Order_id=tbl_order_child.Order_id AND Order_date BETWEEN DATE('$from') AND DATE('$to')";
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
}


	$check=mysqli_num_rows($res);
	if($check>0){

     header("location:pro_rep.php?from=$from&to=$to");
 

	
	}
	else
	{
		$msg="* No data found";
	}
}
else
	{
		$msg="* Date error";
	}
	

	}
	


?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card" style="background: #757F9A;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #D7DDE8, #757F9A);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #D7DDE8, #757F9A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
                        <div class="card-header"><strong>Order Report</strong></div>
                        <h4 class="box-link"><a href="reports.php">Back</a> </h4>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">From</label>
									<input type="date" name="from" placeholder="Enter categories name" class="form-control"  value="<?php echo $categories?>" required>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">To</label>
									<input type="date" name="to" placeholder="Enter categories name" class="form-control"  value="<?php echo $categories?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>

							   </button><br><br>
                                
							  
							   <div class="field_error"><?php echo $msg?></div>

							</div>
						</form>
						   <a href="orderitem.php?all=1"><button id="payment-button" name="all" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Get All</span>
							   </button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>