<?php

	error_reporting(E_ALL);
 	ini_set('display_startup_errors', 1);
 	ini_set("display_errors",1);
	//echo '<pre>',print_r($_POST); exit;
	
	$csv_mimetypes = array(
	'text/csv', 
	'text/plain', 
	'application/csv', 
	'text/comma-separated-values',
	'application/excel', 
	'application/vnd.ms-excel', 
	'application/vnd.msexcel', 
	'text/anytext', 
	'application/octet-stream', 
	'application/txt'
	);
 
 
if (
	in_array($_FILES['csvfile']['type'], $csv_mimetypes) &&
	isset($_POST['msg'])
	) 
	{
	/**
	*	Each time create new file at server side and delete old file of csv.
	*/
	
	//chmod(__FILE__,0777);
	$info = pathinfo($_FILES['csvfile']['name']);
	$ext = $info['extension']; // get the extension of the file
	$newname = "mobileno.".$ext; 

	$msg=$_POST['msg'];
	//echo mb_detect_encoding($msg);exit;
	$target = $newname;
	$success=move_uploaded_file( $_FILES['csvfile']['tmp_name'], $target);
	if($success){
		//echo "File uploaded successfully.";
	}else{
		echo "File uploade fail.";
	}

	function getMobileNo($file){	
		/**
		*	Read phone number from server side file.
		*/
		
		$filedata=file_get_contents($file);
		$mobilenostr=preg_replace("/[\n\r]/", ',', $filedata);
		return $mobilenostr;
	}

	/**
	*	Created on 		:	20-March-2017.
	*	Created by 		:	Mohan Nalgire mnalgire@gmail.com
	*	Modified on 	:		
	*	Modified by 	:	Mohan Nalgire mnalgire@gmail.com
	*/	

	function openurl($url,$postvars) {
		/**
		*	input 			:	url for http request.
		*	use 			:	handling url for curl request and handling curl response.
		*	return 			:	curl response.
		*/
		$curl_log=fopen('curllog.log',"a");
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);//For sending HTTP POST request.
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);//Verbose mode on crul is on.
		curl_setopt($ch, CURLOPT_STDERR, $curl_log);//Standard error handling for curl with file.
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch,CURLOPT_TIMEOUT, '3');  // Timeout for curl.
		$response = trim(curl_exec($ch));
		
		rewind($curl_log);
		$output=fread($curl_log,2048);//
		echo "<pre>",print_r($response,true),"</pre>";
		fclose($curl_log);
		curl_close($ch);
  }
######################################### Manual configuration ################################################
$domain="http://123.63.33.43/blank/sms/user/urlsmstemp.php";
$GSM=getMobileNo($target);

//From above data query string.
$querystring = http_build_query(
			array(
			  'username'=>"kapbulk",//use your sms api username
              'pass'=>"kapbulk@@123", //enter your password
              'senderid'=>"KAPMSG",//Your api sender id.
              'message'=>$_POST['msg'],//Your text message for sms.
              'dest_mobileno'=>"10digit mobileno",//10 digit mobile no comma separated.
              'response'=>"Y",//
              //'unicode'=>'1'
             )
			);
######################################### Manual configuration Ends ################################################

openurl($domain,$querystring);
}

?>