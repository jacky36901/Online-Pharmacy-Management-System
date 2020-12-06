<?php
require('top.inc.php');

	if(isset($_GET['from']) && isset($_GET['to'])){
	$i=1;$p=0;
	$from=get_safe_value($con,$_GET['from']);
	$to=get_safe_value($con,$_GET['to']);
	if($to=='')
	{
		$to=date("Y-m-d");
	}
}

if(isset($_GET['from']) && isset($_GET['to'])){
			$sr="select tbl_purchase_master.*,tbl_purchase_child.*,tbl_item.* from tbl_purchase_master,tbl_purchase_child,tbl_item where tbl_purchase_master.Mpurchase_id=tbl_purchase_child.Mpurchase_id AND tbl_purchase_child.Item_id=tbl_item.Item_id AND tbl_purchase_master.Purchase_date BETWEEN DATE('$from') AND DATE('$to')";
		}
		else
		{
			$sr="select tbl_purchase_master.*,tbl_purchase_child.*,tbl_item.* from tbl_purchase_master,tbl_purchase_child,tbl_item where tbl_purchase_master.Mpurchase_id=tbl_purchase_child.Mpurchase_id AND tbl_purchase_child.Item_id=tbl_item.Item_id AND tbl_purchase_master.Purchase_date <= CURDATE()";
		}
	$res=mysqli_query($con,$sr);
	if(!$res)
	{
		echo "fgfdg.".mysqli_error($con);
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
<div class="content pb-0"  id='printMe'>
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Purchase Report</h4>
				   <h4 class="box-link"><a href="purch.php">Back</a></h4>
				  <h4> <?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
				               if(isset($_GET['all']))echo "Purchase till Today";?></h4>
				               
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Item Name</th>							 
							   <th>Quantity</th>
							   <th>Total Amount</th>
							   <?php if(isset($_GET['all'])){  ?>
							   <th>Date</th>
							   <?php }?>					
							   <th>Vendor</th>
							   <th>Staff</th>
							   
							   
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$tot=0;$qtr=0;
							while($row=mysqli_fetch_assoc($res)){

                                $cid=$row['Cpurchase_id'];
		                        $vid=$row['Vendor_id'];
	                            $item_id=$row['Item_id']; 
	                            $qty=$row['Units_pur']; 
	                            $dat=$row['Purchase_date']; 
	                            $qtr+=$qty;
	                            $amt=$row['tot_amt']; 
	                            $tot+=$amt;
	                            $r3=mysqli_query($con,"select *from tbl_item where Item_id='$item_id'");
	                            $y=mysqli_fetch_assoc($r3);
	                            $name=$y['Item_name'];

	                            $r4=mysqli_query($con,"select *from tbl_vendor where vendor_id='$vid'");
	                            $y1=mysqli_fetch_assoc($r4);
	                            $vn=$y1['vendor_name'];

	                            $stf=$row['Staff_id'];
	                            if($stf!=0)
	                            {
                                $r49=mysqli_query($con,"select *from tbl_staff where Staff_id='$stf'");
	                            $y15=mysqli_fetch_assoc($r49);
	                            $stfn=$y15['username'];
                                 }
                                 else
                                 {
                                 	$stfn='Admin';
                                 }

								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $name?></td>
												 
							   <td><?php echo $qty;?></td>
							  
							 							   
							   <td><?php echo number_format($amt)." Rs"?></td>
							    <?php if(isset($_GET['all'])){  ?>
                               <td><?php echo $dat;?></td>
							    	<?php }?>
							     <td><?php echo $vn;
							 ?></td>
							  <td><?php echo $stfn?></td>
							</tr>
							<?php $i+=1; } ?>
						 </tbody>
					  </table>

					  		  </table>
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial"></th>
							   
							   <th> Total No.items Purchased</th>
							   <th>Total amount</th>
							   
							</tr>
						 </thead>
						 <tbody>

							<tr>
							   <td class="serial"></td>
							   
							   <td><?php echo $qtr?></td>
							    <td><?php echo number_format($tot)." Rs";?></td>
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
?>