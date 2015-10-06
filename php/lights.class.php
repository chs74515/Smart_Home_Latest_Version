<?php

class Lights {

	public static function getForm() {
		$html = "<form action=\"index.php\">";
		$html .= "<input type=\"submit\" formmethod=\"POST\">Turn on light</input>";
		$html .= "<input type=\"hidden\" name=\"lights\" value=\"1\"></input>";
		$html .= "</form>";
		return $html;
		
	}
	
	// If this is called, we have been POST'd
	public static function processPost() {
		$command = escapeshellcmd("python python/LightsHandler.py 1 on");
		$output = shell_exec($command);
		echo $output;
	}
}