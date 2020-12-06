<?php
require('top.inc.php');


			$sr="select tbl_cust.* from tbl_cust";
		
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
				   <h4 class="box-title">Customer Report</h4>
				   <h4 class="box-link"><a href="reports.php">Back</a></h4>
				
				               
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Customer Id</th>							 
							   <th>Name</th>
							   <th>Total.No orders</th>
							 
							   <!-- <th>Total.No Items Purchased</th> -->
							    <th>Total Amount</th>

							  				
							
							   
							   
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$tot=0;$qtr=0;
							while($row=mysqli_fetch_assoc($res)){

                                $cid=$row['cust_id'];
		                        $cname=$row['cust_fname'];
	                       
	                            $r3=mysqli_query($con,"select count(cust_id) as c from tbl_order_master where cust_id='$cid'");
	                            $y=mysqli_fetch_assoc($r3);
	                            $c=$y['c'];
                              

	                            /*$r4=mysqli_query($con,"select *from tbl_order_child where order_id='$oid'");
	                            $y1=mysqli_fetch_assoc($r4);
	                            $vn=$y1['vendor_name'];*/

	                          

								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $cid?></td>
												 
							   <td><?php echo $cname;?></td>
							  
							 							   
							   <td><?php echo $c;?></td>
							  
                               <?php 


                                $r32=mysqli_query($con,"select *from tbl_order_master where cust_id='$cid'");
	                            
	                            

                                 $qt=0;$tamt=0;
                               while($y2=mysqli_fetch_assoc($r32)){

                               	$amt=$y2['Order_amt'];
                               	$tamt+=$amt;
                               	// $t=$y2['tot_qty'];
                               	// $qt+=$t;
                               }

                              ?>
                                <td><?php echo number_format($tamt)." Rs";?></td>
							   <!--   <td><span class='badge badge-edit'><a href="cust_itm.php?id=<?php echo $cid; ?>">Items</a></span></td> -->
							
							</tr>
							<?php $i+=1; } ?>
						 </tbody>
					  </table>

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