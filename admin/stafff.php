<?php
require('top.inc.php');
$msg='';
$from='';
$to='';
if(isset($_POST['submit'])){
	$from=get_safe_value($con,$_POST['from']);
	$to=get_safe_value($con,$_POST['to']);
	if($to=='')
	{
		$to=date("Y-m-d");
		echo $to;
	}
	$sr="select * from tbl_staff where tbl_staff.Staff_doj BETWEEN DATE('$from') AND DATE('$to')";
	$res=mysqli_query($con,$sr);
/*	if(!$res)
	{
		mysqli_error($con);
	}*/

	$check=mysqli_num_rows($res);
	if($check>0){

     header("location:staff_rep.php?from=$from&to=$to");
 

	
		
	}
	else
	{
		$msg="* No data found";
	}
	

	}

if(isset($_POST['all'])){
header("location:staff_rep.php?all=1");
	
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Staff Report</strong></div>
                        
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
							   	<h4 class="box-link"><a href="reports.php">Back</a> </h4>
									<label for="categories" class=" form-control-label">From</label>
									<input type="date" name="from" placeholder="Enter categories name" class="form-control"  required>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">To</label>
									<input type="date" name="to" placeholder="Enter categories name" class="form-control">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Check</span>

							   </button><br><br>
                                
							   
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
						  <a href="staff_rep.php?all=1"> <button id="payment-button" name="all" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Complete Records</span>
							   </button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>