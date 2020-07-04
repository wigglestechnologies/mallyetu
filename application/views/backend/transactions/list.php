<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" class="table-responsive animated fadeInRight">
			
	<div class="card-body table-responsive p-0">
  
  		<table class="table m-0 table-striped">
			<?php $count = $this->uri->segment(4) or $count = 0; ?>

			<?php if ( !empty( $transactions ) && count( $transactions->result()) > 0 ): ?>
				<?php foreach($transactions->result() as $transaction): ?>
					
		  					<tbody style="font-size: 16px;">
			  					<tr>	
			  						<td style="width: 35%;">
			  							<?php
											echo $transaction->contact_name . "( Contact: " . $transaction->contact_phone . " )";
										?>
									</td>
									<td style="width: 10%;">
										<?php if ($transaction->trans_status_id == 1) { ?>
							                <span class="badge badge-danger">
							                  <?php echo $this->Transactionstatus->get_one( $transaction->trans_status_id )->title; ?>
							                </span>
							            <?php } elseif ($transaction->trans_status_id == 2) { ?>
							                <span class="badge badge-info">
							                  <?php echo $this->Transactionstatus->get_one( $transaction->trans_status_id )->title; ?>
							                </span>
							            <?php } elseif ($transaction->trans_status_id == 3) { ?>
							                <span class="badge badge-success">
							                  <?php echo $this->Transactionstatus->get_one( $transaction->trans_status_id )->title; ?>
							                </span>
							            <?php } else { ?>
							                <span class="badge badge-primary">
							                  <?php echo $this->Transactionstatus->get_one( $transaction->trans_status_id )->title; ?>
							                </span>
							            <?php } ?>
									</td>
									<td>
										<?php
											$detail_count = 0;
											$conds['transactions_header_id'] = $transaction->id;
											$detail_count =  $this->Transactiondetail->count_all_by( $conds );
											echo "<small style='padding: 0 50px'>" . $detail_count . " Items </small>";
										 ?>
									</td>
									<td>
										<?php echo $transaction->added_date; ?>
									</td>
									<td>
										<a herf='#' class='btn-delete' data-toggle="modal" data-target="#reportsmodal" id="<?php echo "$transaction->id";?>">
											<i class='fa fa-trash-o'></i>
										</a>
									</td>
									<td>
										<a class="pull-right btn btn-sm btn-primary" href="<?php echo $module_site_url . "/detail/" . $transaction->id;?>">
											Detail
										</a>
									</td>
								</tr>
							</tbody>
						
			
			<?php endforeach; ?>
			<?php else: ?>
					
				<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

			<?php endif; ?>
		</table>
	</div>
</div>
<script>
	// Delete Trigger
	$('.btn-delete').click(function(){
	
		// get id and links
		var id = $(this).attr('id');
		var btnYes = $('.btn-yes').attr('href');
		var btnNo = $('.btn-no').attr('href');

		// modify link with id
		$('.btn-yes').attr( 'href', btnYes + id );
		$('.btn-no').attr( 'href', btnNo + id );
	});
</script>
<?php
	// Delete Confirm Message Modal
	$data = array(
		'title' => get_msg( 'delete_trans_label' ),
		'message' =>  get_msg( 'trans_yes_all_message' ),
		'no_only_btn' => get_msg( 'cat_no_only_label' )
	);
	
	$this->load->view( $template_path .'/components/report_delete_confirm_modal', $data );
?>