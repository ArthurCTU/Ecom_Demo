<?php 
$uploads= "uploads"; // UPLOAD DIRECTORY HERE 

if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

        //  <!-- echo "from functions"; -->


 // helper functions


function last_id(){

   global $connection;  
  return mysqli_insert_id($connection);  
}
    function set_message($msg){

        if(!empty($msg)){
        	$_SESSION['message'] = $msg;
        	 // echo $_SESSION['message'];
        } else{
        	$msg="";
        }

    }
 

    function display_message(){
          if(isset($_SESSION['message'])){
          	echo $_SESSION['message'];
          	// echo "echodisp";
          	unset ($_SESSION['message']);
          }

    }



function redirect($location)
 {

 	return header("Location: $location");
 }

function query($sql) {

	global $connection; 
	return mysqli_query($connection, $sql);
}

function confirm($result) {

	global $connection;
	if(!$result) {
		die("Query FAILED " . mysqli_error($connection));
	}  
}


function escape_string($string){
 
 global $connection;
 return mysqli_real_escape_string($connection,$string);

}

function fetch_array($result) {
return mysqli_fetch_array($result);

}

// get products  front end functions


function get_products(){   

	$query = query("SELECT * FROM products");
	confirm($query);

	 while($row =fetch_array($query))  {

		 $product_image= display_image($row['product_image'])  ;  
                
  //http://placehold.it/320x150
       $bar = <<<LABEL
<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                           <a href= "item.php?id={$row['product_id']}"> <img src="../resources/templates/{$product_image}" alt=""></a>  
                            <div class="caption">
                                <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a></p>
                                <a class= "btn btn-primary" target="_blank" href="../resources/templates/cart.php?add={$row['product_id']}">Add To Cart</a>
                            </div>
                           
                        </div>
                    </div> 
LABEL;
echo $bar;
	 }
         

 }

 function get_categories(){

	 	    $query = query("SELECT * FROM categories");	 
	 	    confirm($query);  

	 	    while($row =fetch_array($query)){

	 	    	$category_links= <<<DELIMETER
              
              <a href= 'category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;
    
    echo $category_links;
	 	    }    
                      
 }


function get_products_in_cat_page(){   

	$query = query("SELECT * FROM products WHERE product_category_id =" .escape_string($_GET['id']));
	confirm($query);

	 while($row =fetch_array($query))  {

		  $product_image= display_image($row['product_image']);

	 	//<img src="{ttp://placehold.it/800x500" alt=""> 
           $information = <<<ENDHEREDOC
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                     <img src=" ../resources/templates/{$product_image}" alt="">    
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/templates/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
ENDHEREDOC;
	  echo $information;

	 }
 }  


function get_products_in_shop_page(){   

	$query = query("SELECT * FROM products");
	confirm($query);

	 while($row =fetch_array($query))  {

		   $product_image= display_image($row['product_image']);  //  <img width= '100 ' src=" ../resources/templates/ {$row['product_image']}" alt="">   

	 	//<img src="{ttp://placehold.it/800x500" alt=""> 
           $information = <<<ENDHEREDOC
<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                     <img src=" ../resources/templates/{$product_image}" alt="">    
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/templates/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
ENDHEREDOC;
	  echo $information;

	 }
 } 

function login_user(){

	   if(isset($_POST['submit'])) {
         $username=  escape_string($_POST['username']);
         $password=  escape_string($_POST['password']);


          $query = query("SELECT * FROM Users WHERE BINARY username='{$username}' AND password='{$password}' ");
          confirm($query);
          

          if(mysqli_num_rows($query) == 0){
               
               set_message("Your Password or UserName is wrong");
              redirect("login.php");

          }
          else{     $_SESSION['username']= $username;
                //   set_message("Welcome to Admin {$username }");
                redirect("admin");
          }
	   }   
}


function send_message(){

	    if(isset($_POST['submit'])) {
             // echo "Message sent(send_message function)";
               
               $to="marthur552@gmail.com";
               $from_name =$_POST['name'];
               $subject=$_POST['subject'];
               $email=$_POST['email'];
               $message=$_POST['message']; 

               $headers= "From: {$from_name}  {$email}";
               
               $result=mail( $to, $subject, $message, $headers);

               if(!$result){

               	  echo "Your message could not be sent, Sorry!";
               	  redirect("contact.php");
               }
               else{
                    echo "Your message has been sent ";
                    redirect("contact.php");
 
               }






	    }
}


function display_orders(){

     $query = query("SELECT * FROM orders");
     confirm($query);
          
          while($row =fetch_array($query))  {
        

        $information = <<<ENDHEREDOC
     <tr>
           <th>{$row['order_id']}</th>
           <th>{$row['order_amount']}</th>
          
           <th>{$row['order_transaction']}</th>
           
           <th>{$row['order_status']}</th>
           <th>{$row['order_currency']}</th>
           <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
1     </tr>
ENDHEREDOC;
    echo $information;

            
      }


}

  function show_paypal(){

   if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >=1 ) {  

    
           $paypalbutton   = <<<ENDHEREDOC
   <input type="image" name="upload" border="0"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online"> 
ENDHEREDOC;
    return  $paypalbutton;
   }

  }   


/******Admin Product*/

function display_image($picture){
        global $uploads;
       return $uploads . DS . $picture;
}


function get_products_in_admin(){
        
          $query = query("SELECT * FROM products");
  confirm($query);

   while($row =fetch_array($query))  {

      $category= show_product_category_title($row['product_category_id']);  // <img width="100" 
     $product_image= display_image($row['product_image'])  ;         
  //http://
    $information = <<<ENDHEREDOC

      <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
              <a href="index.php?edit_product&id={$row['product_id']}"><img width="100"  src="../../resources/templates/{$product_image}" alt=""></a>
            </td>
            <td>{$category}</td>   
            <td>{$row['product_price']}</td>
             <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
ENDHEREDOC;
    echo $information;

      
        }
  }  


  function show_product_category_title($product_category_id) {

   // $category_query = query("SELECT * FROM categories WHERE cat_id= '{$product_category_id]}' "); 
   $query = query("SELECT * FROM categories WHERE cat_id= '{$product_category_id}' "); 
        confirm($query);

         while($row =fetch_array($query) ) {
                return $row['cat_title'];
         }
  }    

  /********?    add products in admin***/

     function add_product(){
       // $result; \

         
           if (!empty($_POST['publish'])) {  
                      //echo "working"; 
                   
                            $product_title=  escape_string($_POST['product_title']);
                    $product_category_id=  escape_string($_POST['product_category_id']);
                     $product_price=  escape_string($_POST['product_price']);
                      $product_description=  escape_string($_POST['product_description']);
                       $short_desc=  escape_string($_POST['short_desc']);
                        $product_quantity=  escape_string($_POST['product_quantity']);
                         $product_image=  escape_string($_FILES['file']['name']);
                          $image_temp_location=  escape_string($_FILES['file']['tmp_name']);

                        $result =  move_uploaded_file($image_temp_location, "../../resources/templates/uploads" . DS . $product_image );
                       // echo $result;

                           $query = query("INSERT INTO  products (product_title, product_category_id, product_price, product_quantity, product_description, short_desc, product_image) VALUES ( '{$product_title}', '{$product_category_id}', '{$product_price}',        '{$product_quantity}', '{$product_description}', '{$short_desc}',  '{$product_image}' )") ;
                          // echo "working"; 
                            $lastid= last_id();
                           confirm($query);

                           set_message("new product with id: {$lastid} just added");



                           redirect("index.php?products");

                           //  session_destroy();
                           
                       } 
             
     }

     function show_categories(){   // show_categories on add product page

        $query = query("SELECT * FROM categories");  
        confirm($query);  

        while($row =fetch_array($query)){

          $category_options= <<<DELIMETER
              
            <option value="{$row['cat_id']}">{$row['cat_title']}</option>
           

DELIMETER;
    
    echo  $category_options;
        }    
                      
 }
    /*********Editing / updating product***********/

function edit_product(){     //update_product() method in tutorial
// $result; \


if (!empty($_POST['update'])) {  
$product_title=  escape_string($_POST['product_title']);
$product_category_id=  escape_string($_POST['product_category_id']);
$product_price=  escape_string($_POST['product_price']);
$product_description=  escape_string($_POST['product_description']);
$short_desc=  escape_string($_POST['short_desc']);
$product_quantity=  escape_string($_POST['product_quantity']);
$product_image=  escape_string($_FILES['file']['name']);
$image_temp_location=  escape_string($_FILES['file']['tmp_name']);

if(empty($product_image)){
    $get_pic= query("SELECT product_image FROM products WHERE product_id = " .escape_string($_GET['id']) . "");
    confirm($get_pic);

    while($pic= fetch_array($get_pic)){
           $product_image =$pic['product_image'];

    }

}

$result =  move_uploaded_file($image_temp_location, "../../resources/templates/uploads" . DS . $product_image );




$query = "UPDATE products SET ";
$query .=  "product_title         = '{$product_title}'        , ";
$query .=  "product_category_id   = '{$product_category_id}'  , ";
$query .=  "product_price         = '{$product_price}'        , ";
$query .=  "product_description   = '{$$product_description}' , ";
$query .=  "short_desc            = '{$short_desc}'           , ";
$query .=  "product_quantity      = '{$product_quantity}'     , ";
$query .=  "product_image         = '{$product_image}'          ";  
$query .=  "WHERE product_id=" . escape_string($_GET['id']);

$send_update_query= query($query);

confirm($send_update_query);

set_message("Product has been updated succesfully");



redirect("index.php?products");

                           //  session_destroy();
                           
                       } 
                     }

                     /***categories in admin ****/
    function show_categories_in_admin(){

        
         $category_query = query("SELECT * FROM categories");
         confirm($category_query);

         while($row= fetch_array($category_query)){
                 $cat_id= $row['cat_id'];
                 $cat_title= $row['cat_title'];  

         

         $category =  <<<ENDHEREDOC

       <tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
ENDHEREDOC;
     echo  $category;
  }

   }


  function add_category(){

    if(isset($_POST['add_category'])){
      $cat_title=escape_string($_POST['cat_title']);
        if(empty($cat_title) || $cat_title== " "){

           echo "<p class='bg-danger'>You've not entered a category in the title field</p>";
        }
          else{
        set_message("new category created");

        $insert_query=query("INSERT INTO categories (cat_title) VALUES ('{$cat_title}') ");
        confirm($insert_query);

        
       }
    } 
  }
  /******Admin User*8********/
                   
    function show_users_in_admin(){

        
         $user_query = query("SELECT * FROM Users");
         confirm($user_query);

         while($row= fetch_array($user_query)){
                 $user_id= $row['user_id'];
                 $username= $row['username'];  
                $email= $row['email'];  
                $password= $row['password'];  

         $user =  <<<ENDHEREDOC

       <tr>
            <td>{$user_id}</td>
            <td>{$username}</td>
            <td>{$email}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
ENDHEREDOC;
     echo $user;
  }

   }

  function add_user(){
       if(isset($_POST['add_user']) ){
$username=  escape_string($_POST['username']);
$email=  escape_string($_POST['email']);
$password=  escape_string($_POST['password']);
//$user_photo=  escape_string($_FILES['file']['name']);
//$photo_temp=  escape_string($_FILES['file']['tmp_name']);

  //    move_uploaded_file($photo_temp, "../../resources/templates/uploads" . DS . $user_photo );


         $u_query = query("INSERT INTO Users (username,email,password ) VALUES ( '{$username}','{$email}','{$password}') ");
         confirm($u_query);
         set_message("New user added");
         redirect("index.php?users");
       }

   }

   function get_reports(){
        
          $query = query("SELECT * FROM reports");
  confirm($query);

   while($row =fetch_array($query))  {

      
  //http://
    $information = <<<ENDHEREDOC

      <tr>  <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_title']}</td>
             <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
ENDHEREDOC;
    echo $information;

      
        }
  } 

?>



