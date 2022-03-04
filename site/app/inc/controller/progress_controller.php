<?php
class progress_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
        $filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
        $boiler = new progress_model();
        $boiler->set_field( array( $key , $field  ) ) ;
        $boiler->set_filter( $filters ) ;
        $boiler->set_order( array( $filed_name ) );
        $boiler->load_data();
        $out = array_column( $boiler->data , $filed_name , $key );
		return $out ;
	}
}
