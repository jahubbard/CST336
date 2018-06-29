<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Jared Hubbard - Homework 2</title>
        <link type="text/css" rel="stylesheet" href="css/styles.css">
        <?php 
            $daysInMonth = date("t");
            $currentMonth = date("F");
            $currentDay = date("j");
            $currentYear = date("y");
            $fullYear = date("o");
            $currentDayWithZero = date("d");
            $currentMonthWithZero = date("m");
            $timeStampOfFirst = mktime(0, 0, 0, $currentMonthWithLeadingZero, 1, $fullYear);
            $startingDay = $w= date("w", $timeStampOfFirst);
            $prevMonth = 0;
            $nextMonth = 0;
            $counter = 0;
            $hexValue = $currentDayWithZero . $currentMonthWithZero . $currentYear; 
        ?>
    </head>
    
    
    <body>
        <section id="header"> 
            <div class="wrapper">
            <h1>Today's Date In Hex <br><span style="color:#<?php echo $hexValue ?>;">#<?php echo $hexValue ?></span></h1>
            </div>
        </section>
        <div class="intro">
             <p>
             This program creates a dynamic calendar using the PHP date function. Today's date is used to create a hexidecimal
             value that will be used to highlight the current date using a CSS border-radius property.<br />
             <img src="img/border-radius.png" alt="Border Radius CSS">
             <br />
             <?php
                $rand1 = rand(10,30);
                $rand2 = rand(10,12);
                $rand3 = rand(10,50);
                echo "Random HEX Example: " . $rand1 . $rand2 . $rand3 . " = " . $rand2 . "/" . $rand1 . "/" . $rand3;
             ?>
             </p>
         </div>
        
        <section id="calendar"> 
        <?php
        
        $weekdays = array("S", "M", "T", "W", "T", "F", "S");
        echo "<table><tr><th colspan=\"7\">$currentMonth</th></tr>";
        
        echo "<tr>";
        for($i = 0; $i < 7; $i++){
             echo "<td class=\"day-of-week\">";
                switch($i){
                    case 0:
                        echo $weekdays[0];
                        break;
                    case 1:
                        echo $weekdays[1];
                        break;
                    case 2:
                        echo $weekdays[2];
                        break;
                    case 3:
                        echo $weekdays[3];
                        break;
                    case 4:
                        echo $weekdays[4];
                        break;
                    case 5:
                        echo $weekdays[5];
                        break;
                    default:
                        echo $weekdays[6];
                }
                    echo "</td>";
        }
        
        echo "</tr>";

                for($i = 0; $i < ceil(($daysInMonth + $startingDay)/7); $i++){
                    
                    echo "<tr>";
                        for($j = 0; $j < 7; $j++){
                            
                            if( $prevMonth < $startingDay ){
                                echo "<td class=\"prev-month\"></td>";
                                $prevMonth++;
                            }
                            else if( $counter < $daysInMonth ){
                                if( $counter + 1 == $currentDay )
                                    echo "<td class=\"current-month current-day\"><span style=\"background-color:#$hexValue\">" . ($counter + 1) . "</span></td>";
                                else
                                    echo "<td class=\"current-month\">" . ($counter + 1) . "</td>";
                                $counter++;
                            }else{
                                echo "<td class=\"next-month\"></td>";
                            }
                            
                        }
                    echo "</tr>";
                    
                }
                echo "</table>";       
       
        ?>
        </section>
        <footer>
			<hr>
			CST 336. 2018 &copy; Hubbard <br />
			<strong>Disclaimer:</strong> The information in this webpage is used for academic puposes only. <br />
			<img src="img/csumb.png" alt="CSUMB Logo">
		</footer>
    </body>
</html>