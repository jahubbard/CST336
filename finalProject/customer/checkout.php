<?php

session_start();


    function displayCartCount() 
    {
        echo count($_SESSION['cart']);
    }
    
    function displayCheckout()
    {
        $errors = array_filter($_SESSION['cart']);
        if(!empty($errors)) {
            $subtotal = 0;
            $taxrate = .0825;
            $taxes = 0;
            $shipping = "Free Shipping";
            $total = 0;
            
            echo "<table class='table table-hover'>";
                    echo "<thead>
                        <tr>
                            <th scope='col'>Subtotal</th>
                            <th scope='col'>Tax (8.25%)</th>
                            <th scope='col'>Shipping</th>
                            <th scope='col'>Total</th>
                        </tr>
                     </thead>";
                    echo"<tbody>";
            foreach($_SESSION['cart'] as &$item) 
            {
                if ($item['price_per_day'] == true)
                {
                    $subtotal += $item['price_per_day'];
                }
                else if ($item['price'] == true)
                {
                    $subtotal += $item['price'];
                }
            }
            
            $taxes = $subtotal * $taxrate;
            $total = $subtotal + $taxes;
            
            echo "<tr>";
            echo "<td>". '$' . number_format($subtotal, 2) . "</td>";
            echo "<td>". '$' . number_format($taxes, 2) . "</td>";
            echo "<td>" . $shipping . "</td>";
            echo "<td>". '$' . number_format($total, 2) . "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }
        
        else
        {
            echo "<h2>Cart is empty.</h2>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Checkout </title>
        <link rel="stylesheet" href="/finalProject/customer/css/styles.css" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>
    <body style = "background-color:gold;">
        <h1> Checkout Page </h1>        
                  
        <nav class='navbar navbar-default - navbar-fixed-top'>
            <div class='container-fluid'>
                <a style='color:black' href='mainpage.php'>Home</a>
                <a style='color:black' href='aircraft.php'> Aircraft Products </a>
                <a style='color:black' href='certificates.php'> Certificate Products </a>
                <a style='color:black' href = 'checkout.php'> Checkout Page</a>
                <a style='color:black' href='cart.php'>
                <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                </span> Cart: <?php displayCartCount(); ?> </a>
            </div>
            <hr>
        </nav>
        <br /> <br />
        <?php displayCheckout(); ?>
    </body>
</html>