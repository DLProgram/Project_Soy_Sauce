<?php
include 'lock.php';
include 'admin_permission.php';

function get_events(){
    $ch = curl_init();  
     
    curl_setopt($ch, CURLOPT_URL, "http://data.vexvia.dwabtech.net/mobile/events/csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output=explode("\r\n", curl_exec($ch));
    curl_close($ch);
    $header = array_shift($output);
    $result=[];
    foreach ($output as $events) {
        $data = explode(",", $events);
        $event['event_id'] = array_shift($data);
        $event['name'] = implode(',', $data);
        if(!empty($event['event_id'])){
            $result[] = $event;
        }
    }

    return $result;
}

function get_divisions($event_id){
    $ch = curl_init();  
     
    curl_setopt($ch, CURLOPT_URL, "http://data.vexvia.dwabtech.net/mobile/{$event_id}/divisions/csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output=explode("\r\n", curl_exec($ch));
    curl_close($ch);
    $header = array_shift($output);
    $result=[];
    foreach ($output as $divisions) {
        $data = explode(",", $divisions);
        $division['division'] = array_shift($data);
        $division['name'] = array_shift($data);
        if(!empty($division['division'])){
            $result[] = $division;
        }
    }

    return $result;
}

function get_matches($event_id, $division){
    $ch = curl_init();  
     
    curl_setopt($ch, CURLOPT_URL, "http://data.vexvia.dwabtech.net/mobile/{$event_id}/{$division}/matches/csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output=explode("\r\n", curl_exec($ch));
    curl_close($ch);
    $result=[];
    foreach ($output as $matches) {
        $data = explode(",", $matches);
        if ($data[0] == 2){
            $match['num'] = $data[2];
            $match['red1'] = $data[5];
            $match['red2'] = $data[6];
            $match['blue1'] = $data[8];
            $match['blue2'] = $data[9];
            $result[] = $match;
        }
    }
    return $result;
}

function empty_table($conn, $all=false){
    if (!$conn->query("TRUNCATE TABLE match_data")){
        die(mysqli_error($conn));
    }
}

function submit_matches($conn, $match_data){
    foreach ($match_data as $match) {
        if (!$conn->query("INSERT INTO match_data (match_num, match_name, blue1, blue2, red1, red2) VALUES ({$match['num']}, '{$match['num']}', '{$match['blue1']}', '{$match['blue2']}', '{$match['red1']}', '{$match['red2']}')")){
            die(mysqli_error($conn));
        }
    }
}

if (isset($_GET['division'])){
    $event_id = $_GET['event_id'];
    $division = $_GET['division'];
    $matches = get_matches($event_id, $division);
    empty_table($conn);
    submit_matches($conn, $matches);
}elseif (isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    $divisions = get_divisions($event_id);
}else{
    $events = get_events();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import match data</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-6 columns">
            <h1>Import match data</h1>
        </div>
        <div class="large-3 columns">
            <a style="margin-top: 10px" class="large button" href=<?php echo strtok("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?');?>>Reset</a>
        </div>
    </div>
    <div class="row">
        
        <?php 
            if (isset($events)){
                echo "<form><select name='event_id' onchange='this.form.submit()'>
                <option value=''></option>";
                foreach ($events as $event) {
                    echo "<option value='{$event['event_id']}'>{$event['name']}</option>";
                }
                echo "</select></form>";
            }elseif (isset($divisions)) {
                echo "<form><input type='hidden' value={$event_id} name='event_id'>";
                echo "<select name='division' onchange='this.form.submit()'>
                <option value=''></option>";
                foreach ($divisions as $division) {
                    echo "<option value='{$division['division']}'>{$division['name']}</option>";
                }
                echo "</select></form>";
            }elseif (isset($matches)) {
                echo"<table class='hover'>
                    <thead>
                    <tr>
                        <th width='10%'>Match</th>
                        <th width='45%'>Red Teams</th>
                        <th width='45%'>Blue Teams</th>
                    </tr>
                    </thead>
                    <tbody>";
                foreach ($matches as $match) {
                    echo"
                    <tr>
                        <td>{$match['num']}</td>
                        <td><span class='alert label'>{$match['red1']} {$match['red2']}</span></td>
                        <td><span class='info label'>{$match['blue1']} {$match['blue2']}</span></td>
                    </tr>
                    ";
                }
                echo "</tbody></table>";
            }
        ?>
        
    </div>
   
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>