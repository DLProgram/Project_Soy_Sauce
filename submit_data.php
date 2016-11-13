<?php
    function process_input($array){
        $result = array();
        $result['match_num'] = $array['match_num'];

        $result['team1'] = $array['team1'];
        $result['team2'] = $array['team2'];

        $result['auto_star_enable1'] = isset($array["auto_star_enable1"]) ? 1 : 0;
        $result['auto_star_range1'] = isset($array["auto_star_range1"]) ? 1 : 0;
        $result['auto_cube_enable1'] = isset($array["auto_cube_enable1"]) ? 1 : 0;
        $result['auto_cube_range1'] = isset($array["auto_cube_range1"]) ? 1 : 0;
        $result['auto_lift1'] = isset($array["auto_lift1"]) ? 1 : 0;

        $result['auto_star_enable2'] = isset($array["auto_star_enable2"]) ? 1 : 0;
        $result['auto_star_range2'] = isset($array["auto_star_range2"]) ? 1 : 0;
        $result['auto_cube_enable2'] = isset($array["auto_cube_enable2"]) ? 1 : 0;
        $result['auto_cube_range2'] = isset($array["auto_cube_range2"]) ? 1 : 0;
        $result['auto_lift2'] = isset($array["auto_lift2"]) ? 1 : 0;

        $result['auto'] = (int) $array['auto'];

        $result['drive_star_enable1'] = isset($array["drive_star_enable1"]) ? 1 : 0;
        $result['drive_star_range1'] = isset($array["drive_star_range1"]) ? 1 : 0;
        $result['drive_cube_enable1'] = isset($array["drive_cube_enable1"]) ? 1 : 0;
        $result['drive_cube_range1'] = isset($array["drive_cube_range1"]) ? 1 : 0;
        $result['drive_lift1'] = isset($array["drive_lift1"]) ? 1 : 0;

        $result['drive_star_enable2'] = isset($array["drive_star_enable2"]) ? 1 : 0;
        $result['drive_star_range2'] = isset($array["drive_star_range2"]) ? 1 : 0;
        $result['drive_cube_enable2'] = isset($array["drive_cube_enable2"]) ? 1 : 0;
        $result['drive_cube_range2'] = isset($array["drive_cube_range2"]) ? 1 : 0;
        $result['drive_lift2'] = isset($array["drive_lift2"]) ? 1 : 0;

        $result['drive'] = (int) $array['drive'];

        return $result;
    }
    function submit_data($conn, $data){
        $q = "INSERT INTO `submitted_result` (`match_num`, `team1`, `team2`,`color`, `auto_star_enable1`, `auto_star_range1`, `auto_cube_enable1`, `auto_cube_range1`, `auto_lift1`, `auto_star_enable2`, `auto_star_range2`, `auto_cube_enable2`, `auto_cube_range2`, `auto_lift2`, `auto`, `drive_star_enable1`, `drive_star_range1`, `drive_cube_enable1`, `drive_cube_range1`, `drive_lift1`, `drive_star_enable2`, `drive_star_range2`, `drive_cube_enable2`, `drive_cube_range2`, `drive_lift2`, `drive`) VALUES ('{$data['match_num']}','{$data['team1']}', '{$data['team2']}', '{$_SESSION['color']}', '{$data['auto_star_enable1']}', '{$data['auto_star_range1']}', '{$data['auto_cube_enable1']}', '{$data['auto_cube_range1']}', '{$data['auto_lift1']}', '{$data['auto_star_enable2']}', '{$data['auto_star_range2']}', '{$data['auto_cube_enable2']}', '{$data['auto_cube_range2']}', '{$data['auto_lift2']}', '{$data['auto']}', '{$data['drive_star_enable1']}', '{$data['drive_star_range1']}', '{$data['drive_cube_enable1']}', '{$data['drive_cube_range1']}', '{$data['drive_lift1']}', '{$data['drive_star_enable2']}', '{$data['drive_star_range2']}', '{$data['drive_cube_enable2']}', '{$data['drive_cube_range2']}', '{$data['drive_lift2']}', '{$data['drive']}')";
        if (!$conn->query($q)){
            die(mysqli_error($conn));
        }else{
            return True;
        }
    }
    if(isset($_POST["submit"])){
        if($_POST['submit'] == "Submit"){
            $data = process_input($_POST);
            $match_num = $data['match_num'];
            $match_num = $match_num + 1;
            submit_data($conn, $data);
        }elseif($_POST['submit'] == "Update"){
            $match_num = $_POST['match_num'];
        }
    }

    if (!isset($match_num)){
        $match_num = 1;
    }
?>