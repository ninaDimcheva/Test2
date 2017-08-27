<?php
$myFile = "notes.txt";
$array = json_decode(file_get_contents($myFile), true);
$newNote = null;
$number = null;
$wrongMessage = false;
$wrongNumber = false;
$picture = null;
$numberNote = 0;
$picture = null;
$deleteNumber = true;
$error = false;
if (isset($_POST['submit'])) {
	$newNote = (string)$_POST['note'];
	$number = (int)$_POST['number'];
	if (strlen($newNote) <= 0 || strlen($newNote) >= 50) {
		$wrongMessage = true;
	}
	if ($number < 1 || $number > 5) {
		$wrongNumber = true;
	}
 
	if($wrongMessage == false && $wrongNumber == false){
		switch ($number) {
			case 1:
				$picture = '&#x263A';
				break;
			case 2:
				$picture = '&#x263B';
				break;
			case 3:
				$picture = '&#x263C';
				break;
			case 4:
				$picture = '&#x263D';
				break;
			case 5:
				$picture = '&#x263D';
				break;
		}
		$array[] = $newNote . "#" . $number . ":" . $picture;
		file_put_contents($myFile, json_encode($array));
	}
}
if (isset($_POST['delete'])) {
	$numberNote = $_POST['numberNote'];
	if(count($array) === 0){
	    $error = true;
    }
	if($numberNote == 0){
	    $deleteNumber = false;
    }
    else{
	    $array = json_decode(file_get_contents($myFile), true);
	    array_splice($array, --$numberNote, 1);
	    file_put_contents($myFile, json_encode($array));
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes</title>
</head>
<body>
<form method="post">
    New note:
    <input type="text" name="note" size="150"><br/><br/>
    Priority - number between 1 and 5:
    <input type="number" name="number"><br/><br/>
    <input type="submit" name="submit" value="Save note"><br/><br/>
    Delete message:
    <input type="number" name="numberNote"><br/><br/>
    <input type="submit" name="delete" value="Delete message"><br/><br/>
    <a href="table.php">View all the products</a><br/>
</form>
<ul>
	<?php
	if ($wrongMessage) {
		echo "Please enter a correct message!";
	}
	if ($wrongNumber) {
		echo "Please enter a correct number!";
	}
	if(!$deleteNumber){
	    echo "Please enter number different from zero!";
    }
    if($error){
	    echo "There are no messages to be deleted!";
    }
	foreach ($array as $value) {
		echo "<li>";
		echo $value;
		echo "</li>";
	}
	?>
</ul>
</body>
</html>