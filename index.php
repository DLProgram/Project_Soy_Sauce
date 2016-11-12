<?php include 'connect.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-12 columns">
            <h1>Home</h1>
        </div>
    </div>

    <form>
        <!-- Match Number -->
        <div class="row">
            <div class="small-3 large-2 columns"><label for="match_num">Match Number</label></div>
            <div class="small-9 large-10 columns"><input type="text" name="match_num" id="match_num" value=<?php if (isset($match_num)) echo '$match_num';else echo 0;?>> </div>
        </div>
        <!-- Team Name -->
        <dir class="row">
            <dir class="small-6 columns" align="center" id="team_name">
                <h5><?php if (isset($team1)) echo $team1; else echo "Team 1"?></h5>
            </dir>
            <dir class="small-6 columns" align="center" id="team_name">
                <h5><?php if (isset($team2)) echo $team2; else echo "Team 2"?></h5>
            </dir>
        </dir>
        <!-- Auto Slider -->
        <dir class="row" >
            <dir class="small-1 large-2 columns" align="left" >
                <label>Auto</label>
            </dir>
            <dir class="small-10 large-10 columns">
                <div class="slider" data-slider data-initial-start="50" data-end="100" data-step="5">
                    <span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>
                    <span class="slider-fill" data-slider-fill></span>
                    <input type="hidden" name="auto">
                </div>
            </dir>
        </dir>
        <!-- Drive Slider -->
        <dir class="row">
            <dir class="small-1 large-2 columns" align="left">
                <label>Drive</label>
            </dir>
            <dir class="small-10 large-10 columns">
                <div class="slider" data-slider data-initial-start="50" data-end="100" data-step="5">
                    <span class="slider-handle"  data-slider-handle role="slider" tabindex="10"></span>
                    <span class="slider-fill" data-slider-fill></span>
                    <input type="hidden" name="drive">
                </div>
            </dir>
        </dir>
        <!-- Submit Button -->
        <div class="row">
            <dir class="small-12 columns">
                <input type="Submit" class="expanded success button" value="Submit">
            </dir>
        </div>
    </form>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>