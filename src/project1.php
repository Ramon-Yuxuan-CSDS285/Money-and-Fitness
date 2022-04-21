<?php
//echo "<pre>";
//print_r our array of images.
//print_r($extractedImages);
//preg_match('/<title>([^<]+)<\/title>/i', $data, $matches);
//$title = $matches[1];

//preg_match('/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', $data, $matches);
//$img = $matches[1];
if (isset($_POST['url'])){
    $url = $_POST['url'];
}
else {
    $url = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="gallery.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <h1>Project 1</h1>
    <form method = "post" action = "project1.php">
        <label for="url">Enter an https:// URL:</label>
        <input type="url" name="url" id="url" placeholder="https://example.com" pattern="https://.*" size="30" required>
        <br>
        <div class="checkboxes">
            <input type="radio" id="images" name="source" value = "image">
            <label for="images">Get all images from this website</label><br>
            <input type="radio" id="paragraph" name="source" value = "paragraph">
            <label for="paragraph">Get all paragraph from this website</label><br>
        </div>
        <br>
        <input type="submit" value="submit">
    </form>
    <div class = "gallery">
    <?php
        if (isset($_POST['url']) && isset($_POST['source'])){
            //$url = $_POST['url'];

            $htmlString = file_get_contents($url);
            //create HTML DOM object
            $htmlDom = new DOMDocument;

            //load the html string into DOM object
            @$htmlDom -> loadHTML($htmlString);

            if ($_POST['source'] == "image" ){
                //extract all elements with <img> tag
                $images = $htmlDom -> getElementsByTagName('img');

                //create array for all images
                $extractedImages = array();

                foreach($images as $imgTag){

                    //Get the src attribute of the img tag.
                    $imgSrc = $imgTag->getAttribute('src');

                    //Get the title attribute of the img tag.
                    $imgTitle = $imgTag->getAttribute('title');

                    //Get the alt attribute of the img tag.
                    $imgAlt = $imgTag->getAttribute('alt');

                    //Add the image details to $extractedImages array.
                    $extractedImages[] = array(
                        'src' => $imgSrc,
                        'title' => $imgTitle,
                        'alt' => $imgAlt
                    );
                }
                foreach ($extractedImages as $temp){
                    echo "<div class=column>";
                    echo "<img src=".$temp["src"]."></img>";
                    echo "<br>";
                    echo "<p>".$temp["alt"]."</p>";
                    echo "</div>";
                }
            }
            elseif ($_POST['source'] == "paragraph" ){
                $p = $htmlDom -> getElementsByTagName('p');
                $extractedParagraph = array();
                foreach ($p as $temp){
                    //$extractedParagraph["p"] = array($temp);
                    $text = $temp->textContent;
                    $extractedParagraph[] = array(
                        'text' => $text,
                    );
                }
                foreach ($extractedParagraph as $t){
                    echo "<div class=column>";
                    echo "<p>".$t["text"]."</p>";
                    echo "</div>";
                }
            }
        }
    ?>
    </div>
    
</body>
</html>