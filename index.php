<?php
include 'connect.php';
include 'submit_data.php';
include 'get_match_data.php';
?>
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
        <div class="large-6 columns">
            <h1>Home</h1>
        </div>
        <div class="large-6 columns" align="center">
            <h2><?php echo isset($match_name) ? $match_name : ""?></h2>
        </div>
    </div>

    <form method="post">
        <div class="row">
            <div class="large-2 columns" align="right">
                <h4>Match: </h4>
            </div>
            <div class="large-8 columns">
                <input type="number" name="match_num" value="<?php echo isset($match_num) ? $match_num : "1";?>">
            </div>
            <div class="large-2 columns">
                <input type="submit" name="submit" class="warning expanded button" value="Update">
            </div>
        </div>
        <div class="row">
            <div class="large-6 columns">
            <!-- Team 1 -->
                <div class="row" align="center">
                    <h2><?php echo isset($team1) ? $team1 : "Team 1" ?></h2>
                </div>
                <div class="row">
                <!-- Auto -->
                    <div class="large-3">
                        <h4>Auto</h4>
                    </div>
                    <div class="large-9">
                        <div class="row">
                        <!-- Star -->
                            <div class="large-3 columns">
                                <h6>Star</h6>
                            </div>
                            <div class="large-3 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="auto_star_enable1" type="checkbox" name="auto_star_enable1">
                                  <label class="switch-paddle" for="auto_star_enable1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                            <div class="large-4 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="auto_star_range1" type="checkbox" name="auto_star_range1">
                                  <label class="switch-paddle" for="auto_star_range1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">F</span>
                                    <span class="switch-inactive" aria-hidden="true">N</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <!-- Cube -->
                            <div class="large-3 columns">
                                <h6>Cube</h6>
                            </div>
                            <div class="large-3 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="auto_cube_enable1" type="checkbox" name="auto_cube_enable1">
                                  <label class="switch-paddle" for="auto_cube_enable1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                            <div class="large-4 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="auto_cube_range1" type="checkbox" name="auto_cube_range1">
                                  <label class="switch-paddle" for="auto_cube_range1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">F</span>
                                    <span class="switch-inactive" aria-hidden="true">N</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <!-- Lift -->
                            <div class="large-3 columns">
                                <h6>Lift</h6>
                            </div>
                            <div class="large-9 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="auto_lift1" type="checkbox" name="auto_lift1">
                                  <label class="switch-paddle" for="auto_lift1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Team 2 -->
            <dir class="large-6 columns">
                    <div class="row" align="center">
                        <h2><?php echo isset($team2) ? $team2 : "Team 2" ?></h2>
                    </div>
                    <div class="row">
                    <!-- Auto -->
                        <div class="large-3">
                            <h4>Auto</h4>
                        </div>
                        <div class="large-9">
                            <div class="row">
                            <!-- Star -->
                                <div class="large-3 columns">
                                    <h6>Star</h6>
                                </div>
                                <div class="large-3 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="auto_star_enable2" type="checkbox" name="auto_star_enable2">
                                      <label class="switch-paddle" for="auto_star_enable2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="auto_star_range2" type="checkbox" name="auto_star_range2">
                                      <label class="switch-paddle" for="auto_star_range2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">F</span>
                                        <span class="switch-inactive" aria-hidden="true">N</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <!-- Cube -->
                                <div class="large-3 columns">
                                    <h6>Cube</h6>
                                </div>
                                <div class="large-3 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="auto_cube_enable2" type="checkbox" name="auto_cube_enable2">
                                      <label class="switch-paddle" for="auto_cube_enable2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="auto_cube_range2" type="checkbox" name="auto_cube_range2">
                                      <label class="switch-paddle" for="auto_cube_range2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">F</span>
                                        <span class="switch-inactive" aria-hidden="true">N</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <!-- Lift -->
                                <div class="large-3 columns">
                                    <h6>Lift</h6>
                                </div>
                                <div class="large-9 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="auto_lift2" type="checkbox" name="auto_lift2">
                                      <label class="switch-paddle" for="auto_lift2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </dir>
            <!-- Slider -->
            <div class="row">
                <div class="large-12 columns" style="margin-bottom: 50px; margin-top: 20px;">
                    <div class="slider" data-slider data-end="100" data-step="10" data-initial-start="50">
                      <span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>
                      <span class="slider-fill" data-slider-fill></span>
                      <input type="hidden" name="auto">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-6 columns">
            <!-- Team 1 -->
                <div class="row show-for-small-only" align="center">
                    <h2><?php echo isset($team1) ? $team1 : "Team 1" ?></h2>
                </div>
                <div class="row">
                <!-- Auto -->
                    <div class="large-3">
                        <h4>Drive</h4>
                    </div>
                    <div class="large-9">
                        <div class="row">
                        <!-- Star -->
                            <div class="large-3 columns">
                                <h6>Star</h6>
                            </div>
                            <div class="large-3 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="drive_star_enable1" type="checkbox" name="drive_star_enable1">
                                  <label class="switch-paddle" for="drive_star_enable1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                            <div class="large-4 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="drive_star_range1" type="checkbox" name="drive_star_range1">
                                  <label class="switch-paddle" for="drive_star_range1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">F</span>
                                    <span class="switch-inactive" aria-hidden="true">N</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <!-- Cube -->
                            <div class="large-3 columns">
                                <h6>Cube</h6>
                            </div>
                            <div class="large-3 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="drive_cube_enable1" type="checkbox" name="drive_cube_enable1">
                                  <label class="switch-paddle" for="drive_cube_enable1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                            <div class="large-4 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="drive_cube_range1" type="checkbox" name="drive_cube_range1">
                                  <label class="switch-paddle" for="drive_cube_range1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">F</span>
                                    <span class="switch-inactive" aria-hidden="true">N</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <!-- Lift -->
                            <div class="large-3 columns">
                                <h6>Lift</h6>
                            </div>
                            <div class="large-9 columns">
                                <div class="switch small">
                                  <input class="switch-input" id="drive_lift1" type="checkbox" name="drive_lift1">
                                  <label class="switch-paddle" for="drive_lift1">
                                    <span class="show-for-sr">Lift</span>
                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Team 2 -->
            <dir class="large-6 columns">
                    <div class="row show-for-small-only" align="center">
                        <h2><?php echo isset($team2) ? $team2 : "Team 2" ?></h2>
                    </div>
                    <div class="row">
                    <!-- Drive -->
                        <div class="large-3">
                            <h4>Drive</h4>
                        </div>
                        <div class="large-9">
                            <div class="row">
                            <!-- Star -->
                                <div class="large-3 columns">
                                    <h6>Star</h6>
                                </div>
                                <div class="large-3 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="drive_star_enable2" type="checkbox" name="drive_star_enable2">
                                      <label class="switch-paddle" for="drive_star_enable2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="drive_star_range2" type="checkbox" name="drive_star_range2">
                                      <label class="switch-paddle" for="drive_star_range2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">F</span>
                                        <span class="switch-inactive" aria-hidden="true">N</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <!-- Cube -->
                                <div class="large-3 columns">
                                    <h6>Cube</h6>
                                </div>
                                <div class="large-3 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="drive_cube_enable2" type="checkbox" name="drive_cube_enable2">
                                      <label class="switch-paddle" for="drive_cube_enable2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                                <div class="large-4 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="drive_cube_range2" type="checkbox" name="drive_cube_range2">
                                      <label class="switch-paddle" for="drive_cube_range2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">F</span>
                                        <span class="switch-inactive" aria-hidden="true">N</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <!-- Lift -->
                                <div class="large-3 columns">
                                    <h6>Lift</h6>
                                </div>
                                <div class="large-9 columns">
                                    <div class="switch small">
                                      <input class="switch-input" id="drive_lift2" type="checkbox" name="drive_lift2">
                                      <label class="switch-paddle" for="drive_lift2">
                                        <span class="show-for-sr">Lift</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </dir>
            <!-- Slider -->
            <div class="row" style="margin-bottom: 50px; margin-top: 20px;">
                <div class="large-12 columns">
                    <div class="slider" data-slider data-end="100" data-step="10" data-initial-start="50">
                      <span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>
                      <span class="slider-fill" data-slider-fill></span>
                      <input type="hidden" name="drive">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <input type="submit" name="submit" class="success expanded button" value="Submit">
            </div>
        </div>

    </form>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>