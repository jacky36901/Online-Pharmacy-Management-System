<?php
require('top.inc.php');
$total=0;$count=0;
// if(isset($_GET['pid']) && $_GET['qty']){
// 	$pid=get_safe_value($con,$_GET['pid']);
// 	$Qty=get_safe_value($con,$_GET['qty']);
// 	$pid_sql="insert into tbl_purchase_child (item_id,p_qty,rate) values('$pid','$Qty',0)";
// 	$x=mysqli_query($con,$pid_sql);
// if(!$x)
// {
// 	echo "error".mysqli_error($con);
// 	die();
// }
// }

if(isset($_POST['submit']))
{
	



}

if(isset($_GET['remove']) && $_GET['remove']!=''){
	$item_id=get_safe_value($con,$_GET['remove']);
	if(isset($_SESSION['cart'][$item_id])){
		unset($_SESSION['cart'][$item_id]);
	}
		
	}
	
	
	


/*$sql="select tbl_item.*,tbl_brand.brand_name from tbl_item,tbl_brand where tbl_item.qty <=10 AND tbl_item.brand_id=tbl_brand.brand_id  order by tbl_item.item_id desc";*/
                                  if($a=='staff')
                                    {
                                    // $v=$_SESSION['IS_LOGIN'];
                                    $stf=$v;
                                    $sql2 = "select * from tbl_staff where username='$v'";
                                    $res1 = mysqli_query($con,$sql2);
                                    $row1 = mysqli_fetch_array($res1);
                                    $staff_id=$row1['Staff_id'];

                                    }
                                    if($a=='admin')
                                    {
                                        $stf='Admin';
                                        $staff_id=0;
                                    }
//                                     echo $staff_id;
// echo $a;
// echo $v;
// echo $stf;
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">View_purchase </h4>
				     <h4 class="box-link"><a href="manage_purchase.php">Manage Purchase</a> <a href="view_purchase.php">View added items</a> <a href="purchase_details.php">Purchase Details</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>							 
							  
							   <th>Item Name</th>
							   <th>Vendor Id</th>					
							   <th>Unit Price</th>
							   <th>Batch.No</th>
							   <th>Date_MFD</th>
							   <th>Date_EXP</th>
							   <th>Qty</th>
							   <th>Total</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							  if(isset($_SESSION['cart'])){
							  	$i=1;$count=0;$total=0;
		                      foreach ($_SESSION['cart'] as $key => $value) {
		                       	  	      
                                          
		                       	  	      $item_id=$value[0];
		                       	  	      $qty=$value[1];
		                       	  	      $vendor_id=$value[2];
		                       	  	      $batch=$value[3];
		                       	  	      $Date_MFD=$value[4];
		                       	  	      $Date_EXP=$value[5];

		                       	  	      $count+=$qty;
		                       	  $sql="select *from tbl_item where Item_id='$item_id'";
                                   $res=mysqli_query($con,$sql);
                                 if(!$res)
                                 {
	                              echo "error".mysqli_error($con);
	                             die();
                                  }
		                       	
                          
							
							while($row=mysqli_fetch_assoc($res)){ $itm=$row['Item_id']; ?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['Item_id']?></td>                    
                                <td><?php echo $row['Item_name']; ?></td>							   						 							   
							   <td><?php echo $vendor_id?></td>
							   <td><?php echo number_format($row['Item_price'])." Rs"; $to=$row['Item_price']*$qty;
                                $total+=$to;

							   ?>
							    <td><?php echo $batch?></td>
							     <td><?php echo $Date_MFD?></td>
							      <td><?php echo $Date_EXP?></td>
							   	
							   </td>
							   <td><?php echo $qty;?></td>
							    <td><?php echo number_format($to)." Rs";?></td>
							   <td>
								<?php
								$it=$row['Item_id'];
						         echo "<span class='badge badge-delete'><a href='?remove=".$it."'>Remove</a></span>&nbsp;";
							
																																						
								?>
							   </td></form>
							</tr>
							<?php $i++; } }?>
						

                             

						<?php }?>
						 </tbody>
					  </table>
					    <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount"><a href="purchase_submit.php?tot=<?php echo  $total;?>&qty=<?php echo $count;?>&staff_id=<?php echo $staff_id;?>" style="color:#fff;">Continue</a>
							  
							   </button>
							
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