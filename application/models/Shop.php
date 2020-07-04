<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for shop table
 */
class Shop extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'mk_shops', 'id', 'shop' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// default where clause
		if ( isset( $conds['no_publish_filter'] )) {
			$this->db->where( 'status', $conds['no_publish_filter'] );
		} else {
			$this->db->where('status',1);
		}

		// order by
		if ( isset( $conds['order_by'] )) {
			//echo "llll"; die;
			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];
			
			$this->db->order_by( 'mk_shops.'.$order_by_field, $order_by_type);
		}
	
		// id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// shop_id condition
		if ( isset( $conds['is_featured'] )) {
			$this->db->where( 'is_featured', $conds['is_featured'] );
		}

		// shop_id condition
		if ( isset( $conds['name'] )) {
			$this->db->where( 'name', $conds['name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->group_start();
			$this->db->like( 'name', $conds['searchterm'] );
			$this->db->or_like( 'name', $conds['searchterm'] );
			$this->db->group_end();
		}

		$this->db->order_by('added_date','desc');
	}
	
}
?>