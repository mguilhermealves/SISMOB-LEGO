<?php
class externalapi_controller{
    public $method = 'GET' ;
    public $paramters = array() ;
    public $header = null ;
    public $body = "" ;
	public function __call( $method, $paramters ) {
		if( preg_match( "/(?P<type>[sg]et)_(?P<method>\w+)/", $method , $match ) ){
			$var = $match[ "method" ] ;
			switch( $match[ "type" ] ){
				case 'set':
				  $this->$var = $paramters[0];
				break;
				case 'get':
				  return $this->$var;
				break;
			}
		}
	}
	public function load( $action ){
        $url = $action ;
        if( count($this->paramters) > 0 ){
            $start = true ;
            foreach($this->paramters as $k => $v){
                $url .=  ( $start ? '?' : '&' ) . $k . "=" . $v ;
            }
        }
        $curl = curl_init();
        curl_setopt_array(
            $curl, 
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $this->method,
                CURLOPT_POSTFIELDS => $this->body,
                CURLOPT_HTTPHEADER => $this->header,
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return array( $response , $err );
    }
    public static function login($body){

        $headers = array(
            'Content-Type: multipart/form-data',
            'ExternalAuth:'.constant("cExternalAuth")		
        );	
        
        $url = constant("cApiUrl").'/login';
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