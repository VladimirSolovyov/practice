<?php //

/**
 * v 1.1 [03.06.2010]
 *
 * шаблон вывода в табличной форме
 *
 **/
	$_data['items'] 	= $this->items(false); // список товара
	$_data['colNames'] 	= $this->colNames(); // массив с названием свойст и полей
	$_data['lister']	= $this->lister(); // листалка

	$_data['colums'] = $this->catalogColums(); // название колонок 
	
	$_data['itemsPrePage_array'] = $this->itemsPrePage_array;
	$_data['itemsPrePage'] = $this->lister['itemsPrePage'];
		
	$data['show_items_count'] = $this->getProperty('template', 'show_items_count');
	?>

<div class="dc-items-wrap__content  dc-items-wrap__content_full-width">

	<?
	require $this->tpl('tpl.car-filter.php');
	if (count($_data['items']) > 0){ // если количество товара больше 0	
	?>

		<div class="items-area dc-item-table__container dc-sugg">
		<table class="dc-item-table__table">
			<tr>
				<?php

				foreach($_data['colums'] as $k => $row){

					if($row['data_techname'] != 'price'  and $row['data_techname'] != 'ar_price'){
						echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'</th>';
					}else{
						echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr($row['name'],'dc').'</th>';
						echo '<th class="column column-'.$k.' column-'.$row['data_techname'].'">'.tr('Кол- во','dc').'</th>';
						echo '<th></th>';
					}
				}
				echo '<th>'.tr('Цены','dc').'</th>';
				?>
			</tr>

				<?php
					foreach($_data['items'] as $k => $row){

						echo '<tr class="'.$row['_oe'].'" >';
					
						$i = 0;
						foreach($_data['colums'] as $colum_key => $colum){

							switch($colum['data_techname'] ){

								case 'price': 
									$price = $this->outPrice($row);
									?>
									<td width="10"><nobr><b><?=$price?></b></td>
									<td width="10"><input id="<?=$row['amount_id']?>" type="text" name="amount" value="1" class="TextBox" style="width: 25px;text-align:center" /></td>
									<td width="10"><span class="button button_buy"><a href="<?=$row['basket_url']?>"><span class="basket_img"></span></a></span></nobr></td>
									<?
									break;

								case 'ar_price': 
									$price = $this->outPrice($row);
									?>
									<td width="10"><nobr><b><?=$price?></b></td>
									<td width="10"><input id="<?=$row['amount_id']?>" type="text" name="amount" value="1" class="TextBox" style="width: 25px;text-align:center" /></td>
									<td width="10"><span class="button button_buy"><a href="<?=$row['basket_url']?>"><span class="basket_img"></span></a></span></nobr></td>
									<?
									break;

								case 'carmodif': 
									$price = $this->outPrice($row);
									?>
									<td>
										<button type="button" class="dc-table-modal-link" data-toggle="modal" data-target="#modif-modal-<?= $row['dat_id'] ?>">
											<?= tr('Применяемость','dc') ?>
										</button>

										<div class="modal fade dc-modif-modal" id="modif-modal-<?= $row['dat_id'] ?>" tabindex="-1" role="dialog" >
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
											  <div class="modal-body">										  
													<div class="dc-modif-modal__close-btn" data-dismiss="modal" aria-label="Close"></div>
													<div class="dc-modif-modal__header-container">
														<span class="dc-modif-modal__header"><?= tr('Применяемость','dc') ?></span>
														<span class="dc-modif-modal__sub-header"></span>
													</div>
													<div class="dc-item-table__container dc-item-table__container--modal">
														<table class="dc-item-table__table ">
															<tr>													  
															  <th><?= tr('Модификация','dc') ?></th>											  
															  <th><?= tr('Годы выпуска','dc') ?></th>											  
															  <th><?= tr('кВ','dc') ?></th>											  
															  <th><?= tr('ЛС','dc') ?></th>											  
															  <th><?= tr('Двигатель, см3','dc') ?></th>													  
															</tr>
															<?
															  foreach($row['carmodif'] as  $carModification){
																  ?>
																	<tr>
																		<td>																	
																			<?= $carModification['crmf_name'] ?>							
																			<span class="dc-item-table__addon-value"><?= $carModification['crmf_body'] ?></span>
																		</td>
																		<td>
																			<?
																				echo $carModification['crmf_sales_start_date']?$carModification['crmf_sales_start_date'].' - ':'';
																				echo $carModification['crmf_sales_finish_date']?$carModification['crmf_sales_finish_date']: tr('Наст. время','dc');																	
																			?>
																		</td>
																		<td><?= $carModification['crmf_kv'] ?></td>
																		<td><?= $carModification['crmf_ls'] ?></td>
																		<td><?= $carModification['crmf_engine_volume'] ?></td>
																	</tr>
																  <?									
															  }
															?>										  
														</table>
													</div>
											  </div>
											</div>
										  </div>
										</div>	
									</td>
									<?

									break;

								default:
									echo '<td class="column column-'.($i++).' column-'.$colum['data_techname'].'">';
									require $this->tpl('tpl.table_item.php');
									echo '</td>';
									break;

							}

						}
						if ($row['article'] != '') {
							echo '<td class="column column-'.($i++).' column-price"><a style="font-weight: bold;" target="_blank" href="/search.html?article=' . urlencode($row['article']) . '&sort___search_results_by=final_price">'.tr('Узнать цену','dc').'</a></td>';
						} else {
							echo '<td class="column column-'.($i++).' column-price"><a style="color: #FF0000;font-weight: bold;" target="_blank" href="/vin/form.html">'.tr('VIN-запрос','Template').'</a></td>';
						}

						echo '</tr>';

					}
				?>

		</table>
		</div>

	
	<?
		require $this->tpl('tpl.listing.php');
		require $this->tpl('tpl.bottom-seo-text.php');
	}
	?>
	<?require $this->tpl('tpl.bottom-seo-text.php');?>
</div>

