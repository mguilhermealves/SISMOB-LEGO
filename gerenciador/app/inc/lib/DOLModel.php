<?php
class DOLModel extends rootOBJ {
	function __construct( $table ) {
		$c = new local_mysqli();
		$this->set_con( $c );
		$this->set_table( $table );
		$this->set_schema( $this->con->fields_config( $this->table ) );
		$keys = array();
		foreach( $this->schema as $key => $value){
			if( isset( $value["PK"] ) ){
				$keys["pk"][] = $key ;
			}
			if( isset( $value["UNI"] ) ){
				$keys["UNI"][] = $key ;
			}
		}
		$this->set_keys( $keys );
	}

	public function save(){
		if( isset( $this->field ) ){
			if( isset( $this->field["idx"] ) ){
				unset( $this->field["idx"] ) ;
			}
			$ff = implode( " , " , $this->field ) ;
			if( preg_match("/'/", $ff ) ){
				if( isset( $this->filter ) && is_array( $this->filter ) && count( $this->filter ) == 1 && ltrim( rtrim( $this->filter[0] ) ) == "active = 'yes'" ){
					unset( $this->filter );
				}
				if( isset( $this->filter ) && is_array( $this->filter ) ){
					$fi = " where " . implode( " and " , $this->filter ) . " " ;
					$pa = isset( $this->paginate ) ? " limit " . implode( " , " , $this->paginate ) . " " : "" ;
					$ff .= ", modified_at = now(), modified_by = '" . $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 ) . "'" ;
					return $this->con->update( $ff , $this->table, $fi . $pa );
				}
				else {
					$ff .= ", created_at = now(), created_by = '" . $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 ) . "'" ;
					return $this->con->insert( $ff, $this->table , null );
				}
			}
		}
		else {
			return false;
		}
	}

	public function remove(){
		if( isset( $this->filter ) ){
			$fi = " where " . implode( " and " , $this->filter ) . " " ;
			$pa = isset( $this->paginate ) ? " limit " . implode( " , " , $this->paginate ) . " " : "" ;
			$ff = " active = 'no', removed_at = now(), removed_by = '" . $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 ) . "'" ;
			return $this->con->update( $ff, $this->table, $fi . $pa );
		}
	}

	public function populate( $data , $encode = false ){
		$array = array();
		foreach( $this->schema as $key => $value ){
			if( isset( $data[ $key ] ) ){
				if( $encode === true ){
					$data[ $key ] = utf8_decode( $data[ $key ] ) ;
				}
				if ( !is_array( $data[ $key ]) && strtolower( $data[ $key ] ) ){
					$array[ $key ] = sprintf(
						" %s = '%s' "
						, $key
						, $this->con->real_escape_string( $data[ $key ] ) 
					) ; 
				}
			}
		}
		if( count( $array ) ){
			$this->set_field( $array ) ;
		}
	}

	public function return_data(){
		$this->load_data();
		return array( $this->recordset , $this->data ) ;
	}

	public function return_data_vw(){
		$this->load_data_vw();
		return array( $this->recordset , $this->data ) ;
	}

	public function _list_data( $value = "name" , $filter = array() , $key = "idx" , $order = "" ){
		$this->set_field( array( $key , $value ) ) ;
		$this->set_filter( count( $filter ) ? array_merge( array( " active = 'yes' " ) , $filter ) : array( " active = 'yes' " ) );
		$this->set_order( array( $order == "" ? preg_replace( "/.+ as (.+)$/" , "$1" , $value ) . " asc " : $order ) );
		$this->load_data();
		return $this->data;
	} 

	public function _current_data( $filter = array() , $fields = array() , $attach = array() , $attach_son = array() , $availabled = false ){
		$field = array( " idx " , " DATE_FORMAT( created_at , '%d/%m/%Y %H:%i' ) as created_at " , " DATE_FORMAT( modified_at , '%d/%m/%Y %H:%i' ) as modified_at " ) ;
		if( !count( $filter ) ){ $filter = array( " idx = -1 " ) ; }
		if( count( $fields ) ){ $field = array_merge( $field , $fields ) ; }
		$this->set_field( $field  ) ;
		$this->set_filter( $filter ) ;
		$this->set_paginate( array( 1 ) ) ;
		$this->load_data() ;

		if( count( $attach ) ){
			foreach( $attach as $k => $v ){
				$this->attach( array( $v["name"] ) , isset( $v["direction"] ) ? $v["direction"] : false , isset( $v["specific"] ) ? $v["specific"] : "" ) ;
			}
		}
		if( count( $attach_son ) ){
			foreach( $attach_son as $k => $v ){
				$classesfather = $v[0] ;
				$soon = $v[1] ;
				$classes = array( $soon["name"] ) ;
				$reverse_table = isset( $soon["direction"] ) ? $soon["direction"] : "" ;
				$options = isset( $soon["options"] ) ? $soon["options"] : "" ;
				$this->attach_son( $classesfather , $classes , $reverse_table , $options ) ;
			}		
		}
		if( $availabled != false && count( $availabled ) ){
			$this->data[0]["_availabe_attach"] = $availabled ;
			foreach ($availabled as $key => $value) {
				if( isset( $this->data[0][ $key . "_attach"][ 0 ] ) ){
					foreach( $this->data[0][ $key . "_attach"] as $k => $v ) {
						$this->data[0]["_availabe_attach"][ $key ][ "data" ][] = $v["idx"] ; 
					}
				}
			}
		}
		return current( $this->data ) ;
	}

	public function load_data(){
		$ff = isset( $this->field ) ? implode( "," , $this->field ) : " * " ;
		$fi = isset( $this->filter ) ? " where " . implode( " and " , $this->filter ) . " " : "" ;
		$or = isset( $this->order ) ? " order by " . implode( " , " , $this->order ) . " " : "" ;
		$gp = isset( $this->group ) ? " group by " . implode( " , " , $this->group ) . " " : "" ;
		$pa = isset( $this->paginate ) ? " limit " . implode( " , " , $this->paginate ) . " " : "" ;
		$r = $this->con->select( $ff, $this->table, $fi . $gp . $or . $pa );
		$this->set_data( $this->con->results( $r ) );
		$this->set_recordset( $this->con->result( $this->con->select( " count( " . implode(",", $this->keys["pk"] ) . ") as q " , $this->table, $fi . $gp ) , "q" , 0 ) );
	}

	public function load_data_vw(){
		$ff = isset( $this->field ) ? implode( "," , $this->field ) : " * " ;
		$fi = isset( $this->filter ) ? " where " . implode( " and " , $this->filter ) . " " : "" ;
		$or = isset( $this->order ) ? " order by " . implode( " , " , $this->order ) . " " : "" ;
		$gp = isset( $this->group ) ? " group by " . implode( " , " , $this->group ) . " " : "" ;
		$pa = isset( $this->paginate ) ? " limit " . implode( " , " , $this->paginate ) . " " : "" ;
		$r = $this->con->select( $ff, $this->table, $fi . $gp . $or . $pa );
		$this->set_data( $this->con->results( $r ) );
		$this->set_recordset( $this->con->result( $this->con->select( " count( 1 ) as q " , $this->table, $fi . $gp ) , "q" , 0 ) );
	}

	public function attach( $classes = array() , $reverse_table = null , $options = null , $class_field = null  ){
		$new_data = array() ;
		$_data = $this->data ;
		foreach( $_data as $key => $value ){
			$new_data[ $key ] = $value ;
			foreach( $classes as $class ){
				$r = $this->con->select(
					sprintf( "%s_id as k" , $class )
					, sprintf( "%s_%s" , $reverse_table ? $class : $this->table , $reverse_table ? $this->table : $class )
					, sprintf( " where active = 'yes' and %s_id = '%d'" , $this->table , $value["idx"] )
				) ;
				$filter_key = array( '0' );
				foreach( $this->con->results( $r ) as $key_r => $data ){ $filter_key[] = "'" . $data[ "k" ] . "'" ; } 
				$r = $this->con->select(
					isset( $class_field ) ? implode( ", " , $class_field ) : "*"
					, $class
					, sprintf( " where active = 'yes' and idx in (%s) %s " , implode( "," , array_unique( $filter_key ) ) , $options )
				) ;
				$new_data[ $key ][ $class."_attach" ] = $this->con->results( $r ) ;
			}
		}
		$this->set_data( $new_data ) ;
	}

	public function attach_all( $classes = array() , $reverse_table = null , $options = null , $class_field = null  ){
		$new_data = array() ;
		$_data = $this->data ;
		foreach( $_data as $key => $value ){
			$new_data[ $key ] = $value ;
			foreach( $classes as $class ){
				$r = $this->con->select(
					sprintf( "%s_id as k" , $class )
					, sprintf( "%s_%s" , $reverse_table ? $class : $this->table , $reverse_table ? $this->table : $class )
					, sprintf( " where %s_id = '%d' order by created_at DESC" , $this->table , $value["idx"] )
				) ;
				$filter_key = array( '0' );
				foreach( $this->con->results( $r ) as $key_r => $data ){ $filter_key[] = "'" . $data[ "k" ] . "'" ; } 
				$r = $this->con->select(
					isset( $class_field ) ? implode( ", " , $class_field ) : "*"
					, $class
					, sprintf( " where idx in (%s) %s order by created_at DESC" , implode( "," , array_unique( $filter_key ) ) , $options )
				) ;
				$new_data[ $key ][ $class."_attach" ] = $this->con->results( $r ) ;
			}
		}
		$this->set_data( $new_data ) ;
	}

	public function join( $name = null , $table = null , $fw_key = array() , $options = null , $field = null ){
		$new_data = array() ;
		$_data = $this->get_data() ;
		foreach( $_data as $key => $value ){
			$new_data[ $key ] = $value ;
			$flt = array( " active = 'yes' " ) ;
			foreach( (array)$fw_key as $fw_keys => $data_value ){
				if( isset( $value[ $data_value ] ) ){
					$flt[] = $fw_keys . " = '" . $value[ $data_value ]  . "' ";
				}
			}
			if( count( $flt ) > 1 || ! empty( $options ) ){
				$r = $this->con->select( isset( $field ) ? implode( ", " , $field ) : "*" , $table , " where " . implode( " and " , $flt ) . strtr( $options , array( "#IDX#" => $value["idx"] ) ) ) ;
				$new_data[ $key ][ $name."_attach" ] = $this->con->results( $r ) ;
			}
			else{
				$new_data[ $key ][ $name."_attach" ] = array() ;
			}
		}
		$this->set_data( $new_data ) ;
	}

	public function attach_son( $classesfather = "" , $classes = array() , $reverse_table = null , $options = null, $class_field = null  ){
		if( $classesfather != "" && isset( $classes ) && count( $classes ) ){
			$new_data = array() ;
			$_data = $this->data ;
			foreach( $_data as $key => $value ){
				$new_data[ $key ] = $value ;
				if( isset( $new_data[ $key ][ $classesfather . "_attach" ] ) && count( $new_data[ $key ][ $classesfather . "_attach" ] ) ){
					foreach( $new_data[ $key ][ $classesfather . "_attach" ] as $k => $v ){
						foreach( $classes as $class ){
							$r = $this->con->select(
								sprintf( "%s_id as k" , $class )
								, sprintf( "%s_%s" , $reverse_table ? $class : $classesfather , $reverse_table ? $classesfather : $class )
								, sprintf( " where active = 'yes' and %s_id = '%d'" , $classesfather, $this->con->real_escape_string( $v["idx"] ) )
							) ;
							$filter_key = array( '0' );
							foreach( $this->con->results( $r ) as $key_r => $data ){ $filter_key[] = $data[ "k" ] ; } 
							$r = $this->con->select(
								isset( $class_field[ $class ] ) ? implode( ", " , $class_field[ $class ] ) : "*"
								, $class
								, sprintf( " where active = 'yes' and idx in ('%s') %s " , implode( "','" , array_unique( $filter_key ) ) , ( $options != null ? preg_replace("/%s/im", $this->con->real_escape_string( $value["idx"] ) , $options ) : "" ) ) 
							) ;
							$new_data[ $key ][ $classesfather . "_attach" ][ $k ][ $class."_attach" ] = $this->con->results( $r ) ;
						}
					}
				}
			}
			$this->set_data( $new_data ) ;
		}
	}

	public function save_attach( $info , $classes = array() , $reverse_table = null ){
		foreach( $classes as $class ){
			if( isset( $info["post"][ $class . "_id" ] ) ){
				$execute = $info["post"][ $class . "_id" ] ;
				$varexecute = array() ;
				if( is_array( $execute ) && count( $execute ) ){
					$varexecute = $execute ;
				}
				elseif( !is_array( $execute ) && (int)$execute > 0 ){
					$varexecute[] = $execute ;
				}

				if( count( $varexecute ) ){
					$this->con->update(
						sprintf( " active = 'no' , removed_at = now() , removed_by = '%d' " , $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 ) )
						, sprintf( " %s_%s " , $reverse_table ? $class : $this->table , $reverse_table ? $this->table : $class )
						, sprintf( " where active='yes' and %s_id = '%d'" , $this->table , $this->con->real_escape_string( $info["idx"] ) )
					);
					foreach ( $varexecute as $var) {
						$sql = sprintf(
							"INSERT INTO %s ( %s, %s, created_by, created_at) VALUES( '%d' , '%d', %d , now() ) ON DUPLICATE KEY UPDATE active = 'yes', removed_at = NULL, removed_by = NULL, modified_at=now(), modified_by='%d' "
							, sprintf( " %s_%s " , $reverse_table ? $class : $this->table , $reverse_table ? $this->table : $class )
							, sprintf( " %s_id " , $class )
							, sprintf( " %s_id " , $this->table )
							, $this->con->real_escape_string( $var )
							, $this->con->real_escape_string( $info["idx"] )
							, $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 )
							, $this->con->real_escape_string( isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) ? $_SESSION[ constant("cAppKey") ]["credential"]["idx"] : 0 )
						) ;
						$this->con->query( $sql ) ;
					}
				}
			}
		}
	}
	public function array_sort($array, $on, $order=SORT_ASC){
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}

		return $new_array;
	}
}
?>