<h1><?=$AR_MSG['SearchModule']['msg1']?></h1>

<ul>

	<? if ($SearchSetting['search_from_catalog']) { ?>
	<li><p><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg2']?></a></p>
	<? } ?>

	<li><nobr><?=$AR_MSG['SearchModule']['msg3']?></nobr></li>

	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</ul>