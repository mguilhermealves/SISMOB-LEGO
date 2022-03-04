<?php
class course_controller{

    public function curso( $info ){
		$page = 'curso';
			
		if( !site_controller::check_login() ){
			basic_redir($GLOBALS["home_url"]);
		}
		$curso = new courses_model();			
		$curso->set_filter( array( " active = 'yes' ", " slug = '".$info["slug"]."' " ) ) ;			
		$curso->load_data();	
		$curso->attach( array("sections") , false , " and section_status = 'Publicado' order by display_position" , array("idx","section_title") );	
		$curso->attach_son("sections", array("lessons") , false , " and lessons_status = 'Publicado' order by display_position " );
		$curso->attach_son("sections", array("tests","surveys","forum") , true, " and status = 'Publicado' order by display_position " );
		$curso->join("instrutor", "users", array("idx" => "course_instructor"),null,array("idx","first_name"));			
		$data = $curso->data[0];							
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");			
		include( constant("cRootServer") . "ui/page/treinamento_curso.php");							
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");		
		
	}

    public function section_content( $info ){
		$page = 'treinamento_iniciar';		
		if( !site_controller::check_login() ){
			basic_redir($GLOBALS["home_url"]);
		}
			
			$curso = new courses_model();			
			$curso->set_filter( array( " active = 'yes' ", " slug = '".$info["slug"]."' " ) ) ;			
			$curso->load_data();	
			$curso->attach( array("sections") , false , " and section_status = 'Publicado' order by display_position" , array("idx","section_title") );
			$curso->attach_son("sections", array("lessons") , false , " and lessons_status = 'Publicado' order by display_position " );
			$curso->attach_son("sections", array("tests","surveys","forum") , true, " and status = 'Publicado' order by display_position " );
			$course_data = $curso->data[0];

			$sidebar = array();
			foreach( $curso->data[0]["sections_attach"] as $k => $v ){
				$sidebar[ $k ] = array(
					"title" => $v["section_title"]
					, "content" => array()
				) ;
				foreach( $v["lessons_attach"] as $kin => $vin ){
					if( isset( $sidebar[ $k ]["content"][ $vin["display_position"] ] ) ){
						$sidebar[ $k ]["content"][] = array( 
							"idx" => $vin["idx"] 
							, "type" => "lesson" 
							, "title" => $vin["lessons_title"] 
						) ;	
					}
					else{
						$sidebar[ $k ]["content"][ $vin["display_position"] ] = array( 
							"idx" => $vin["idx"] 
							, "type" => "lesson" 
							, "title" => $vin["lessons_title"] 
						) ;	
					}
				}
				foreach( $v["tests_attach"] as $kin => $vin ){
					if( isset( $sidebar[ $k ]["content"][ $vin["display_position"] ] ) ){
						$sidebar[ $k ]["content"][] = array( 
							"idx" => $vin["idx"] 
							, "type" => "test" 
							, "title" => $vin["title"] 
						) ;	
					}
					else{
						$sidebar[ $k ]["content"][ $vin["display_position"] ] = array( 
							"idx" => $vin["idx"] 
							, "type" => "test" 
							, "title" => $vin["title"] 
						) ;	
					}
				}
				foreach( $v["surveys_attach"] as $kin => $vin ){
					if( isset( $sidebar[ $k ]["content"][ $vin["display_position"] ] ) ){
						$sidebar[ $k ]["content"][] = array( 
							"idx" => $vin["idx"] 
							, "type" => "survey" 
							, "title" => $vin["title"] 
						) ;	
					}
					else{
						$sidebar[ $k ]["content"][ $vin["display_position"] ] = array( 
							"idx" => $vin["idx"] 
							, "type" => "survey" 
							, "title" => $vin["title"] 
						) ;	
					}
				}
				foreach( $v["forum_attach"] as $kin => $vin ){
					if( isset( $sidebar[ $k ]["content"][ $vin["display_position"] ] ) ){
						$sidebar[ $k ]["content"][] = array( 
							"idx" => $vin["idx"] 
							, "type" => "forum" 
							, "title" => $vin["title"] 
						) ;	
					}
					else{
						$sidebar[ $k ]["content"][ $vin["display_position"] ] = array( 
							"idx" => $vin["idx"] 
							, "type" => "forum" 
							, "title" => $vin["title"] 
						) ;	
					}
				}
				
			}

			$data = [];
					
			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");

			switch($info["slug2"]){

				case "lesson":
					$complete = new progress_model();
					$complete->set_filter( array( " active = 'yes' ", " users_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]. "", "type = 'lesson'", "object_id =  ".$info["idx"]. "","complete = 'yes'"  ) ) ;
					$complete->load_data();
					$objeto_completo = isset($complete->data[0]);
					$lesson = new lessons_model();			
					$lesson->set_filter( array( " active = 'yes' ", " idx = '".$info["idx"]."' " ) ) ;			
					$lesson->load_data();	
					$lesson->attach(array("sections") , true );
					$lesson->attach_son("sections", array("courses") , true );
					$data = $lesson->data[0];

					if( $data["lessons_type"] == "text" && $objeto_completo < 100 ){
						$a = course_controller::saveprogress( array( "post" => array( "user_id" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"] , "type" => 'lesson' , "object_id" => $info["idx"] , "currenttimeuser" => 1 , "valor" => 100 ) ) ) ;
					}
					$section_title = $data["sections_attach"][0]["section_title"];
					include( constant("cRootServer") . "ui/page/course/lesson.php");
				break;

				case "test":
					$objeto_completo = false;
					$complete = new progress_model();
					$complete->set_filter( array( " active = 'yes' ", " users_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]. "", "type = 'test'", "object_id =  ".$info["idx"]. "","complete = 'yes'"  ) ) ;
					$complete->load_data();
					if(isset($complete->data[0])){
						$objeto_completo = true;
					}
					
					$test = new tests_model();			
					$test->set_filter( array( " active = 'yes' ", " idx = '".$info["idx"]."' " ) ) ;			
					$test->load_data();	
					$test->attach(array("questions","sections"));
					$test->attach_son("questions",array("alternatives"));
					$test->attach_son("sections", array("courses") , true );
					$data = $test->data[0];		
					$section_title = $data["sections_attach"][0]["section_title"];							
					include( constant("cRootServer") . "ui/page/course/test.php");
				break;
				case "result":					
					$objeto_completo = false;					

					$complete = new progress_model();
					$complete->set_filter( array( " active = 'yes' ", " users_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]. "", "type = 'test'", "object_id =  ".$info["idx"]. "","complete = 'yes'"  ) ) ;
					$complete->load_data();
					if(isset($complete->data[0])){
						$objeto_completo = true;
					}
					$test = new tests_model();			
					$test->set_filter( array( " active = 'yes' ", " idx = '".$info["idx"]."' " ) ) ;			
					$test->load_data();	
					$test->attach(array("questions","sections"));
					$test->attach_son("questions",array("alternatives"));
					$test->attach_son("sections", array("courses") , true );
					$data = $test->data[0];			

					$attemptexists = new attempts_model();	
					$attemptexists->set_filter(  array( " active = 'yes' ", " user_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"], " tests_id = ".$info["idx"] ) );
					$attemptexists->set_order( array("created_at DESC limit 1") );
					$attemptexists->load_data();

					$seleciona_tentativa = isset($info["post"]["attempt_select"]) ? $info["post"]["attempt_select"] : $attemptexists->data[0]["attempt_number"];
					
					$attempts = new attempts_model();
					$attempts->set_filter( array( " active = 'yes' ", " user_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"], " tests_id = ".$info["idx"], "attempt_number = ".$seleciona_tentativa) ) ;	
					$attempts->load_data();	
					$attempt_current = $attempts->data;	
					$section_title = $data["sections_attach"][0]["section_title"];	

					include( constant("cRootServer") . "ui/page/course/test_result.php");
				break;

			}
											
			include( constant("cRootServer") . "ui/common/foot.php");
			print("<script src='".constant("cFurniture")."js/single-lesson.js'></script>");
			print("<script src='".constant("cFurniture")."js/avaliacao.js'></script>");		
			include( constant("cRootServer") . "ui/common/footer.php");		
		
	}

    public static function contents_section($info){

		$contents = [];
		$boiler = new sections_model();
		$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
		$boiler->load_data();	
		$boiler->attach(array("lessons"), false , " and lessons_status = 'Publicado' order by display_position " );
		$boiler->attach(array("tests","surveys","forum"),true, " and status = 'Publicado' order by display_position " );
		$data = current( $boiler->data ) ;			
		
		foreach( $data["lessons_attach"] as $lesson){				
			array_push($contents,array("idx"=>$lesson["idx"],"title"=>$lesson["lessons_title"],"order"=>$lesson["display_position"],"type"=>"lesson"));
		}
		foreach( $data["tests_attach"] as $test){			
			array_push($contents,array("idx"=>$test["idx"],"title"=>$test["title"],"order"=>$test["display_position"],"type"=>"test"));
		}
		foreach( $data["surveys_attach"] as $survey){			
			array_push($contents,array("idx"=>$survey["idx"],"title"=>$survey["title"],"order"=>$survey["display_position"],"type"=>"survey"));
		}
		foreach( $data["forum_attach"] as $forum){			
			array_push($contents,array("idx"=>$forum["idx"],"title"=>$forum["title"],"order"=>$forum["display_position"],"type"=>"forum"));
		}

		return $boiler->array_sort($contents, 'order', SORT_ASC);
	}

	public function savetests($info){		



		course_controller::saveprogress($info);				
		$values = array();
		parse_str($info["post"]["form"], $values);

		$attemptexists = new attempts_model();	
		$attemptexists->set_filter(  array( " active = 'yes' ", " user_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"], " tests_id = ".$values["tests_id"] ) );
		$attemptexists->set_order( array("created_at DESC limit 1") );
		$attemptexists->load_data();
		$save = [];
		foreach($values["questions"] as $k => $v){
			$valores = explode(',',$v);
			$question = new questions_model();
			$question->set_filter( array( " active = 'yes' ", " idx = '".$k."' " ) ) ;			
			$question->load_data();
			$question->attach(array("alternatives"));
			switch( $question->data[0]["type"] ){
				case "dicotomia":
					$correta = current( array_filter( $question->data[0]["alternatives_attach"], function($x){ return $x["is_correct"] == 'yes'; }) ) ;

					$save = array(
						'user_id' => (int)$_SESSION[ constant("cAppKey") ]["credential"]["idx"],
						'tests_id' => $values["tests_id"],
						'questions_id' => $k,
						'alternatives_id' => $valores[0],
						'attempt' => serialize($question->data),
						'attempt_number' => count($attemptexists->data) == 0 ? 1 : $attemptexists->data[0]["attempt_number"] + 1,
						'started_at' => $values["started_at"],
						'duration' => $values["duration"],
						'execute_corrections' => "yes",
						'execute_points' => isset( $correta["idx"] ) && $correta["idx"] == $valores[0] ? $question->data[0]["points"] : 0 ,
					);
				break;
				case "dissertativa":
					$save = array(
						'user_id' => (int)$_SESSION[ constant("cAppKey") ]["credential"]["idx"],
						'tests_id' => $values["tests_id"],
						'questions_id' => $k,
						'alternatives_text' => $valores[0],
						'attempt' => serialize($question->data),
						'attempt_number' => count($attemptexists->data) == 0 ? 1 : $attemptexists->data[0]["attempt_number"] + 1,
						'started_at' => $values["started_at"],
						'duration' => $values["duration"]
					);
				break;
			}
			
			$attempts = new attempts_model();				
			$attempts->populate( $save );		
			$attempts->save();

		}
		print(json_encode($values));
		
	}


    public static function saveprogress($info){								
        $file = "furniture/upload/progress/user_".$info["post"]["user_id"]."/progress_".$info["post"]["type"]."_".$info["post"]["object_id"].".sql";        
        if (!file_exists(dirname(constant("cRootServer") . $file))) {
            mkdir( dirname( constant("cRootServer") . $file) , 0777, true);
			chmod( dirname( constant("cRootServer") . $file )  , 0775 ) ;
        }
        if (file_exists(constant("cRootServer") . $file)) {
            unlink(constant("cRootServer") . $file);
        }
        $txt = "INSERT INTO `progress` \n";
        $txt .= "(`created_at`,`type`,`users_id`,`object_id`,`video_progress`,`valor`,`complete`)";
        $txt .= "VALUES	('".date("Y-m-d H:i:s")."','".$info["post"]["type"]."',".$info["post"]["user_id"].",".$info["post"]["object_id"].",".$info["post"]["currenttimeuser"].",".$info["post"]["valor"].",'".($info["post"]["valor"]==100?'yes':'no')."');";
        file_put_contents( $file, $txt , 0);			
        return true;
    }

	public static function verifyprogress($type,$object_id){
			$complete = new progress_model();
			$complete->set_filter( array( " active = 'yes' ", " users_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]. "", "type = '".$type."'", "object_id =  ".$object_id. "","complete = 'yes'"  ) ) ;
			$complete->load_data();		
			return isset($complete->data[0]);
	}

	public static function verifyAllprogress($course_id,$user_id = false){
		if( $user_id == false ){
			$user_id = $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ;
			if( $percentAll = current( progress_controller::data4select("idx",array(" active = 'yes' " , " users_id = '" . $user_id . "' " , " object_id = '" . $course_id . "' " , " type = 'course' " ) , "valor" ) ) ){
				return (int)$percentAll;
			}
		}
		$percentAll = 0;


		$curso = new courses_model();			
		$curso->set_filter( array( " active = 'yes' ", " idx = '".$course_id."' " ) ) ;			
		$curso->load_data();		
		$curso->attach( array("sections") , false , " and section_status = 'Publicado' order by display_position" , array("idx","section_title") );	
		$curso->attach_son("sections", array("lessons") , false , " and lessons_status = 'Publicado' order by display_position " );
		$curso->attach_son("sections", array("tests","surveys","forum") , true, " and status = 'Publicado' order by display_position " );
		
		$qtde_objects = 0;
		$percentAll = 0;
	
		if(isset($curso->data[0]["sections_attach"])){
			foreach($curso->data[0]["sections_attach"] as $sections){
				foreach( $sections["lessons_attach"] as $lessons){				
					$qtde_objects++;
					$progress = new progress_model();
					$progress->set_filter( array( " active = 'yes' ", " users_id = ".$user_id. "", "type = 'lesson'", "object_id =  ".$lessons["idx"]. ""  ) ) ;
					$progress->load_data();					
					$percentAll += isset($progress->data[0]["valor"])?$progress->data[0]["valor"]:0;				
				}
				foreach( $sections["tests_attach"] as $tests){			
					$qtde_objects++;
					$progress = new progress_model();
					$progress->set_filter( array( " active = 'yes' ", " users_id = ".$user_id. "", "type = 'test'", "object_id =  ".$tests["idx"]. ""  ) ) ;
					$progress->load_data();
					$percentAll += isset($progress->data[0]["valor"])?$progress->data[0]["valor"]:0;
				}
				foreach( $sections["surveys_attach"] as $surveys){			
					$qtde_objects++;
					$progress = new progress_model();
					$progress->set_filter( array( " active = 'yes' ", " users_id = ".$user_id. "", "type = 'survey'", "object_id =  ".$surveys["idx"]. ""  ) ) ;
					$progress->load_data();
					$percentAll += isset($progress->data[0]["valor"])?$progress->data[0]["valor"]:0;
				}
				foreach( $sections["forum_attach"] as $forums){			
					$qtde_objects++;
					$progress = new progress_model();
					$progress->set_filter( array( " active = 'yes' ", " users_id = ".$user_id. "", "type = 'forum'", "object_id =  ".$forums["idx"]. ""  ) ) ;
					$progress->load_data();
					$percentAll += isset($progress->data[0]["valor"])?$progress->data[0]["valor"]:0;
				}
			}
		}
		$percentAll = $qtde_objects > 0 && $percentAll > 0 ? $percentAll / ( $qtde_objects * 100 ) * 100 : 0 ;
		
		return (int)$percentAll;
	}

	public static function allAttempts($tests_id){
		$attempts = new attempts_model();	
		$attempts->set_filter(  array( " active = 'yes' ", " user_id = ".$_SESSION[ constant("cAppKey") ]["credential"]["idx"], " tests_id = ".$tests_id ) );
		$attempts->set_group(array("attempt_number"));
		$attempts->load_data();
		$attemptsdata = $attempts->data;			
		return $attemptsdata;
	}
}