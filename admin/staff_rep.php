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
			$sr="select * from tbl_staff where tbl_staff.Staff_doj BETWEEN DATE('$from') AND DATE('$to')";
		}
		else
		{
			$sr="select * from tbl_staff where tbl_staff.Staff_doj <= CURDATE()";
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
				   <h4 class="box-title">Staff Report</h4>
				   <h4 class="box-link"><a href="stafff.php">Back</a></h4>
				  <h4> <?php  if(isset($_GET['from']) && isset($_GET['to'])) echo $from ." : ". $to ;
				               if(isset($_GET['all']))echo " Till Today";?></h4>
				               
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>							 
							   <th>Staff name</th>
							   <th>Designation</th>
							   <th>number</th>
							    <th>DOB</th>
							   
							   <th>DOJ</th>
							   				
							  
							   
							   
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$tot=0;$qtr=0;
							while($row=mysqli_fetch_assoc($res)){

                                $cid=$row['Staff_id'];
		                        $vid=$row['Staff_fname'];
	                            $item_id=$row['Staff_dob']; 
	                            $qty=$row['Staff_des']; 
	                            $dat=$row['Staff_doj']; 
	                            // $qtr+=$qty;
	                            $amt=$row['Staff_num']; 
	                            // $tot+=$amt;
	                            // $r3=mysqli_query($con,"select *from tbl_item where Item_id='$item_id'");
	                            // $y=mysqli_fetch_assoc($r3);
	                            // $name=$y['Item_name'];

	                            // $r4=mysqli_query($con,"select *from tbl_vendor where vendor_id='$vid'");
	                            // $y1=mysqli_fetch_assoc($r4);
	                            // $vn=$y1['vendor_name'];

	                            // $stf=$row['Staff_id'];
	                        

								?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $cid?></td>
												 
							   <td><?php echo $vid;?></td>
							  <td><?php echo $qty;?></td>
							  <td><?php echo $amt;?></td>
							 							   
							   <td><?php echo $item_id;?></td>
							   
                               <td><?php echo $dat;?></td>
							    	
							    <!--  <td><?php echo $vn;
							 ?></td> -->
							  <!-- <td><?php echo $stfn?></td> -->
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