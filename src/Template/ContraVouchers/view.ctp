<style>
@media print{
    .maindiv{
        width:100% !important;
    }   
    .hidden-print{
        display:none;
    }
}
p{
margin-bottom: 0;
}
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}
</style>
<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>

<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding: 10px;margin: auto;width: 55%;font-size: 12px;" class="maindiv">    
    <table width="100%" class="divHeader">
        <tr>
            <td width="30%"><?php echo $this->Html->image('/logos/'.$contravoucher->company->logo, ['width' => '40%']); ?></td>
            <td align="center" width="30%" style="font-size: 12px;"><div align="center" style="font-size: 16px;font-weight: bold;color: #0685a8;">COUNTRA VOUCHER</div></td>
            <td align="right" width="40%" style="font-size: 12px;">
            <span style="font-size: 14px;"><?= h($contravoucher->company->name) ?></span>
            <span><?= $this->Text->autoParagraph(h($contravoucher->company->address)) ?>
            <?= h($contravoucher->company->mobile_no) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="border:solid 2px #0685a8;margin-bottom:5px;margin-top: 5px;"></div>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%" valign="top" align="left">
                <table>
					<tr>
                        <td>Bank/Cash Account</td>
                        <td width="20" align="center">:</td>
                        <td><?= h($contravoucher->BankCash->name) ?></td>
                    </tr>
                    <tr>
                        <td>Voucher No</td>
                        <td width="20" align="center">:</td>
                        <td><?= h('#'.str_pad($contravoucher->voucher_no, 4, '0', STR_PAD_LEFT)) ?></td>
                    </tr>
                </table>
            </td>
            <td width="50%" valign="top" align="right">
                <table>
                    <tr>
                        <td>Transaction Date</td>
                        <td width="20" align="center">:</td>
                        <td><?= h(date("d-m-Y",strtotime($contravoucher->transaction_date))) ?></td>
                    </tr>
					<tr>
						<td>Created On</td>
						<td width="20" align="center">:</td>
						<td><?= h(date("d-m-Y",strtotime($contravoucher->created_on))) ?></td>
					</tr>
                </table>
            </td>
        </tr>
    </table>
	
    <br/>
    <table width="100%" class="table" style="font-size:12px">
        <tr>
            <th><?= __('Paid to') ?></th>
            <th><?= __('Amount') ?></th>
            <th><?= __('Narration') ?></th>
        </tr>
        <?php
         $total_cr=0; $total_dr=0; foreach ($contravoucher->contra_voucher_rows as $contra_voucher_row): ?>
        <tr>
            <td style="white-space: nowrap;"><?= h($contra_voucher_row->ReceivedFrom->name) ?></td>
            <td style="white-space: nowrap;"><?= h($this->Number->format($contra_voucher_row->amount,[ 'places' => 2])) ?> <?= h($contra_voucher_row->cr_dr) ?></td>
            <td><?= h($contra_voucher_row->narration) ?></td>
        </tr>
		<?php if(!empty($ref_bal[$contra_voucher_row->received_from_id])):?>
		<tr >
		
		<td colspan="3" style="border-top:none !important;">
			<table width="100%">
			
			<?php $dr_amt=0; $cr_amt=0; foreach($ref_bal[$contra_voucher_row->received_from_id] as $refbal): ?>
			<tr>
					<td style="width :180px !important;"> <?= h($refbal->reference_type). '-' .h($refbal->reference_no) ?></td>
					
					<td > <?php if($refbal->credit != '0' ){ ?> 
					<?= h($this->Number->format($refbal->credit,['places'=>2])) ?> Cr 
					<?php } elseif( $refbal->debit != '0'){?>
					<?= h($this->Number->format($refbal->debit,['places'=>2])) ?> Dr
					<?php } ?></td>
					</tr>
					<?php 
					
					if($refbal->credit != '0' ){ 
						$cr_amt=$cr_amt+$refbal->credit;
					} elseif( $refbal->debit != '0'){
						$dr_amt=$dr_amt+$refbal->debit;
					} ?>
			<?php endforeach; ?>
			<?php 
				if($contra_voucher_row->cr_dr == 'Dr' ){ 
					$on_acc=$contra_voucher_row->amount-($dr_amt-$cr_amt);

					if($on_acc > 0) {?>
						<tr>
							<td style="width :180px !important;"> <?php echo "On Account";  ?></td>
							<td>:</td>
							<td > <?= h($this->Number->format($on_acc,['places'=>2])); ?>Dr
								
							</td>
						</tr>
					<?php }} elseif( $contra_voucher_row->cr_dr == 'Cr'){
						$on_acc1=$contra_voucher_row->amount-($cr_amt-$dr_amt);

					if($on_acc1 > 0) {?>
						<tr>
							<td style="width :180px !important;"> <?php echo "On Account";  ?></td>
							<td>:</td>
							<td > <?= h($this->Number->format($on_acc1,['places'=>2])); ?>Cr
					<?php }} ?>
							</td>
						</tr>
			</table>
		</td>
		
		</tr><?php endif; ?>
        <?php if($contra_voucher_row->cr_dr=="Cr"){
            $total_cr=$total_cr+$contra_voucher_row->amount;
        }else{
            $total_dr=$total_dr+$contra_voucher_row->amount;
        }
        $total=$total_dr-$total_cr; endforeach; ?>
    </table>
    
    
    
    <div style="border:solid 1px ;"></div>
    <table width="100%" class="divFooter">
        <tr>
            <td align="left" valign="top">
                <table>
                    <tr>
                        <td style="font-size: 16px;font-weight: bold;">
                        Rs: <?= h($this->Number->format($total,[ 'places' => 2])) ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">Rupees<?php echo ucwords($this->NumberWords->convert_number_to_words($total)) ?> Only </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">
                        via <?= h($contravoucher->payment_mode) ?> 
                        <?php if($contravoucher->payment_mode=="Cheque"){
                            echo ' ('.$contravoucher->cheque_no.')';
                        } ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td align="right" valign="top" width="35%">
                <table style="margin-top:3px;">
                    <tr>
                       <td width="15%" align="center"> 
                        <?php 
                         echo $this->Html->Image('/signatures/'.$contravoucher->creator->signature,['height'=>'40px','style'=>'height:40px;']); 
                         ?></br>
                         </hr>
                         <span><b>Prepared By</b></span><br/>
                         <span><?= h($contravoucher->company->name) ?></span><br/>
                        </td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>
</div>

