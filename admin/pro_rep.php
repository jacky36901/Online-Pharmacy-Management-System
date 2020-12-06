<?php
require('top.inc.php');


$sql="select tbl_item.* from tbl_item";
$res=mysqli_query($con,$sql);
if(!$res)
{
	echo "error".mysqli_error($con);
	die();
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
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products Reports</h4>
				   <h4 class="box-link"><a href="reports.php">Back</a></h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>							 
							   <th>Item Name</th>
							   <th>Sold</th>					
							   <th>Availble</th>
							  
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;$sold=0;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_id']?></td>
							   <?php 
							   $it=$row['Item_id'];
                               $sw="select *from tbl_order_child where Item_id='$it'";
                                $e=mysqli_query($con,$sw);
                               while($d=mysqli_fetch_assoc($e)){
                                $orqty=$d['Corder_qty'];
                                $sold+=$orqty;

                            }
							   ?>						 
							   <td><?php echo $row['Item_name'];?></td>
							    <td><?php echo $sold;?></td>
							   <td><?php echo $row['Item_qty']?></td>
							 							   
							  <?php $sold=0 ?> 
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