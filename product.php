<?php
 require('top.php');

$product_id=mysqli_real_escape_string($con,$_GET['id']);

 $con= mysqli_connect("localhost","root","","pharmacy");
$m="";


if(isset($_POST['c-btn'])&&isset($_POST['c_qty'])&&$_POST['Item_id']>=1)
   {
     if(!isset($_SESSION['USER_LOGIN'])){
        header("location:login.php");
    }
       $iid=$_POST['Item_id'];    
       $c_qty=$_POST['c_qty'];
       // $rus=$_SESSION['USER_LOGIN'];
  /*     $_SESSION['cart'][$iid]['c_qty']=$c_qty;
        header("location:cart.php");*/
    if(isset($_SESSION['USER_LOGIN']))
    {
         // $rus=$_SESSION['USER_LOGIN'];
         $s="select * from tbl_cart where item_id='$iid' AND cust_id='$c_id'";
         $res=mysqli_query($con,$s);
         if(mysqli_num_rows($res)>0){
          
              $m='item already exist in Cart';
             
               }
          else
          {

      
              $ql="insert into tbl_cart(item_id,cust_id,product_qty,status) Values('$iid','$c_id','$c_qty','pay')";
              $result=mysqli_query($con,$ql);  
             if($result)
             {
                // header("location:cart.php?buy=$iid");
               $m='Added to Cart';
               header("location:cart.php");
             } 
             else
             {
                // header("location:login.php");
                echo "error".mysqli_error($con);
             }  
          } 
     }    
  
   // else
   // {
   //  header("location:log.php?iid=$iid");
   // }

}
      


?>
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="
                        col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="product-grid.html">Products</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">ean shirt</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                         <?php
                             $query="select * from tbl_item where Item_id='$product_id'";
                             $query_run=mysqli_query($con,$query);
                             while($row=mysqli_fetch_array($query_run)){
                           ?>
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                           <?php echo '<img src="admin/upload/'.$row['Item_img'].'" alt="image">'?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $row['Item_name']?></h2>
                                <ul  class="pro__prize">
                                    
                                    <li><?php echo $row['mrp'];?></li>
                                </ul>
                                <p class="pro__info"><?php echo $row['Item_desc']?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
                                     <form method ="post"> 
                                    <input value=1 type="number" name='c_qty' style="width: 80px;">
                                    <div class="sin__desc align--left">
                                        <!-- <p><span>Categories:</span></p> -->
                                       
                                    </div>
                                    <input type="text" name="Item_id" value="<?php echo $row['Item_id'];  ?>" hidden>
                                 <form method ="post"> 
                                 <?php
            $p=$row['Item_qty'];
            // echo $p;
            if($p > 0)

            {  ?>
      <button type="submit" name="c-btn"  id="getbt" style="background: #000;color:#fff;padding: 5px;">Add to cart</button>
       <br><?php echo $m; ?>';
    <?php }
     else {  
      echo "<H1>OUT OF STOCK</H1>";
     }
?>
   </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
            <?php } ?>
        </section>
        <!-- End Product Details Area -->
        
        
<?php require('footer.php')?>
        