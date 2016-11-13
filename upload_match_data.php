<?php
include("connect.php");
if(!empty($_FILES)){
    $myfile = fopen($_FILES['fileUpload']['tmp_name'], "r");
    $all_rows = array();
    $header = null;
    $result = [];
    while ($row = fgetcsv($myfile)) {
        if ($header === null) {
            $header = $row;
            continue;
        }
        $all_rows[] = array_combine($header, $row);
    }
    fclose($myfile);

    $num_of_row = $conn->query("SELECT COUNT(*) FROM match_data")->fetch_assoc()['COUNT(*)'];
    if ($num_of_row > 0){
        if ($conn->query("TRUNCATE TABLE match_data")){
            array_push($result, "Deleted Old Data");
        }else{
            die(mysqli_error($conn));
        }
    }

    foreach ($all_rows as $key) {
        if (strpos($key['Match'], "Qualifier") !== False){
            preg_match("(\d+)", $key['Match'], $matches);
            $match_num = $matches[0];
            $match_name = $key['Match'];
            $blue1 = $key['Blue Team (1)'];
            $blue2 = $key['Blue Team (2)'];
            $red1 = $key['Red Team (1)'];
            $red2 = $key['Red Team (2)'];
            
            

            if ($conn->query("INSERT INTO match_data (match_num, match_name, blue1, blue2, red1, red2) VALUES ({$match_num}, '{$match_name}', '{$blue1}', '{$blue2}', '{$red1}', '{$red2}')")){
                array_push($result, "Added Data {$match_name}");
            }else{
                die(mysqli_error($conn));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Match Data</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="row">
        <div class="large-12 columns">
            <h1>Upload Match Data</h1>
        </div>
    </div>
    <div class="row">
        <form method="post" enctype="multipart/form-data">
        <div class="large-3 columns">
            <label for="fileUpload" class="button">Open File</label>
            <input type="file" id="fileUpload" class="show-for-sr" name="fileUpload">
        </div>
        <div class="large-3 columns end">
            <input type="submit" name="submit" class="success button">
        </div>
        </form>
    </div>
    <div class="row">
        <table class="hover">
        <?php
            if(isset($result)){
                foreach ($result as $row) {
                    echo "<tr><td>";
                    echo $row;
                    echo "</td></tr>";
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