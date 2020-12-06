<?php
require('top.inc.php');
 //require('searchv.php');

if(isset($_GET['type']) && $_GET['type']!=''){
  $type=get_safe_value($con,$_GET['type']);

  
  if($type=='delete'){
    $id=get_safe_value($con,$_GET['id']);
    $delete_sql="delete from tbl_vendor where vendor_id='$id'";
    mysqli_query($con,$delete_sql);
  }
}

// if(isset($_GET['sch']))
// {
//   $search=$_GET['sch'];
// $sql="select * from tbl_vendor where vendor_name like '%{$search}%'";
// }
// else
// {
$sql="select * from tbl_vendor";
// }
$res=mysqli_query($con,$sql);
if(!$res)
{
  echo "error".mysqli_error($con);
  die();
}

?>
<div class="content pb-0">
 <!--  <div class="search align-center">
     <form method="post">
    <input type="text" name="searchv" placeholder="search Vendor"  style="border:1px solid #000;">
     <button name="v-btn" type="submit" style="background:#000;color: #fff;">Search</button>
    </form>
    </div> -->
  <div class="orders">
     <div class="row">
      <div class="col-xl-12">
       <div class="card">
        <div class="card-body">
           <h4 class="box-title">Vendor </h4>
           <h4 class="box-link"><a href="manage_vendor.php">Add vendor</a> </h4>
        </div>
        <div class="card-body--">
           <div class="table-stats order-table ov-h">
            <table class="table ">
             <thead>
              <tr>
                 <th class="serial">#</th>
                 <th>ID</th>
                 <th>Name</th>
                 <th>Phone.no</th>
                 <th>Email</th>
                 <th>Address</th>
                
                 <th></th>
              </tr>
             </thead>
             <tbody>
              <?php 
              $i=1;
              while($row=mysqli_fetch_assoc($res)){$em= strtolower($row['vendor_email']);?>

              <tr>
                 <td class="serial"><?php echo $i?></td>
                 <td><?php echo $row['vendor_id']?></td>
                 <td><?php echo $row['vendor_name']?></td>
                  <td><?php echo $row['vendor_num']?></td>
                  <td style="text-transform: lowercase;"><?php echo $row['vendor_email']?></td>
                  <td><span class='badge badge-pending'><a href=
                    "vendor_address.php?id=<?php echo $row['vendor_id'];?>">Address</a></span>&nbsp;</td>             
                
                 <td>
                <?php
                echo "<span class='badge badge-edit'><a href='manage_vendor.php?id=".$row['vendor_id']."'>Edit</a></span>&nbsp;";
                
                echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['vendor_id']."'>Delete</a></span>";
                
                ?>
                 </td>
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