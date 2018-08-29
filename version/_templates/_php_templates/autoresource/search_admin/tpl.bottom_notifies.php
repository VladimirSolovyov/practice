<? if (!$SearchSetting['admin_search']) { ?>

<noindex>
<p><small><a href="/shop/report_error.html?errid=E2&article=<?=$SearchSetting['dirtySearchCode']?>&brand=<?=$SearchSetting['searchBrand']?>"><img src="/_sysimg/info2.gif" align="absmiddle" hspace="5" border="0"/><?=$AR_MSG['SearchModule']['msg21']?></a></small></p>
</noindex>

<? if (($clientData['cst_category_id'] > 1) && !$clientData['retail']) { ?>

<div style="background: #D0D0D0; padding: 10px; margin-top: 10px; margin-bottom: 10px;">

<b><?=$AR_MSG['SearchModule']['msg22']?></b>

</div>

<? } ?>

<? } ?>

<?
	
	if (sizeof($showDelivery)>0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;
	
?>


<div class="notice"><b><?=$AR_MSG['SearchModule']['msg23']?></b>

<? foreach ($Deliveries as $dlv=>$delivery) { ?>

<? $k++; ?>	

<div style="padding: 10px">

<sup><font color="#990000"><?=$k?></font></sup>		
<?=$delivery['dlv_text']?>&nbsp;
</div>

<? } ?>

<? if ($show_replacement_conditions==1) { ?>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['superseded_by']?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg48']?></a>
			</sup></span>		
<?=$AR_MSG['SearchModule']['msg24']?>&nbsp;
</div>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="<?=$row['replacement_for']?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?=$AR_MSG['SearchModule']['msg49']?></a>
			</sup></span>	
<?=$AR_MSG['SearchModule']['msg25']?>&nbsp;
</div><br/>

<? } ?>

</div>

<? } ?>