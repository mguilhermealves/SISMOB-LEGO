<?php
class sections_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "section_title" ){
		$boiler = new sections_model();
		$boiler->set_field( array( $key , $field  ) ) ;
		$boiler->set_filter( $filters ) ;
		$boiler->load_data();
		$out = array();
		foreach( $boiler->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	private function filter( $info ){
		$done = array();
		$filter = array( "active = 'yes'" );
		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
		  $done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
		  $done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}
		if( isset( $info["course_id"] ) && !empty( $info["course_id"] ) ){
			$filter["course_id"] = " idx in ( select courses_sections.sections_id from courses_sections where active = 'yes' and courses_sections.courses_id = '" . $info["course_id"] . "' ) " ;
		}
		if( isset( $info["get"]["filter_name"] ) && !empty( $info["get"]["filter_name"] ) ){
			$done["filter_name"] = $info["get"]["filter_name"] ;
			$filter["filter_name"] = " section_title like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		if (isset($info["get"]["filter_section_status"]) && !empty($info["get"]["filter_section_status"])) {
		  $done["filter_section_status"] = $info["get"]["filter_section_status"];
		  $filter["filter_section_status"] = " section_status = '" . $info["get"]["filter_section_status"] . "' ";
		}
		return array( $done , $filter ) ;
	}
	public function display_by_courses( $info ){		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'display_position asc';

		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		list( $done , $filter ) = $this->filter( $info );
		$boiler = new sections_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( $ordenation ) ) ;
		list( $total , $data ) = $boiler->return_data();
		$boiler->attach(array("courses") , true );
		$data = $boiler->data;

		$ordenation_section_title = 'section_title-asc';
        $ordenation_section_title_ordenation = 'fas fa-border-none';
        $ordenation_position = 'display_position-asc';
        $ordenation_position_ordenation = 'fas fa-border-none';
        $ordenation_status = 'section_status-asc';
        $ordenation_status_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
          case 'section_title asc':
            $ordenation_section_title = 'section_title-desc';
            $ordenation_section_title_ordenation = 'fas fa-angle-up';
            break;
          case 'section_title desc':
            $ordenation_section_title = 'section_title-asc';
            $ordenation_section_title_ordenation = 'fas fa-angle-down';
            break;
          case 'display_position asc':
            $ordenation_position = 'display_position-desc';
            $ordenation_position_ordenation = 'fas fa-angle-up';
            break;
          case 'display_position desc':
            $ordenation_position = 'display_position-asc';
            $ordenation_position_ordenation = 'fas fa-angle-down';
            break;
          case 'section_status asc':
            $ordenation_status = 'section_status-desc';
            $ordenation_status_ordenation = 'fas fa-angle-up';
            break;
          case 'section_status desc':
            $ordenation_status = 'section_status-asc';
            $ordenation_status_ordenation = 'fas fa-angle-down';
            break;
        }
		$page = "seções";

		$done_url = isset( $info["course_id"] ) ? sprintf( $GLOBALS["sections_by_course_url"] , $info["course_id"] ) : $GLOBALS["sections_url"] ;

		$form = array(
			"title" => "Listagem de Seções"
			, "titlenew" => "Nova Seção"
			, "new" => $GLOBALS["newsection_url"]
			, "search" => isset( $info["course_id"] ) ? sprintf( $GLOBALS["sections_by_course_url"] , $info["course_id"] ) : $GLOBALS["sections_url"]
			, "action" => $GLOBALS["section_url"]
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/sections.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		?>
		<script>
			$(document).ready( function(){
				$("select[id^='lessons_type']").bind("change",function(){
					var id = String( $(this).attr("id") ).replace('lessons_type','')
					var type = $("option:selected", $(this) ).val();
					$("label[for='lessons_description"+id+"']").hide();
					$("label[for='lessons_content_url"+id+"']").hide();
					$("tetarea[id='lessons_description"+id+"']").hide();
					$("input[id='lessons_content_url"+id+"']").hide();
					switch( type ){
						case "text":
							$("label[for='lessons_description"+id+"']").show();
							$("tetarea[id='lessons_description"+id+"']").show();
						break;
						case "pdf":
						case "video":
						case "imagem":
						case "powerpoint":
						case "planilhaexcel":
						case "tincan":
							$("label[for='lessons_content_url"+id+"']").show();
							$("input[id='lessons_content_url"+id+"']").show();
						break;
					}
				})
			})
		</script>
		<?php
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new sections_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " section_title asc " ) ) ;
		list( $total , $data ) = $boiler->return_data();
		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		
		$page = "seções";
		$form = array(
			"title" => "Listagem de Seções"
			, "titlenew" => "Nova Seção"
			, "new" => $GLOBALS["newsection_url"]
			, "search" => $GLOBALS["sections_url"]
			, "action" => set_url( $GLOBALS["section_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/sections.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$total = 0 ;
		$sr = 0 ;
		$paginate = 5000;
		$page = "Seção";
		$data = array();
		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		$form = array(
			"title" => "Cadastrar Seção"
			, "url" => $GLOBALS["newsection_url"] 
		);
		//$info["get"]["done"] =  set_url( $GLOBALS["sections_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new sections_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("lessons"));
			$boiler->attach(array("tests","surveys","forum","courses"),true);
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;			
			$form["title"] = "Editar Seção";
			$form["url"] = sprintf( $GLOBALS["section_url"] , $info["idx"] ) ;			
		}	
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/section.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		print("<script src='".constant("cFurniture")."js/slip.js'></script>");
		print("<script src='".constant("cFurniture")."js/order-dragdrop.js'></script>");		
		
		?>
		<script>
			$("select[id^='lessons_type']").bind("change",function(){
				var id = String( $(this).attr("id") ).replace('lessons_type','')
				var type = $("option:selected", $(this) ).val();
				$("#container_lessons_description"+id).hide();
				$("#container_lessons_content_url"+id).hide();
				switch( type ){
					case "text":
						$("#container_lessons_description"+id).show();
					break;
					case "pdf":
					case "video":
					case "imagem":
					case "powerpoint":
					case "planilhaexcel":
					case "tincan":
						$("#container_lessons_content_url"+id).show();
					break;
				}
			})
			$.each( $("select[id^='lessons_type']") , function(i,o){
				$(o).change()
			})
		</script>
		<?php
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new sections_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["section_title"] );
		$boiler->populate( $info["post"] );
		$boiler->save();
		
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		if( isset( $info["post"]["courses_id"] ) && (int)$info["post"]["courses_id"] > 0 ){		
			$boiler->save_attach($info, array("courses"),true);
		}
	
		if( isset( $info["post"]["no-redirect"] ) ){
			print("ok");
		}
		else{
			if( isset( $info["post"]["done"] ) ){
				basic_redir( $info["post"]["done"] ) ;
			}
			else{
				basic_redir( $GLOBALS["sections_url"] ) ;
			}
		}
	  }
	  public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new sections_model();
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		  $boiler->remove();			
		}	
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["sections_url"] ) ;
		  }
		}
	  }
	  public function formnew( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$courses_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;	
		$page = "Seção";
		$data = array();
		$form = array(
		"title" => "Cadastrar Seção"
		, "url" => $GLOBALS["newsectionsave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["courses_url"] , $info["get"] );

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/section.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function section_clone($info){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
			$section = new sections_model();
			$section->set_filter( array( " idx = '" . $info["post"]["section_id"] . "'" ) ) ;
			$section->load_data();			
			$section->attach(array("lessons"));
			$section->attach(array("tests","surveys","forum","courses"),true);

			$clone = new sections_model();						
			$clone->populate( $section->data[0] );
			$clone->save();		
			$sectionclone_id = $clone->con->insert_id;
			$attach_course["idx"] = $sectionclone_id;

			$info["post"]["done"] = set_url( sprintf($GLOBALS["section_url"],$sectionclone_id ), $info["get"]);


			$attach_course["post"]["courses_id"] =  $info["post"]["course_id"];
			$clone->save_attach($attach_course, array("courses"), true);

			foreach($section->data[0]["lessons_attach"] as $lesson){
				unset($lesson["created_by"],$lesson["created_at"],$lesson["modified_at"],$lesson["modified_by"]);
				$clone_lessons = new lessons_model();						
				$clone_lessons->populate( $lesson );
				$clone_lessons->save();		
				$attach_section["idx"] = $clone_lessons->con->insert_id;
				$attach_section["post"]["sections_id"] = $sectionclone_id;
				$clone_lessons->save_attach($attach_section, array("sections"), true);
			}

			foreach($section->data[0]["forum_attach"] as $forum){
				unset($forum["created_by"],$forum["created_at"],$forum["modified_at"],$forum["modified_by"]);
				$clone_forum = new forum_model();						
				$clone_forum->populate( $forum );
				$clone_forum->save();		
				$attach_section["idx"] = $clone_forum->con->insert_id;
				$attach_section["post"]["sections_id"] = $sectionclone_id;
				$clone_forum->save_attach($attach_section, array("sections"));
			}

			foreach($section->data[0]["tests_attach"] as $test){
				$currentidx = $test["idx"];
				unset($test["idx"],$test["created_by"],$test["created_at"],$test["modified_at"],$test["modified_by"]);
				$clone_tests = new tests_model();						
				$clone_tests->populate( $test );
				$clone_tests->save();
				$testclone_id = $clone_tests->con->insert_id;		
				$attach_section["idx"] = $testclone_id;
				$attach_section["post"]["sections_id"] = $sectionclone_id;
				$clone_tests->save_attach($attach_section, array("sections"));

				$test = new tests_model();
				$test->set_filter( array( " idx = '" . $currentidx . "'" ) ) ;
				$test->load_data();			
				$test->attach(array("questions"));

				foreach($test->data[0]["questions_attach"] as $question){
					$currentidx = $question["idx"];
					unset($question["idx"],$question["created_by"],$question["created_at"],$question["modified_at"],$question["modified_by"]);
					$clone_questions = new questions_model();						
					$clone_questions->populate( $question );
					$clone_questions->save();	
					$questionclone_id = $clone_questions->con->insert_id;	
					$attach_test["idx"] = $questionclone_id;
					$attach_test["post"]["tests_id"] = $testclone_id;
					$clone_questions->save_attach($attach_test, array("tests"), true);	

					$question = new questions_model();
					$question->set_filter( array( " idx = '" .$currentidx. "'" ) ) ;
					$question->load_data();			
					$question->attach(array("alternatives"));

					foreach($question->data[0]["alternatives_attach"] as $alternative){
						$currentidx = $alternative["idx"];
						unset($alternative["idx"],$alternative["created_by"],$alternative["created_at"],$alternative["modified_at"],$alternative["modified_by"]);
						$clone_alternatives = new alternatives_model();						
						$clone_alternatives->populate( $alternative );
						$clone_alternatives->save();		
						$attach_test["idx"] = $clone_alternatives->con->insert_id;
						$attach_test["post"]["questions_id"] = $questionclone_id;
						$clone_alternatives->save_attach($attach_test, array("questions"), true);									
					}
					
				}
				
			}

			foreach($section->data[0]["surveys_attach"] as $survey){
				$currentidx = $survey["idx"];
				unset($survey["idx"],$survey["created_by"],$survey["created_at"],$survey["modified_at"],$survey["modified_by"]);
				$clone_surveys = new surveys_model();						
				$clone_surveys->populate( $survey );
				$clone_surveys->save();
				$surveyclone_id = $clone_surveys->con->insert_id;		
				$attach_section["idx"] = $surveyclone_id;
				$attach_section["post"]["sections_id"] = $sectionclone_id;
				$clone_surveys->save_attach($attach_section, array("sections"));

				$survey = new surveys_model();
				$survey->set_filter( array( " idx = '" . $currentidx . "'" ) ) ;
				$survey->load_data();			
				$survey->attach(array("surveyquestions"));

				foreach($survey->data[0]["surveyquestions_attach"] as $surveyquestion){
					$currentidx = $surveyquestion["idx"];
					unset($surveyquestion["idx"],$surveyquestion["created_by"],$surveyquestion["created_at"],$surveyquestion["modified_at"],$surveyquestion["modified_by"]);
					$clone_surveyquestions = new surveyquestions_model();						
					$clone_surveyquestions->populate( $surveyquestion );
					$clone_surveyquestions->save();	
					$surveyquestionclone_id = $clone_surveyquestions->con->insert_id;	
					$attach_survey["idx"] = $surveyquestionclone_id;
					$attach_survey["post"]["surveys_id"] = $surveyclone_id;
					$clone_surveyquestions->save_attach($attach_survey, array("surveys"), true);	

					$surveyquestion = new surveyquestions_model();
					$surveyquestion->set_filter( array( " idx = '" .$currentidx. "'" ) ) ;
					$surveyquestion->load_data();			
					$surveyquestion->attach(array("surveyalternatives"));

					foreach($surveyquestion->data[0]["surveyalternatives_attach"] as $surveyalternative){
						$currentidx = $surveyalternative["idx"];
						unset($surveyalternative["idx"],$surveyalternative["created_by"],$surveyalternative["created_at"],$surveyalternative["modified_at"],$surveyalternative["modified_by"]);
						$clone_surveyalternatives = new surveyalternatives_model();						
						$clone_surveyalternatives->populate( $surveyalternative );
						$clone_surveyalternatives->save();		
						$attach_survey["idx"] = $clone_surveyalternatives->con->insert_id;
						$attach_survey["post"]["surveyquestions_id"] = $surveyquestionclone_id;
						$clone_surveyalternatives->save_attach($attach_survey, array("surveyquestions"), true);									
					}
					
				}
				
			}


		if( isset( $info["post"]["no-redirect"] ) ){
			print("ok");
		  }
		  else{
			if( isset( $info["post"]["done"] ) ){	
										
				basic_redir(  $info["post"]["done"] );
			}
			else{
			  basic_redir( $GLOBALS["sections_url"] ) ;
			}
		  }
	}

	public static function select_sections(){
		$section = new sections_model();
		$section->load_data();
		$sections = $section->data;
		return $sections;
	}

	public function ordering($info){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		foreach($info["post"]["order"] as $k => $v){
			$typeId = explode("_", $v);

			if($typeId[0] == 'lesson'){
				$update["display_position"] = $k+1;
				$model = new lessons_model();					
				$model->set_filter( array( " idx = '" . $typeId[1] . "' " ) ) ;
				$model->populate( $update );
				$model->save();
			}

			if($typeId[0] == 'test'){
				$update["display_position"] = $k+1;
				$model = new tests_model();					
				$model->set_filter( array( " idx = '" . $typeId[1] . "' " ) ) ;
				$model->populate( $update );
				$model->save();
			}

			if($typeId[0] == 'survey'){
				$update["display_position"] = $k+1;
				$model = new surveys_model();					
				$model->set_filter( array( " idx = '" . $typeId[1] . "' " ) ) ;
				$model->populate( $update );
				$model->save();
			}

			if($typeId[0] == 'forum'){
				$update["display_position"] = $k+1;
				$model = new forum_model();					
				$model->set_filter( array( " idx = '" . $typeId[1] . "' " ) ) ;
				$model->populate( $update );
				$model->save();
			}
		}

		if( isset( $info["post"]["no-redirect"] ) ){
			print("ok");
		  }
		  else{
			if( isset( $info["post"]["done"] ) ){
			  basic_redir( $info["post"]["done"] ) ;
			}
			else{
			  basic_redir( $GLOBALS["sections_url"] ) ;
			}
		  }
	}

	public static function contents_section($info){

		$contents = [];
		$boiler = new sections_model();
		$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
		$boiler->load_data();	
		$boiler->attach( array( "lessons" )  );
		$boiler->attach(array("tests","surveys","forum"),true);	
		$data = current( $boiler->data ) ;			
		
		foreach( $data["lessons_attach"] as $lesson){			
			$contents[] = array("idx"=>$lesson["idx"],"title"=>$lesson["lessons_title"],"order"=>$lesson["display_position"],"type"=>"lesson");
		}
		foreach( $data["tests_attach"] as $test){			
			$contents[] = array("idx"=>$test["idx"],"title"=>$test["title"],"order"=>$test["display_position"],"type"=>"test");
		}
		foreach( $data["surveys_attach"] as $survey){			
			$contents[] = array("idx"=>$survey["idx"],"title"=>$survey["title"],"order"=>$survey["display_position"],"type"=>"survey");
		}
		foreach( $data["forum_attach"] as $forum){			
			$contents[] = array("idx"=>$forum["idx"],"title"=>$forum["title"],"order"=>$forum["display_position"],"type"=>"forum");
		}

		return $boiler->array_sort($contents, 'order', SORT_ASC);
	}

}
