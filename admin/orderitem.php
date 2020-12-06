<?php
require('top.inc.php');

	if(isset($_GET['from']) && isset($_GET['to'])){
	$from=get_safe_value($con,$_GET['from']);
	$to=get_safe_value($con,$_GET['to']);

$sql="select tbl_order_master.* from tbl_order_master where Order_date BETWEEN DATE('$from') AND DATE('$to')";
}
if(isset($_GET['all']))
{
$sql="select tbl_order_master.* from tbl_order_master where Order_date <= CURDATE()";	
}
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
}

 if(isset($_POST['dbt1']))
  {


  	if(isset($_GET['all']))
     {
     $sql="select tbl_order_master.* from tbl_order_master where Order_date <= CURDATE()AND tbl_order_master.Order_status='Approved.Waiting for dispatch'";	
     }

    if(isset($_GET['from']) && isset($_GET['to'])){
    $sql="select tbl_order_master.* from tbl_order_master where Order_date BETWEEN DATE('$from') AND DATE('$to') AND tbl_order_master.Order_status='Approved.Waiting for dispatch'";
      }
  }
   if(isset($_POST['dbt2']))
  {
  	     	if(isset($_GET['all']))
     {
     $sql="select tbl_order_master.* from tbl_order_master where Order_date <= CURDATE()AND tbl_order_master.Order_status='Shipped'";	
     }

    if(isset($_GET['from']) && isset($_GET['to'])){
    $sql="select tbl_order_master.* from tbl_order_master where Order_date BETWEEN DATE('$from') AND DATE('$to') AND tbl_order_master.Order_status='Shipped'";
      }
  }
   if(isset($_POST['dbt3']))
  {
  	  	if(isset($_GET['all']))
     {
     $sql="select tbl_order_master.* from tbl_order_master where Order_date <= CURDATE()AND tbl_order_master.Order_status='Deliverd'";	
     }

    if(isset($_GET['from']) && isset($_GET['to'])){
    $sql="select tbl_order_master.* from tbl_order_master where Order_date BETWEEN DATE('$from') AND DATE('$to') AND tbl_order_master.Order_status='Deliverd'";
      }
  }
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
				   <h4 class="box-title">Order Reports</h4>
				   	<div style="float: right;display: flex;">
                 <div>
				<form method="post" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button type="submit" name="dbt1" style="px;margin-top: 10px;background: #000;color: #fff;cursor: pointer;border: none;">Approved</button> </form>
                 </div>
                 <div>
				<form method="post" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button type="submit" name="dbt2" style="px;margin-top: 10px;background: #000;color: #fff;cursor: pointer;border: none;">Shipped</button> </form>
                 </div>
                 <div>
				<form method="post" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button type="submit" name="dbt3" style="margin-top: 10px;background: #000;color: #fff;cursor: pointer;border: none;">Delivered</button> </form>
                 </div>
				</div>
				     <h5><?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
				               if(isset($_GET['all']))echo "Orders till today";?></h5>
				   <h4 class="box-link"><a href="reports.php">Back</a></h4>

				</div>
			
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Order ID</th>
							  	  <th>Order Date</th>						 
							   <th>Item details</th>
							   <!-- <th>Quantity</th>					 -->
							   <th>Customer name</th>
							    <!-- <th>Order Date</th> -->
							     <th>Order Status</th>
							  
							  
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$sold=0;
							while($row=mysqli_fetch_assoc($res)){
								$cid=$row['cust_id'];
								$sql22="select * from tbl_cust where cust_id='$cid'";
								$res22=mysqli_query($con,$sql22);
								$row22=mysqli_fetch_assoc($res22);
								$cname=$row22['username']
								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Order_id']?></td>
							    <td><?php echo $row['Order_date']?></td>

							   <?php 
							   $it=$row['Order_id'];
							   ?>
                     				 
							   <td> <span class='badge badge-pending'><a href="order_Ritm.php?id=<?php  echo $it?>">Items</a></span></td>
							    <!-- <td><?php echo $row['tot_qty'];?></td> -->

							   <td style="text-align: left;"><?php echo $cname?></td>
							    <td><?php echo $row['Order_status']?></td>
							 							   
							  
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