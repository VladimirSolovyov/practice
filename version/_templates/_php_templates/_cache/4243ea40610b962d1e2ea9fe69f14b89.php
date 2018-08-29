<h2><?= $MSG['PrintDialog']['msg1'] ?></h2>

<? if (isset($NO_REPORTS)) { ?>

	<p><?= $MSG['PrintDialog']['msg2'] ?></p>

	<p><a href="#" onclick="window.history.go(-1)"><?= $MSG['PrintDialog']['msg3'] ?></a></p>

<? } else { ?>

	<p><?= $MSG['PrintDialog']['msg4'] ?></p>

	<ul>

		<?
		$url = $REPORTS['url'];
		unset($REPORTS['url']);
		?>

		<? foreach ($REPORTS as $REPORT) { ?>

			<li>

				<? if ($alter_view) { ?>

					<a href="<?= $url ?>&doc_id=<?= $REPORT['rpt_md5'] ?>&use_alter=0"><img src="/_sysimg/ms_office.png" width="16" height="16" alt="MS Office" title="MS Office" style="vertical-align:middle; margin-right:5px; margin-left:0px; border:0;"/></a>
					<a href="<?= $url ?>&doc_id=<?= $REPORT['rpt_md5'] ?>&use_alter=1"><img src="/_sysimg/oo.png" width="16" height="16" alt="OpenOffice" title="OpenOffice" style="vertical-align:middle; margin-right:5px; margin-left:0px; border:0;"/></a>
					<span>&nbsp;<?=tr($REPORT['rpt_name'], 'reports')?></span>

				<? } else { ?>

					<a href="<?= $url ?>&doc_id=<?= $REPORT['rpt_md5'] ?>"><?=tr($REPORT['rpt_name'], 'reports')?></a>

				<? } ?>

			</li>

		<? } ?>

	</ul>

<? } ?>