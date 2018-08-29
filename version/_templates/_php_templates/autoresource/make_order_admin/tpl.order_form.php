<script type="text/javascript">

	jqWar('document').ready(function () {

		jqWar('#setCustomersDirectory').on('click', function () {
			cstId = jqWar('#cst_id').val();
			if (!cstId)
				cstId = 0;
			rsDirectoryCustomerControl = jqWar('#dcm_cst_id');
			if (rsDirectoryCustomerControl.length)
				rsDirectoryCustomerControl.val(cstId);
			update_func();
		});

		setTimeout(
			function () {
				jqWar('.custom-combobox').on('focusout', function () {
						if (jqWar('#cst_id').val() !== '') {
							jqWar('#setCustomersDirectory').click();
						}
					}
				)
			}, 500
		);


		jqWar("input[name=save_order]").click(function () {
			var summ = '<?=$SUMM_value?>';
			var prepay = jqWar("#prepayment").val();

			if (isNaN(prepay)) {
				alert('Неправильно введена сумма предоплаты. Сумма предоплаты должна быть числом.');
				return false;
			}
			if (parseFloat(summ) < parseFloat(prepay)) {
				alert('Сумма предоплаты не может быть больше суммы заказа');
				return false;
			}

		});


		jqWar('#prepayment').on('keyup',function(){

				var prepay = this.value;

				if(parseFloat(prepay)>0) {
					var hardCash = 1;
					jqWar('#ord_pmk_id').val(hardCash);
				}

		});


		rsDirectories = jqWar('nobr .rsDirectory');
		if (rsDirectories.length) {
			rsSiblings = jqWar(rsDirectories.siblings().andSelf());
			if (rsSiblings.length) {
				rsSiblings.not('#ord_csc_id_viewState').hide();
				rsDirectories.after('<img src="/images/address-book-icon.png" align="absmiddle" style="cursor: pointer;">');
			}
		}

	});

</script>

<?= $order['validationScript'] ?>

<form id="<?= $order['id'] ?>" name="<?= $order['name'] ?>" action="<?= $order['action'] ?>" method="<?= $order['method'] ?>" onsubmit="<?= $order['onsubmit'] ?>">

	<? if ($MESSAGE_CLIENT_DEALER === true) { ?>

		<div class="notice"><?= tr('Внимание! Вами формируется заказ на клиента торговой точки - дилера, но цена закупа позиций рассчитана как для торговых точек - филиалов. При необходимости, скорректируйте цены закупа вручную.', 'MakeOrderModule') ?></div>

	<? } ?>

	<table border="0" width="100%">
		<? if ($order['fields']['dcm_cst_id']) { ?>

			<tr>
				<td>
					<nobr><?= $order['fields']['dcm_cst_id']['caption'] ?></nobr>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<?= $order['fields']['cst_id']['html'] ?>
							</td>
							<td>
								<span id="setCustomersDirectory" style="cursor:pointer;color:#00457A">Применить</span>
							</td>
							<td>
								<?= $order['fields']['dcm_cst_id']['html'] ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<nobr><?= $order['fields']['ord_csc_id']['caption'] ?></nobr>
				</td>
				<td><?= $order['fields']['ord_csc_id']['html'] ?>
					<br/>
					<?= $cars_link ?>
				</td>
			</tr>


			<tr>
				<td height="10" colspan="2"></td>
			</tr>

		<? } ?>


		<? if ($order['fields']['ord_contact_person']) { ?>

			<? include(PHP_DataRender::includeTemplatePath('/autoresource/make_order_admin/tpl.order_auth.php')); ?>

		<? } ?>

		<? if ($order['fields']['company']) { ?>

			<? include(PHP_DataRender::includeTemplatePath('/autoresource/make_order_admin/tpl.order_guest.php')); ?>


		<? } ?>
		<tr>
			<td>
				<nobr><?= $order['fields']['prepayment']['caption'] ?></nobr>
			</td>
			<td><?= $order['fields']['prepayment']['html'] ?></td>
		</tr>

		<? if ($order['fields']['self_order']) { ?>
			<div class="notice">
				<strong><?= tr('Внимание!', 'Common') ?></strong> <?= tr('Заказ будет разделен по поставщикам!', 'MakeOrderModule') ?>
			</div>
		<? } ?>

		<? include(PHP_DataRender::includeTemplatePath('/autoresource/make_order_admin/tpl.order_basket.php')); ?>

		<tr>
			<td colspan="2" height="60">
				<? include(PHP_DataRender::includeTemplatePath('/autoresource/make_order_admin/tpl.order_bottom.php')); ?>
			</td>
		</tr>

		<?= $order['fields']['_prid']['html'] ?>
		<?= $order['fields']['subj']['html'] ?>
		<?= $order['fields']['ord_id']['html'] ?>
		<?= $order['fields']['ord_dcm_id']['html'] ?>
		<?= $order['fields']['ord_active']['html'] ?>
		<?= $order['fields']['ord_fixed']['html'] ?>
		<?= $order['fields']['hide_small_basket']['html'] ?>
		<?= $order['fields']['ord_source_id']['html'] ?>
		<?= $order['fields']['self_order']['html'] ?>

		<script language="JavaScript">

			calcDelivery();

		</script>

	</table>
</form>