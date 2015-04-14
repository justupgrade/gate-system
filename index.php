<?php
	function __autoload($name){
		require_once './classes/' . $name . '.php';
	}
	
	$system = new System();
	$system->generate();
	
	$gates = $system->getGates();
	$center = $system->getCenter();
	
	$gates_html = '';
	foreach($gates as $room){
		$col = $room->col; $row = $room->row;
		$left = 50 + $col * 30; $top = 50 + $row * 30;
		$gates_html .= "<div class='room gate' style='left: $left; top: $top;'></div>";
	}
	
	$left = $center->col * 30 + 50; $top = $center->row * 30 + 50;
	$center_html = "<div class='room center' style='left: $left; top: $top;'></div>";
?>

<html>
<head>
	<title> Gate-System </title>
	<style> @import url('./styles/main.css');</style>
</head>
<body>
	<?php 
		echo $gates_html;
		echo $center_html;
	?>
</body>
</html>