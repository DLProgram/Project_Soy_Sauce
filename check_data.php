<?php
include 'lock.php';
include 'connect.php';

function get_unchecked_data($conn){
    $match_nums = $conn->query("SELECT DISTINCT(match_num) FROM submitted_result")->fetch_all();
    $unchecked_macthes = [];
    foreach ($match_nums as $target_match) {
        $red_data = $conn->query("SELECT * FROM submitted_result WHERE match_num={$target_match[0]} AND color='red'")->fetch_assoc();
        $blue_data = $conn->query("SELECT * FROM submitted_result WHERE match_num={$target_match[0]} AND color='blue'")->fetch_assoc();
        $unchecked_macthes[$target_match[0]] = array('red' => $red_data, 'blue' => $blue_data);
    }
    return $unchecked_macthes;
}

function process_checked_data($conn, $match_num, $score){
    $red_data = $conn->query("SELECT * FROM submitted_result WHERE match_num={$match_num} AND color='red'")->fetch_assoc();
    $blue_data = $conn->query("SELECT * FROM submitted_result WHERE match_num={$match_num} AND color='blue'")->fetch_assoc();
    $red1 = array('match_num' => $match_num, 'team' => $red_data['team1'], 'auto_star_enable' => $red_data['auto_star_enable1'], 'auto_star_range' => $red_data['auto_star_range1'],'auto_cube_enable' => $red_data['auto_cube_enable1'],'auto_cube_range' => $red_data['auto_cube_range1'],'auto_lift' => $red_data['auto_lift1'],'auto' => $red_data['auto'], 'drive_star_enable' => $red_data['drive_star_enable1'], 'drive_star_range' => $red_data['drive_star_range1'],'drive_cube_enable' => $red_data['drive_cube_enable1'],'drive_cube_range' => $red_data['drive_cube_range1'],'drive_lift' => $red_data['drive_lift1'], 'drive' => ($red_data['drive'] * $score / 100));
    $red2 = array('match_num' => $match_num, 'team' => $red_data['team2'], 'auto_star_enable' => $red_data['auto_star_enable2'], 'auto_star_range' => $red_data['auto_star_range2'],'auto_cube_enable' => $red_data['auto_cube_enable2'],'auto_cube_range' => $red_data['auto_cube_range2'],'auto_lift' => $red_data['auto_lift2'],'auto' => $red_data['auto'], 'drive_star_enable' => $red_data['drive_star_enable2'], 'drive_star_range' => $red_data['drive_star_range2'],'drive_cube_enable' => $red_data['drive_cube_enable2'],'drive_cube_range' => $red_data['drive_cube_range2'],'drive_lift' => $red_data['drive_lift2'], 'drive'=> (100 - $red_data['drive']) * $score / 100);
    $blue1 = array('match_num' => $match_num, 'team' => $blue_data['team1'], 'auto_star_enable' => $blue_data['auto_star_enable1'], 'auto_star_range' => $blue_data['auto_star_range1'],'auto_cube_enable' => $blue_data['auto_cube_enable1'],'auto_cube_range' => $blue_data['auto_cube_range1'],'auto_lift' => $blue_data['auto_lift1'],'auto' => $blue_data['auto'], 'drive_star_enable' => $blue_data['drive_star_enable1'], 'drive_star_range' => $blue_data['drive_star_range1'],'drive_cube_enable' => $blue_data['drive_cube_enable1'],'drive_cube_range' => $blue_data['drive_cube_range1'],'drive_lift' => $blue_data['drive_lift1'], 'drive' => ($blue_data['drive'] * $score / 100));
    $blue2 = array('match_num' => $match_num, 'team' => $blue_data['team2'], 'auto_star_enable' => $blue_data['auto_star_enable2'], 'auto_star_range' => $blue_data['auto_star_range2'],'auto_cube_enable' => $blue_data['auto_cube_enable2'],'auto_cube_range' => $blue_data['auto_cube_range2'],'auto_lift' => $blue_data['auto_lift2'],'auto' => $blue_data['auto'], 'drive_star_enable' => $blue_data['drive_star_enable2'], 'drive_star_range' => $blue_data['drive_star_range2'],'drive_cube_enable' => $blue_data['drive_cube_enable2'],'drive_cube_range' => $blue_data['drive_cube_range2'],'drive_lift' => $blue_data['drive_lift2'], 'drive' => (100 - $blue_data['drive']) * $score / 100);
    delete_match_data($conn, $match_num);
    return array($red1, $red2, $blue1, $blue2);
}

function submit_checked_data($conn, $checked_data){
    foreach ($checked_data as $team_data) {
        $sresult = $conn->query("INSERT INTO `checked_result` (`team_name`, `auto_star_enable`, `auto_star_range`, `auto_cube_enable`, `auto_cube_range`, `auto_lift`, `auto`, `drive_star_enable`, `drive_star_range`, `drive_cube_enable`, `drive_cube_range`, `drive_lift`, `drive`) VALUES ('{$team_data['team']}', '{$team_data['auto_star_enable']}', '{$team_data['auto_star_range']}', '{$team_data['auto_cube_enable']}', '{$team_data['auto_cube_range']}', '{$team_data['auto_lift']}', '{$team_data['auto']}', '{$team_data['drive_star_enable']}', '{$team_data['drive_star_range']}', '{$team_data['drive_cube_enable']}', '{$team_data['drive_cube_range']}', '{$team_data['drive_lift']}', '{$team_data['drive']}')");
        if(!$sresult){
            die(mysqli_error($conn));
        }
    }
}

function delete_match_data($conn, $match_num){
    $dresult = $conn->query("DELETE FROM `submitted_result` WHERE match_num={$match_num}");
    if (!$dresult){
        die(mysqli_error($conn));
    }
}

if(!empty($_GET)){
    if($_GET['submit'] == "Submit"){
        if(empty($_GET['score'])){
            $error = "Please enter a score!!";
        }else{
            submit_checked_data($conn, process_checked_data($conn, $_GET['match_num'], $_GET['score']));
        }
    }elseif($_GET['submit'] == "Delete"){
        delete_match_data($conn, $_GET['match_num']);
    }
    
}

$unchecked_macthes = get_unchecked_data($conn);

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
                <th width="10%">Match #</th>
                <th width="20%">Teams</th>
                <th>Score</th>
                <th width="20%">Submit</th>
            </tr>
            <?php
            foreach ($unchecked_macthes as $match_num => $teams) {
                echo"
                <tr>
                    <form>
                        <td align='right'>{$match_num}<input type='hidden' name='match_num' value={$match_num}></td>
                        <td align='center'><span class='alert label'>{$teams['red']['team1']} {$teams['red']['team2']}</span><span class='info label'>{$teams['blue']['team1']} {$teams['blue']['team2']}</span></td>
                        <td><input type='number' name='score'></td>
                        <td align='right'>
                            <input type='submit' class='success button' value='Submit' name='submit'>
                            <input type='submit' class='alert button' value='Delete' name='submit'>
                        </td>
                    </form>
                <tr>
                ";
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