<h1><?=tr('Анализ интернет-магазина', 'AdminPageH1')?></h1>

<h2><?=tr("Работа триггеров", "analysis")?></h2>

<div class="notice"><?=$trigger_message?></div>

<h2><?=tr("Анализ настроек", "analysis")?></h2>

<?  ?><? if(!empty($online_errors)) { ?>

	<h3><?=tr("Критические показатели", "analysis")?></h3>

	<? $i = 1; ?>
	<? foreach ($online_errors as $group => $errors) { ?>

		<div class="error" style="word-wrap: break-word">
			<strong><?=$i++?>. <?=$groups[$group]?>:</strong><br/>
			<ul>

				<? foreach ($errors as $error) { ?>

					<li><?=$error?></li>

				<? } ?>

			</ul>
		</div>
	<? } ?>

<? } ?>

<? if(!empty($online_notices)) { ?>

	<h3><?=tr("Предупреждения", "analysis")?></h3>

	<? $i = 1; ?>
	<? foreach ($online_notices as $group => $errors) { ?>

		<div class="notice" style="word-wrap: break-word">
			<strong><?=$i++?>. <?=$groups[$group]?>:</strong><br/>
			<ul>

				<? foreach ($errors as $error) { ?>

					<li><?=$error?></li>

				<? } ?>

			</ul>
		</div>
	<? } ?>

<? } ?>

<? if (empty($online_errors) and empty($online_notices)) { ?>

	<div class="notice"><?=tr("В ходе анализа нарушений не выявлено", "analysis")?></div>

<? } ?><?  ?>

<h2 style="margin-top: 50px"><?=tr("Анализ работы", "analysis")?></h2>

<div class="notice"><?=$offline_message?></div>

<? if(!$hideOffline) { ?>

	<? $online_errors = $offline_errors; ?>
	<? $online_notices = $offline_notices; ?>
	<?  ?><? if(!empty($online_errors)) { ?>

	<h3><?=tr("Критические показатели", "analysis")?></h3>

	<? $i = 1; ?>
	<? foreach ($online_errors as $group => $errors) { ?>

		<div class="error" style="word-wrap: break-word">
			<strong><?=$i++?>. <?=$groups[$group]?>:</strong><br/>
			<ul>

				<? foreach ($errors as $error) { ?>

					<li><?=$error?></li>

				<? } ?>

			</ul>
		</div>
	<? } ?>

<? } ?>

<? if(!empty($online_notices)) { ?>

	<h3><?=tr("Предупреждения", "analysis")?></h3>

	<? $i = 1; ?>
	<? foreach ($online_notices as $group => $errors) { ?>

		<div class="notice" style="word-wrap: break-word">
			<strong><?=$i++?>. <?=$groups[$group]?>:</strong><br/>
			<ul>

				<? foreach ($errors as $error) { ?>

					<li><?=$error?></li>

				<? } ?>

			</ul>
		</div>
	<? } ?>

<? } ?>

<? if (empty($online_errors) and empty($online_notices)) { ?>

	<div class="notice"><?=tr("В ходе анализа нарушений не выявлено", "analysis")?></div>

<? } ?><?  ?>

<? } ?>