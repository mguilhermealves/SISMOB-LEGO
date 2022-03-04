<?php
class externalapi_controller{

	public static function load($body,$action){
        $headers = array(
			'Content-Type: multipart/form-data',
			'ExternalAuth:'.constant("cExternalAuth")		
			);					   
		$url =  constant("cApiUrl").'/'.$action;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS ,$body);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);
		curl_close($ch);					
		return (array)json_decode($data,true);	
    }

}
