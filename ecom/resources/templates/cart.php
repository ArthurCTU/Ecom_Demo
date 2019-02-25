<?php require_once("config.php"); ?>
<?php    

   if(isset($_GET['add']))  {

$query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add'] ) . " ");  
     confirm($query);

    while($row=fetch_array($query)){
          if($row['product_quantity']!=$_SESSION['product_' . $_GET['add']] ) {
             //  echo "where";
          	$_SESSION['product_' . $_GET['add']] +=1;
          	redirect("../../public_html/checkout.php");
            //echo "where";
          } else{
                // echo "where2";
          	set_message("We only have " . $row['product_quantity'] . " " . $row['product_title'] . " available");
          	redirect("../../public_html/checkout.php");  
            // echo "where2";
          }
           
     }  

   }


     if(isset($_GET['remove'])){
          
          $_SESSION['product_' . $_GET['remove']]--;
          if(  $_SESSION['product_' . $_GET['remove']]< 1 )  {
                  
                  unset( $_SESSION['item_total']);
                 unset(  $_SESSION['item_quantity']);
          	redirect("../../public_html/checkout.php");
          } else{

          	  redirect("../../public_html/checkout.php");
          }



      }  


       if(isset($_GET['delete'])){
          
          $_SESSION['product_' . $_GET['delete']]='0';
          unset( $_SESSION['item_total']);
          unset(  $_SESSION['item_quantity']);    
           redirect("../../public_html/checkout.php"); 

         } 


function process_transation(){
                

                  if(isset($_GET['tx'])){
    
    $amount=$_GET['amt'];
    $currency=$_GET['cc'];
    $transaction=$_GET['tx'];
    $status= $_GET['st'];


    


      
      $item_quantity=0;
      $total = 0;

      foreach ($_SESSION as $name=> $value) {   //  foreach($_SESSION as $name=> $value){
     
      
     {

      if($value>0)
      

       if(substr( $name,0,8 )== "product_") {    // if(substr($name,0,7)=='product_'){
           
           

                  $length=strlen($name-8);
          $id=substr($name,8,$length);    

      $send_order=query("INSERT INTO orders (order_amount, order_transaction, order_status, order_currency) VALUES ( '{$amount }','{$transaction}',                     '{$status}','{$currency }' )");

       $lastid= last_id();
       echo $lastid;
       


   confirm($send_order);          

            $query = query("SELECT * FROM products WHERE product_id =" .escape_string($id) . " " );
                       

            
            confirm($query);
             
            while($row=fetch_array($query)){
 

              $bus=$row['product_price']*$value;
             $item_quantity +=$value; 
 
        $product_price= $row['product_price'];
        $product_title= $row['product_title'];
      //   $product_quantity= $row['product_quantity'];
               
      $dquery=query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES ( '{$id }', ' {$last_id}' ,        '{$product_title}' ,'{$product_price }', '{$value}' )");
    confirm($dquery);
            
           
           
 
          }
             $total += $bus ;
           $item_quantity;

                  }
                 }

                   
               }

               session_destroy();
             }  else{     

        redirect("index.php");  
             }

         
         }

function cart(){

$item_name= 1;
$item_number=1;
$amount=1;
$quantity=1;
$item_quantity=0;
$total = 0;

foreach ($_SESSION as $name=> $value) {   //  foreach($_SESSION as $name=> $value){



if($value>0){


if(substr( $name,0,8 )== "product_") {    // if(substr($name,0,7)=='product_'){

$length=strlen($name-8);
$id=substr($name,8,$length);    

$query= query("SELECT * FROM products WHERE product_id = " .escape_string($id). "" );    //WHERE product_id =" . escape_string($id) . " " );

confirm($query);
//
//echo "this is my text";  //do  insert removed code under   
//$row = mysqli_fetch_array($query);
//$row = mysqli_fetch_array($query);
while($row = fetch_array($query)){
$bus=$row['product_price']*$value;
$item_quantity +=$value;
$product_image= display_image($row['product_image']); 
$baz = <<<ENDHEREDOC
<tr>
<td>{$row['product_title']}<br> <img width='100' src='../resources/templates/$product_image'></td>
<td>&#36;{$row['product_price']}</td>
  
<td>{$value}</td>
<td>&#36;{$bus} </td> 

 
<td><a class='btn btn-warning' href= "../resources/templates/cart.php?remove={$row['product_id']}">
<span class='glyphicon glyphicon-minus'></span></a>    

<a class='btn btn-success' href="../resources/templates/cart.php?add={$row['product_id']}">
<span class='glyphicon glyphicon-plus'></span></a>  

<a class='btn btn-danger' href="../resources/templates/cart.php?delete={$row['product_id']}">
<span class= 'glyphicon glyphicon-remove'></span></a></td>
</tr>
<input type="hidden" name="item_name_{$item_name}"     value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}"           value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}"       value="{$value}"></tr>
ENDHEREDOC;
echo $baz;  
        
//<input type="hidden" name="quantity_{$quantity}"  value="{$row['product_quantity']}">
      $item_name++;
      $item_number++;
      $amount++;
      $quantity++;

}
 $_SESSION['item_total'] = $total += $bus;
  $_SESSION['item_quantity'] =  $item_quantity;

    }
   }

     
               }

         
         }

?>
    <!-- Page Content -->
   