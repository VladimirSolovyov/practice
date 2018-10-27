<? if (empty($client->cst_category_id)) { ?>
	<?= $_interface->MSG['AccessDenied']['msg1'] ?>
	<div class="message message_type_error">
		<div class="message__text">
			<?= $_interface->MSG['AccessDenied']['msg2'] ?>
		</div>
	</div>
<? } else {
	?>
	<h1><?= $_interface->MSG['OrderListModule']['msg13'] ?></h1>
	<? if ($_REQUEST['tab'] == 'orders') { ?>

		<div id="orders-tab">
			<?
			echo AutoResource_CallModule(
				'OrderListModule',
				'module.order-list.php',
				'DR_PHP',
				true
			);
			?>
		</div>

	<? } else { ?>

		<div id="positions-tab">
			<?
			echo AutoResource_CallModule(
				'PositionListModule',
				'module.position-list.php',
				'DR_PHP',
				true
			);
			?>
		</div>

	<? } ?>

<? } ?>