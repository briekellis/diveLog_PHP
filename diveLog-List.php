<?php
$mysqli = mysqli_connect("localhost", "lisabalbach_ellis69", "CIT180121", "lisabalbach_Ellis") or die(mysql_error());

$query = "SELECT * FROM diver_name";
//$query2 = "SELECT * FROM lake";
$result = $mysqli->query($query)
    or die($mysqli->error);

$response= array();

$posts = array();

while($row=$result->fetch_assoc())
{
    $diver_fname=$row['f_name'];
    $diver_lname=$row['l_name'];
    //$lake=$row['lake_name'];
    //$location=$row['state'];

$posts[]= array('f_name'=>$diver_fname, 'l_name'=>$diver_lname
/*, 'lake_name'=>$lake, 'state'=>$location*/);
}

$response['entry'] = $posts;

$fp = fopen('diveLog.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);

$display_block="<p>The dive log entry information has been written to json</p>";
$display_block.="<p><a href='viewjsondata.php'>View divers</a></p>";
$display_block .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='addressBookMenu.html' style='color:darkgreen';>Cancel and return to main menu</a></p></form>";
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Json File</title>
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>