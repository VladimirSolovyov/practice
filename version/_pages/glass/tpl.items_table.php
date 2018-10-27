<?php //

/**
 * v 1.1 [03.06.2010]
 *
 * шаблон вывода в табличной форме
 *
 **/

$_data['items'] = $this->items(false); // список товара
$_data['colNames'] = $this->colNames(); // массив с названием свойст и полей
$_data['lister'] = $this->lister(); // листалка

$_data['colums'] = $this->catalogColums(); // название колонок

$_data['itemsPrePage_array'] = $this->itemsPrePage_array;
$_data['itemsPrePage'] = $this->lister['itemsPrePage'];

$_data['show_items_count'] = $this->getProperty('template', 'show_items_count');
$_data['pagination_down_show'] = $this->getProperty('template', 'pagination_down_show');
$showAskPrice = Loader::getApi('dc3')->getDcPropertyByName('template', 'show_ask_price_button', $this->cat_id);
$basketWaresAssoc = $this->basketWaresAssoc;
if (count($_data['items']) <= 0) {
	if (!empty($_REQUEST['p'])) {
		require $this->tpl('tpl.control.php');
	}
	if(count($_data['navArray']) <= 0){
		echo '<span class="no_rows_catalog">'.tr('Нет записей', 'Common').'</span>';
	}	
	return;
}
?>
<div class="dc-items-wrap__content  <?= (!$_data['filters'])?'dc-items-wrap__content_full-width':''; ?>">
		<?
		require $this->tpl('tpl.car-filter.php');
		require $this->tpl('tpl.control.php');
		?>
	
	<div class="items-area dc-item-table__container  dc-sugg">
	
		<table class="dc-item-table__table">
			<tr>
				<?php
				foreach($_data['colums'] as $k => $row){
					
					switch($row['data_techname'] ){
						
						case 'article': 
							echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'<span class="dc-item-table__sub-th-value">'.tr('Код производителя','dc').'</span></th>';
							break;
						
						case 'property': 
							switch($row['cfg_name'] ){
								case 'dat_field3': 
									break;
								
								case 'dat_field4':
									echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr('Года производства','dc').'</th>';
									break;
								
								case 'dat_field5': 
									break;
								
								case 'dat_field6':
									echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'</th>';
									break;
								
								case 'dat_field8': 
									break;
								
								case 'dat_field9': 
									break;
								
								default :
									echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'</th>';
									break;								
							}
							break;
						
						case 'ar_price': 
							break;
						
						case 'price': 
							break;
						
						default :
							echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'</th>';
							break;	
					}
				}
				echo '<th>'.tr('Цены','dc').'</th>';
				?>
				
			</tr>

			<?php
			foreach ($_data['items'] as $k => $row) {

				echo '<tr class="' . $row['_oe'] . '"  data-item="'.$row['dat_id'].'">';
				$i = 0;

				foreach ($_data['colums'] as $colum_key => $colum) {
					
					switch($colum['data_techname'] ){
						
						case 'name':									
							echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';
							if($row['name']){
								echo $row['name'];
							}
							else{
								echo $row['dat_field6']?$row['dat_field6']:'';
								echo $row['dat_field8']?' '.$row['dat_field8']:'';
								echo $row['dat_field9']?' '.$row['dat_field9']:'';
							}
							echo '</td>';
							break;
						
						
						case 'article': 
							echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';
							echo $row['article'];
							echo $row['dat_field3']?' <span class="dc-item-table__sub-td-value">'.$row['dat_field3'].'</span>':'';
							echo '</td>';
							break;
						
						case 'property': 
							switch($colum['cfg_name'] ){
								case 'dat_field3': 
									break;
								
								case 'dat_field4':									
									echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';
									if($row['dat_field4']){
										echo $row['dat_field4'];
										echo $row['dat_field5']?' - '.$row['dat_field5']:' - ...';
									}
									echo '</td>';
									break;
								
								case 'dat_field5': 
									break;
								
								case 'dat_field6': 
									echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';
									echo $row['dat_field6'];
									echo $row['dat_field8']?', '.$row['dat_field8']:'';
									echo '</td>';
									break;
								
								case 'dat_field8': 
									break;
								
								
								case 'dat_field9': 
									break;
								
								default :
									echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';

									if(!is_array($row[$colum_key])){ 
										require $this->tpl('tpl.table_item.php');
									}
									else{
										$answerStr = '';
										for($i = 0; $i < count($row[$colum_key]); $i++){										
											if(is_array($row[$colum_key][$i])){ 
												foreach($row[$colum_key][$i] as $key => $value){												
													$answerStr .= ' '.$value;
												}											
											}
											else{
												$answerStr .= $row[$colum_key][$i];
											}
											if($i != count($row[$colum_key])-1 ){
												$answerStr .=', ';
											} 
										}
										echo $answerStr;
									}

									echo '</td>';
									break;								
							}
							break;
						
						case 'ar_price': 
							break;
						
						case 'price': 
							break;
						
						default :
							echo '<td class="column column-' . ($i++) . ' column-' . $colum['data_techname'] . '">';
							
							if(!is_array($row[$colum_key])){ 
								require $this->tpl('tpl.table_item.php');
							}
							else{
								$answerStr = '';
								for($i = 0; $i < count($row[$colum_key]); $i++){										
									if(is_array($row[$colum_key][$i])){ 
										foreach($row[$colum_key][$i] as $key => $value){												
											$answerStr .= ' '.$value;
										}											
									}
									else{
										$answerStr .= $row[$colum_key][$i];
									}
									if($i != count($row[$colum_key])-1 ){
										$answerStr .=', ';
									} 
								}
								echo $answerStr;
							}
							
							echo '</td>';
							break;	
					}

				}				
				
				if($row['article']){
					echo '<td class="column-price">';

					if($showAskPrice === 'Y'){ 							
						echo '<a href="/search.html?article=' . $row['article'] . '&sort___search_results_by=final_price&term=0&smode=A" '
								. 'alt="' . tr('Узнать цену', 'dc') . '" title="' . tr('Узнать цену', 'dc') . ' ' . $row['name'] . '">' . tr('Узнать цену', 'dc') . '</a>'; 
					}

					echo '</td>';
				}	
				echo '</tr>';

			}
			?>

		</table>
	</div>
	
	<?require $this->tpl('tpl.listing.php');?>
	<?require $this->tpl('tpl.bottom-seo-text.php');?>
</div>