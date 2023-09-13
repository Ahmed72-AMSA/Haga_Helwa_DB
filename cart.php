<?php include 'header.php';?>
<?php include 'navbar.php';?>
<?php include './connection.php';?>


<?php
$prices = array();
if(!isset($_SESSION["cart"])){
 $_SESSION["cart"]=[];
}

if(isset($_POST["id"])){
$id = $_POST["id"];
$quantity = $_POST["quantity"];

if(empty($quantity)){
    $quantity=1;
}


$query = "select image,title,price,describtion from `clothes` where id = '$id'";
$db = mysqli_prepare($conn,$query);
mysqli_stmt_execute($db);
$result = mysqli_stmt_get_result($db);
$fetch = mysqli_fetch_assoc($result);

$_SESSION["cart"][]=[
 "image" => $fetch["image"],
 "title" => $fetch["title"],
 "describtion" => $fetch["describtion"],
 "price" => $fetch["price"],
 "quantity" => $quantity,

 
];
$_SESSION["cart"] = array_unique($_SESSION["cart"], SORT_REGULAR);




}
if(isset($_POST["remove"])){
    $index= $_POST["remover"];
    unset($_SESSION["cart"][$index]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);


}


// store title of products
$_SESSION["titles"]=array();
foreach($_SESSION["cart"] as $item){
$_SESSION["titles"][]=$item["title"];
}

$_SESSION["pro"]=implode(' , ',$_SESSION["titles"]);

$products = $_SESSION["pro"];






if(!isset($_SESSION['indicate']) || $_SESSION['indicate']==0){
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied please login.';
    exit();


}



 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: <?= $_SESSION['background']?>">
<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>
 
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Edit</td>
                </tr>
            </thead>
   
            <tbody>
                <?php foreach($_SESSION["cart"] as $cart){?>
                <tr>
                    <td><img src="<?= $cart['image']?>" alt="images"></td>

                    <td><?= $cart['title']?></td>

                    <td><?=$cart["describtion"]?></td>

                    <td><?=$cart['quantity']?></td>
                    
                  

                    <td><?= $cart['price']?></td>
                    
                    <td><?=$cart['quantity'] *  $cart['price']?></td>

                    <?php  $prices[]=$cart['quantity'] *  $cart['price']?>


                    


  
                  
              



                  
                      


                    <form action="" method="post">
                    <input type="hidden" name="remover" value="<?= array_search($cart,$_SESSION['cart'])?>" >
                    <td><button type="submit" name="remove" value="<?php echo $cart;?>"  class="btn btn-danger">Remove</button></td>
                    </form>
                    

                    <!-- Remove any cart item  -->
                    <td></td>

                <?php } ?>

   
                    
                    
                
                </tr>

            </tbody>
            <!-- confirm order  -->
            <form action="confirmOrder.php" method="post">
            <td><button type="submit" name="confirm" class="btn btn-success">Get Receipt</button></td>

            </form>


            <form method="post">

            <td><button type="submit" name="send" class="btn btn-danger">Send Order</button></td>
            </form>





            
        </table>
    </section>


    <?php 

    // Subtotal summation 
   
    $_SESSION["sum"]=0;

    for($i=0 ; $i<count($prices);$i++){
     $_SESSION["sum"]+=$prices[$i];
    }

    $total = $_SESSION["sum"];

    if(isset($_POST["send"])){
      
        $order = "select products,totalPrice from `clothes_order` where totalPrice = '$total'";
        $db_order = mysqli_prepare($conn,$order);
        mysqli_stmt_execute($db_order);
        $result_order = mysqli_stmt_get_result($db_order);
        $fetch_order = mysqli_fetch_assoc($result_order);
        $order_rows = mysqli_num_rows($result_order);

        var_dump($fetch_order);

        if($order_rows<1){

        $query2 = "insert into clothes_order(products , totalPrice) values ('$products','$total')";
        $db2 = mysqli_prepare($conn,$query2);
        mysqli_stmt_execute($db2);
        $result2 = mysqli_stmt_get_result($db2);
    }
        
        
    }

     






  ?>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$<?=$_SESSION["sum"]?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<?=$_SESSION["sum"]?></strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section>

    <?php include "footer.php" ?>

    
</body>
</html>

