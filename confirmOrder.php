<?php
include "header.php";
include "navbar.php";
$current_date = date('Y-m-d');


if(isset($_POST["submit"])){
    require('fpdf.php'); // Include FPDF library

    // Get form data
   
    
    // Create new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set font

    $pdf->SetFont('Arial','',12);

    $pdf->Cell(130 ,5,'Haga Helwa Store',0,0);
    $pdf->Cell(59 ,5,'INVOICE',0,1);//end of line
    
    //set font to arial, regular, 12pt
    
    $pdf->Cell(130 ,5,'[Street Address]',0,0);
    $pdf->Cell(59 ,5,'',0,1);//end of line
    
    $pdf->Cell(130 ,5,'[City, Country, ZIP]',0,0);
    $pdf->Cell(25 ,5,'Date',0,0);
    $pdf->Cell(34 ,5,"[".$current_date."]",0,1);//end of line
    
    $pdf->Cell(130 ,5,'Phone [01021023089]',0,0);
    $pdf->Cell(25 ,5,'Invoice #',0,0);
    $pdf->Cell(34 ,5,'[01021023089]',0,1);//end of line
    
    $pdf->Cell(130 ,5,'Fax [+12345678]',0,0);
    $pdf->Cell(35 ,5,'Customer name:',0,0);
    $pdf->Cell(35 ,5,$_SESSION['user'],4,1);//end of line
    
    //make a dummy empty cell as a vertical spacer
    $pdf->Cell(189 ,10,'',0,1);//end of line
    
    //billing address
    $pdf->Cell(100 ,5,'Bill to',0,1);//end of line
    
    //add dummy cell at beginning of each line for indentation
    $pdf->Cell(10 ,5,'',0,0);
    $pdf->Cell(90 ,5,'[Name]',0,1);
    
    $pdf->Cell(10 ,5,'',0,0);
    $pdf->Cell(90 ,5,'[Company Name]',0,1);
    
    $pdf->Cell(10 ,5,'',0,0);
    $pdf->Cell(90 ,5,'[Address]',0,1);
    
    $pdf->Cell(10 ,5,'',0,0);
    $pdf->Cell(90 ,5,'[Phone]',0,1);
    
    //make a dummy empty cell as a vertical spacer
    $pdf->Cell(189 ,10,'',0,1);//end of line
    
    //invoice contents
    $pdf->SetFont('Arial','B',12);
    
    $pdf->Cell(130 ,5,'Title',1,0);
    $pdf->Cell(25 ,5,'Quantity',1,0);
    $pdf->Cell(34 ,5,'Total Price',1,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    
    //Numbers are right-aligned so we give 'R' after new line parameter
    foreach($_SESSION["cart"] as $cart){
    $pdf->Cell(130 ,5,$cart['title'],1,0);
    $pdf->Cell(25 ,5,$cart['quantity'],1,0);
    
    $pdf->Cell(34 ,5,$cart['price'],1,1,'R');//end of line
    }

    

    
   
    
    //summary
    $pdf->Cell(130 ,5,'',0,0);
    $pdf->Cell(25 ,5,'Subtotal',0,0);
    $pdf->Cell(4 ,5,'$',1,0);
    $pdf->Cell(30 ,5,$_SESSION["sum"],1,1,'R');//end of line
    
    $pdf->Cell(130 ,5,'',0,0);
    $pdf->Cell(25 ,5,'Taxable',0,0);
    $pdf->Cell(4 ,5,'$',1,0);
    $pdf->Cell(30 ,5,'0',1,1,'R');//end of line
    
    $pdf->Cell(130 ,5,'',0,0);
    $pdf->Cell(25 ,5,'Tax Rate',0,0);
    $pdf->Cell(4 ,5,'$',1,0);
    $pdf->Cell(30 ,5,'0',1,1,'R');//end of line
    
    $pdf->Cell(130 ,5,'',0,0);
    $pdf->Cell(25 ,5,'Total Due',0,0);
    $pdf->Cell(4 ,5,'$',1,0);
    $pdf->Cell(30 ,5,$_SESSION["sum"],1,1,'R');//end of line
    ob_clean();

    $pdf->Output();

}

    
        
    
// }
    ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: <?= $_SESSION['background']?>">
<section id="cart-add" class="section-p1">
    <form>
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" name="coupon" placeholder="Enter coupon code">
            <button class="normal mt-2" type="submit" >Apply</button>
        </div>
        </form>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <form class=" col-4" method="post">
                name<input type="text" >
               email <input type="email" >
                address<input type="text" >
                city<input type="text" >
                postalCode<input type="number" >
                phone<input type="text">
                paymentType<select >
                <option value="Cash_on_Delivery">Cash on Delivery</option>
                    <option value="Credit_Card">Credit Card</option>
                    <option value="Fawry">Fawry</option>
                </select>
                <button class="normal mt-2" type="submit" name="submit">proceed to checkout</button>
            </form>
           
        </div>
    </section>


    <?php include "footer.php" ?>
    
</body>
</html>

