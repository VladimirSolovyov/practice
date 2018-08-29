<div style="display:none;"><img src="/images/add_basket_loader.gif" /></div>

<form class="search-data__form" action="<?=$SearchSetting['basketURL']?>" method="POST">

<? if ($SearchSetting['useOrderColumn'] == 1) { ?>

<input type="hidden" name="func" value="add">
<div class="searchPrderButton"><input type="submit" value="<?=$AR_MSG['SearchModule']['msg46']?>"></div><br>

<? } ?>

<? $excludes_array = array('amount', 'weight', 'dlv_weight_tax'); ?>

<? $columns = 0; ?>
<? foreach ($__search_results['header'] as $hdr_id=>$column) { ?>
	
	<? if (($column['visible']!=true) or (in_array($hdr_id, $excludes_array))) continue; ?>

	<? $columns++; ?>

<? } ?>

<table class="web_ar_datagrid search-results search-results_type_classic search-results--fixed" fix-thead>
<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/classic/tpl.search_results_table_header.php')); ?>

<? $showDelivery = array(); ?>

<? foreach ($__search_results['data'] as $dat_id=>$row) { ?>

<?
if ($row['info_only'] == 1) {
	
	if (($SearchSetting['searchCode'] != $row['parsed_article']) or ($ZeroResultShown == 1)) {
	
		continue;
		
	} else {
		
		foreach ($__search_results['data'] as $dat_id2=>$row2) {
		
		    if (($row['parsed_article'] == $row2['parsed_article']) && ($dat_id != $dat_id2) && ($row2['info_only'] == 0) && ($row['prd_info_link'] == $row2['prd_info_link'])) { 
    			continue 2;
			}

		}
		
		$ZeroResultShown = 1;

	}

} 
?>

<?
 
if (($isProvider['provider_id'] == $row['provider_id']) && ($row['provider_id']>0)) { 
	$class = 'provider_row'; 
}
?>


<tr <?=($_interface->csColorRowPosition ?'class="search-row lg" style="'.$row['sts_style'].'"':'class="search-row '.$class.'"')?>>

	<? foreach ($__search_results['header'] as $hdr_id=>$column) { ?>
		
		<? if (($column['visible']!=true) or (in_array($hdr_id, $excludes_array))) continue; ?>
		
		<? 
			switch($hdr_id) {
				
				case 'spare_info':
				case 'article': 
				case 'prd_info_link': {
					$col_align = 'left';
				} break;
				
				case 'final_price':
				case 'customer_price':
				case 'dlv_weight_tax':
				case 'price_brutto': {
					$col_align = 'right';
				} break;
				
				default: {
					$col_align = 'center';
				}
				
			}
		?>
		<td class="search-col search-col__<?=$hdr_id?>">
			<? include(PHP_DataRender::includeTemplatePath('/autoresource/search/classic/tpl.search_results_table_cell.php')); ?>
		</td>


	<? } ?>
	
	<? if ($basket_check == 1) { ?>
        <td align="right">
			<? if ($row['final_price_val'] && ($desire_price != 0)) { ?>
				<?=number_format((($row['final_price_val'] - $desire_price) / $desire_price *100), 2, '.', ' ')?>
			<? } ?>
		</td>
        <td align="right">
			<? if ($row['max_term'] && ($desire_term != 0)) { ?>
				<?=number_format((($row['max_term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
			<? } elseif ($row['term'] && ($desire_term !=0 )) { ?>
				<?=number_format((($row['term'] - $desire_term) / $desire_term *100), 2, '.', ' ')?>
  	
            <? } ?>
        </td>
    <? } ?>
</tr>

<? } ?>

</table>

</form>