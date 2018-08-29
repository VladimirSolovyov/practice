<table border="0" width="100%">

<tr>
<td>
<nobr><?=$AR_MSG['SearchModule']['msg1']?></nobr>
	
	<? if ($SearchSetting['catalog_search']) { ?>
	<li><a href="<?=$SearchSetting['catalog_search_url']?>"><?=$AR_MSG['SearchModule']['msg6']?></a>
	<? } ?>

</td><td align="right" valign="top">

<? if ($__search_results && !$SearchSetting['empty_search']) { ?>

<b><?=$AR_MSG['SearchModule']['msg9']?></b>&nbsp;<?=$cid?>

<? } ?>

</td>
<td valign="top" style="padding-left: 10px">
	
	<? if ($SearchSetting['groups_count'] > 1) { ?>
	
	<b><?=$AR_MSG['SearchModule']['msg41']?></b>&nbsp;
	
	<?
		$sLink = new cLink($_SERVER['REQUEST_URI'], '');
		$sLink->removeQueryParam("g");
	?>
	
	<select onchange="window.location.href = '<?=$sLink->link?>&g='+this.value">
	
	<? foreach ($alternatives as $dat_id=>$row) { ?>
	
			<option value="<?=$row['id']?>" <?=($_REQUEST['g']==$row['id']?'selected="selected"':'')?>>
				<?=$row['brand']?>
			</option>

	<? } ?>

	</select>
	
	<? } ?>

</td></tr>
</table>

<? if ($_SYSTEM->REQUESTED_PAGE != "/shop/basket_check.html") { ?>

<? $st_c = 0 ?>
<table border="0" cellpadding='1' cellspacing="0" width="100%" style="border-top: 1px solid #A0A0A0; border-bottom: 1px solid #A0A0A0">

<caption><?=$AR_MSG['SearchModule']['msg42']?></caption>

<? foreach ($searchStat as $key=>$searchN) { ?>

<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<?
	$st_c++;
	$link = new cLink($_SERVER['REQUEST_URI'], '');
  
    $link->removeQueryParam("g");
    $link->removeQueryParam("article");

    $link->addQueryParam("article", $searchN['sse_search_number']);
?>

<td><a href="<?=$link?>"><b><?=$searchN['sse_search_number']?></b></a></td>

<? if ($st_c % 7 == 0) { ?><tr><? } ?>

<? } ?>

</table><br>

<? } ?>