<?php
include "connection.php";
include "header.php";
include "navbar.php";
$errMsg="";
$err=[];
$counter=0;
if(isset($_SESSION["id"])){
$_SESSION["id"]="";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['submit'])) {

$mail = test_input($_REQUEST["mail"]);
$password = test_input($_REQUEST["pass"]);
$hashedPass= password_hash($password,PASSWORD_DEFAULT);



if (!isset($_SESSION['indicate'])) {
  $_SESSION['indicate']=0;

}

if(empty($mail)){
 $err="Mail should not be empty ";

}


if(empty($password)){
  $err="password should not be empty ";
 
 }


 



 if(empty($err)){
$query = "SELECT * FROM `signup` WHERE type = 'admin' AND email = '$mail' AND password = '$password'";
 $db = mysqli_prepare($conn,$query);
  mysqli_stmt_execute($db);
 $result = mysqli_stmt_get_result($db);
 $adminRows = mysqli_num_rows($result);
 $fetch = mysqli_fetch_all($result,MYSQLI_ASSOC);

  if($adminRows>0 && ($fetch)){
  
  
    
  header("Location:admin/view/addCategory.php");
   }else $errMsg="incorrect mail or password";



  $sql = "SELECT * FROM `signup` WHERE type = 'user' AND email = '$mail' AND password = '$password'";
  $db2 = mysqli_prepare($conn,$sql);
  $x = mysqli_stmt_execute($db2);
  $result2 = mysqli_stmt_get_result($db2);
   
   $num_rows=mysqli_num_rows($result2);
   if($num_rows>0 && password_verify($password,$hashedPass)){
    $_SESSION['indicate']=1;
    header("Location:shop.php");
   }else{
    $errMsg="Incorrect Password or mail";
   }


   $query_3 = "SELECT `id` from `signup` where email='$mail' and password='$password'";
  $db3 = mysqli_prepare($conn,$query_3);
  mysqli_stmt_execute($db3);
 $result3 = mysqli_stmt_get_result($db3);
 $fetch3 = mysqli_fetch_all($result3,MYSQLI_ASSOC);


foreach ($fetch3 as $item) {
  foreach ($item as $key => $value) {
    $_SESSION["id"]=$value; 
  }
}






}





  }








  
 














  




  







    


    






        
    
    

    
    
























    
    
  



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

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
<div class="card-body px-5 py-5" style="background-color:darkgray;">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" class="form-control p_input" name="mail">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" class="form-control p_input" name="pass">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                 <div class="mx-5 my-4"><p class="text-danger font-weight-bold ms-2"><?= $errMsg ?></p></div>


                  <div class="text-center">
                    <button class="btn btn-primary btn-block enter-btn" name="submit">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
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
  
  
    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session
  
</body>
</html>


            
             