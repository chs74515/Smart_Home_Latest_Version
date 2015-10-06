<?php

class Lights {

	public static function getForm() {
		$html = "<form action=\"index.php\">";
		$html .= "<label for=\"lightid\">Light ID:</label>";
		$html .= "<input type=\"textbox\" name=\"lightid\"></value><br />";
		$html .= "<input type=\"hidden\" name=\"lights\" value=\"1\"></input>";
		$html .= "<input type=\"radio\" name=\"status\" value=\"on\">On</input><br />";
		$html .= "<input type=\"radio\" name=\"status\" value-\"off\">Off</input><br />";
		$html .= "<input type=\"submit\" formmethod=\"POST\"></input>";
		$html .= "</form>";
		return $html;
		
	}
	
	// If this is called, we have been POST'd
	public static function processPost() {
		if(!empty($_POST['status'])) {
			$value = $_POST['status'];
		} else {
			$value = "on";
		}
		
		if(!empty($_POST['lightid'])) {
			$lightid = $_POST['lightid'];
		} else {
			$lightid = 1;
		}
		
		$command = escapeshellcmd("python python/LightsHandler.py $lightid $value");
		$output = shell_exec($command);
		echo $output;
	}
}