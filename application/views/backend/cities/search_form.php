<div class='row my-3'>
	<div class='col-6'>
	<?php
		$attributes = array('class' => 'form-inline');
		echo form_open( $module_site_url .'/search', $attributes);
	?>
		
		<div class="form-group mr-3">

			<?php echo form_input(array(
				'name' => 'searchterm',
				'value' => set_value( 'searchterm' ),
				'class' => 'form-control form-control-sm',
				'placeholder' => get_msg( 'btn_search' )
			)); ?>

	  	</div>

	  	<div class="form-group" style="padding-right: 5px;">

			<?php
				$options=array();
				$conds['shop_id'] = $selected_shop_id;
				$options[0]=get_msg('select_country');
				$countries = $this->Country->get_all_by($conds);
				foreach($countries->result() as $country) {
					
						$options[$country->id]=$country->name;
				}

				echo form_dropdown(
					'country_id',
					$options,
					set_value( 'country_id', show_data( @$cities->country_id), false ),
					'class="form-control form-control-sm" id="country_id"'
				);
			?>

	  	</div>

	  	<div class="form-group" style="padding-right: 2px;">
		  	<button type="submit" class="btn btn-sm btn-primary">
		  		<?php echo get_msg( 'btn_search' )?>
		  	</button>
	  	</div>

	  	<div class="form-group">
		  	<a href='<?php echo $module_site_url; ?>' class='btn btn-sm btn-primary'>
				<?php echo get_msg( 'btn_reset' )?>
			</a>
	  	</div>

	<?php echo form_close(); ?>

	</div>	

	<div class='col-6'>
		<a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right'>
			<span class='fa fa-plus'></span> 
			<?php echo get_msg( 'city_add' )?>
		</a>
	</div>

</div>

