
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel">Edit Item opening balance</span>
		</div>
		
		<div class="actions">
			<?= $this->Html->link(
				'Add',
				'/Items/Opening-Balance',
				['class' => 'btn btn-default']
			); ?>
			<?= $this->Html->link(
				'View',
				'/Items/Opening-Balance-View',
				['class' => 'btn btn-default']
			); ?>
		</div>
	</div>
	<div class="portlet-body form">
	<?= $this->Form->create($ItemLedger,['id'=>'form_sample_3']) ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Item <span class="required" aria-required="true">*</span></label>
					<br/>
					<label><?php echo $Items->name; ?></label>
					<?php echo $this->Form->input('item_id', ['type' => 'hidden','value' =>$Items->id]); ?>
					
				</div>
			</div>
			<div class="col-md-5"></div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Date <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('date', ['type' => 'text','label' => false,'class' => 'form-control input-sm ','data-date-format' => 'dd-mm-yyyy','value' =>date("d-m-Y",strtotime($financial_year->date_from)),'readonly']); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Old Quantity <span class="required" aria-required="true">*</span></label>
					<?php 
					echo $this->Form->input('quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Quantity']); ?>
				</div>
			</div>
			<div class="col-md-2" id="hide_quantity">
				<div class="form-group">
					<label class="control-label">New Quantity <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('new_quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm','value' => 0,'placeholder'=>'New Quantity']); ?>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Rate <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('rate', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Rate']); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Value <span class="required" aria-required="true">*</span></label>
					<?php 
					echo $this->Form->input('value', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Value']); ?>
				</div>
			</div>
			<div class="col-md-1"  >
			
				<?php 
					echo $this->Form->input('serial_number_enable', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm','placeholder'=>'Value','value'=>$SerialNumberEnable[0]->serial_number_enable]); ?>
			</div>
		</div>
		
		<div class="row" >
			<div class="col-md-3" id="itm_srl_num"></div>
			<div class="col-md-4"></div>
			<div class="col-md-5" id="show_data" >
			 <table   class="table table-hover" >
				 <thead>
					<tr>
						<th width="20%">Sr. No.</th>
						<th>Serial Number</th>
						<th width="10%">Action</th>
						
					</tr>
				</thead>
				<tbody>
				<?php $i=0; foreach ($ItemSerialNumbers as $ItemSerialNumber){ $i++;?>
				<tr>
						<td><?= h($i) ?></td>
						<td><?= h($ItemSerialNumber->serial_no); ?></td>
						<td>
						 	
							<?= $this->Html->link('<i class="fa fa-trash"></i> ',
									['action' => 'DeleteSerialNumbers', $ItemSerialNumber->id, $ItemSerialNumber->item_id,$ItemLedger->id], 
									[
										'escape' => false,
										'class' => 'btn btn-xs red',
										'confirm' => __('Are you sure, you want to delete {0}?', $ItemSerialNumber->id)
									]
								) ?>
							
						</td>
					</tr>
				<?php  } ?>
				</tbody>
			</table>
			</div>
		</div>
		
		
		
		<button type="submit" class="btn blue-hoki">Submit</button>

		<?php 
		
		if(empty($ItemSerialNumbers[0]->serial_no)){?>
		
		<?= $this->Html->link('Delete',
							['action' => 'DeleteItemOpeningBalance', $ItemLedger->id], 
							[
								'escape' => false,
								'class'=>'btn btn-danger'
							]
						); 

		}?>
	<?= $this->Form->end() ?>
	</div>
</div>
