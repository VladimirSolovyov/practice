<style>
	#timer {
		margin: 50px 0;
	}

	#timer_table {
		border-collapse: collapse;
		margin-top: 10px;
	}

	#timer_table td, #timer_table th {
		border: 1px solid #000000;
		padding: 3px;
		text-align: center;
		color: #000000;
	}

	#timer_table td.time {
		text-align: right;
	}

	#timer_table td.bold {
		font-weight: bold;
	}

	#timer_table td.data, #timer_table td.label, #timer_table td.expander {
		text-align: left;
	}

	#timer a {
		cursor: pointer;
		text-decoration: underline;
		color: #000000;
		display: inline;
		padding: 0;
		margin: 0;
	}

	#timer a:hover {
		color: blue;
		text-decoration: none;
	}

	.div_timer_tooggle {
		display: none;
	}

	#timer_table tr {
		display: none;
	}

	#timer_table tr.external td {
		background-color: cyan;
	}

	#timer_table tr.head, #timer_table tr.level0, #timer_table tr.level1 {
		display: table-row;
	}

	.expander img {
		vertical-align: middle;
	}

	<? if ($group != 'root') { ?>
	#timer_table th.data, #timer_table td.data {
		display: none;
	}
	<? } ?>
</style>

<div id="timer">
	<? if (empty($this->errors)) { ?>

		<script>
			function changeVisibleTimerTable() {
				if (document.getElementById('timer_table').style.display == 'none') {
					document.getElementById('timer_table').style.display = '';
				} else {
					document.getElementById('timer_table').style.display = 'none';
				}
			}
			function timerTooggle(id) {
				if (document.getElementById('div_timer_tooggle' + id).style.display == 'block') {
					document.getElementById('div_timer_tooggle' + id).style.display = 'none';
				} else {
					document.getElementById('div_timer_tooggle' + id).style.display = 'block';
				}
			}
			function tooggle_time_row(el, id) {
				var ar = document.getElementsByName('parent' + id);
				if (el.innerHTML.indexOf('dt_plus') > 0) {
					for (i = 0; i < ar.length; i++) {
						ar[i].style.display = 'table-row';
					}
					el.innerHTML = '<img src="/_sysimg/tree/dt_minus.gif"/>'
				} else {
					for (i = 0; i < ar.length; i++) {
						ar[i].style.display = 'none';
					}
					el.innerHTML = '<img src="/_sysimg/tree/dt_plus.gif"/>'
				}
			}
		</script>
		<? $allTime = round($points[0]['time'], 4); ?>
		<? $importantPercent = 10; ?>
		<a id="timer_more" onclick="changeVisibleTimerTable()" title="Подробнее...">Время формирования страницы: <?= $allTime ?><?=($onlySiteTime ? ', без учета внешних сервисов: ' . $onlySiteTime : '')?></a>
		<table cellspacing="0" cellpadding="0" id='timer_table' style="display:none">

			<tr class="head">
				<? if ($allTime) { ?>
					<th>*</th>
				<? } ?>
				<th>+/-</th>
				<th>Точка</th>
				<th>Уровень</th>
				<th>Длительность, сек.</th>
				<? if ($allTime) { ?>
					<th>Длительность, %</th>
				<? } ?>
				<th>Время старта</th>
				<th>Время окончания</th>
				<th>Расход памяти</th>
				<th>Память старта</th>
				<th>Память окончания</th>
				<th class="data">Данные</th>
			</tr>
			<? $max_level = 0; ?>
			<? foreach ($points as $key => $point) { ?>
				<? if ($point['level'] > $max_level) {
					$max_level = $point['level'];
				} ?>
				<? if ($point['level'] <= $outputParams['maxLevelOutput'] or $group == 'root') { ?>
					<tr class="level<?= $point['level'] ?><?= $point['external'] ? ' external' : ''?>" name="parent<?= $point['parent_id'] ?>">
						<? if ($allTime) { ?>
							<td class="bold">
								<? $percent = number_format($point['time']/$allTime, 4) * 100; ?>
								<?=str_repeat('!', round($percent/$importantPercent))?>
							</td>
						<? } ?>
						<td class="expander"><? if ($point['has_child'] and $point['level'] > 0) { ?>
								<?= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $point['level'] - 1) ?><a
								onclick="tooggle_time_row(this, <?= $key ?>)"><img src="/_sysimg/tree/dt_plus.gif"/></a>
							<? } ?></td>
						<td class="label"><?= $point['label'] ?></td>
						<td><?= $point['level'] ?></td>
						<td class="time bold"><?= number_format($point['time'], 4) ?></td>
						<? if ($allTime) { ?>
							<td class="time bold"><?= $percent ?></td>
						<? } ?>
						<td class="time"><?= number_format($point['otimeb'], 4) ?></td>
						<td class="time"><?= number_format($point['otimee'], 4) ?></td>
						<td class="time bold"><?= number_format($point['memory'], 0, '.', ' ') ?></td>
						<td class="time"><?= number_format($point['omemoryb'], 0, '.', ' ') ?></td>
						<td class="time"><?= number_format($point['omemorye'], 0, '.', ' ') ?></td>
						<td class="data">
							<? if (!empty($point['data'])) { ?>
								<? if (is_array($point['data']) or is_object($point['data']) or strlen($point['data']) > 100) { ?>
									<a class="a_timer_tooggle" onclick="timerTooggle(<?= $key ?>)">данные</a>
									<div class="div_timer_tooggle" id="div_timer_tooggle<?= $key ?>">
										<pre><? print_r($point['data']); ?></pre>
									</div>
								<? } else { ?>
									<?= $point['data'] ?>
								<? } ?>
							<? } ?>
						</td>
					</tr>
				<? } ?>
			<? } ?>
		</table>
		<style>
			<? $arColor = array(
				'0' => 'fff',
				'1' => 'eee',
				'2' => 'ddd',
				'3' => 'ccc',
				'4' => 'bbb',
				'5' => 'aaa',
				'6' => '999',
				'7' => '888',
				'8' => '777',
				'9' => '666',
				'10' => '555',
				'11' => '444',
				'12' => '333',
				'13' => '222',
				'14' => '111',
				'15' => '000',
			);?>
			<? for($i = 0; $i<=$max_level; $i++) { ?>
			#timer_table tr . level <?=$i?> td {
				background-color: # <?=$arColor[$i]?>;
			}

			<? } ?>
		</style>
	<? } else { ?>
		<div class="error"><?= implode('<br/>', $errors) ?></div>
	<? } ?>
</div>