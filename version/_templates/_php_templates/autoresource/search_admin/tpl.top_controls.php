<? foreach ($__search_results['controls'] as $hdr_id => $control) { ?>

	<div class="<?= ($hdr_id == "filter" ? 'notice' : '') ?>" style="padding-bottom: 0px;<?= ($hdr_id == "filter" ? 'min-width:1000px;' : '') ?>">
		<?= $control ?>
	</div>

<? } ?>