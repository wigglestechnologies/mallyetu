 <div class="card-header"  style="border-top: 2px solid red;">
    <h3 class="card-title"><?php echo $panel_title; ?></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-widget="remove">
        <i class="fa fa-times"></i>
      </button>
    </div>
</div>
<!-- /.card-header -->
<div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">
    	<?php $count = $this->uri->segment(4) or $count = 0; ?>
            <?php if ( ! empty( $data )): ?>
              	<?php foreach($data as $d): ?>
				    <li class="item">
				        <div class="product-img">
				        	<?php 
                    $default_photo = get_default_photo( $d->id, 'product' ); 
                     if( $default_photo->img_path  != "") {
                  ?>
				          	<img src="<?php echo img_url( '/thumbnail/'. $default_photo->img_path ); ?>" alt="Product Image" class="img-size-50">
                  <?php } else if (!file_exists(img_url( 'thumbnail/'. $default_photo->img_path ))) { ?>

                      <img src="<?php echo img_url( 'thumbnail/avatar.png'); ?>" class="img-circle img-sm" alt="User Image">
                  <?php } else if ( $default_photo->img_path  == "" ) { ?>
                      <img src="<?php echo img_url( 'thumbnail/avatar.png'); ?>" class="img-circle img-sm" alt="User Image">
                  <?php } ?>
				        </div>
				        <div class="product-info">
				          <a href="javascript:void(0)" class="product-title"><?php echo $d->name; ?>
				            <span class="badge badge-warning float-right"><?php echo $this->Shop->get_one($d->shop_id)->currency_symbol . $d->unit_price; ?></span></a>
				          <span class="product-description">
				            <?php echo $d->description; ?>
				          </span>
				        </div>
				    </li>
				    <!-- /.item -->
      			<?php endforeach; ?>
            <?php endif; ?>
    </ul>
</div>
<div class="card-footer text-center">
    <a href="<?php echo site_url('/admin/products')?>" class="uppercase">View All Products</a>
</div>
<!-- /.card-footer -->