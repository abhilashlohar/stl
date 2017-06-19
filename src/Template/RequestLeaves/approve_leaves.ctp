<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Leave Application Form</span>
			
		</div>

	</div>
	<div class="portlet-body form">
		<?=  $this->Form->create($RequestLeavesData,['id'=>'form_sample_3']) ?>
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
					</div>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label class="col-md-6 control-label">Employee Name</label>
						<div class="col-md-6">
							<?php echo $employeedata->name; ?>
							<?php echo $this->Form->input('employee_id',['type' => 'hidden','value'=> $employeedata->id]); ?>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label class="col-md-6 control-label">Leave Type</label>
						<div class="col-md-6">
							<?php echo $RequestLeavesData->leave_type->leave_name; ?>
						</div>
					</div>
				</div>
			</div><br/>
			
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label class="col-md-6 control-label">Leave From</label>
						<div class="col-md-6">
							<?php echo date("d-m-Y",strtotime($RequestLeavesData->leave_from));?>
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label class="col-md-6 control-label">Leave To</label>
						<div class="col-md-6">
							<?php echo date("d-m-Y",strtotime($RequestLeavesData->leave_to));?>
						</div>
					</div>
				</div>
			</div><br/>
			
			<div class="row">
				<div class="col-md-9">
					<div class="form-group">
						<label class="col-md-4 control-label">Reason For Leave</label>
						<div class="col-md-8">
							<?php echo $RequestLeavesData->reason; ?>
						</div>
					</div>
				</div>
			</div><br/>
			
			<br/><div class="row">
				<div class="col-md-9">
					<div class="form-group">
						<label class="col-md-4 control-label">Remark</label>
						<div class="col-md-8">
							<?php echo $RequestLeavesData->remarks; ?>
						</div>
					</div>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-md-9">
						<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th colspan="2">Total Eligible</th>
						<th colspan="2">Leave taken till date</th>
						<th colspan="2">Current leave day</th>
						<th colspan="2">Balance</th>
					</tr>
					<tr>
						<th>SL</th>
						<th>CL</th>
						<th>SL</th>
						<th>CL</th>
						<th>SL</th>
						<th>CL</th>
						<th>SL</th>
						<th>CL</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($requestLeaves as $RequestLeave): ?>
					<tr>
						<td>15</td>
						<td>15</td>
						<td><?php echo $RequestLeave->SickLeave; ?></td>
						<td><?php echo $RequestLeave->CasualLeave; ?></td>
						<?php if($RequestLeavesData->leave_type_id==1){ ?>
						<td><?php echo '0'; ?></td>
						<td><?php echo $RequestLeave->no_of_days; ?></td>
						<?php } elseif($RequestLeavesData->leave_type_id==2){?>
						<td><?php echo $RequestLeave->no_of_days; ?></td>
						<td><?php echo '0'; ?></td>
						<?php }?>
						<?php if($RequestLeavesData->leave_type_id==1){ ?>
						<td><?php echo 15-$RequestLeave->SickLeave; ?></td>
						<td><?php echo 15-$RequestLeave->CasualLeave-$RequestLeave->no_of_days; ?></td>
						<?php } elseif($RequestLeavesData->leave_type_id==2){?>
						<td><?php echo $RequestLeave->no_of_days; ?></td>
						<td><?php echo '0'; ?></td>
						<?php }?>
					</tr>
				<?php endforeach; ?>
				
				</tbody>
			</table>
				</div>
			</div><br/>
				
			</div>
			<br/>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					
					<button type="submit" class="btn btn-primary" >ADD</button>
					</div>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
<style>

.padding-right-decrease{
	padding-right: 0;
}
.padding-left-decrease{
	padding-left: 0;
}
</style>