<?php
class mail_controller{
	public static $attach = array();
	public static $from = array();
	public static $replyTo = array();
	public static $Address = array();
	public static $CC = array();
	public static $BCC = array();

	public static function save( $info ){
		$boiler = new messages_model();
		if( isset( $info["idx"] ) && $info["idx"] > 0 ){
			$boiler->set_filter( array( " idx = '" . addslashes( $info["idx"] ) . "' ") ) ;
		}
		$boiler->populate( $info["post"] , true ) ;
		$boiler->save() ;
		if( ! isset( $info["idx"] ) || $info["idx"] < 1 ){
			$info["idx"] = $boiler->con->insert_id ;
		}
        return $info ;
	}

	public static function send( $id = NULL , $limit = 100 ){
		$messages = new messages_model();
		$filter = array( " error_msg is null " , " sent_at is null " , " active = 'yes' " , " type = 'mail' " ) ;
		if( ! is_null( $id ) ){
			$filter[] = " idx = '" . $id . "' " ;
		}
		else{
			$last = strtotime("+3 hours");
			$filter[] = " scheduled_at <= '" . date('Y-m-d H:i:s', $last) . "' " ;
		}
		$messages->set_filter( $filter ) ;
		$messages->set_paginate( array( 0 , $limit ) ) ;
		$messages->load_data() ;
		$data = $messages->data ;
		if( count( $data ) ){
	            require_once( constant("cRootServer_APP") . "/inc/lib/phpmailer/class.phpmailer.php" );
			foreach( $data as $v ){
				$mailboxes = utf8_unserialize( $v["mailboxes"] ) ;
				$info = array( "idx" => $v["idx"] , "post" => array() ) ;
				$status = false;
                $mail1 = new PHPMailer();
                $mail1->SetLanguage("br", 'phpmailer/language/');
                $mail1->isSMTP();
					
				$mail1->CharSet = "utf-8";
                $mail1->SMTPDebug = 3;	
                $mail1->SMTPAuth   = true;
    			$mail1->SMTPSecure = "tls";
	    		$mail1->Port     = constant("mail_from_port");
		    	$mail1->Host     = constant("mail_from_host");
				$mail1->Username = constant("mail_from_user");
				$mail1->Password = constant("mail_from_pwd");
			    	$mail1->IsHTML(true);
				$mail1->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
				$mail1->Subject = remove_accents( $v["name"] ) ;

				if( isset( $mailboxes["Address"] ) && count( $mailboxes["Address"] ) ){
					if( isset( $mailboxes["Address"]["mail"] ) ){
						$mail1->AddAddress( $mailboxes["Address"]["mail"] , $mailboxes["Address"]["name"] );
					}
					else{
						foreach( $mailboxes["Address"] as $values ){
							$mail1->AddAddress( $values["mail"] , $values["name"] );
						}
					}
				}
				if( isset( $mailboxes["from"]["mail"] ) && strlen( $mailboxes["from"]["mail"] ) && isset( $mailboxes["from"]["name"] ) && strlen( $mailboxes["from"]["name"] ) ){
					$mail1->setFrom($mailboxes["from"]["mail"] , $mailboxes["from"]["name"] ) ;
				}
				if( isset( $mailboxes["replyTo"]["mail"] ) && isset( $mailboxes["replyTo"]["name"]) ){
					$mail1->addReplyTo( $mailboxes["replyTo"]["mail"] , $mailboxes["replyTo"]["name"] ) ;
					$mail1->addbcc( $mailboxes["replyTo"]["mail"] , $mailboxes["replyTo"]["name"] );
				}
				if( isset( $mailboxes["CC"] ) && count( $mailboxes["CC"] ) ){
					foreach( $mailboxes["CC"] as $values ){
						$mail1->addcc( $values["mail"] , $values["name"] );
					}
				}
				if( isset( $mailboxes["BCC"] ) && count( $mailboxes["BCC"] ) ){
					foreach( $mailboxes["BCC"] as $values ){
						$mail1->addbcc( $values["mail"] , $values["name"] );
					}
				}
				
				if( isset( $v["textmsg"] ) && strlen( $v["textmsg"] ) ){
					$mail1->AltBody = $v["textmsg"] ;
				}
				if( isset( $v["htmlmsg"] ) && strlen( $v["htmlmsg"] ) ){
					$mail1->Body = $v["htmlmsg"] ;
				}

				if( !$mail1->Send() ) {
					$nm = new messages_model();
					$nm->set_filter( array( " idx = '" . $v["idx"] . "' " ) ) ;
					$nm->populate( array( "error_msg" => $mail1->ErrorInfo ) );
					$nm->save();
				}
				else{
					$nm = new messages_model();
					$nm->set_filter( array( " idx = '" . $v["idx"] . "' " ) ) ;
					$nm->populate( array( "sent_at" => date("Y-m-d H:i:s") ) );
					$nm->save();
				}
				$mail1->ClearAllRecipients();
				$mail1->ClearAttachments();
				unset( $nm ) ;
				unset( $mail1 ) ;
			}
		}
		$messages->con->my_query("update messages set error_msg=NULL where not error_msg is NULL");
	}

	public static function sms( $id = NULL , $limit = 1 ){
		$messages = new messages_model();
		$filter = array( " error_msg is null " , " sent_at is null " , " active = 'yes' " , " type = 'sms' " ) ;
		if( ! is_null( $id ) ){
			$filter[] = " idx = '" . $id . "' " ;
		}
		else{
			$last = strtotime("+3 hours");
			$filter[] = " scheduled_at <= '" . date('Y-m-d H:i:s', $last) . "' " ;
		}
		$messages->set_filter( $filter ) ;
		$messages->set_paginate( array( 0 , $limit ) ) ;
		$messages->load_data() ;
		$data = $messages->data ;
		if( count( $data ) ){
			foreach( $data as $v ){
				$mailboxes = utf8_unserialize( $v["mailboxes"] ) ;
				$externalapi_controller = new externalapi_controller();
				$externalapi_controller->set_header( array( "x-api-key" => "tPQHzoCqVS3YFC4UxOBq88jR8UBTa4qN8Jhnvm9v" ) ) ;
				$externalapi_controller->set_body( array( "phone_number" => $mailboxes["to"] , "message" => $v["htmlmsg"] ) );
				$externalapi_controller->set_method("POST");
				list( $response , $err ) = $externalapi_controller->load( "https://a4q0v5i017.execute-api.sa-east-1.amazonaws.com/sendsms" );
				if ($err) {
					$nm = new messages_model();
					$nm->set_filter( array( " idx = '" . $v["idx"] . "' " ) ) ;
					$nm->populate( array( "error_msg" => "cURL Error #:" . $err ) );
					$nm->save();
				} else {
					$nm = new messages_model();
					$nm->set_filter( array( " idx = '" . $v["idx"] . "' " ) ) ;
					$nm->populate( array( "sent_at" => date("Y-m-d H:i:s") ) );
					$nm->save();
				}
				sleep(0.33);
			}
		}
	}
}
?>
