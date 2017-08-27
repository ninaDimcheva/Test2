<?php
$myFile = "notes.txt";
$priority = 0;
$priorityArray = array();
$note = null;
$array = json_decode(file_get_contents($myFile), true);
for($i = 0; $i < count($array); $i++){
$priority = explode("#", $array[$i])[1];
$note = explode("#", $array[$i])[0];
$priorityArray[$note] = $priority;
}
asort($priorityArray, SORT_REGULAR);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sorted messages</title>
    <style>
        table{
            font-family: arial, sans - serif;
            border-collapse: collapse;
        }
        td,th{
            border:  1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
<table>
    <tr><td>Priority</td><td>Message</td></tr>
    <?php
    foreach ($priorityArray as $key => $value){
        $value = explode(":", $value)[0];
        if($value == 1 || $value == 2){
            echo '<tr bgcolor="#008000">';
        }
        if($value == 3 || $value == 4){
	        echo '<tr bgcolor="#ffff00">';
        }
        if($value == 5){
	        echo '<tr bgcolor="#ffc0cb">';
        }
	    echo "<td>$value</td><td>$key</td>";
             echo "</tr>";
    }
    ?>
</table>
<a href="index.php">Include another message</a>
</body>
</html>