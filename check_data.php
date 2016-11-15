<?php
include 'lock.php';
include 'connect.php';

function get_unchecked_data($conn){
    $submitted_matches = $conn->query("SELECT * FROM submitted_result")->fetch_all(MYSQLI_ASSOC);
    return $submitted_matches;
}

function process_checked_data($conn, $id, $score){
    $match_data = $conn->query("SELECT * FROM submitted_result WHERE id={$id}")->fetch_assoc();
    $team1 = array('match_num' => $match_data['match_num'], 'team' => $match_data['team1'],'auto_star_enable' => $match_data['auto_star_enable1'], 'auto_star_range' => $match_data['auto_star_range1'],'auto_cube_enable' => $match_data['auto_cube_enable1'],'auto_cube_range' => $match_data['auto_cube_range1'],'auto_lift' => $match_data['auto_lift1'],'auto' => ($match_data['auto'] * $score / 100), 'drive_star_enable' => $match_data['drive_star_enable1'], 'drive_star_range' => $match_data['drive_star_range1'],'drive_cube_enable' => $match_data['drive_cube_enable1'],'drive_cube_range' => $match_data['drive_cube_range1'],'drive_lift' => $match_data['drive_lift1'], 'drive' => ($match_data['drive'] * $score / 100));
    $team2 = array('match_num' => $match_data['match_num'], 'team' => $match_data['team2'],'auto_star_enable' => $match_data['auto_star_enable2'], 'auto_star_range' => $match_data['auto_star_range2'],'auto_cube_enable' => $match_data['auto_cube_enable2'],'auto_cube_range' => $match_data['auto_cube_range2'],'auto_lift' => $match_data['auto_lift2'],'auto' => ($match_data['auto'] * $score / 100), 'drive_star_enable' => $match_data['drive_star_enable2'], 'drive_star_range' => $match_data['drive_star_range2'],'drive_cube_enable' => $match_data['drive_cube_enable2'],'drive_cube_range' => $match_data['drive_cube_range2'],'drive_lift' => $match_data['drive_lift2'], 'drive' => ($match_data['drive'] * $score / 100));
    return array($team1, $team2);
}

function submit_checked_data($conn, $checked_data){
    foreach ($checked_data as $team_data) {
        $sresult = $conn->query("INSERT INTO `checked_result` (`team_name`, `auto_star_enable`, `auto_star_range`, `auto_cube_enable`, `auto_cube_range`, `auto_lift`, `auto`, `drive_star_enable`, `drive_star_range`, `drive_cube_enable`, `drive_cube_range`, `drive_lift`, `drive`) VALUES ('{$team_data['team']}', '{$team_data['auto_star_enable']}', '{$team_data['auto_star_range']}', '{$team_data['auto_cube_enable']}', '{$team_data['auto_cube_range']}', '{$team_data['auto_lift']}', '{$team_data['auto']}', '{$team_data['drive_star_enable']}', '{$team_data['drive_star_range']}', '{$team_data['drive_cube_enable']}', '{$team_data['drive_cube_range']}', '{$team_data['drive_lift']}', '{$team_data['drive']}')");
        if(!$sresult){
            die(mysqli_error($conn));
        }
    }
}

function delete_match_data($conn, $id){
    $dresult = $conn->query("DELETE FROM `submitted_result` WHERE id={$id}");
    if (!$dresult){
        die(mysqli_error($conn));
    }
}

if(!empty($_GET)){
    if($_GET['submit'] == "Submit"){
        if(empty($_GET['score'])){
            $error = "Please enter a score!!";
        }else{
            submit_checked_data($conn, process_checked_data($conn, $_GET['id'], $_GET['score']));
            delete_match_data($conn, $_GET['id']);
        }
    }elseif($_GET['submit'] == "Delete"){
        delete_match_data($conn, $_GET['id']);
    }
    
}

$unchecked_matches = get_unchecked_data($conn);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Data</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-6 columns">
            <h1>Check Data</h1>
        </div>
    </div>
    <div class="row">
        <?php
        if(isset($error)){
            echo"
            <div class='row'>
                <div class='alert callout' style='margin-top: 50px;' data-closable>
                    <h5>{$error}<h5>
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            </div>";
        }
        ?>
    </div>
    <div class="row">
        <table>
            <tr>
                <th width="5%">ID</th>
                <th width="10%">Match #</th>
                <th width="20%">Teams</th>
                <th>Score</th>
                <th width="20%">Submit</th>
            </tr>
            <?php
            foreach ($unchecked_matches as $match) {
                if ($match['color'] == 'red'){
                    echo"
                    <tr>
                        <form>
                            <td>{$match['id']}<input type='hidden' name='id' value={$match['id']}></td>
                            <td>{$match['match_num']}</td>
                            <td><span class='alert label'>{$match['team1']} {$match['team2']}</span></td>
                            <td><input type='number' name='score'></td>
                            <td>
                                <input type='submit' class='success button' value='Submit' name='submit'>
                                <input type='submit' class='alert button' value='Delete' name='submit'>
                            </td>
                        </form>
                    <tr>
                    ";
                }elseif ($match['color'] == 'blue'){
                    echo"
                    <tr>
                        <form>
                            <td>{$match['id']}<input type='hidden' name='id' value={$match['id']}></td>
                            <td>{$match['match_num']}</td>
                            <td><span class='info label'>{$match['team1']} {$match['team2']}</span></td>
                            <td><input type='number' name='score'></td>
                            <td>
                                <input type='submit' class='success button' value='Submit' name='submit'>
                                <input type='submit' class='alert button' value='Delete' name='submit'>
                            </td>
                        </form>
                    <tr>
                    ";
                }
            }
            ?>
        </table>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>