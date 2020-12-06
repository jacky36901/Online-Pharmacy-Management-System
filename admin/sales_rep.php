<?php

require('top.inc.php');
						if(isset($_GET['from']) && isset($_GET['to'])){
	$from=get_safe_value($con,$_GET['from']);
	$to=get_safe_value($con,$_GET['to']);
}
?>
<style type="text/css">

	.rep{
		width: 150px;
		float: left;
		color: #fff;
		background:#000;
		border:none;
		/*border-radius: 30px;*/
        size: 50%;
		margin: 15px;
		margin-right: 550px;
		margin-top: -25px;
        float: right;
		padding: 10px 20px;
		cursor: pointer;
		font-size: 18;
	}
	.rep:hover{
		background-color: #fff;
		color: black;
		transition: 0.8s ease ;
	}
</style>
<div class="content pb-0" id='printMe'>

	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card" >
				<div class="card-body" >
				   <h4 class="box-title">Sales Report:</h4>
				   <h5><?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
				               if(isset($_GET['all']))echo "Sales till Today";?></h5>
				   <h4 class="box-link"><a href="sales.php">Back</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Item Name</th>
							   <th>username</th>
							   <th>Quantity</th>
							   <th>Amount</th>
							      <?php if(isset($_GET['all'])){  ?>
							   <th>Date</th>
							   <?php }?>
							   <!-- <th>Cust_id</th> -->
							   
							</tr>
						 </thead>
						 <tbody>
						<?php 
							
							if(isset($_GET['from']) && isset($_GET['to'])){
								$i=1;$p=0;$tot=0;
	$from=get_safe_value($con,$_GET['from']);
	$to=get_safe_value($con,$_GET['to']);
	if($to=='')
	{
		$to=date("Y-m-d");
	}
		$sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust where tbl_order_master.Order_id=tbl_order_child.Order_id AND tbl_order_master.cust_id=tbl_cust.cust_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.Order_date BETWEEN DATE('$from') AND DATE('$to')";
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
	}


		while ($row=mysqli_fetch_assoc($res)){
			$trt=$row['Corder_qty'];
			$p+=$trt;
			$su=$row['mrp']*$row['Corder_qty'];
			$tot+=$su;
?>



							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_name']?></td>
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['Corder_qty']?></td>
							   <td><?php echo number_format($row['mrp']*$row['Corder_qty'])." Rs";?></td>
							  <!--   <td><?php echo $row['cust_id']?></td> -->
							</tr>
							<?php 
							  $i+=1;
						      }} ?>

	<?php 
							
							if(isset($_GET['all'])){
								$i=1;$p=0;$st=0;

		$sr="select tbl_order_master.*,tbl_order_child.*,tbl_item.*,tbl_cust.* from tbl_order_master,tbl_order_child,tbl_item,tbl_cust where tbl_order_master.Order_id=tbl_order_child.Order_id AND tbl_order_master.cust_id=tbl_cust.cust_id AND tbl_order_child.Item_id=tbl_item.Item_id AND tbl_order_master.Order_date <= CURDATE()";
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
	}


		while ($row=mysqli_fetch_assoc($res)){
			$trt=$row['Corder_qty'];
			$p+=$trt;
			$tot=$row['Order_amt'];
			$t=$row['mrp']*$row['Corder_qty'];
			$st+=$t;
			$dat=$row['Order_date'];
?>          



							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_name']?></td>
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['Corder_qty']?></td>
							   <td><?php echo number_format($row['mrp']*$row['Corder_qty'])." Rs";?></td>
							   <!--  <td><?php echo $row['cust_id']?></td> -->

                               <td><?php echo $dat;?></td>
							    	
							</tr>
							<?php 
							  $i+=1;
						      }} ?>
						 </tbody>
					  </table>
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial"></th>
							   
							   <th> Total No.items</th>
							   <th>Total amount</th>
							   
							</tr>
						 </thead>
						 <tbody>

							<tr>
							   <td class="serial"></td>
							   
							   <td><?php echo $p?></td>
							    <td><?php if(isset($_GET['all'])){echo number_format($st)." Rs";}if(isset($_GET['from']) && isset($_GET['to'])){echo number_format($tot)." Rs";}?></td>
							</tr>
					
						</tbody>

					</table>
                     

				   </div>
                    <!-- <input type="button" onClick="printDiv('printMe')" value="Print"/> -->
				</div>

			 </div>
		  </div>
	   </div>
	   
	   
	</div>
</div>
<input class="rep" type="button" onClick="printDiv('printMe')" value="Print"/>
<script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
<?php
require('footer.inc.php');
ob_end_flush();
?>