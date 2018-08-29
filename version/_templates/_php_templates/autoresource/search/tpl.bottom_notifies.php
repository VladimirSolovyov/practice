<?

if (sizeof($showDelivery) > 0 || $show_replacement_conditions) {
	$Deliveries = $showDelivery;
	$k = 0;

	?>


	<div class="warning search-data__warning search-data__warning_deliveries">
		<div class="warning__caption"><?= $AR_MSG['SearchModule']['msg23'] ?></div>

		<? foreach ($Deliveries as $dlv => $delivery) { ?>

			<? $k++; ?>

			<div class="warning__term">
				<sup><?= $k ?></sup>
				<?= $delivery['dlv_text'] ?>&nbsp;
			</div>

		<? } ?>

		<? if ($show_replacement_conditions != 0) { ?>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['superseded_by'] ?>" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg48'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg24'] ?>&nbsp;
			</div>

			<div style="padding: 5px">
				<span style="color: #990000">
					<sup>
						<a title="<?= $row['replacement_for'] ?>" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default"><?= $AR_MSG['SearchModule']['msg49'] ?></a>
					</sup>
				</span>
				<?= $AR_MSG['SearchModule']['msg25'] ?>&nbsp;
			</div><br/>

		<? } ?>

	</div>

<? } ?>

<? if (!$SearchSetting['admin_search']) { ?>

	<? if ($clientData['retail']!==true) { ?>

		<div class="warning search-data__warning">
			<div class="warning__caption"><?= $AR_MSG['Forms']['msg5'] ?></div>
			<div class="warning__text"><?= $AR_MSG['SearchModule']['msg22'] ?></div>
		</div>

	<? } ?>

<? } ?>

<div class="search-data__warning">
	<? if (!$SearchSetting['admin_search']) { ?>
		<noindex>
			<div class="search-error-bottom">
				<div class="search-error-bottom__caption"><?= $AR_MSG['SearchModule']['msg50'] ?></div>
				<div class="search-error-bottom__text"><?=trp('Если в списке аналогичных товаров вы нашли ошибку, %sсообщите об этом%s, пожалуйста.', 'SearchModule', '<a href="/shop/report_error.html?errid=E2&article=' . $SearchSetting['searchCode'] . '&brand=' . $SearchSetting['searchBrand'] . '" class="search-error-bottom__link">', '</a>')?></div>
			</div>
		</noindex>

	<? } ?>
</div>
