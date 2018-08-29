<style>
	body {
		margin: 10px
	}
</style>

<h1><?=tr('Отладка ценообразования', 'AdminPageH1')?></h1>

<h2><?=tr('Информация о детали', 'price_debug')?></h2>

<ul>
	<li><?=tr('Код детали', 'Forms')?>: <?= $partInfo['article'] ?></li>
	<li><?=tr('Производитель', 'Forms')?>: <?= $partInfo['brand'] ?></li>
	<li><?=tr('Название детали', 'Forms')?>: <?= $partInfo['spare_info'] ?></li>
	<li><?=tr('Вес детали', 'Forms')?>: <?= $partInfo['weight'] ?> <?=tr('кг', 'Common')?></li>
	<li><?=tr('Наличие', 'Forms')?>: <?= $partInfo['remains'] ?></li>
	<li><?=tr('Срок поставки', 'Forms')?>: <?= $partInfo['term'] ?></li>
	<li><?=tr('Минимальная партия', 'Forms')?>: <?= $partInfo['min_quantity'] ?></li>
	<li><?=tr('Дата обновления прайс-листа', 'Forms')?>: <?= date('d.m.Y', strtotime($partInfo['refresh_date'])) ?></li>
	<li><?=tr('Поставщик', 'Forms')?>: <?= $partInfo['short_name'] ?></li>
</ul>

<h2><?=tr('Образование цены клиента', 'price_debug')?></h2>

<table width="100%" border="1" bgcolor="#000000">
	<tr bgcolor="#CCCCCC">
		<th><?=tr('№', 'Common')?></th>
		<th><?=tr('Наименование этапа', 'price_debug')?></th>
		<th><?=tr('Значение', 'price_debug')?></th>
		<th><?=tr('Единица измерения', 'price_debug')?></th>
		<th><?=tr('Действие', 'price_debug')?></th>
		<th><?=tr('Цена', 'price_debug')?></th>
	</tr>
	<? foreach ($arClientSteps as $key => $step) { ?>
		<tr bgcolor="#FFFFFF">
			<td>
				<div align="center"><?=($key+1)?></div>
			</td>
			<td><?=$step['caption']?></td>
			<td>
				<div align="center"><?=$step['value']?></div>
			</td>
			<td>
				<div align="center"><?=$step['sign']?></div>
			</td>
			<td>
				<div align="center"><?=$step['action']?></div>
			</td>
			<td>
				<div align="right"><?=$step['price']?></div>
			</td>
		</tr>
	<? } ?>
</table>

<h2><?=tr('Образование цены контрагента', 'price_debug')?></h2>

<table width="100%" border="1" bgcolor="#000000">
	<tr bgcolor="#CCCCCC">
		<th><?=tr('№', 'Common')?></th>
		<th><?=tr('Наименование этапа', 'price_debug')?></th>
		<th><?=tr('Значение', 'price_debug')?></th>
		<th><?=tr('Единица измерения', 'price_debug')?></th>
		<th><?=tr('Действие', 'price_debug')?></th>
		<th><?=tr('Цена', 'price_debug')?></th>
	</tr>
	<? foreach ($arManagerSteps as $key => $step) { ?>
		<tr bgcolor="#FFFFFF">
			<td>
				<div align="center"><?=($key+1)?></div>
			</td>
			<td><?=$step['caption']?></td>
			<td>
				<div align="center"><?=$step['value']?></div>
			</td>
			<td>
				<div align="center"><?=$step['sign']?></div>
			</td>
			<td>
				<div align="center"><?=$step['action']?></div>
			</td>
			<td>
				<div align="right"><?=$step['price']?></div>
			</td>
		</tr>
	<? } ?>
</table>
<p><a href="javascript:void(0)" onclick="opener.window.focus(); window.close();"><?=tr('закрыть окно', 'Common')?></a></p>