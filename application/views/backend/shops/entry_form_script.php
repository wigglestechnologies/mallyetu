<script>
	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {
		
		$('#shop-form').validate({
			rules:{
				name:{
					blankCheck : "",
					minlength: 3,
					remote: "<?php echo $module_site_url .'/ajx_exists/'.@$shop->id; ?>"
					
				},
				description:{
					required : true
				},
				shoptag:{
					required : true
				},
				cover:{
					required : true
				},
				icon:{
					required : true
				}
			},
			messages:{
				name:{
					blankCheck : "<?php echo get_msg( 'err_shop_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_shop_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_shop_exist' ) ;?>."
				},
				cover:{
					required : "<?php echo get_msg( 'err_image_missing' ) ;?>."
				},
				icon:{
					required : "<?php echo get_msg( 'err_icon_missing' ) ;?>."
				}
			}

		});

		// custom validation
		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			    	return true;
			   }
		})
		

	}
	

	<?php endif; ?>

	$('.delete-img').click(function(e){
			e.preventDefault();

			// get id and image
			var id = $(this).attr('id');

			// do action
			var action = '<?php echo $module_site_url .'/delete_cover_photo/'; ?>' + id + '/<?php echo @$shop->id; ?>';
			console.log( action );
			$('.btn-delete-image').attr('href', action);
			
		});

		$('.delete-shop').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		var image = $(this).attr('image');
		var action = '<?php echo site_url('/admin/shops/delete/');?>';
		$('.btn-delete-shop').attr('href', action + id);
	});
		
	$('#shoptag').change(function(){
		var shop_tag = $(this).val();

    	$('#tagselect').val(shop_tag);
    	
	});

	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

    		var target = $(e.target).attr("value") // activated tab
    		$('#current_tab').val(target);

	});
</script>

<?php 
	// replace cover photo modal
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'shop',
		'img_parent_id' => @$shop->id
	);
	
	$this->load->view( $template_path .'/components/shop_photo_upload_modal', $data );
	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_cover_photo_modal' );

	// replace icon photo modal
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'shop-icon',
		'img_parent_id' => @$shop->id
	);
	
	$this->load->view( $template_path .'/components/icon_upload_modal', $data );
	// delete icon photo modal
	$this->load->view( $template_path .'/components/delete_icon_modal' ); 
?>
