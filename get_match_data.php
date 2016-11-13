<?php 
include "connect.php";

$match_data = $conn->query("SELECT * FROM match_data WHERE match_num={$match_num}")->fetch_assoc();
$team1 = $match_data['blue1'];
$team2 = $match_data['blue2'];
$match_name = $match_data['match_name'];

?>