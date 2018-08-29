<?
if ($search_form['fields']) {

	$hiddenFieldsHtml = '';
	$buttons = [];
	$fields = [];
	foreach ($search_form['fields'] as $field) {
		if ($field['instance_name'] == 'Hidden') {
			$hiddenFieldsHtml .= $field['html'];
			continue;
		} else if ($field['instance_name'] == 'Submit') {
			$buttons[] = $field;
			continue;
		}
		$fields[] = $field;
	}
	?>
	<form class="search-form-footer" action="<?= $search_form['action'] ?>" name="<?= $search_form['name'] ?>" id="<?= $search_form['id'] ?>" method="<?= $search_form['method'] ?>" onsubmit="<?= $search_form['onsubmit'] ?>" target="<?= $search_form['target'] ?>">
		<div class="search-form-footer__container">
			<div class="search-form-footer__filters">
				<? foreach ($fields as $field) { ?>
					<div class="search-form-footer__item">
						<label class="search-form-footer__label">
							<?= $field['caption'] ?>
						</label>
						<div class="search-form-footer__input">
							<?= $field['html'] ?>
						</div>
					</div>
				<? } ?>
			</div>
			<div class="search-form-footer__action">
				<? foreach ($buttons as $button) { ?>
					<?= $button['html'] ?>
				<? } ?>
			</div>
		</div>
		<?= $hiddenFieldsHtml ?>
	</form>
	<?= $search_form['validationScript'] ?>
	<?
}
?>