<?php
function process_input($array){
    $result = array();
    $result['match_num'] = $array['match_num'];

    $result['auto_star_enable1'] = isset($array["auto_star_enable1"]) ? True : False;
    $result['auto_star_range1'] = isset($array["auto_star_range1"]) ? True : False;
    $result['auto_cube_enable1'] = isset($array["auto_cube_enable1"]) ? True : False;
    $result['auto_cube_range1'] = isset($array["auto_cube_range1"]) ? True : False;
    $result['auto_lift1'] = isset($array["auto_lift1"]) ? True : False;

    $result['auto_star_enable2'] = isset($array["auto_star_enable2"]) ? True : False;
    $result['auto_star_range2'] = isset($array["auto_star_range2"]) ? True : False;
    $result['auto_cube_enable2'] = isset($array["auto_cube_enable2"]) ? True : False;
    $result['auto_cube_range2'] = isset($array["auto_cube_range2"]) ? True : False;
    $result['auto_lift2'] = isset($array["auto_lift2"]) ? True : False;

    $result['auto'] = (int) $array['auto'];

    $result['drive_star_enable1'] = isset($array["drive_star_enable1"]) ? True : False;
    $result['drive_star_range1'] = isset($array["drive_star_range1"]) ? True : False;
    $result['drive_cube_enable1'] = isset($array["drive_cube_enable1"]) ? True : False;
    $result['drive_cube_range1'] = isset($array["drive_cube_range1"]) ? True : False;
    $result['drive_lift1'] = isset($array["drive_lift1"]) ? True : False;

    $result['drive_star_enable2'] = isset($array["drive_star_enable2"]) ? True : False;
    $result['drive_star_range2'] = isset($array["drive_star_range2"]) ? True : False;
    $result['drive_cube_enable2'] = isset($array["drive_cube_enable2"]) ? True : False;
    $result['drive_cube_range2'] = isset($array["drive_cube_range2"]) ? True : False;
    $result['drive_lift2'] = isset($array["drive_lift2"]) ? True : False;

    $result['drive'] = (int) $array['drive'];

    return $result;
}
if(isset($_POST["submit"])){
    $result = process_input($_POST);
    echo var_dump($result);
}
?>