<?php
session_start();
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../view/connection.php";


$titleErr=$priceErr=$quantity=$describtion = $imageSearch="";
$title = $quantityErr= $desErr= $price =$image= $imageErr = $searchImageErr = "";
$search = 0;

$errs=[];




  $query = "select `name` from `categories`";
   $db = mysqli_prepare($conn,$query);
   mysqli_stmt_execute($db);
   $result = mysqli_stmt_get_result($db);
   $fetch = mysqli_fetch_all($result,MYSQLI_ASSOC);
   $num_rows=mysqli_num_rows($result);

  


  













if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['addProduct'])) {

    if(empty($_REQUEST['title'])){
        $titleErr="Title is Required";
        $errs[]=$titleErr;


    }
    else{
    $title=test_input($_REQUEST['title']);
    if (!preg_match("/^[a-zA-Z ]*$/", $title)){
        $title="";
        $titleErr="String only allowed";
        $errs[]=$titleErr;

    }
   }


    if (empty($_REQUEST['price'])) {
        $priceErr = 'Price is required';
        $errs[]=$priceErr;

        
    } else {
        $price = test_input($_REQUEST['price']);
        if (!is_numeric($price)) {
            $priceErr="";
            $priceErr = "Only digits allowed.";
            $errs[]=$priceErr;

        }

    }


    if (empty($_POST["quantity"])) {
	    $quantityErr = "Quantity is required";
      $errs[]=$quantityErr;

	  } else {
	    $quantity = test_input($_POST["quantity"]);
        if (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity < 1) {
	      $quantityErr = "Quantity must be a positive integer starting from 1";
        $errs[]=$quantityErr;

	    }

	  }






    if (empty($_REQUEST['desc'])) {
        $desErr = 'Password is required';
        $errs[]=$desErr;

    } 
    else{
      $describtion=test_input($_REQUEST['desc']);
    }




    if (empty($_FILES["image"])) {
        $imageErr = "Image is required";
        $errs[]=$imageErr;

      } else {
        $target_dir = "./img/products/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if (!file_exists($_FILES["image"]["tmp_name"])) {
          $image = "Image is invalid";
          $errs[]=$imageErr;

        } else {
          move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
          $image = $target_file;
        }
      }

if(empty($errs)){
 $query2 = "insert into `clothes`(title,describtion,price,quantity,image) values('$title','$describtion','$price','$quantity','$image')";
 $db2 = mysqli_prepare($conn,$query2);
 mysqli_stmt_execute($db2);
 $result = mysqli_stmt_get_result($db2);
}







 


    





  }


  $searchDesc = $searchPrice= $searchTitle= $searchQuantity= "";
  $titleSearch = $descSearch = $priceSearch = $quantitySearch = "";

  
  




  if(isset($_GET["getProduct"])){

    $search = $_GET["search"];





 

 $query3 = "select title,describtion,price,quantity from `clothes` where id = '$search'";
 $db3 = mysqli_prepare($conn,$query3);
 mysqli_stmt_execute($db3);
 $result3 = mysqli_stmt_get_result($db3);

 $searchFetch = mysqli_fetch_assoc($result3);

 if(mysqli_num_rows($result3)>0){
 $searchDesc = $searchFetch["describtion"];
 $searchPrice = $searchFetch["price"];
 $searchTitle  = $searchFetch['title'];
 $searchQuantity = $searchFetch["quantity"];




 }











    
}

if(isset($_POST["delete"])){
  $query4 = "delete from `clothes` where id= '$search'";
  $db4 = mysqli_prepare($conn,$query4);
  mysqli_stmt_execute($db4);


 }

 if(isset($_POST["update"])){
 $titleSearch = test_input($_POST["title-search"]);
 $descSearch = test_input($_POST["desc-search"]);
 $priceSearch = test_input($_POST["price-search"]);
 $quantitySearch = test_input($_POST["quantity-search"]);



 if (empty($_FILES["image-search"])) {
  $searchImageErr = "Image is required";

} else {
  $target_dir2 = "./img/products/";
  $target_file2 = $target_dir2 . basename($_FILES["image-search"]["name"]);
  $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
  
  if (!file_exists($_FILES["image-search"]["tmp_name"])) {
    $searchImageErr = "Image is invalid";

  } else {
    move_uploaded_file($_FILES["image-search"]["tmp_name"], $target_file2);
    $imageSearch = $target_file2;
  }
}











 $query5 = "update `clothes` set title = '$titleSearch' , describtion = '$descSearch' , price = '$priceSearch' , quantity = '$quantitySearch' , image= '$imageSearch'  where id= '$search'";
 $db5 = mysqli_prepare($conn,$query5);
 mysqli_stmt_execute($db5);


 }








  


    






  



  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  
  }


?>


      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

              <div class="card-body px-5 py-5">

                <h3 class="card-title text-left mb-3">Add Product</h3>

                <!-- original form -->
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-select">
                    <?php foreach($fetch as $item){?>
                    <?php foreach ($item as $value){?>

                    <?php if($num_rows>0){?>
                    <option class="text-danger" name="<?= $value ?>"><?= $value ?></option>
                    <?php } ?>

                    <?php } ?>
                    <?php } ?>

                    
</select>
                  </div>
                  <div class="form-group mt-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control text-white"> <span class="text-danger ms-3"><?= $titleErr?></span>

                  </div>

                  <div class="form-group mt-3 text-white">
                    <label>Description</label>
                    <input type="text" name="desc" class="form-control text-white"> <span class="text-danger ms-3"><?= $desErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control text-white"> <span class="text-danger ms-3"><?= $priceErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control text-white"> <span class="text-danger ms-3"><?= $quantityErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control text-white"> <span class="text-danger ms-3"><?= $imageErr?></span>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>

                


                  
                </form>


                    




                <!-- Update and delete form -->





                <form  method="get">
                <div class="form-group">
                  <label>Search by ID</label>
                  <input type="search" name="search" class="form-control text-white" placeholder="Search by product's ID">
                  <button type="submit" class="btn btn-primary mt-2" name="getProduct">Get Product</button>
                  </form>
                    
                  </div>
                <form method="POST" enctype="multipart/form-data">
                  
            


                  <div class="form-group mt-3">
                    <label>Title</label>
                    <input type="text" name="title-search" class="form-control text-white" value="<?= $searchTitle ?>"> <span class="text-danger ms-3"><?= $titleErr?></span>

                  </div>

                  <div class="form-group mt-3">
                    <label>Description</label>
                    <input type="text" name="desc-search" class="form-control text-white" value="<?= $searchDesc ?>" > <span class="text-danger ms-3"><?= $desErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Price</label>
                    <input type="number" name="price-search" class="form-control text-white" value="<?= $searchPrice?>"> <span class="text-danger ms-3"><?= $priceErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity-search" class="form-control p_input" value="<?=$searchQuantity?>"> <span class="text-danger ms-3"><?= $quantityErr?></span>
                  </div>
                  <div class="form-group mt-3">
                    <label>Image</label>
                    <input type="file" name="image-search" class="form-control p_input"> <span class="text-danger ms-3"><?= $imageErr?></span>
                  </div>

                  
                  <div class="text-center">
                    <button type="submit" name="update" class="btn btn-warning btn-block enter-btn">Update Product</button>
                    <button type="submit" name="delete" class="btn btn-danger btn-block enter-btn">Delete Product</button>

                  </div>


                


                  
                </form>


              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>



  
    

<?php 
include "../view/footer.php";
 ?>