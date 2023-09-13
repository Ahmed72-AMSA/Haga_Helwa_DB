<?php
session_start();
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../view/connection.php";


if(isset($_POST["addCategory"])){
$catName=$_POST["name"];
$query = "insert into `categories`(`name`) values(?)";
 $db = mysqli_prepare($conn,$query);
 mysqli_stmt_bind_param($db,'s',$catName);
 mysqli_stmt_execute($db);
 $result = mysqli_stmt_get_result($db);
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
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="addCategory.php">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="name" class="form-control p_input text-white">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
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