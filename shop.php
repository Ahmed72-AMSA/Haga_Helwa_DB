<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<?php
$counter=0;

$query = "select id,title,image,describtion,price from `clothes` ";
$db = mysqli_prepare($conn,$query);
mysqli_stmt_execute($db);
$result = mysqli_stmt_get_result($db);
$fetch = mysqli_fetch_all($result);
// var_dump($fetch);
if(isset($_GET["review"])){
$review = $_GET["review"];
}


if(isset($_GET["id"])){
$id= $_GET["id"];
}

// reviews table


$user = $_SESSION["user"];

$title = "";

if(isset($_GET["title"])){
$title = $_GET["title"];
}









if(isset($_GET["subReview"])){

$query3 = "select username,productName,review from `reviews` where username = '$user' AND productName='$title'";
 $db3 = mysqli_prepare($conn,$query3);
 mysqli_stmt_execute($db3);
 $result4 = mysqli_stmt_get_result($db3);

 $reviews_row = mysqli_num_rows($result4);

 
 if($reviews_row<1){
 $query2 = "insert into `reviews` (username,productName,review) values ('$user','$title','$review')";
 $db2 = mysqli_prepare($conn,$query2);
 mysqli_stmt_execute($db2);
 $result3 = mysqli_stmt_get_result($db2);
 }
}







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
<body style="background-color: <?= $_SESSION['background']?>;"
>
<section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modren Desgin</p>

        
        <div class="pro-container">
        <?php foreach($fetch as $product){?>
          

            <div class="pro row-cols-3">
            <!-- <form> -->
            <img src="<?=$product[2]?>" alt="p1" />
                <div class="des mb-3">
                    <h2><?= $product[1]?></h2>

                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>

                    <h5 class="text-danger">price : <?= $product[4]?></h5>

                    <h4>Quantity</h4>
                    <form method="POST" action="cart.php">
                    <input type="number" name="quantity" >
                    <input class="form-control" type="hidden" name="id" value="<?=$product[0]?>"></input>
                    <button type="submit" name="submit" class="mt-5"><a href="cart.php" class="cart"><i class="fas fa-shopping-cart "></i></a></button>


                    </form>


                </div>
           
      






                <form method="GET">
                <input class="form-control w-100" type="text" name="review" placeholder="review">
                <button type="submit" class="btn btn-primary mt-4" name="subReview" >Send Review</a></button>
                <input class="form-control" type="hidden" name="title" value="<?=$product[1]?>"></input>


                </form>

                <?php

                if(isset($_GET["subReview"])){
                
                }
              


               ?>



                </div>
                <?php }?>

        </div>




</form>
                

                

              
    </section>
    


    <section id="pagenation" class="section-p1">
    <nav aria-label="Page navigation example" >
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="shop.php" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1 of 2 </a></li>
 
    <li class="page-item">
      <a class="page-link" href="shop.php?" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
        </div>
        <div class="form ">
            <input type="text " placeholder="Enter Your E-mail... ">
            <button class="normal ">Sign Up</button>
        </div>
    </section>


    <?php include 'footer.php' ?>


  
</body>
</html>
    