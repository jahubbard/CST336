<?php

include '../dbConnection.php';

session_start();

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['studentName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}
    
    function displayAllCertificates() 
    {
        global $conn;
        $sql="SELECT * FROM certificates";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    if(!isset($_SESSION['cart'])) 
    {
        $_SESSION['cart'] = array();
    }
    
    if (isset($_POST['cert_type'])) 
    {
        $newItem = array();
        $newItem['cert_type'] = $_POST['cert_type'];
        $newItem['required_flight_hours'] = $_POST['required_flight_hours'];
        $newItem['price'] = $_POST['price'];
        
        foreach($_SESSION['cart'] as &$item) 
        {
            if ($newItem['cert_type'] == $item['cert_type']) 
            {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true) 
        {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }
        function displayCartCount() 
    {
        echo count($_SESSION['cart']);
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products - C.I.A. Certificates</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>
    <body style = 'background-color:gold;'>
        
        <div class="container">
            <h1>Products - C.I.A. Certificates</h1>
            
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
                
            <?php
                $records = displayAllCertificates();
                
                echo "<table class='table table-hover'>";
                echo "<thead>
                        <tr>
                            <th scope='col'>Certificate Type ID</th>
                            <th scope='col'>Required Flight Hours</th>
                            <th scope='col'>Price</th>
                            <th scope='col'>Add To Cart</th>
                        </tr>
                     </thead>";
                echo"<tbody>";
                foreach($records as $record) 
                {
                    $cert_type = $record['cert_type'];
                    $required_flight_hours = $record['required_flight_hours'];
                    $price = $record['price'];
                    
                    echo "<tr>";
                    echo "<td>" . $record['cert_type'] . "</td>";
                    echo "<td>" . $record['required_flight_hours'] . "</td>";
                    echo "<td>" . '$' .$record['price'] . "</td>";
                   
                    echo "<form method ='post'>";
                    echo "<input type='hidden' name='cert_type' value='$cert_type'>";
                    echo "<input type='hidden' name='required_flight_hours' value='$required_flight_hours'>";
                    echo "<input type='hidden' name='price' value='$price'>";
                    
                    if ($_POST['price'] == $price) 
                    {
                        echo "<td><button class='btn btn-success'>Added To Cart</button></td>";
                    } 
                    else 
                    {
                        echo "<td><button class='btn btn-warning'>Add</button></td>";
                    }
                    echo "</tr>";
                    echo "</form>";
                }
                echo "</tbody>";
                echo "</table>";
            ?>

                <br><br>
                
            <form action="../logout.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
            </form>
            </div>
            <br>
        </div>
        <hr>
    </body>
</html>