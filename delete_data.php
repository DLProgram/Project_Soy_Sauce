<?php
include 'lock.php';
include 'admin_permission.php';

function empty_all_tables($conn){
    if (!$conn->query("TRUNCATE TABLE submitted_result")){
        die(mysqli_error($conn));
    }
    if (!$conn->query("TRUNCATE TABLE checked_result")){
        die(mysqli_error($conn));
    }
    if (!$conn->query("TRUNCATE TABLE match_data")){
        die(mysqli_error($conn));
    }
}

if (isset($_GET['delete'])) {
    empty_all_tables($conn);
    $msg = "Deleted all data!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <?php include 'navbar.php';?>
    <?php 
        if(!empty($msg)){
            echo"
            <div class='row'>
                <div class='alert callout' style='margin-top: 50px;' data-closable>
                    <h5>{$msg}<h5>
                    <button class='close-button' aria-label='Dismiss alert' type='button' data-close>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            </div>";
        }
    ?>
    <div class="row">
        <div class="large-6 columns">
            <h1>Delete Data</h1>
        </div>
    </div>
    <div class="row">
        <p>This will delete all data including <strong>match list</strong>, <strong>data submitted by scouters</strong>, <strong>and data checked by admin</strong>.</p>
    </div>
    <div class="row">
        <form>
            <div class="large-2 columns">
                <input type="checkbox" name="delete" id="delete">
                <label for="delete">I Understand</label>

            </div>
            <div class="large-2 columns end" >
                <input type="submit" class="expanded button alert" value="Delete">
            </div>
        </form>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>
</html>