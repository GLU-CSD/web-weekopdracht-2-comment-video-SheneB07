<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";

if(!empty($_POST)){

    //dit is een voorbeeld array.  Deze waardes moeten erin staan.
    $postArray = [
        'name' => "Ieniminie",
        'email' => "ieniminie@sesamstraat.nl",
        'message' => "Geweldig dit"
    ];

    $setReaction = Reactions::setReaction($postArray);

    if(isset($setReaction['error']) && $setReaction['error'] != ''){
        prettyDump($setReaction['error']);
    }
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
</head>
<body>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/zuMHy7bkFEE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    <!-- <h2>Hieronder komen reacties</h2>
    <p>Maak hier je eigen pagina van aan de hand van de opdracht</p> -->

    <form action="" method="POST">
        <label>
            Email:
            <input type="text" name="Name" required /></label><br />
            <label>
                Comment:<br />
                <textarea name="Comment" required></textarea><label><br />
                <input type="submit" name="Submit" value="Submit"/>
    </form>





</body>
</html>

<?php
$con->close();
?>

<?php
if(isset($_POST["Submit"])) {
    print "<h2>Your comment has been submitted!</h2>";

    $Name = $_POST["Name"];
    $Comment = $_POST["Comment"];

    //Old Comments
    $Old = fopen("comments.txt", "r+t");
    $Old_Comments = fread($Old, 1024);

    $Write = fopen("comments.txt", "w+");

    $String = 
    "<div class='comment'><span>".$Name."</span><br/>
    <span>".date("Y/m/d")." | ".date("h: i A")."</span><br />
    <span>".$Comment."</span></div>\n".$Old_Comments;
    fwrite($Write, $String);
    fclose($Write);
    fclose($Old);

    //Display comments
    $Read = fopen("comments.txt", "r+t");
    echo "<h1>Comments:</h1><hr>".fread($Read, 1024);
    fclose($Read);


}