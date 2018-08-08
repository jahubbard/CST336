<?php
include '../dbConnection.php';

session_start();

//include 'cart.php';
$conn = getDatabaseConnection("channel_islands");

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
        
        else if (isset($_POST['cert_type'])) 
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

    function displaySearchResults() {
        global $conn;
        
        if (isset($_GET['searchForm'])) {
            echo "<h3>Products Found: </h3>";
            
            $namedParameters = array();
            if(isset($_GET['category']) && $_GET['category'] == 'aircraft') {
                
                $sql = "SELECT * FROM aircraft where 1";
                
                if (!empty($_GET['query'])) {
                    $sql .= " AND aircraft_type LIKE :aircraft_type";
                    $namedParameters[":aircraft_type"] = "%" . $_GET['query'] . "%";
                }
                
                if (!empty($_GET['priceFrom'])) {
                    $sql .= " AND price_per_day >= :priceFrom";
                    $namedParameters[":priceFrom"] = $_GET['priceFrom'];
                }
                
                if (!empty($_GET['priceTo'])) {
                    $sql .= " AND price_per_day <= :priceTo";
                    $namedParameters[":priceTo"] = $_GET['priceTo'];
                }
                
                $stmt = $conn->prepare($sql);
                $stmt->execute($namedParameters);
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo "<table class='table table-hover'>";
                echo "<thead>
                    <tr>
                        <th scope='col'>Aircraft ID</th>
                        <th scope='col'>Aircraft Type</th>
                        <th scope='col'>Aircraft Operator</th>
                        <th scope='col'>Price Per Day</th>
                        <th scope='col'> Add To Cart </th>
                    </tr>
                 </thead>";
                echo"<tbody>";
                foreach ($records as $record) {
                    echo "<tr>";
                    echo "<td>" . $record['aircraft_id'] . "</td>";
                    echo "<td>" . $record['aircraft_type'] . "</td>";
                    echo "<td>" . $record['aircraft_operator'] . "</td>";
                    echo "<td>" . '$' .$record['price_per_day'] . "</td>";
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='aircraft_id' value='".$record['aircraft_id']."'>";
                    echo "<input type='hidden' name='aircraft_type' value='".$record['aircraft_type']."'>";
                    echo "<input type='hidden' name='color' value='".$record['color']."'>";
                    echo "<input type='hidden' name='aircraft_operator' value='".$record['aircraft_operator']."'>";
                    echo "<input type='hidden' name='price_per_day' value='".$record['price_per_day']."'>";
                
                    if (isset($_POST['aircraft_id']) && $_POST['aircraft_id'] == $record['aircraft_id']) {
                        echo "<td><button class='btn btn-success'>Added To Cart</button></td>";
                    } 
                    else {
                        echo "<td><button class='btn btn-warning'>Add</button></td>";
                    }
                    echo "</tr>";
                    echo "</form>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            
            else if(isset($_GET['category']) && $_GET['category'] == 'certificates') {
                
                $sql = "SELECT * FROM certificates where 1";
                
                if (!empty($_GET['query'])) {
                    $sql .= " AND cert_type LIKE :cert_type";
                    $namedParameters[":cert_type"] = "%" . $_GET['query'] . "%";
                }
                
                if (!empty($_GET['priceFrom'])) {
                    $sql .= " AND price >= :priceFrom";
                    $namedParameters[":priceFrom"] = $_GET['priceFrom'];
                }
                
                if (!empty($_GET['priceTo'])) {
                    $sql .= " AND price <= :priceTo";
                    $namedParameters[":priceTo"] = $_GET['priceTo'];
                }
                
                $stmt = $conn->prepare($sql);
                $stmt->execute($namedParameters);
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo "<table class='table table-hover'>";
                echo "<thead>
                    <tr>
                        <th scope='col'>Certificate Type</th>
                        <th scope='col'>Required Flight Hours</th>
                        <th scope='col'>Price</th>
                        <th scope='col'> Add To Cart </th>
                    </tr>
                 </thead>";
                echo"<tbody>";
                foreach ($records as $record) {
                    echo "<tr>";
                    echo "<td>" . $record['cert_type'] . "</td>";
                    echo "<td>" . $record['required_flight_hours'] . "</td>";
                    echo "<td>" . $record['price'] . "</td>";
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='cert_type' value='".$record['cert_type']."'>";
                    echo "<input type='hidden' name='required_flight_hours' value='".$record['required_flight_hours']."'>";
                    echo "<input type='hidden' name='price' value='".$record['price']."'>";
                
                     if (isset($_POST['cert_type']) && $_POST['cert_type'] == $record['cert_type']) {
                        echo "<td><button class='btn btn-success'>Added To Cart</button></td>";
                    } 
                    else {
                        echo "<td><button class='btn btn-warning'>Add</button></td>";
                    }
                    
                    echo "</tr>";
                    echo "</form>";
                }
                echo "</tbody>";
                echo "</table>";
                
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Home Page</title>
        <link rel="stylesheet" href="/finalProject/customer/css/styles.css" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    </head>
    
    <body style = 'background-color:gold;'>
        <h1> Welcome <?=$_SESSION['studentName']?>!<br> Search for a Product or Select a Tab!</h1>
        <!-- Bootstrap Navagation Bar -->
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
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div align="center">
                    <!-- Filters -->
                    <h3> Category </h3>
                    <h6> Select a Category and then either a price or a product name to filter down your search. If not, select a category then click on submit.</h6>
                    <select name="category">
                        <option value="">Select One</option>
                        <option value="aircraft">Aircraft</option>
                        <option value="certificates">Certificates</option>
                    </select>
                    <br /><br />
                    
                    
                    <label for="pName"><h3>Product Search</h3></label>    
                    <input type="text" style ='width:50%;' class="form-control" name="query" id="pName" placeholder="Enter an Aircraft or Certification Type">
                    <br>
                    
                    </div>
                    <h3 style="padding-left: 48%">Price (Optional)</h3>
                    <div style ="padding-left: 45%;">
                        
                 From: <input type="text" name="priceFrom" size="7"/> <br>
                </div>
                <div align ="center">
                       To:   <input type="text" name="priceTo" size="7"/>
                    
                <br /><br />
                    <input type="submit" value="Submit" class="btn btn-default" name="searchForm">
                </div>
                <br /><br />
            </form>
            
            <?= displaySearchResults() ?>   
            <hr>
            <div>
                <div align="center">
                 <!--Survey Question AJAX-->
                 Was the content of this web page helpful?<br />
                <input type="radio" name="question2" id="q2-1"  value="Yes"/> Yes </input> <br />
                <input type="radio" name="question2" id="q2-2"  value="No"/> No </input> <br />
                <input type="radio" name="question2" id="q2-3"  Value="Unsure"/> Unsure </input> <br />
                <div id="question2-feedback" class="answer"></div><br /> 
                <br />
                <div id="btnSurvey" class="btn btn-info">Give Feedback</div>
                </div>                
             </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="checkSurvey.js"></script>
            <br />
            <form action="../logout.php">
                <input type="submit" class = 'btn btn-secondary' id = "beginning" value="Logout"/>
            </form>
            <br>
    </body>
</html>