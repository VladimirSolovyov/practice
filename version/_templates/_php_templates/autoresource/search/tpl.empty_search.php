<div class="warning search-data__empty-warning">

	<? if ($SearchSetting['search_from_catalog']) { ?>
		<p><a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg2'] ?></a></p>
	<? } ?>

	<p><?= $AR_MSG['SearchModule']['msg3'] ?></p>
	<?= $AR_MSG['SearchModule']['msg4'] ?> <a class="warning__link" href="/vin/form.html"><?= $AR_MSG['SearchModule']['msg5'] ?></a>.

	<? if ($SearchSetting['catalog_search']) { ?>
		<a class="warning__link" href="<?= $SearchSetting['catalog_search_url'] ?>"><?= $AR_MSG['SearchModule']['msg6'] ?></a>
	<? } ?>

</div>