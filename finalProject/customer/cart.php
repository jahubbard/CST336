<?php
    session_start();
    
    if(!isset( $_SESSION['studentName'])) 
    {
        //redirects back to login.php if $_SESSION doesn't contain valid credentials
        header("Location:/finalProject/index.php");
    }
    

    if (isset($_POST['removeId'])) 
    {
        foreach ($_SESSION['cart'] as $itemKey => $item) 
        {
            if ($item['aircraft_id'] == $_POST['removeId']) 
            {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    
     if (isset($_POST['removeIdCert'])) 
    {
        foreach ($_SESSION['cart'] as $itemKey => $item) 
        {
            if ($item['cert_type'] == $_POST['removeIdCert']) 
            {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    
    /*if (isset($_POST['remove_quantity'])) 
    {
        foreach ($_SESSION['cart'] as &$item) 
        {
            if ($item['aircraft_id'] == $_POST['aircraft_id']) 
            { 
                $item['quantity'] = $_POST['update'];
            }
        }
    }*/
    
    function displayCart() 
    {
        
        
        if(isset($_SESSION['cart'])) 
        {
            //Need if statement to alternate between aircraft and cert
            
            echo "<table class='table table-hover'>";
                echo"<thead style='text-align:left;' >
                    <tr>
                        <th scope='col'><h3> ID / Cert Name </h3></th>
                        <th scope ='col'><h3> Type </h3></th>
                        <th scope = 'col'><h3> Price </h3></th>
                    </tr>
                </thead>";
            echo "<tbody>";
            
            foreach ($_SESSION['cart'] as $item) 
            {
                $aircraft_id = $item['aircraft_id'];
                $aircraft_type = $item['aircraft_type'];
                $color = $item['color'];
                $aircraft_operator = $item['aircraft_operator'];
                $price_per_day = $item['price_per_day'];
                $cert_type = $item['cert_type'];
                $required_flight_hours = $item['required_flight_hours'];
                $price = $item['price'];
                $itemQuant = $item['quantity'];
                
                echo "<tr style='text-align:left;'>";
                if ($aircraft_id != NULL)
                {
                    echo "<td><h4>" . $item['aircraft_id'] . "</h4></td>";
                    echo "<td><h4>" . $item['aircraft_type'] . "</h4></td>";
                    echo "<td><h4>". '$'. $item['price_per_day'] . "</h4></td>";
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='remove_quantity' value='$aircraft_id'>";
                    echo "<td><input type='text' name='update' class='form-control' placeholder='$itemQuant'></td>";
                    //echo'<td><button class="btn btn-danger">Remove</button></td>';
                    echo '</form>';
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='removeId' value='$aircraft_id'>";
                    echo '<td><button class="btn btn=danger">Remove</button></td>';
                    echo '</form>';
                }
                else if($cert_type != NULL)
                {
                    echo "<td><h4>" . $item['cert_type'] . "</h4></td>";
                    echo "<td><h4>" . $item['required_flight_hours'] . "</h4></td>";
                    echo "<td><h4>". '$' . $item['price'] . "</h4></td>";
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='removeQuantityCert' value='$cert_type'>";
                    echo "<td><input type='text' name='update' class='form-control' placeholder='$itemQuant'></td>";
                    //echo'<td><button class="btn btn-danger">Remove</button></td>';
                    echo '</form>';
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='removeIdCert' value='$cert_type'>";
                    echo '<td><button class="btn btn=danger">Remove</button></td>';
                    echo '</form>';
                }
                
                $aircraft_id = NULL;
                $cert_type = NULL;
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title> Cart </title>
    </head>
    <body style="background-color:gold;">
        <div class='container'>
            <div class='text-center'>
                
                <!-- Bootstrap Navagation Bar -->
                <nav class='navbar navbar-default - navbar-fixed-top'>
                    <div class='container-fluid'>
                        <div class='navbar-header'>
                            <a class='navbar-brand' href='#'>Channel Island Aviation</a>
                        </div>
                        <ul class='nav navbar-nav'>
                            <li><a href='mainpage.php'> Home</a></li>
                            <li><a href='aircraft.php'> Aircraft Products</a></li>
                            <li><a href ='certificates.php'> Certificate Products</a> </li>
                            <li><a href = 'checkout.php'> Checkout Page</a></li>
                            <li><a href='cart.php'>Cart</a></li>
                            
                            <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                            </span> Cart: <?php displayCartCount(); ?> </a></li>
                        </ul>
                    </div>
                </nav>
                
                <br /> <br /> <br />
                <h2>Shopping Cart</h2>
                <hr style="border-bottom: 5px orange solid;">
                <!-- Cart Items -->
                <?php displayCart(); ?>
            </div>
        </div>
        <button type="button" class="btn btn-secondary btn-lg btn-block">
            <a style='color:black' href ='checkout.php'> Click to Checkout </a>
        </button>
        <br /> <br /> 
        <form action="../logout.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
    </body>
</html>