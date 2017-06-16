<?php //pr($pettyCashReceiptVouchers); exit; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Receipt Vouchers</span>
		</div>
	
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
				<?php $page_no=$this->Paginator->current('Receipts'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Leave Type</th>
							<th>Leave From</th>
							<th>Leave To</th>
							<th>Leave Status</th>
							
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($requestLeaves as $requestLeave): $i++; 
						
					?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h($requestLeave->leave_type->leave_name) ?></td>
							<td><?= h(date("d-m-Y",strtotime($requestLeave->leave_from))); ?></td>
							<td><?= h(date("d-m-Y",strtotime($requestLeave->leave_to))); ?></td>
							<td><?= h($requestLeave->leave_status) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
				
			</div>
		</div>
	

