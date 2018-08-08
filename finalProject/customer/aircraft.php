<?php

include '../dbConnection.php';

session_start();

$conn = getDatabaseConnection("channel_islands");

if(!isset( $_SESSION['studentName'])) 
{
    //redirects back to login.php if $_SESSION doesn't contain admin credentials
    header("Location:/finalProject/index.php");
}

    
    function displayAllAircraft() 
    {
        global $conn;
        $sql="SELECT * FROM aircraft";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (isset($_POST['aircraft_id'])) {
        $newItem = array();
        $newItem['aircraft_id'] = $_POST['aircraft_id'];
        $newItem['aircraft_type'] = $_POST['aircraft_type'];
        $newItem['color'] = $_POST['color'];
        $newItem['aircraft_operator'] = $_POST['aircraft_operator'];
        $newItem['price_per_day'] = $_POST['price_per_day'];
        
        foreach($_SESSION['cart'] as &$item) {
            if ($newItem['aircraft_id'] == $item['aircraft_id']) {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true) {
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
        <title>Products - C.I.A. Aircraft</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>
    <body style = 'background-color:gold;'>
        
        <div class="container">
            <h1>Products - C.I.A. Aircraft</h1>
            
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
            $records = displayAllAircraft();
            
            echo "<table class='table table-hover'>";
            echo "<thead>
                    <tr>
                        <th scope='col'>Aircraft ID</th>
                        <th scope='col'>Aircraft Type</th>
                        <th scope='col'>Aircraft Operator</th>
                        <th scope='col'>Price Per Day</th>
                        <th scope='col'>Add To Cart</th>
                    </tr>
                 </thead>";
            echo"<tbody>";
            foreach($records as $record) 
            {
                $aircraft_id = $record['aircraft_id'];
                $aircraft_type = $record['aircraft_type'];
                $color = $record['color'];
                $aircraft_operator = $record['aircraft_operator'];
                $price_per_day = $record['price_per_day'];
                echo "<tr>";
                echo "<td>" . $record['aircraft_id'] . "</td>";
                echo "<td>" . $record['aircraft_type'] . "</td>";
                echo "<td>" . $record['aircraft_operator'] . "</td>";
                echo "<td>" . '$' .$record['price_per_day'] . "</td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='aircraft_id' value='$aircraft_id'>";
                echo "<input type='hidden' name='aircraft_type' value='$aircraft_type'>";
                echo "<input type='hidden' name='color' value='$color'>";
                echo "<input type='hidden' name='aircraft_operator' value='$aircraft_operator'>";
                echo "<input type='hidden' name='price_per_day' value='$price_per_day'>";
                
                if ($_POST['aircraft_id'] == $aircraft_id) {
                    echo "<td><button class='btn btn-success'>Added To Cart</button></td>";
                } else {
                    echo "<td><button class='btn btn-warning'>Add</button></td>";
                }
                echo "</tr>";
                echo "</form>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>

                <br><br>
                
            </form>
            
            <form action="../logout.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
            </form>
            </div>
            <br>
        </div>
        <hr>
    </body>
</html>