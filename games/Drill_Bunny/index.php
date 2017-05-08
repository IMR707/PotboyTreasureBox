<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1 , user-scalable=no">
        <title>Chacket Valleyparker: DRILL BUNNY</title>
        <meta name="description" content="A game by Dream Show Adventures for Ludum Dare 29."/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Press+Start+2P">
        <style type="text/css">
            body {
                background-color: #333;
            }

            #ludumdare29 {
                width:320px;
                height:512px;
                position: absolute;
                left:50%;
                top:20%;
                margin:0 0 0 -160px;
                border: 2px solid white;
                font-family: 'Press Start 2P';
            }
            /* Apparently this forces the browser to load the font */
            /* This works but NOT if set to display: none */
            #loadfont {
                font-family: 'Press Start 2P';
                color: #333;
            }
        </style>
    </head>
    <body>
        <div id="ludumdare29"></div>
        <div id="loadfont"></div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/phaser.min.js"></script>
    <script src="js/game.min.js"></script>
</html>