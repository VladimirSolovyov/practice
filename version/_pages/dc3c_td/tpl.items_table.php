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

$data['show_items_count'] = $this->getProperty('template', 'show_items_count');

?>
<div class="dc-items-wrap__content">

	<?
	if (count($_data['items']) > 0) { // если количество товара больше 0
	?>

			<? require $this->tpl('tpl.control.php'); ?>
			<?/*
			<div class="dc3_count">
				<? if ($data['show_items_count'] == 'all') { ?>
					<table width="200" border="0" cellpadding="0" cellspacing="0" class="inpage">
						<tr>
							<td>
								<nobr><?=tr('Показывать по','dc');?>:</nobr>
							</td>
							<? foreach ($_data['itemsPrePage_array'] as $val) { ?>
								<td width="2"><img src="/_sysimg/1x1.gif"/></td>
								<? if ($_data['itemsPrePage'] == $val) { ?>
									<td class="inpage_sel" ><?= $val ?></td>
								<? } else { ?>
									<td ><a href="<?= $this->url(array('max' => $val)); ?>"><?= $val ?></a>
									</td>
								<?
								}
							}?>
						</tr>
					</table>
				<? } ?>
			</div>
			*/?>
		<div class="dc-sugg items-area">

			<?
			$lastItemHash = '';
			foreach ($_data['items'] as $k => $row) {
				$curItemHash = md5($row['brand'].'|'.$row['name']);
				if ($lastItemHash !== $curItemHash) {
					if ($lastItemHash !== '') {
						?></table></div></div><?
					}
					?>
				<div class="dc-td-product">
					<div class="dc-td-product__header">
						<div class="dc-td-product__header-img-container">
							<?
							if (is_array($row['image'])) {
								$row['image'] = $row['image'][0];
							}
							if (!empty($row['image'])) {
								?>
								<a href="<?= $row['image'] ?>" data-show-modal class="image" target="_blank" style="display: inline; width: auto; height: auto;">
									<? if (strpos($row['image'], 'http') !== false) { ?>
										<img class="dc-td-product__header-img" src="<?= $row['image'] ?>">
									<? } else { ?>
										<img class="dc-td-product__header-img" src="<?= getThumbPath($row['image'], 120, 140) ?>">
									<? } ?>
								</a>
								<?
							} 
							?>
						</div>
						<div class="dc-td-product__header-info-container">
							<span class="dc-td-product__header-name">
								<?=$row['brand']?> <?=$row['name']?>
							</span>
							<table class="dc-td-product__header-main-options">
								<? switch ($this->catalogInfo['cat_techname']) {
									
									case 'tires':
										?>	
										<tr>
										<td ><?=tr('Сезонность','dc');?></td><td ><?=tr($row['season'],'dc')?></td>
										</tr>									
										<tr>
										<td ><?=tr('Тип','dc');?></td><td ><?=tr($row['sealing_method'],'dc')?></td>
										</tr>
										
										<?
										break;
									
									case 'discs':
										?>				
										<tr>
										<td ><?=tr('Тип','dc');?></td><td ><?=tr($row['type'],'dc')?></td>
										</tr>
										<tr>
										<td ><?=tr('Материал','dc');?></td><td ><?=tr($row['material'],'dc')?></td>
										</tr>
										<tr>
										<td ><?=tr('Цвет','dc');?></td><td ><?=tr($row['color'],'dc')?></td>
										</tr>
										<?
										break;
								} ?>
								
							</table>
						</div>
					</div>
	
					<?/*
					<h1 class="products_h1"></h1>
		
					<table cellpadding="0" cellspacing="0" class="products_model" data-item="<?=$row['dat_id']?>" border="0" width="100%">
						<tr>
							<?
							if (is_array($row['image'])) {
								$row['image'] = $row['image'][0];
							}
							if (!empty($row['image'])) {
								?>
								<td valign="top" style="padding-bottom:15px;padding-right:20px;width:120px;">
									<a href="<?=$row['image']?>" class="image" target="_blank" style="display: inline; width: auto; height: auto;">
										<? if (strpos($row['image'], 'http') !== false) {?>
											<img src="<?=$row['image']?>" width="120" style="border: 1px solid #CCCCCC;">
										<? } else { ?>
											<img src="<?=getThumbPath($row['image'],120,140)?>" width="120" height="140" style="border: 1px solid #CCCCCC;">
										<? } ?>

									</a>
								</td>
								<?
							} else {
								?><td></td><?
							}
							?>
						</tr>
					</table>
					*/ ?>
					
					<div class="dc-item-table__container dc-item-table__container--td-catalog">
						<table class="dc-item-table__table">
							<tr>
								<? switch ($this->catalogInfo['cat_techname']) {

									case 'tires':
										?>
										<th ><?=tr('Типоразмер','dc');?></th>
										<th ><?=tr('Индекс нагрузки','dc');?></th>
										<th ><?=tr('Индекс скорости','dc');?></th>
									<?/*	<th ><?=tr('Тип','dc');?></th>
										<th ><?=tr('Сезонность','dc');?></th>*/?>
										<th ><?=tr('Шипы','dc');?></th> 
										<th >RunFlat</th>
										<?
										break;

									case 'discs':
										?>
										<th><?=tr('Диаметр','dc');?></th>
										<th ><?=tr('Ширина обода','dc');?></th>
										<th ><?=tr('Кол-во крепежных отверстий','dc');?><br /> <?=tr('и диаметр их расположения','dc');?></th>
										<th ><?=tr('Диаметр отверстия под ступицу','dc');?></th>
										<th ><?=tr('Вынос','dc');?></th>
									<?/*	<th ><?=tr('Тип','dc');?></th>
										<th ><?=tr('Материал','dc');?></th>
										<th ><?=tr('Цвет','dc');?></th> */?>
										<?
										break;

								} ?>
								<th ><?=tr('Цена','dc');?></th>
								<th ><?=tr('Заказать','SearchModule');?></th>
							</tr>
						<?
					}
					?>
							<tr>
								<? switch ($this->catalogInfo['cat_techname']) {

									case 'tires':
										?>
										<td><?=($row['width'].'/'.$row['height'].' R'.$row['diameter'])?></td>
										<td ><?=$row['load_index']?></td>
										<td ><?=$row['speed_index']?></td>
									<?/*	<td ><?=$row['sealing_method']?></td>
										<td ><?=tr($row['season'],'dc')?></td> */?>
										<td ><?=tr($row['spikes'],'dc')?></td>
										<td ><?=tr($row['runflat'],'dc')?></td>
										<?
										break;

									case 'discs':
										?>
										<td><?=$row['diameter']?></td>
										<td ><?=$row['width']?></td>
										<td ><?=$row['LZ']?> x <?=$row['PCD']?></td>
										<td ><?=$row['DIA']?></td>
										<td ><?=$row['ET']?></td>
									<?/*	<td ><?=tr($row['type'],'dc')?></td>
										<td ><?=tr($row['material'],'dc')?></td>
										<td ><?=tr($row['color'],'dc')?></td> */?>
										<?
										break;

								} ?>
								<td ><?=((float)$row['price'] > 0 ? $this->outPrice($row) : '-')?></td>
								<td >
									<? if ((float)$row['price'] > 0) { ?>
									<input class="DigitalTextBox" id="<?= $row['amount_id'] ?>" type="text" name="amount" value="1" onkeypress="return digitsCheck(event)" />
									<span class="btn-add-basket"><a class="add-basket__link" href="<?= $row['basket_url'] ?>"></a></span>
									
									<? } ?>
								</td>
							</tr>
					<?

					$lastItemHash = $curItemHash;
				} ?>
				</table>
				</div>				
			</div>
		</div>
		<?
		//require $this->tpl('tpl.control.php');
		require $this->tpl('tpl.listing.php');
		require $this->tpl('tpl.bottom-seo-text.php');
	} elseif (count($_data['navArray']) == 0) {
		echo $this->tw2u('<span class="no_rows_catalog">'.tr('Нет записей','dc').'</span>');
	}
	?>
</div>