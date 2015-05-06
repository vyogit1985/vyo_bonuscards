<?php
/*code string*/
function code_string($input_string) {
  return md5('secret'.$input_string);
}

/*execute sql query*/
	function db_query($query) {
		$result = mysql_query($query);
		if (!$result)
		{
			die(mysql_error());
			/*error code*/
		}
		
		return $result;
	}

/*create table with image borders*/
	function bordered_table($table_body) {
		$table_template = 
			'
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="border_up_left"></td>
					<td class="border_up"></td>
					<td class="border_up_right"></td>
				</tr>
				<tr>
					<td class="border_left"></td>
					<td>{table_body}</td>
					<td class="border_right"></td>
				</tr>
				<tr>
					<td class="border_down_left"></td>
					<td class="border_down"></td>
					<td class="border_down_right"></td>
				</tr>
			</table>
			';
		
		$table_template = str_replace('{table_body}', $table_body, $table_template);
		
		return $table_template;
	}
	
/*return full ip*/
	function get_ip() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$sub_net = getenv('HTTP_X_FORWARDED_FOR');
		if (($sub_net != NULL) && ($sub_net != $ip)) $ip = $ip.'/'.$sub_net;
		return $ip;
	}
	
/*check string on bugs*/
	function check_string($input_string) {
		/*$input_string = substr($input_string, 0, 50);*/
		$input_string = stripslashes($input_string);
		$input_string = htmlspecialchars($input_string);
		return $input_string;
	}
	
	function is_empty($input_string) {
		if ((trim($input_string) == '') || (strlen($input_string) == 0)) return TRUE;
		else return FALSE;
	}
	
	function generate_number($length = 10){
	  $chars = '0123456789';
	  $numChars = strlen($chars);
	  $string = '';
	  for ($i = 0; $i < $length; $i++) {
	    $string .= substr($chars, rand(1, $numChars) - 1, 1);
	  }
	  return $string;
	}
?>