<?php $this->load->view( $template_path .'/partials/shop_nav' ); ?>
<?php $this->load->view( $template_path .'/'. $module_path .'/list'); ?>

	<?php $this->load->view( $template_path .'/partials/pag' ); ?>

<?php 
	$list_script_path = $template_path .'/'. $module_path .'/list_script';
	
	if ( is_view_exists( $list_script_path )) $this->load->view( $list_script_path ); 
?>