<?php require_once("../config.php"); ?>
<?php 

       if(isset($_GET['id']))  {

              $query = query("DELETE FROM products WHERE product_id=" . escape_string($_GET['id'] ) . " "); 
              confirm($query); 
              set_message("Product deleted");
              redirect( "../../../public_html/admin/index.php?products");
       }
       else{

             redirect( "../../../public_html/admin/index.php?products");
       
       }
 
 ?>