<?php require_once("../resources/templates/config.php"); ?>
<!--?php // require_once("cart.php"); ?-->


<!-- Header-->
<?php include("../resources/templates/front/header.php" ) ?>

<?php //  if(isset($_SESSION['product_168'])){    // suppose to display number at corner of screen -->}

?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-danger"> <?php display_message();  //echo "somthing";  ?> </h4>
      <h1>Checkout</h1>

  
 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="marthur552-facilitator-1@gmail.com">
   <input type="hidden" name="currency_code" value="US">

    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
            
     
          </tr>
        </thead>
        <tbody>
            <tr>
            
                     <?php cart();  //echo "wtf";                //  <td><a href="cart.php?remove=1">Remove</a><td>  ?>
     
           
            </tr>
        </tbody>
    </table>
      <?php echo  show_paypal(); 
          // echo "paypal missing checkout.php";
       ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php 

            echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity']:$_SESSION['item_quantity']= " zero (0)";

   ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"> &#36;<?php 

            echo isset($_SESSION['item_total']) ? $_SESSION['item_total']:$_SESSION['item_total']= "zero (0)";

   ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


        <!-- Footer -->
        

    </div>
    <!-- /.container -->

 <!-- jQuery -->
     <?php include("../resources/templates/front/footer.php" ) ?>
