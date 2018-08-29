<?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
?>

<h3><?= $msgBuffer['OrderChangeNotify']['msg1'] ?></h3>

<p><?= $msgBuffer['OrderChangeNotify']['msg2'] ?> <?= $customer['contact_surname'] ?> <?= $customer['contact_first_name'] ?>
	<?= $customer['contact_patronymic_name'] ?>
	! <?= $msgBuffer['OrderChangeNotify']['msg3'] ?> <?= $_SERVER['SERVER_NAME'] ?>
	<?= $msgBuffer['OrderChangeNotify']['msg4'] ?>:</p>

<table style="width: 100%; font-size: 95%" cellpadding="0" cellspacing="1" class="admin_blank_table">
	<tr style="background-color: #F0F0F0">
		<? foreach ($posTable['header'] as $hdr_id => $column) {
			if ($column['visible']) {
				?>
				<th><?= $column['caption'] ?></th><?
			}
		}
		?>
	</tr>
	<? foreach ($posTable['data'] as $id => $row) { ?>
		<tr <? if (!empty($posTable['styles'][$id])) { ?> style="<?= $posTable['styles'][$id] ?>" <? } ?>>
			<? foreach ($posTable['header'] as $hdr_id => $column) {
				if ($column['visible']) { ?>
					<td><?= $row[$hdr_id] ?></td>
				<? }
			} ?>
		</tr>
	<? } ?>
</table>

<p><?= trp('msgCanViewOrdersStatus', 'OrderCancelNotify',
		'<a href="' . $httpProtocol . '://' . $_SERVER['SERVER_NAME'] . '/shop/myorders.html">', '</a>') ?>
</p>