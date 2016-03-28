<?php

//A SteamAPI Key is needed to get users profile info (To get your key, go to http://steamcommunity.com/dev/apikey)
$steamAPIKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; 

//SteamID for Demo page
$demoUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?steamid=76561198023541849'; //There's mine

if (!isset($_GET['steamid'])) {
    header("Location: $demoUrl");
    exit();
}else
    $steamID = $_GET['steamid'];

$url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$SteamAPIKey.'&steamids='.$steamID;
$json = file_get_contents($url);
$table = json_decode($json, true);
$userData = $table['response']['players'][0];

//Load Random Song
$dir = $_SERVER['DOCUMENT_ROOT'].'/content/sounds/';
$song = array_diff(scandir($dir), array('..', '.'));
$randsound = rand(1, sizeof($song));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link rel="stylesheet" href="css/style.css" />
        <title>My Loading Screen</title>
    </head>
    <body>
        <audio id="loadingsound" autoplay loop>
            <source src="/content/sounds/sound<?php echo $randsound; ?>.ogg" type="audio/ogg">
        </audio>
        <header>
        </header>
        <section>
            <div id="profile">
                <?php echo '<img src="'.$userData['avatarfull'].'" />';?>
            </div>
        </section>
        <footer>
        </footer>
    </body>
</html>
