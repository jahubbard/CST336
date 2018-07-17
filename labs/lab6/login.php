<?php
session_start();
?>
<html>
    <head>
        <title>OtterMart - Admin Site</title>
    </head>
    <body>
        <h1> OtterMart - Admin Site</h1>
        
        <form method="POST" action="loginProcess.php">
            Username: <input type="text" name="username" /><br />
            Password: <input type="password" name="password" /><br />
            
            <input type="submit" name="submit" value="Login!"/>
            
            <?php
            
                if($_SESSION['incorrect']) {
                    echo "<p class = 'lead' id = 'error' style='color:red'>";
                    echo "<strong>Incorrect Username or Password!</strong></p>";
                }
            ?>
        </form>
    </body>
</html>