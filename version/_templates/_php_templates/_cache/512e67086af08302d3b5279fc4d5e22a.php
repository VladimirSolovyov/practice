<?= $MSG['RecoverPasswordModule']['msg9'] ?>

<? if (!isset($recovery['messages'])) { ?>

	<? if ($csStrictRegistration): ?>
		<div class="warning">
			<?= $csStrictRegistration; ?>
		</div>
	<? else: ?>

		<div class="row">
			<div class="col-xs-12 col-sm-10 col-md-8">
				<form id="<?= $recovery['id'] ?>" name="<?= $recovery['name'] ?>" action="<?= $recovery['action'] ?>" method="<?= $recovery['method'] ?>">

					<div class="warning mb-25">
						<? if ($csSendSmsRecoverPassword) { ?>
							<?= $MSG['RecoverPasswordModule']['msg15'] ?>
						<? } else { ?>
							<?= $MSG['RecoverPasswordModule']['msg10'] ?>
						<? } ?>
					</div>

					<div class="universal-form__subgroup">

						<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
							<label class="form-gr__label" for="email">
								<?= $recovery['fields']['email']['caption'] ?>
							</label>
							<div class="form-gr__control"><?= $recovery['fields']['email']['html'] ?></div>
						</div>

					<? if ($csSendSmsRecoverPassword) { ?>
							<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
								<label class="form-gr__label" for="contact_phone">
									<?= $recovery['fields']['contact_phone']['caption'] ?>
								</label>
								<div class="form-gr__control"><?= $recovery['fields']['contact_phone']['html'] ?></div>
							</div>
					<? } ?>

						<div id="tr_reg_hc_code">
							<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
								<label class="form-gr__label" for="reg_hc_code">
									<?=$recovery['fields']['reg_hc_code']['caption']?>
								</label>
								<div class="form-gr__control form-gr__control--hc">
									<?=$recovery['fields']['reg_hc_code']['html']?>
								</div>
								<div class="form-gr__tooltip form-gr__tooltip--hc">
									<?=$recovery['fields']['reg_hc_image']['html']?>
								</div>
							</div>
						</div>

						<div class="form-gr form-gr--secondw form-gr_horizontal_center">
							<div class="form-gr__label"></div>
							<div class="form-gr__control"><?= $recovery['fields']['get_password']['html'] ?></div>
						</div>

						<?= $recovery['fields']['_prid']['html'] ?>
						<?= $recovery['fields']['subj']['html'] ?>

					</div>

				</form>
			</div>
		</div>

	<?endif ?>

<? } else { ?>

	<? $process_messages = & $recovery; ?>
	<?  ?><? if (count($process_messages['messages']) > 0) {
	
	foreach($process_messages['messages'] as $message) { ?>

		<?=$message?>
		
	<? }

} ?><?  ?>

<? } ?>