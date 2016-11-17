<?php
include 'lock.php';
if (isset($_GET['team'])){
    $entries = $conn->query("SELECT * FROM checked_result WHERE team_name='{$_GET['team']}'")->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-6 columns">
            <h1>Team Details</h1>
        </div>
        <div class="large-6 columns" align="right">
            <h2><?php echo isset($_GET['team']) ? $_GET['team'] : ""; ?></h2>
        </div>
    </div>
    <div class='row'>
        <div class="table-scroll">
                <table class="hover">
                <tr>
                    <th>Auto</th>
                    <th>Drive</th>

                    <th>Auto star enable</th>
                    <th>Auto star range</th>
                    <th>Auto cube enable</th>
                    <th>Auto cube range</th>

                    <th>Drive star enable</th>
                    <th>Drive star range</th>
                    <th>Drive cube enable</th>
                    <th>Drive cube range</th>

                    <th>Auto lift</th>
                    <th>Drive lift</th>
                </tr>
                <?php
                foreach ($entries as $entrie) {
                    echo"
                    <tr>
                        <td>{$entrie['auto']}</td>
                        <td>{$entrie['drive']}</td>
                        <td>{$entrie['auto_star_enable']}</td>
                        <td>{$entrie['auto_star_range']}</td>
                        <td>{$entrie['auto_cube_enable']}</td>
                        <td>{$entrie['auto_cube_range']}</td>
                        <td>{$entrie['drive_star_enable']}</td>
                        <td>{$entrie['drive_star_range']}</td>
                        <td>{$entrie['drive_cube_enable']}</td>
                        <td>{$entrie['drive_cube_range']}</td>
                        <td>{$entrie['auto_lift']}</td>
                        <td>{$entrie['drive_lift']}</td>
                    </tr>
                    ";
                }
                ?>
            </table>
        </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>