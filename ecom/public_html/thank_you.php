<?php require_once("../resources/templates/config.php"); ?>
<?php require_once("cart.php");  // to be deleted ?> 

<?php include("../resources/templates/front/header.php" ) ?>

<?php 
       
  
process_transaction();



     // session_destroy();
   

  // http://localhost/ecom/public_html/thank_you.php?tx=34535434=345&amt=345&cc=USA&st=Completed
   
?>

<div class="container">   
  <h1>Thank you! Payment recieved</h1>
</div>


<?php include("../resources/templates/front/footer.php" ) ?>