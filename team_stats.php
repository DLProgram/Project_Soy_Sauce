<?php
include 'lock.php';

function get_teams($conn){
    $teams = $conn->query("SELECT DISTINCT(team_name) FROM checked_result")->fetch_all();
    $team_names = [];
    foreach ($teams as $row) {
        $team_names[] = $row[0];
    }
    return $team_names;
}

function get_team_stats($conn, $team_name){

    $stats['team_name'] = $team_name;
    $entries = $conn->query("SELECT * FROM checked_result WHERE team_name='{$team_name}'")->fetch_all(MYSQLI_ASSOC);
    $stats['num_of_entries'] = count($entries);

    $stats['num_of_ase'] = 0;
    $stats['num_of_asr'] = 0;
    $stats['num_of_ace'] = 0;
    $stats['num_of_acr'] = 0;

    $stats['num_of_dse'] = 0;
    $stats['num_of_dsr'] = 0;
    $stats['num_of_dce'] = 0;
    $stats['num_of_dcr'] = 0;

    $stats['num_of_al'] = 0;
    $stats['num_of_dl'] = 0;

    $stats['sum_of_auto'] = 0;
    $stats['sum_of_drive'] = 0;

    $stats['auto'] = "";
    $stats['drive'] = "";
    foreach ($entries as $entrie) {
        $stats['num_of_ase'] += $entrie['auto_star_enable'];
        $stats['num_of_asr'] += $entrie['auto_star_range'];
        $stats['num_of_ace'] += $entrie['auto_cube_enable'];
        $stats['num_of_acr'] += $entrie['auto_cube_range'];

        $stats['num_of_dse'] += $entrie['drive_star_enable'];
        $stats['num_of_dsr'] += $entrie['drive_star_range'];
        $stats['num_of_dce'] += $entrie['drive_cube_enable'];
        $stats['num_of_dcr'] += $entrie['drive_cube_range'];

        $stats['num_of_al'] += $entrie['auto_lift'];
        $stats['num_of_dl'] += $entrie['drive_lift'];

        $stats['sum_of_auto'] += $entrie['auto'];
        $stats['sum_of_drive'] += $entrie['drive'];

        $stats['auto'] = $stats['auto'] . $entrie['auto'] . ',';
        $stats['drive'] = $stats['drive'] . $entrie['drive'] . ',';
    }
    $stats['auto'] = rtrim($stats['auto'], ",");
    $stats['drive'] = rtrim($stats['drive'], ",");

    // var_dump($stats);

    $stats['avg_of_ase'] = $stats['num_of_ase']/$stats['num_of_entries'] * 100;
    $stats['avg_of_asr'] = $stats['num_of_asr']/$stats['num_of_entries'] * 100;
    $stats['avg_of_ace'] = $stats['num_of_ace']/$stats['num_of_entries'] * 100;
    $stats['avg_of_acr'] = $stats['num_of_acr']/$stats['num_of_entries'] * 100;

    $stats['avg_of_dse'] = $stats['num_of_dse']/$stats['num_of_entries'] * 100;
    $stats['avg_of_dsr'] = $stats['num_of_dsr']/$stats['num_of_entries'] * 100;
    $stats['avg_of_dce'] = $stats['num_of_dce']/$stats['num_of_entries'] * 100;
    $stats['avg_of_dcr'] = $stats['num_of_dcr']/$stats['num_of_entries'] * 100;

    $stats['avg_of_al'] = $stats['num_of_al']/$stats['num_of_entries'] * 100;
    $stats['avg_of_dl'] = $stats['num_of_dl']/$stats['num_of_entries'] * 100;

    $stats['avg_of_auto'] = $stats['sum_of_auto']/$stats['num_of_entries'];
    $stats['avg_of_drive'] = $stats['sum_of_drive']/$stats['num_of_entries'];
    return $stats;
}

function sort_by($name, $all_team_stats){
    $sort_key = [];
    foreach ($all_team_stats as $key => $value) {
        $sort_key[$key] = $value[$name];
    }
    array_multisort($sort_key, SORT_DESC, $all_team_stats);
    return $all_team_stats;
}

$all_team_stats = [];
foreach (get_teams($conn) as $team) {
    $all_team_stats[] = get_team_stats($conn, $team);
}


if (!isset($_GET['sort_by'])) {
    $all_team_stats = sort_by('avg_of_drive', $all_team_stats);
}else{
    $all_team_stats = sort_by($_GET['sort_by'], $all_team_stats);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Statistics</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-6 columns">
            <h1>Team Statistics</h1>
        </div>
    </div>
    <div class="row">
        <div class="table-scroll">
            <table class="hover">
                <thead>
                    <tr>
                        <th></th>
                        <th><a href="?sort_by=team_name">Team</a></th>
                        <th><a href="?sort_by=avg_of_auto">Auto</a></th>
                        <th><a href="?sort_by=avg_of_drive">Drive</a></th>

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
                </thead>
                <?php
                $counter = 1;
                foreach ($all_team_stats as $team_stats) {
                    echo"
                    <tr>
                    <td>{$counter}</td>
                    <td><a href='team_detail.php?team={$team_stats['team_name']}'>{$team_stats['team_name']}</a></td>
                    <td><center>{$team_stats['avg_of_auto']}</center><span class='line'>{$team_stats['auto']}</span></td>
                    <td><center>{$team_stats['avg_of_drive']}</center><span class='line'>{$team_stats['drive']}</span></td>

                    <td>{$team_stats['num_of_ase']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_ase']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_asr']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_asr']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_ace']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_ace']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_acr']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_acr']}/{$team_stats['num_of_entries']}</span></td>

                    <td>{$team_stats['num_of_dse']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_dse']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_dsr']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_dsr']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_dce']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_dce']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_dcr']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_dcr']}/{$team_stats['num_of_entries']}</span></td>

                    <td>{$team_stats['num_of_al']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_al']}/{$team_stats['num_of_entries']}</span></td>
                    <td>{$team_stats['num_of_dl']}/{$team_stats['num_of_entries']}<span class='donut' >{$team_stats['num_of_dl']}/{$team_stats['num_of_entries']}</span></td>
                    </tr>
                    ";
                    $counter++;
                }
                ?>
            </table>
        </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/jquery.peity.min.js"></script>
    <script type="text/javascript">
        $.fn.peity.defaults.donut = {
          delimiter: null,
          fill: ["green", "red"],
          height: null,
          radius: 7,
          width: null
        }
        $.fn.peity.defaults.line = {
          delimiter: ",",
          fill: "#c6d9fd",
          height: 16,
          max: null,
          min: 0,
          stroke: "#4d89f9",
          strokeWidth: 1,
          width: 60
        }
        $(".line").peity("line")
        $(".donut").peity("donut")
    </script>
</body>
</html>