<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
</style>

<?php   
if(!empty($copy))
{
	//pr($salesOrder->po_date); exit;
		$salesOrder->po_date=date(("d-m-Y"),strtotime($salesOrder->po_date));
		$salesOrder->expected_delivery_date=date(("d-m-Y"),strtotime($salesOrder->expected_delivery_date	));
	
}
?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Add Sales Order</span>
			<?php if($process_status=='Pulled From Quotation'){ ?>
			<br/><span style=" font-size: 13px; ">Converting Quotation: <?= h(($quotation->qt1.'/QO-'.str_pad($quotation->qt2, 3, '0', STR_PAD_LEFT).'/'.$quotation->qt3.'/'.$quotation->qt4)) ?></span>
			<?php } ?>
		</div>

		<div class="actions">
			<div class="btn-group">
				<button id="btnGroupVerticalDrop5" type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
				Pull Quotation <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop5">
					<li>
					   <?php echo $this->Html->link(' Keep Open Quotation','/Quotations/index?pull-request=true',array('escape'=>false)); ?>
					</li>
					<li>
					   <?php echo $this->Html->link('Close Quotation','/Quotations/index?pull-request=true&&status=close',array('escape'=>false)); ?>
					</li>
				</ul>
			</div>
        </div>

		
		<div class="actions">
			<?php echo $this->Html->link('<i class="fa fa-files-o"></i> Copy Sales Order','/SalesOrders/index?copy-request=copy',array('escape'=>false,'class'=>'btn btn-xs green')); ?>
		</div>
	</div>
	<?php  
	if($sales_id){
		$salesOrder_data=$salesOrder_data;
		
	}else{
		
		$salesOrder_data=$salesOrder_data;
	}
	?>
	
	
	<div class="portlet-body form">
		<?=   $this->Form->create($salesOrder_data,['id'=>'form_sample_3']) ?>
		<div class="form-body">
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="col-md-3 control-label">Date</label>
						<div class="col-md-9">
							<?php echo $this->Form->input('created_on', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => date("d-m-Y"),'readonly']); ?>
						</div>
					<span style="color: red;"><?php if($chkdate == 'Not Found'){  ?>
					You are not in Current Financial Year
				<?php } ?></span>	
					</div>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Customer</label>
						<div class="col-md-9">
						
							<?php 
							$options=array();
							foreach($customers as $customer){
								if(empty($customer->alias)){
									$merge=$customer->customer_name;
								}else{
									$merge=$customer->customer_name.'	('.$customer->alias.')';
								}
								
								$options[]=['text' =>$merge, 'value' => $customer->id, 'contact_person' => $customer->contact_person, 'employee_id' => $customer->employee_id, 'transporter_id' => $customer->transporter_id, 'documents_courier_id' => @$customer->customer_address[0]->transporter_id, 'dispatch_address' => @$customer->customer_address[0]->address];
							}
							if($sales_id){
								echo $this->Form->input('customer_id', ['empty' => "--Select--",'label' => false,'options' => $options,'class' => 'form-control input-sm select2me','value' => @$salesOrder->customer_id]);
								
							}else{
								echo $this->Form->input('customer_id', ['empty' => "--Select--",'label' => false,'options' => $options,'class' => 'form-control input-sm select2me','value' => @$quotation->customer_id]);
								
							} ?>
							
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Sales Order No.</label>
						<div class="col-md-3 padding-right-decrease">
							<?php echo $this->Form->input('so1', ['label' => false,'class' => 'form-control input-sm','readonly','value'=>$Company->alias]); ?>
						</div>
						<div class="col-md-3 padding-right-decrease" id="so3_div">
						<?php
							$options=array();
							foreach($Filenames as $Filenames){
								$merge=$Filenames->file1.'-'.$Filenames->file2.'' ;
								
								$options[]=['text' =>$merge, 'value' => $merge];
							}
							echo $this->Form->input('so3', ['options'=>$options,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
						<div class="col-md-3">
							<?php echo $this->Form->input('so4', ['label' => false,'value'=>substr($s_year_from, -2).'-'.substr($s_year_to, -2),'class' => 'form-control input-sm','readonly']); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Address</label>
						<div class="col-md-9">
							<?php 
							if($sales_id){
								echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control','placeholder' => 'Address','value' => @$salesOrder->customer_address]);
								
							}else{
							echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control','placeholder' => 'Address','value' => @$quotation->customer_address]);
							} ?>
							<a href="#" role="button" class="pull-right select_address" >
							Select Address </a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Salesman</label>
						<div class="col-md-9">
							<?php
							if($sales_id){
								echo $this->Form->input('employee_id', ['empty' => "--Select--",'label' => false,'options' => $employees,'class' => 'form-control input-sm select2me','value' => @$salesOrder->employee_id]);
								
							}else{
							echo $this->Form->input('employee_id', ['empty' => "--Select--",'label' => false,'options' => $employees,'class' => 'form-control input-sm select2me','value' => @$quotation->employee_id]); }?>
						</div>
					</div>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">Customer PO NO <span class="required" aria-required="true">*</span></label>
						<div class="col-md-9">
							<?php
							if($sales_id){
								echo $this->Form->input('customer_po_no', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => @$salesOrder->customer_po_no]);
								
							}else{
							echo $this->Form->input('customer_po_no', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Customer PO NO']); 
							} ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-3 control-label">PO Date <span class="required" aria-required="true">*</span></label>
						<div class="col-md-9">
							<?php
								if($sales_id){
								echo $this->Form->input('po_date', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => @$salesOrder->customer_po_no]);
								
							}else{
								echo $this->Form->input('po_date', ['type'=>'text','label' => false,'class' => 'form-control input-sm date-picker','placeholder'=>'PO Date','data-date-format'=>'dd-mm-yyyy'
							 ]);
							} ?>
						</div>
					</div>
				</div>
			</div>
			<br/>
			<table class="table tableitm" id="main_tb">
				<thead>
					<tr>
						<th width="50">S No</th>
						<th>Items</th>
						<th width="130">Quantity</th>
						<th width="130">Rate</th>
						<th width="130">Amount</th>
						<th width="100">Excise Duty</th>
						<th width="90">Sale Tax</th>
						<th width="70"></th>
					</tr>
				</thead>
				<tbody id="main_tbody">
					<?php  
					if(!empty($process_status=="Pulled From Quotation") || !empty($quotation)) 
					{ pr ($copy); exit;
					if(!empty($quotation->quotation_rows)){
					$q=0; foreach ($quotation->quotation_rows as $quotation_rows): 
					if($quotation_rows->quantity==$quotation_rows->proceed_qty){$disable_class="disabledbutton";
					}else{ $disable_class=""; } 
					?>
						<tr class="tr1 <?php echo $disable_class; ?> maintr" row_no='<?php echo @$quotation_rows->id; ?>'>
							<td rowspan="2"><?php echo ++$q; --$q; ?></td>
							<td>

								<div class="row">
									<div class="col-md-10 padding-right-decrease">
										<?php echo $this->Form->input('sales_order_rows.'.$q.'.item_id', ['empty'=>'Select','options' => $items,'label' => false,'class' => 'form-control input-sm  item_box item_id','placeholder'=>'Item','value' => @$quotation_rows->item->id ,'popup_id'=>$q]); ?>
									</div>
									<div class="col-md-1 padding-left-decrease">
										<a href="#" class="btn btn-default btn-sm popup_btn" role="button" popup_id="<?php echo $q; ?>"> <i class="fa fa-info-circle"></i> </a>
										<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: none; padding-right: 12px;" popup_div_id="<?php echo $q; ?>"><div class="modal-backdrop fade in" ></div>
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body" popup_ajax_id="<?php echo $q; ?>">
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn default closebtn">Close</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm quantity','max'=>@$quotation_rows->quantity-$quotation_rows->proceed_qty,'placeholder'=>'Quantity','value' => @$quotation_rows->quantity-$quotation_rows->proceed_qty]); ?></td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.rate', ['type'=>'text','label' => false,'class' => 'form-control input-sm quantity','placeholder'=>'Rate','min'=>'0.01','value' => @$quotation_rows->rate,'r_popup_id'=>$q]); ?></td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.amount', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Amount','value' => @$quotation_rows->amount]); ?></td>
							<td><?php 
							$options=['Yes'=>'Yes','No'=>'No'];
							echo $this->Form->input('sales_order_rows.'.$q.'.excise_duty', ['options'=>$options,'label' => false,'class' => 'form-control input-sm']); ?></td>
							<td>
							<?php $options=[];
							foreach($SaleTaxes as $SaleTaxe){ 
								$options[]=['text' => (string) $SaleTaxe->tax_figure, 'value' => $SaleTaxe->id, 'description' => $SaleTaxe->quote_description];
							} 
							echo $this->Form->input('sales_order_rows.'.$q.'.sale_tax_id', ['options'=>$options,'label' => false,'class' => 'form-control input-sm change_des']);
							//echo $this->Form->input('sales_order_rows.'.$q.'.
							//', ['type'=>'text','label' => false]); ?>
							</td>
							<td><a class="btn btn-xs btn-default addrow" href="#" role='button'><i class="fa fa-plus"></i></a><a class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-times"></i></a></td>
						</tr>
						<tr class="tr2 <?php echo $disable_class; ?> maintr" row_no='<?php echo @$quotation_rows->id; ?>'>
							<td colspan="6">
							<div class="note-editable" id="summer<?php echo $q; ?>" ><?php echo $quotation_rows->description; ?></div>
							</td>
							<td></td>
						</tr>
					<?php $q++; endforeach; } } elseif(!empty($copy)) { 
					if(!empty($salesOrder->sales_order_rows)){
					$q=0; foreach ($salesOrder->sales_order_rows as $sales_order_rows): ?>
						<tr class="tr1 maintr" row_no='<?php echo @$sales_order_rows->id; ?>'>
							<td rowspan="2"><?php echo ++$q; --$q; ?></td>
							<td>
							<div class="row">
									<div class="col-md-10 padding-right-decrease">
										<?php echo $this->Form->input('sales_order_rows.'.$q.'.item_id', ['empty'=>'Select','options' => $items,'label' => false,'class' => 'form-control input-sm select2me item_box item_id','value' => @$sales_order_rows->item->id,'popup_id'=>$q]); ?>
									</div>
									<div class="col-md-1 padding-left-decrease">
										<a href="#" class="btn btn-default btn-sm popup_btn" role="button" popup_id="<?php echo $q; ?>"> <i class="fa fa-info-circle"></i> </a>
										<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: none; padding-right: 12px;" popup_div_id="<?php echo $q; ?>"><div class="modal-backdrop fade in" ></div>
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body" popup_ajax_id="<?php echo $q; ?>">
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn default closebtn">Close</button>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							
							</td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm quantity','placeholder'=>'Quantity','value' => @$sales_order_rows->quantity]); ?></td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.rate', ['type'=>'text','label' => false,'class' => 'form-control input-sm quantity','placeholder'=>'Rate','value' => @$sales_order_rows->rate,'r_popup_id'=>$q]); ?></td>
							<td><?php echo $this->Form->input('sales_order_rows.'.$q.'.amount', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Amount','value' => @$sales_order_rows->amount]); ?></td>
							<td><?php 
							$options=['Yes'=>'Yes','No'=>'No'];
							echo $this->Form->input('sales_order_rows.'.$q.'.excise_duty', ['options'=>$options,'label' => false,'class' => 'form-control input-sm']); ?></td>
							<td>
							<?php $options=[];
							foreach($SaleTaxes as $SaleTaxe){ 
								$options[]=['text' => (string) $SaleTaxe->tax_figure, 'value' => $SaleTaxe->id, 'description' => $SaleTaxe->quote_description];
							} 
							echo $this->Form->input('sales_order_rows.'.$q.'.sale_tax_id', ['options'=>$options,'label' => false,'class' => 'form-control input-sm change_des']);
							?>
							</td>
							<td><a class="btn btn-xs btn-default addrow" href="#" role='button'><i class="fa fa-plus"></i></a><a class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-times"></i></a></td>
						</tr>
						<tr class="tr2 maintr" row_no='<?php echo @$sales_order_rows->id; ?>'>
							<td colspan="6" class="main">
								<div class="note-editable" id="summer<?php echo $q; ?>" ><?php echo $sales_order_rows->description; ?></div>
							</td>
							<td></td>
						</tr>
					<?php $q++; endforeach; } } ?>
				</tbody>
			</table>
			<table class="table tableitm" id="tbl2">
				<tr>
					<td  align="right">
					<b>Discount <label><?php echo $this->Form->input('discount_type', ['type' => 'checkbox','label' => false,'class' => 'form-control input-sm','id'=>'discount_per']); ?></label>(in %)</b>
					<div class="input-group col-md-2" style="display:none;" id="discount_text">
						<input type="text" name="discount_per" class="form-control input-sm" placeholder="5.5"  'step'=0.01><span class="input-group-addon">%</span>
					</div>
					</td>
					<td><?php echo $this->Form->input('discount', ['type' => 'number','label' => false,'class' => 'form-control input-sm','placeholder' => 'Discount','step'=>0.01]); ?></td>
				</tr>
				
				
				<tr>
					<td align="right"><b>Total</b></td>
					<td width="20%"><?php echo $this->Form->input('total', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Total','value' => 0,'step'=>0.01,'readonly']); ?></td>
				</tr>
				<tr>
					<td  align="right">
					<b>P&F <label><?php echo $this->Form->input('pnf_type', ['type' => 'checkbox','label' => false,'class' => 'form-control input-sm','id'=>'pnfper']); ?></label>(in %)</b>
					<div class="input-group col-md-2" style="display:none;" id="pnf_text">
						<input type="text" name="pnf_per" class="form-control input-sm" placeholder="5.5"  'step'=0.01><span class="input-group-addon">%</span>
					</div>
					</td>
					<td><?php echo $this->Form->input('pnf', ['type' => 'number','label' => false,'class' => 'form-control input-sm','placeholder' => 'P&F','step'=>0.01]); ?></td>
				</tr>
				<tr>
					<td  align="right"><b>Total after P&F </b></td>
					<td><?php echo $this->Form->input('total_after_pnf', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Total after P&F','readonly','step'=>0.01]); ?></td>
				</tr>

			</table>

			
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Transporter <span class="required" aria-required="true">*</span></label>
						<?php
							echo $this->Form->input('transporter_id', ['empty' => "--Select--",'label' => false,'options' => $transporters,'class' => 'form-control input-sm select2me','value' => @$quotation->customer->transporter_id]);  ?>
					</div>
					<br/>
					<div class="form-group">
						<label class="control-label">Documents Courier <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('documents_courier_id', ['empty' => "--Select--",'label' => false,'options' => $transporters,'class' => 'form-control input-sm select2me','value' => @$quotation->customer->customer_address[0]->transporter_id]); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Expected Delivery Date <span class="required" aria-required="true">*</span></label>
						<?php
							if($sales_id){
							 echo $this->Form->input('expected_delivery_date', ['type'=>'text','label' => false,'class' => 'form-control input-sm date-picker','placeholder'=>'PO Date','data-date-format'=>'dd-mm-yyyy','value'=>date("d-m-Y",strtotime($salesOrder->expected_delivery_date))
							 ]);
								
							}else{
								echo $this->Form->input('expected_delivery_date', ['type'=>'text','label' => false,'class' => 'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy'
							 ]);
							} ?>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Delivery Description <span class="required" aria-required="true">*</span></label>
						<?php 
						if($sales_id){
							echo $this->Form->input('delivery_description', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Delivery Description','value'=>$salesOrder->delivery_description]); 
							
						}else{
							echo $this->Form->input('delivery_description', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Delivery Description']); 
						}
						
						?>
					</div>
				</div>
			</div>
			<h4>Dispatch Details</h4>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
						<?php 
						if($sales_id){
							echo $this->Form->input('dispatch_name', ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Name','value'=>$salesOrder->dispatch_name]); 
							
						}else{
							echo $this->Form->input('dispatch_name', ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Name']); 
						}
						
						?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Mobile <span class="required" aria-required="true">*</span></label>
						<?php 
						if($sales_id){
							echo $this->Form->input('dispatch_mobile', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Mobile','value'=>$salesOrder->dispatch_mobile]); 
							
						}else{
							echo $this->Form->input('dispatch_mobile', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Mobile']); 
						}
						?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Email <span class="required" aria-required="true">*</span></label>
						<?php 
						if($sales_id){
							echo $this->Form->input('dispatch_email', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Email','value'=>$salesOrder->dispatch_email]); 
							
						}else{
							echo $this->Form->input('dispatch_email', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Email']); 
						}
						 ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Address  <span class="required" aria-required="true">*</span></label>
						<?php 
						if($sales_id){
							echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Email','value'=>$salesOrder->customer_address]); 
							
						}else{
							echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Email']); 
						}
						
					?>
					</div>
				</div>
				
				
			</div>
			<div class="row">
				
				<div class="col-md-4">
					<div class="form-group">
						<div class="radio-list" data-error-container="#road_permit_required_error">
						<label class="control-label">Road Permit Required <span class="required" aria-required="true">*</span></label>
						<?php 
						
						echo $this->Form->radio('road_permit_required',[['value' => 'Yes', 'text' => 'Yes'],['value' => 'No', 'text' => 'No']]); ?>
						</div>
						<div id="road_permit_required_error"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<div class="radio-list" data-error-container="#form49_error">
						<label class="control-label">Form-49 Required <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->radio('form49',[['value' => 'Yes', 'text' => 'Yes'],['value' => 'No', 'text' => 'No']]); ?>
						</div>
						<div id="form49_error"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Additional Note  <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('additional_note', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Additional Note','value' => @$quotation->customer_address]); ?>
					</div>
				</div>
			</div>
			<br/>
		</div>
		<?php echo $this->Form->input('process_status', ['type' => 'hidden','value' => @$process_status]); ?>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<?php if($chkdate == 'Not Found'){  ?>
					<label class="btn btn-danger"> You are not in Current Financial Year </label>
				<?php } else { ?>
					<button type="submit" class="btn btn-primary" id='submitbtn' >ADD SALES ORDER</button>
				<?php } ?>	
					</div>
			</div>
		</div>
		
		<?= $this->Form->end() ?>
	</div>
</div>
<style>
.table thead tr th {
    color: #FFF;
	background-color: #254b73;
}
.padding-right-decrease{
	padding-right: 0;
}
.padding-left-decrease{
	padding-left: 0;
}
</style>


<table id="sample_tb" style="display:none;">
	<tbody>
		<tr class="tr1 preimp maintr">
			<td rowspan="2" width="10">0</td>
			<td>
				<div class="row">
					<div class="col-md-10 padding-right-decrease">
						<?php echo $this->Form->input('item_id', ['empty'=>'Select','options' => $items,'label' => false,'class' => 'form-control input-sm item_box item_id','placeholder' => 'Item']); ?>
					</div>
					
				</div>
			</td>
			<td width="100"><?php echo $this->Form->input('unit[]', ['type' => 'type','label' => false,'class' => 'form-control input-sm quantity','placeholder' => 'Quantity']); ?></td>
			<td width="100"><?php echo $this->Form->input('rate[]', ['type' => 'text','label' => false,'class' => 'form-control input-sm quantity','placeholder' => 'Rate','step'=>"0.01"]); ?>
			</td>
			<td width="100"><?php echo $this->Form->input('amount[]', ['type' => 'text','label' => false,'class' => 'form-control input-sm','placeholder' => 'Amount']); ?></td>
			<td width="100"><?php 
			$options=['Yes'=>'Yes','No'=>'No'];
			echo $this->Form->input('excise_duty', ['options'=>$options,'label' => false,'class' => 'form-control input-sm']); ?></td>
			<td width="100">
			<?php $options=[];
							foreach($SaleTaxes as $SaleTaxe){ 
								$options[]=['text' => (string) $SaleTaxe->tax_figure, 'value' => $SaleTaxe->id, 'description' => $SaleTaxe->quote_description];
							} 
							echo $this->Form->input('sale_tax_id', ['options'=>$options,'label' => false,'class' => 'form-control input-sm change_des']);
			?>
			</td>
			<td width="70"><a class="btn btn-xs btn-default addrow" href="#" role='button'><i class="fa fa-plus"></i></a><a class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-times"></i></a></td>
		</tr>
		<tr class="tr2 preimp maintr">
			<td colspan="6" class="main"></td>
		</tr>
	</tbody>
</table>

<div id="terms_conditions" style="display:none;">
</div>



<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	jQuery.validator.addMethod("notEqualToGroup", function (value, element, options) {
		// get all the elements passed here with the same class
		var elems = $(element).parents('form').find(options[0]);
		// the value of the current element
		var valueToCompare = value;
		// count
		var matchesFound = 0;
		// loop each element and compare its value with the current value
		// and increase the count every time we find one
		jQuery.each(elems, function () {
			thisVal = $(this).val();
			if (thisVal == valueToCompare) {
				matchesFound++;
			}
		});
		// count should be either 0 or 1 max
		if (this.optional(element) || matchesFound <= 1) {
			//elems.removeClass('error');
			return true;
		} else {
			//elems.addClass('error');
		}
	}, jQuery.format(""))
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		
		rules: {
			company_id:{
				required: true,
			},
			date : {
				  required: true,
			},
			customer_id : {
				  required: true,
			},
			so1 : {
				  required: true,
			},
			so3:{
				required: true
			},
			so4:{
				required: true,
			},
			customer_address:{
				required: true,
			},
			employee_id : {
				  required: true,
			},
			customer_po_no  : {
				  required: true,
			},
			po_date: {
				  required: true,
			},
			transporter_id:{
				required: true,	
			},
			documents_courier_id:{
				required: true,	
			},
			expected_delivery_date:{
				required: true,	
			},
			delivery_description:{
				required: true,	
			},
			dispatch_name:{
				required: true,	
			},
			dispatch_mobile:{
				required: true,
				digits: true,
				minlength: 10,
				maxlength: 10,
			},
			dispatch_email:{
				required: true,
				email: true,
			},
			road_permit_required:{
				required: true,
			},
			form49:{
				required: true,
			}
		},

		messages: { // custom messages for radio buttons and checkboxes
			membership: {
				required: "Please select a Membership type"
			},
			service: {
				required: "Please select  at least 2 types of Service",
				minlength: jQuery.validator.format("Please select  at least {0} types of Service")
			}
		},

		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			put_code_description();
			success3.hide();
			error3.show();
			//Metronic.scrollTo(error3, -200);
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').text('Submitting.....');
			put_code_description();
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	//--	 END OF VALIDATION
	
	
	$("#pnfper").on('click',function(){
		
		if($(this).is(':checked')){
			$("#pnf_text").show();
			$('input[name="pnf"]').attr('readonly','readonly');
			$('input[name="pnf_per"]').val(0);
			
		}else{
			$("#pnf_text").hide();
			$('input[name="pnf"]').removeAttr('readonly');
			$('input[name="pnf"]').val(0);
			$('input[name="pnfper"]').val(0);
			
		}
				calculate_total();
	})
	
	$("#discount_per").on('click',function(){
		if($(this).is(':checked')){
			$("#discount_text").show();
			$('input[name="discount"]').attr('readonly','readonly');
			
			
		}else{
			$("#discount_text").hide();
			$('input[name="discount"]').removeAttr('readonly');
			$('input[name="discount_per"]').val(0);
			$('input[name="discount"]').val(0);
			
		}
		calculate_total();
	})

	<?php if($process_status=="New" ){ ?> add_row(); 
	$("#main_tb tbody tr.tr1").each(function(){
		var description=$(this).find("td:nth-child(7) select option:selected").attr("description");
		$(this).closest("td").find('input').val(description);
	});
	<?php } ?>
	
    $('.addrow').die().live("click",function() { 
		add_row();
    });
	
	$('.change_des').die().live("change",function() { 
		var description=$(this).find('option:selected').attr("description");
		$(this).closest("td").find('input:eq(0)').val(description);
		var ledger_account_id=$(this).find('option:selected').attr("ledger_account_id");
		$(this).closest("td").find('input:eq(1)').val(ledger_account_id);
    });
	
	
	$("#main_tb tbody tr.tr1").each(function(){
		var description=$(this).find("td:nth-child(7) select option:selected").attr("description");
		$(this).find("td:nth-child(7) input").val(description);
	});
	
	
	$('.deleterow').die().live("click",function() {
		var l=$(this).closest("table tbody").find("tr").length;
		if (confirm("Are you sure to remove row ?") == true) {
			if(l>2){
				var row_no=$(this).closest("tr").attr("row_no");
				var del="tr[row_no="+row_no+"]";
				$(del).remove();
				rename_rows();
				calculate_total();
			}
		} 
    });
	
	function add_row(){
		var tr1=$("#sample_tb tbody tr.tr1").clone();
		$("#main_tb tbody#main_tbody").append(tr1);
		var tr2=$("#sample_tb tbody tr.tr2").clone();
		$("#main_tb tbody#main_tbody").append(tr2);
		
		var w=0; var r=0;
		$("#main_tb tbody#main_tbody tr.maintr").each(function(){
			$(this).attr("row_no",w);
			r++;
			if(r==2){ w++; r=0; }
		});
		rename_rows();
	}
	rename_rows();
	calculate_total();
	function rename_rows(){
		var i=0;
		
		$("#main_tb tbody tr.tr1").each(function(){
		    $(this).find('span.help-block-error').remove();
			$(this).find("td:nth-child(1)").html(++i); --i;
			//$(this).find("td:nth-child(2) select").attr({name:"sales_order_rows["+i+"][item_id]", id:"sales_order_rows-"+i+"-item_id",popup_id:i}).select2().rules("add", "required");
			$(this).find("td:nth-child(2) select").attr({name:"sales_order_rows["+i+"][item_id]", id:"sales_order_rows-"+i+"-item_id",popup_id:i}).select2().rules('add', {
						required: true,
						notEqualToGroup: ['.item_id'],
						messages: {
							notEqualToGroup: "Do not select same Item again."
						}
					});
			$(this).find("td:nth-child(3) input:eq( 0 )").attr({name:"sales_order_rows["+i+"][quantity]", id:"sales_order_rows-"+i+"-quantity"}).rules('add', {
						required: true,
						digits: true,
						min: 1,
						messages: {
							min: "Quantity can't be zero."
						}
					});
				//$(this).find("td:nth-child(3)").append('<span for="sales_order_rows-'+i+'-quantity" class="help-block help-block-error" style="display:none;"></span>');
					
			$(this).find("td:nth-child(4) input").attr({name:"sales_order_rows["+i+"][rate]", id:"sales_order_rows-"+i+"-rate",r_popup_id:i}).rules('add', {
						required: true,
						number: true,
						min: 0.01
					});
			$(this).find("td:nth-child(5) input").attr({name:"sales_order_rows["+i+"][amount]", id:"sales_order_rows-"+i+"-amount"}).rules("add", "required");
			$(this).find("td:nth-child(6) select").attr("name","sales_order_rows["+i+"][excise_duty]");
			$(this).find("td:nth-child(7) select").attr("name","sales_order_rows["+i+"][sale_tax_id]");
			$(this).find("td:nth-child(7) input:eq( 0 )").attr("name","sales_order_rows["+i+"][sale_tax_description]");
			var description=$(this).find("td:nth-child(7) select option:selected").attr("description");
			$(this).find("td:nth-child(7) input:eq( 0 )").val(description);
			$(this).find("td:nth-child(7) input:eq( 1 )").attr("name","sales_order_rows["+i+"][sale_tax_ledger_account_id]");
			var ledger_account_id=$(this).find("td:nth-child(7) select option:selected").attr("ledger_account_id");
			$(this).find("td:nth-child(7) input:eq( 1 )").val(ledger_account_id);
		i++; });
		
		var i=0;
		$("#main_tb tbody tr.tr2").each(function(){
			var htm=$(this).find('td:nth-child(1)').find('div.note-editable').html();
			
			if(!htm){ htm=""; }
			$(this).find('td:nth-child(1)').html('');
			$(this).find('td:nth-child(1)').append('<div id=summer'+i+'>'+htm+'</div>');
			$(this).find('td:nth-child(1)').find('div#summer'+i).summernote();
			$(this).find('td.main:nth-child(1)').append('<textarea name="sales_order_rows['+i+'][description]"style="display:none;"></textarea>');
		i++; });
		
		

		$("select.item_box").each(function(){
			var popup_id=$(this).attr('popup_id');
			var item_id=$(this).val();
			if(popup_id){
				last_three_rates_onload(popup_id,item_id);
			}
		});
	}
	put_code_description();
	function put_code_description(){
			var i=0;
			$("#main_tb tbody#main_tbody tr.tr2").each(function(){
				var row_no=$(this).attr('row_no');		
				var code=$(this).find('div#summer'+i).code();
				$('#main_tb tbody tr.tr2[row_no="'+row_no+'"]').find('td:nth-child(1) textarea').val(code);
			i++; });
		}
	
	$('#main_tb input,#tbl2 input').die().live("keyup","blur",function() { 
		calculate_total();
    });
	$('#main_tb select').die().live("change",function() {
		calculate_total();
    });
	
	function calculate_total(){
		var total=0; var grand_total=0;
		$("#main_tb tbody tr.tr1").each(function(){
			var qty=$(this).find("td:nth-child(3) input").val();
			var Rate=$(this).find("td:nth-child(4) input").val();
			var Amount=qty*Rate;
			$(this).find("td:nth-child(5) input").val(Amount.toFixed(2));
			total=total+Amount;
		});
		
		
		if($("#discount_per").is(':checked')){
			var discount_per=parseFloat($('input[name="discount_per"]').val());
			var discount_amount=(total*discount_per)/100;
			if(isNaN(discount_amount)) { var discount_amount = 0; }
			$('input[name="discount"]').val(discount_amount.toFixed(2));
		}else{
			var discount_amount=parseFloat($('input[name="discount"]').val());
			if(isNaN(discount_amount)) { var discount_amount = 0; }
		}
		total=total-discount_amount
		
		$('input[name="total"]').val(total.toFixed(2));
		
		if($("#pnfper").is(':checked')){
			var pnf_per=parseFloat($('input[name="pnf_per"]').val());
			var pnf_amount=(total*pnf_per)/100;
			if(isNaN(pnf_amount)) { var pnf_amount = 0; }
			$('input[name="pnf"]').val(pnf_amount.toFixed(2));
		}else{
			var pnf_amount=parseFloat($('input[name="pnf"]').val());
			if(isNaN(pnf_amount)) { var pnf_amount = 0; }
		}
		var total_after_pnf=total+pnf_amount;
		if(isNaN(total_after_pnf)) { var total_after_pnf = 0; }
		$('input[name="total_after_pnf"]').val(total_after_pnf.toFixed(2));
		
		var sale_tax_per=parseFloat($('input[name="sale_tax_per"]').val());
		var sale_tax=(total_after_pnf*sale_tax_per)/100;
		if(isNaN(sale_tax)) { var sale_tax = 0; }
		$('input[name="sale_tax_amount"]').val(sale_tax.toFixed(2));
		

		
	}
	
	$('.select_address').on("click",function() { 
		open_address();
    });
	
		
	$('.closebtn').live("click",function() { 
		$(".modal").hide();
    });
	
	$('.closebtn').on("click",function() { 
		$("#myModal12").hide();
    });
	$('.popup_btn').live("click",function() {
		var popup_id=$(this).attr('popup_id');
		$("div[popup_div_id="+popup_id+"]").show();
    });
	
	
	
	function open_address(){
		var customer_id=$('select[name="customer_id"]').val();
		$("#result_ajax").html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var url="<?php echo $this->Url->build(['controller'=>'Customers','action'=>'addressList']); ?>";
		url=url+'/'+customer_id,
		$("#myModal12").show();
		$.ajax({
			url: url,
		}).done(function(response) {
			$("#result_ajax").html(response);
		});
	}
	
	$('.insert_address').die().live("click",function() { 
		var addr=$(this).text();
		$('textarea[name="customer_address"]').val(addr);
		$("#myModal12").hide();
    });
	


	
	  
	$('select[name="customer_id"]').on("change",function() {
		var customer_id=$('select[name="customer_id"] option:selected').val();
		var url="<?php echo $this->Url->build(['controller'=>'Customers','action'=>'defaultAddress']); ?>";
		url=url+'/'+customer_id,
		$.ajax({
			url: url,
		}).done(function(response) {
			$('textarea[name="customer_address"]').val(response);
		});
		
		
		$("#so3_div").html('Loading...');
		var url="<?php echo $this->Url->build(['controller'=>'Filenames','action'=>'listFilename']); ?>";
		url=url+'/'+customer_id+'/so',
		$.ajax({
			url: url,
		}).done(function(response) {
			$("#so3_div").html(response);
			$('select[name="qt3"]').attr('name','so3').select2();
		});
		
		
		
		var employee_id=$('select[name="customer_id"] option:selected').attr("employee_id");
		$("select[name=employee_id]").val(employee_id).select2();
		
		var transporter_id=$('select[name="customer_id"] option:selected').attr("transporter_id");
		$("select[name=transporter_id]").val(transporter_id).select2();
		
		var documents_courier_id=$('select[name="customer_id"] option:selected').attr("documents_courier_id");
		$("select[name=documents_courier_id]").val(documents_courier_id).select2();
		
		var dispatch_address=$('select[name="customer_id"] option:selected').attr("dispatch_address");
		$("textarea[name=dispatch_address]").val(dispatch_address);
		
    });
	

	
	
	
	$('select[name="company_id"]').on("change",function() {
		var alias=$('select[name="company_id"] option:selected').attr("alias");
		$('input[name="so1"]').val(alias);
    });
	
	$('.select_term_condition').die().live("click",function() { 
		var addr=$(this).text();
		$("#myModal2").show();
    });
	
	$('.closebtn2').on("click",function() { 
		$("#myModal2").hide();
    });
	
	$('.insert_tc').die().live("click",function() {
		$('#terms_conditions').html("");
		var inc=0;
		$(".tabl_tc tbody tr").each(function(){
			var v=$(this).find('td:nth-child(1) input[type="checkbox"]:checked').val();
			if(v){
				++inc;
				var tc=$(this).find('td:nth-child(2)').text();
				//$('textarea[name="terms_conditions"]').val($('textarea[name="terms_conditions"]').val()+inc+". "+tc+"&#13;&#10;");
				$('#terms_conditions').append(inc+". "+tc+"&#13;&#10;");
			}
		});
		var terms_conditions=$("#terms_conditions").text();
		$('textarea[name="terms_conditions"]').val(terms_conditions);
		$("#myModal2").hide();
    });
	
		$("select.item_box").die().live("change",function(){
		var popup_id=$(this).attr('popup_id');
		var item_id=$(this).val();
		last_three_rates(popup_id,item_id);
	})
	$("select.item_box").each(function(){
		var popup_id=$(this).attr('popup_id');
		var item_id=$(this).val();
		if(popup_id){
			last_three_rates_onload(popup_id,item_id);
		}
	});
	
	$("select.item_box").die().live("change",function(){ 
		var popup_id=$(this).attr('popup_id');
		var item_id=$(this).val();
		last_three_rates(popup_id,item_id);
	})
	
	function last_three_rates_onload(popup_id,item_id){
		
			var customer_id=$('select[name="customer_id"]').val();
			//$('.modal[popup_div_id='+popup_id+']').show();
			$('div[popup_ajax_id='+popup_id+']').html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
			if(customer_id){
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'RecentRecords']); ?>";
				url=url+'/'+item_id+'/'+customer_id,
				$.ajax({
					url: url,
					dataType: 'json',
				}).done(function(response) {
					$('input[r_popup_id='+popup_id+']').attr({ min:response.minimum_selling_price}).rules('add', {
						min: response.minimum_selling_price,
						messages: {
							min: "Enter value greater than minimum selling price "+response.minimum_selling_price
						}
					});
					$('div[popup_ajax_id='+popup_id+']').html(response.html);
				});
			}else{
				$('div[popup_ajax_id='+popup_id+']').html('Select customer first.');
				$(".item_box[popup_id="+popup_id+"]").val('').select2();
			}
	}
	function last_three_rates(popup_id,item_id){
			var customer_id=$('select[name="customer_id"]').val();
			$('.modal[popup_div_id='+popup_id+']').show();
			$('div[popup_ajax_id='+popup_id+']').html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
			if(customer_id){
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'RecentRecords']); ?>";
				url=url+'/'+item_id+'/'+customer_id,
				$.ajax({
					url: url,
					dataType: 'json',
				}).done(function(response) {
					if(response.minimum_selling_price>0){
						$('input[r_popup_id='+popup_id+']').attr({ min:response.minimum_selling_price}).rules('add', {
							min: response.minimum_selling_price,
							messages: {
								min: "Minimum selling price: "+response.minimum_selling_price
							}
						});
					}
					else{
						$('input[r_popup_id='+popup_id+']').attr({ min:response.minimum_selling_price}).rules('add', {
							min: 0.01,
							messages: {
								min: "Rate Can't be 0 "
							}
						});
						
					}
					$('div[popup_ajax_id='+popup_id+']').html(response.html);
				});
			}else{
				$('div[popup_ajax_id='+popup_id+']').html('Select customer first.');
				$(".item_box[popup_id="+popup_id+"]").val('').select2();
			}
	}
	
	
});
</script>
	 
<div id="myModal12" class="modal fade in" tabindex="-1"  style="display: none; padding-right: 12px;"><div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="result_ajax">
				
			</div>
			<div class="modal-footer">
				<button class="btn default closebtn">Close</button>
				<button class="btn yellow">Save</button>
			</div>
		</div>
	</div>
</div>


<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<?php echo $this->Form->create('pull_from_quotation', ['url' => ['action' => 'pull_from_quotation']])?>
			<div class="modal-body">
				<p>
					<label>Select Quotation Ref. No.</label>
					<?php 
					$options=array();
					foreach($quotationlists as $quotationdata){
						$options[]=['text' => h(($quotationdata->qt1.'/QT-'.str_pad($quotationdata->id, 3, '0', STR_PAD_LEFT).'/'.$quotationdata->qt3.'/'.$quotationdata->qt4)), 'value' => $quotationdata->id];
					}
					echo $this->Form->input('quotation_id', ['empty' => "--Select--",'label' => false,'options' => $options,'class' => 'form-control input-sm select2me']); ?>
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn blue" type="submit" name="pull_submit">GO</button>
			</div>
		<?= $this->Form->end() ?>
		</div>
	</div>
</div>

<div id="myModal2" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: none; padding-right: 12px;"><div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="result_ajax">
			<h4>Commercial Terms & Conditions</h4>
			<table class="table table-hover tabl_tc">
			<?php foreach ($termsConditions as $termsCondition): ?>
				 
				 <tr>
					<td width="10"><label><?php echo $this->Form->input('dummy', ['type' => 'checkbox','label' => false,'class' => '']); ?></label></td>
					<td><p><?= h($termsCondition->text_line) ?></p></td>
				</tr>
			<?php endforeach; ?>
			</table>
			</div>
			<div class="modal-footer">
				<button class="btn default closebtn2">Close</button>
				<button class="btn btn-primary insert_tc">Insert</button>
			</div>
		</div>
	</div>
</div>