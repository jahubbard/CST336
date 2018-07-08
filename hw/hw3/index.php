<!DOCTYPE html>
<html lang="en">
	<head>
  		<meta charset="utf-8">
    	<title>Personalized Quotes</title>
    	<link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
	<body>
		<header>
			<h1>Personalized Quotes</h1>
		</header>
		<hr />
		<br /><br />
		<main>
			<div class="IntroText">
				<?php
                    // define variables and set to empty values
                    $fnameErr = $lnameErr = $cbornErr = $ageErr = $moodErr = "";
                    $fname = $lname = $cborn = $age = $mood = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["fname"])) {
                            $fnameErr = "First name is required";
                         } else {
                            $fname = test_input($_POST["fname"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
                                $fnameErr = "Only letters and white space allowed"; 
                            }
                            $fnameErr = "";
                        }
                        
                        if (empty($_POST["lname"])) {
                            $lnameErr = "Last name is required";
                         } else {
                            $lname = test_input($_POST["lname"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
                                $lnameErr = "Only letters and white space allowed"; 
                            }
                            $lnameErr = "";
                        }
                        
                        if (empty($_POST["cborn"])) {
                            $cbornErr = "City Born is required";
                         } else {
                            $cborn = test_input($_POST["cborn"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z ]*$/",$cborn)) {
                                $cbornErr = "Only letters and white space allowed"; 
                            }
                            $cbornErr = "";
                        }
  
                        if (empty($_POST["age"])) {
                            $ageErr = "Age is required";
                        } else {
                            $age = test_input($_POST["age"]);
                            $ageErr = "";
                        }

                        if (empty($_POST["mood"])) {
                            $moodErr = "Mood is required";
                        } else {
                            $mood = test_input($_POST["mood"]);
                            $moodErr = "";
                        }
                    }

                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                ?>

<h3>Please enter the following details:</h3>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  First Name: <input type="text" name="fname" value="<?php echo $fname;?>">
  <span class="error">* <?php echo $fnameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="lname" value="<?php echo $lname;?>">
  <span class="error">* <?php echo $lnameErr;?></span>
  <br><br>
  City Born: <input type="text" name="cborn" value="<?php echo $cborn;?>">
  <span class="error">* <?php echo $cbornErr;?></span>
  <br><br>
  Age Bracket: <select name ="age">
  <option value="braclet1" <?php if ($_POST['age'] == 'bracket1') echo 'selected="selected"'; ?> >1-15</option>
  <option value="bracket2" <?php if ($_POST['age'] == 'bracket2') echo 'selected="selected"'; ?> >16-30</option>
  <option value="bracket3" <?php if ($_POST['age'] == 'bracket3') echo 'selected="selected"'; ?> >31-45</option>
  <option value="bracket4" <?php if ($_POST['age'] == 'bracket4') echo 'selected="selected"'; ?>>46-55</option>
  <option value="other" <?php if ($_POST['age'] == 'other') echo 'selected="selected"'; ?>>Other</option>
</select>
<span class="error">* <?php echo $ageErr;?></span>
  <br><br>
  Current Mood:
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="angry") echo "checked";?> value="angry">Angry
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="gloomy") echo "checked";?> value="gloomy">Gloomy
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="restless") echo "checked";?> value="restless">Restless
  <br /><br />
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="peaceful") echo "checked";?> value="peaceful">Peaceful
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="cheerful") echo "checked";?> value="cheerful">Cheerful
  <input type="radio" name="mood" <?php if (isset($mood) && $mood=="excited") echo "checked";?> value="excited">Excited 
  <span class="error">* <?php echo $moodErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Personalized Quote:</h2>";
if (isset($_POST['submit']) && empty($fnameErr) && empty($lnameErr) && empty($cbornErr) && empty($ageErr) && empty($moodErr)) {
    $quoteList = array(
    "The best and most beautiful things in the world cannot be seen or even touched - they must be felt with the heart. - Helen Keller", 
    "The best preparation for tomorrow is doing your best today. - H. Jackson Brown, Jr.", 
    "I can't change the direction of the wind, but I can adjust my sails to always reach my destination. - Jimmy Dean", 
    "Change your thoughts and you change your world. - Norman Vincent Peale"
    );
    echo '<i>' . $quoteList[mt_rand(0, count($quoteList)-1)] . '</i><br /><br />';
}
else {
    echo '<p> Please enter your details above. </p>';
}
?>
			</div>
		</main>

		<footer>
			<hr>
			Course Name. 2018&copy; Hubbard <br />
			<strong>Disclaimer:</strong> The information in this webpage is used for academic puposes only.
		</footer>
	</body>
</html>