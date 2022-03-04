<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SERVER["DOCUMENT_ROOT"] = dirname( __FILE__ ) . "/../html/" ;
//$_SERVER["HTTP_HOST"] = "wikipet.hsollearn.com.br";
//putenv('SERVER_PORT=443');
//putenv('SERVER_PROTOCOL=https');

$_SERVER["DOCUMENT_ROOT"] = dirname( __FILE__ ) . "/../public_html/" ;
$_SERVER["HTTP_HOST"] = "wikipet.local";
putenv('SERVER_PORT=80');
putenv('SERVER_PROTOCOL=http');

putenv('SERVER_NAME='.$_SERVER["HTTP_HOST"]);
putenv('SCRIPT_NAME=index.php') ;
set_include_path( $_SERVER["DOCUMENT_ROOT"]  . PATH_SEPARATOR . get_include_path());
require_once( $_SERVER["DOCUMENT_ROOT"] . "../app/inc/main.php");

function find($path, $name = "x"){
	$dir_iterator = new RecursiveDirectoryIterator($path);
	$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
	foreach ($iterator as $file) {
		if ($file->isFile()) {
			if ( preg_match("/.+(" . $name . ")$/",basename( $file->getPathname() )) ) {
				return $file->getPathname();
			}
		}
	}
	return false;
}
$progress_model = new progress_model();

foreach( array( find( $_SERVER["DOCUMENT_ROOT"] .  "furniture/upload/progress/" , ".sql" ) ) as $v ){
    if( $v != "" ){
        $context = file_get_contents( $v );
	    $progress_model->con->my_query( $context ) ;
        unlink( $v );
    }
}

foreach( $progress_model->con->results( $progress_model->con->select( " progress.users_id 
, courses_sections.courses_id " , " progress left join tests_sections on ( tests_sections.tests_id = progress.object_id and progress.type = 'test' and tests_sections.active = 'yes' ) left join sections_lessons on ( sections_lessons.lessons_id = progress.object_id and progress.type = 'lesson' and sections_lessons.active = 'yes' ) inner join courses_sections on ( courses_sections.sections_id = ( ifnull( sections_lessons.sections_id ,tests_sections.sections_id ) ) and courses_sections.active = 'yes' ) " , " where progress.active = 'yes' and progress.calculate = 'no' group by progress.users_id , courses_sections.courses_id " ) ) as $v ){
    $valor = course_controller::verifyAllprogress( $v["courses_id"] , $v["users_id"] );
    $progress_model->con->my_query( "update progress set active = 'no', remove_at=now() where users_id = '".$v["users_id"]."' and type in ( 'course' ) and calculate = 'yes' " ) ;
    $txt = "INSERT INTO `progress`";
    $txt .= "(`created_at`,`type`,`users_id`,`object_id`,`video_progress`,`valor`,`complete`,`calculate`)";
    $txt .= "VALUES	(now(),'course',".$v["users_id"].",".$v["courses_id"].",0,".$valor.",'".($valor==100?'yes':'no')."','yes');";
    $progress_model->con->my_query( $txt ) ;
    $progress_model->con->my_query( "update progress set calculate = 'yes' where users_id = '".$v["users_id"]."' and type in ( 'lesson' , 'test' ) and calculate = 'no' " ) ;
}
?>
