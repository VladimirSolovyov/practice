<? foreach ($__search_results['controls'] as $hdr_id=>$control) { ?>

<? if ($hdr_id == 'searchPages') continue; ?>

<div class="<?=($hdr_id=="filter"?'notice':'')?>" style="padding-top: 0px; padding-bottom: 0px">
	<?=$control?>
</div>

<? } ?>