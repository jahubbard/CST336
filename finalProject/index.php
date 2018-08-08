<!--Final Project - Channel Islands Aviation-->

<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Channel Islands Aviation - Company Website</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Channel Islands Aviation</h1>
        
        <br /><br />
        
        <figure id="me">
                <img src="/finalProject/img/plane.jpg" alt="Picture of CIA CESSNA" />
        </figure>
            
        <br /><br />
        
        <!--<form>
            Lastname: <input type="text" id="lastname"/>
            <span style="color:red" id="lastnameValidation"></span> <br />
            Password: <input type="password" id="password"/>
            <span style="color:red" id="passwordValidation"></span> <br />     
        </form>
        
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
            $("#lastname").change(function() {
                aler($(this).val());//shows username entered for testing purposes
                $.ajax({
                        type: "post",
                        url: "loginProcess.php",
                        data: { "lastname": $(this).val()},
                        success: function(data,status) {
                            alert(data);//displaying data recieved, for testing purposes
                        }
                });
            });
            $("#password").change(function() {
                aler($(this).val());//shows password entered for testing purposes
                $.ajax({
                        type: "post",
                        url: "loginProcess.php",
                        data: { "password": $(this).val()},
                        success: function(data,status) {
                            alert(data);//displaying data recieved, for testing purposes
                        }
                });
            });
            success: function(data,status) {
                if (data=="Available") {
                    $("#lastnameValidation").html("Available!");
                    $("#lastnameValidation").css("color","green");
                } else {
                    $("#lastnameValidation").html("Lastname already taken!");
                    $("#lastnameValidation").css("color","red");
                }
            }
        </script>-->
        
        <form method="POST" action ="loginProcess.php">
            Last Name: <input type="text" name="lastname"/> <br />
            Password: <input type="password" name="password"/> <br />
            
            <input type="submit" class = 'btn btn-primary' name="submitForm" value="Login" />
            <br /><br />
            <?php
                if($_SESSION['incorrect']) {
                    echo "<p class = 'lead' id = 'error' style ='color:red'>";
                    echo "<strong>Incorrect Last Name or Password!</strong></p>";
                }
            ?>
        </form>
    
    </body>
</html>