<?php
    $backgroundImage = "img/sea.jpg";
    
    if(empty($_GET['keyword'])) {
        include 'api/pixabayAPI.php';
        $keyword = $_GET['category'];
        $layout = $_GET['layout'];
        $imageURLs = getImageURLs($keyword, $layout);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    
    else if(empty($_GET['category'])) {
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        $layout = $_GET['layout'];
        $imageURLs = getImageURLs($keyword, $layout);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <meta charset='utf-8'>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br>
        <?php
            if (!isset($imageURLs)) {
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
            else if(empty($_GET['keyword']) && empty($_GET['category'])){
                echo "<h2> Type a keyword or choose a category to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i < 7; $i++) {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active';" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                    for($i = 0; $i < 7; $i++) {
                        do {
                            $randomIndex = rand(0, count($imageURLs));
                        } while(!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="carousel-item ';
                        echo ($i == 0) ? "active" : "";
                        echo '">';
                        echo '<img src="' . $imageURLs[$randomIndex] . '">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
            //endElse
        ?>
        <br>
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal">
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for="Vertical"></label><label for="lvertical"> Vertical </label>
            <select name="category">
                <option value="">Select One</option>
                <option name="keyword" value="ocean">Sea</option>
                <option name="keyword" value="forest">Forest</option>
                <option name="keyword" value="mountain">Mountain</option>
                <option name="keyword" value="snow">Snow</option>
            </select>
            <input type="submit" value"Search"/>
        </form>
        <br /> <br />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>