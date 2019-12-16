<?php 
$diveLog=file_get_contents("diveLog.json");

$display="<div id='diver'><hq>Dive Log Entry</h1>";

    $display="<div id='diver'><h2>Dive Log Entries</h2>";
    $logObj = json_decode($diveLog);
    foreach ($logObj->entry as $log){
    $diver_fname = $log->f_name;
    $diver_lname = $log->l_name;
    //$lake = $log->lake_name;
    //$location = $log->state;
    $display.= "<p>" . $diver_lname . ", " . $diver_fname . "</p>";   
    }
    $display .="</div>"
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dive Log Entries</title>
        <link href="greens.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php echo $display;?>
    </body>
    <p>
        <a href = 'addressBookMenu.html'>Return to Main Menu</a>
    </p>
</html>