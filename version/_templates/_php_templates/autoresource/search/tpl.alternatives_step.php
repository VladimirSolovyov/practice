<div class="alternatives">

	<div class="alternatives-header">
		<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
			<? if ($column['visible'] == true) { ?>
				<div class="alternatives-header__col  alternatives-header__col--<?= $hdr_id ?>"><?= $column['caption'] ?></div>
			<? } ?>
		<? } ?>
	</div>

	<? foreach ($alternatives['data'] as $dat_id => $row) { ?>

		<div class="alternatives__row" data-href="<?= $row['group_link'] ?>">

			<? foreach ($alternatives['header'] as $hdr_id => $column) { ?>
				<? if ($column['visible'] == true) { ?>
					<span class="alternatives__col alternatives__col--<?= $hdr_id ?>">
						<span class="alt_<?= $hdr_id ?>">

							<?= $row[$hdr_id] ?>

							<? if ($hdr_id == 'spare') { ?>

								<? if ($row['superseded_by'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg7'] ?><?= $row['superseded_by'] ?>
								<? } ?>

								<? if ($row['replacement_for'] != '') { ?>
									<?= $row['code'] ?> - <?= $AR_MSG['SearchModule']['msg8'] ?><?= $row['replacement_for'] ?>
								<? } ?>

							<? } ?>

						</span>
					</span>
				<? } ?>
			<? } ?>
		</div>
	<? } ?>
</div>