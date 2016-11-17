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
    }

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
                <tr>
                    <th>Team</th>
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
                foreach (get_teams($conn) as $team) {
                    $team_stats = get_team_stats($conn, $team);
                    echo"
                    <tr>
                    <td><a href='team_detail.php?team={$team}'>{$team}</a></td>
                    <td>{$team_stats['avg_of_auto']}</td>
                    <td>{$team_stats['avg_of_drive']}</td>

                    <td>{$team_stats['num_of_ase']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_ase']}%)</strong></td>
                    <td>{$team_stats['num_of_asr']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_asr']}%)</strong></td>
                    <td>{$team_stats['num_of_ace']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_ace']}%)</strong></td>
                    <td>{$team_stats['num_of_acr']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_acr']}%)</strong></td>

                    <td>{$team_stats['num_of_dse']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_dse']}%)</strong></td>
                    <td>{$team_stats['num_of_dsr']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_dsr']}%)</strong></td>
                    <td>{$team_stats['num_of_dce']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_dce']}%)</strong></td>
                    <td>{$team_stats['num_of_dcr']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_dcr']}%)</strong></td>

                    <td>{$team_stats['num_of_al']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_al']}%)</strong></td>
                    <td>{$team_stats['num_of_dl']}/{$team_stats['num_of_entries']}<strong>({$team_stats['avg_of_dl']}%)</strong></td>
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