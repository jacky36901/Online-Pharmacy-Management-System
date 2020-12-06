<?php
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
header("location:login.php");
 }
 else{
 


  if(isset($_GET['ccd']))
   {
    $ccd=$_GET['ccd'];
  $s="delete from tbl_cart where cart_id='$ccd'";
  $res=mysqli_query($con,$s); 
}


if(isset($_POST['update'])&&isset($_POST['product_qty'])&&isset($_POST['cart_id']))
{
  $iid=$_POST['cart_id'];
  $qty=$_POST['product_qty'];
  $s="update tbl_cart set product_qty='$qty' where cart_id='$iid'";
 $r= mysqli_query($con,$s);
  if(!$r)
  {
    echo "error".mysqli_error($con);
  }

}
}

?>
   <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         // $U=$_SESSION['USER_LOGIN'];
                                         // echo  $U;
                                        // echo $c_id;
                                       
                                        $S="select tbl_cart.*,tbl_item.* from tbl_cart,tbl_item where tbl_cart.item_id=tbl_item.Item_id AND tbl_cart.cust_id='$c_id'";

                    $rez=mysqli_query($con,$S) or die(mysqli_error($con));
                    if(!$rez)
                    {
                     echo "error".mysqli_error($con);
                    }
                    $c=0;$i=0;$tot=0;
                    if(mysqli_num_rows($rez)>0){
                    while($e=mysqli_fetch_assoc($rez)){
     
                     $cart_id=$e['cart_id'];
                     $qty=$e['product_qty']; 
                     $i+=$qty;
                     $price=$e['mrp']; 
                     $subtot=$qty*$price;
                     $tot+=$subtot;

               // echo $tot;
                // echo $e['Item_name'];
                
                
                ?>
                                        <tr>
                                            <td class="product-thumbnail"> <?php echo '<img src="admin/upload/'.$e['Item_img'].'" alt="image">'?></td>
                                            <td class="product-name"><?php echo $e['Item_name']?>
                                                
                                            </td>

                                            <td class="product-price"><span class="amount"><?php echo $e['mrp']?></span></td>
                                            
                                            <td class="product_qty"> 
                                               <form method="POST">
                        <input type="text" class="form-control text-center"  name="product_qty" value="<?php echo $e['product_qty']?>" placeholder=""
                          aria-label="Example text with button addon" aria-describedby="button-addon1">
                          <input type="text" name="cart_id" value="<?php  echo $cart_id;  ?>" hidden>
                          &nbsp<input type="submit" name="update" value="update" class="btn btn-outline-primary"></form>

                                            <td class="product-subtotal">
                                                <?php
                                     echo number_format($subtot)." Rs";?></td>
                                            <td class="product-remove"><a href="?ccd=<?php echo $cart_id; ?>"><i class="icon-trash icons"></i></a></td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <!-- <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$230.00</strong>
                  </div>
                </div> -->
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo number_format($tot)." Rs" ?></strong>
                  </div>
                </div>
    


                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="#">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="pay.php">COD pay</a>
                                            <a href="cardpay.php">CARD payment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                    </div>
                </div>
            </div>
        </div>
        
        
<?php require('footer.php')?>
        