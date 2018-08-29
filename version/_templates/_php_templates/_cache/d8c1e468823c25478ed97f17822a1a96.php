<?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
$pmkInfo = Loader::getApi('paymentkinds')->getPaymentKindInfoById($_POST['ord_pmk_id']);
?>

<h2><?= $msgBuffer['MakeOrderModule']['msg19'] ?></h2>

<div class="order-success">

	<div class="warning order-success__warning">
		<div class="warning__text"><?= $msgBuffer['MakeOrderModule']['msg55'] ?></div>
	</div>

	<? if ($activation_code != '') { ?>
		<?= $msgBuffer['RegistrationModule']['msg92'] ?>
	<? } ?>

	<h2><?= $msgBuffer['MakeOrderModule']['msg20'] ?></h2>

	<div class="warning">
		<div class="warning__text">
			<ul>
				<li>
					<? if ($pmkInfo['pmk_img'] != "") { ?>
						<img src="<?= $pmkInfo['pmk_img'] ?>" hspace=3 align=absmiddle alt="<?= tr($pmkInfo['pmk_name'], 'payment_kinds') ?>"/>&nbsp;
					<? } ?>
					<?= $Interface->MSG['MakeOrderModule']['msg21'] . " &laquo;" . tr($pmkInfo['pmk_name'], 'payment_kinds') ?>&raquo;

					<? if ($pmkInfo['pmk_is_online'] == "Y") { ?>
						<strong>
							<a href="/shop/payments-online.html?dcm_id=<?= md5($_POST['ord_dcm_id']) ?>&pmk_id=<?= $pmkInfo['pmk_id'] ?>"><?= $Interface->MSG['MakeOrderModule']['msg65'] ?></a>
						</strong>
					<? } ?>
				</li>

				<li>
					<strong><a href="<?= CMS_API::createUrl("/shop/documents.html", [
							"dcm_id" => md5($_POST['ord_dcm_id'])
						]) ?> "><?= $Interface->MSG['MakeOrderModule']['msg22'] ?></a>
					</strong>
				</li>
				
				<li><?= $msgBuffer['MakeOrderModule']['msg23'] ?>
					"<a href="<?= CMS_API::createUrl('/shop/personal/info.html') ?>"><?= $msgBuffer['MakeOrderModule']['msg24'] ?></a>".
				</li>

				<li><?= $msgBuffer['MakeOrderModule']['msg25'] ?>
					"<a href="<?= CMS_API::createUrl($_interface->positionsUrl) ?>"><?= $msgBuffer['MakeOrderModule']['msg26'] ?></a>".
				</li>
			</ul>
		</div>
	</div>
</div>