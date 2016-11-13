<?php 
include "connect.php";
function get_team($conn, $color, $match_num){
    $match_data = $conn->query("SELECT * FROM match_data WHERE match_num={$match_num}")->fetch_assoc();
    if($color == "blue"){
        $team1 = $match_data['blue1'];
        $team2 = $match_data['blue2'];
    }elseif($color == "red"){
        $team1 = $match_data['red1'];
        $team2 = $match_data['red2'];
    }else{
        $team1 = $match_data['blue1'];
        $team2 = $match_data['blue2'];
    }
    $match_name = $match_data['match_name'];
    return array('team1' => $team1, 'team2' => $team2, 'match_name' => $match_name);
}

$match_data = get_team($conn, $_SESSION['color'], $match_num);

$team1 = $match_data['team1'];
$team2 = $match_data['team2'];

$match_name = $match_data['match_name'];

?>