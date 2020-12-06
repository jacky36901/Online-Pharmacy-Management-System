<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
   $type=get_safe_value($con,$_GET['type']);
   if($type=='status'){
      $operation=get_safe_value($con,$_GET['operation']);
      $id=get_safe_value($con,$_GET['id']);
      if($operation=='active'){
         $status='1';
      }else{
         $status='0';
      }
      $update_status_sql="update tbl_item set status='$status' where Item_id='$id'";
      mysqli_query($con,$update_status_sql);
   }
   
   if($type=='delete'){
      $id=get_safe_value($con,$_GET['id']);
      $delete_sql="delete from tbl_item where Item_id='$id'";
      mysqli_query($con,$delete_sql);
   }
}

$sql="select tbl_item.*,tbl_category.Cat_name,tbl_brand.Brand_name from tbl_item,tbl_category,tbl_brand where tbl_item.Cat_id=tbl_category.Cat_id and tbl_item.Brand_id=tbl_brand.Brand_id order by tbl_item.Item_id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
               <h4 class="box-title">Products</h4>
               <h4 class="box-link"><a href="manage_product.php">Add Products</a> </h4>
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        <th class="serial">#</th>
                        <th>ID</th>
                        <th>Categories</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Price</th>
                      
                        <th>Rack</th>
                        <th>Qty</th>
                        <th width="10%">Img</th>
                       
                        <th width="20%"></th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php 
                     $i=1;
                     while($row=mysqli_fetch_assoc($res)){?>
                     <tr>
                        <td class="serial"><?php echo $i?></td>
                        <td><?php echo $row['Item_id']?></td>
                        <td><?php echo $row['Cat_name']?></td>
                        <td><?php echo $row['Brand_name']?></td>
                        <td><?php echo $row['Item_name']?></td>
                        <td><span class='badge badge-pending'><a href=
                                       "item_desc.php?id=<?php echo $row['Item_id'];?>">Show</a></span>&nbsp;</td>
                        <td><?php echo $row['Item_price']?></td>
                        <!-- <td><?php echo $row['Presc_needed']?></td> -->
                        <td><?php echo $row['Rack_no']?></td>
                        <td><?php echo $row['Item_qty']?></td>
                        <!--<td><?php echo $row['Item_img']?></td>-->
                         
                        <td class="yo"><?php echo '<img src="upload/'.$row['Item_img'].'"  width="50px" height="30px" alt="image">'?></td>
                            




                      
                        <td>
                        <?php
                        
                        echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['Item_id']."'>Edit</a></span>&nbsp;";
                        
                        echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['Item_id']."'>Delete</a></span>";


                        echo "<span class='badge badge-edit'><a href='manage_purchase.php?pid=".$row['Item_id']."'>Purchase</a></span>&nbsp;<br>";
                        
                        ?>
                        </td>
                     </tr>
                     <?php
                     $i=$i+1;
                      } ?>
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