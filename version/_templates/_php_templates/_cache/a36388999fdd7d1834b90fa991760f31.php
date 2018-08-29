<?
if (isset($tableDataConfig)) {
	$col_count = 0;
	?>
	<table class="data-table" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
		<?
		if ($tableDataConfig['columns']) {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<?
				foreach ($tableDataConfig['columns'] as $column) {
					$col_count++;
					?>
					<th style="Margin:0;background-color:#f3f3f3;color:#999;font-family:Arial,sans-serif;font-size:11px;font-weight:400;line-height:1.3;margin:0;padding:20px 10px;text-align:left;vertical-align:middle">
						<?= $column['caption'] ?>
					</th>
				<?
				}
				?>
			</tr>
			<?
			foreach ($tableDataConfig['data'] as $row) {
				?>
				<tr style="padding:0;text-align:left;vertical-align:top">
					<?
					foreach (array_keys($tableDataConfig['columns']) as $column_id) {
						?>
						<td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:middle;word-wrap:break-word">
						<?
						if (is_array($row[$column_id])) {

							if ($row[$column_id]['value']) {
								?>
								<p style="Margin:0;Margin-bottom:10px;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;line-height:1.3;margin:0;margin-bottom:2px;padding:0;text-align:left">
									<?= $row[$column_id]['value'] ?>
								</p>
							<?
							}

							if ($row[$column_id]['additional']) {
								?>
								<p class="additional" style="Margin:0;Margin-bottom:10px;color:#999;font-family:Arial,sans-serif;font-size:13px;font-weight:400;line-height:1.3;margin:0;margin-bottom:2px;padding:0;text-align:left">
									<?= $row[$column_id]['additional'] ?>
								</p>
							<?
							}

						} else {
							echo $row[$column_id];
						}
						?></td><?
					}
					?>
				</tr>
			<?
			}
		}
		if ($tableDataConfig['summary']) {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<td colspan="<?= $col_count ?>" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;background-color:#f3f3f3;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:15px;font-weight:700;hyphens:auto;line-height:1.3;margin:0;padding:20px 10px;text-align:right;vertical-align:top;word-wrap:break-word">
					<?= $tableDataConfig['summary'] ?>
				</td>
			</tr>
		<?
		} else {
			?>
			<tr style="padding:0;text-align:left;vertical-align:top">
				<td colspan="<?= $col_count ?>" class="end" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;border-top:1px solid #f3f3f3;color:#000;font-family:Arial,sans-serif;font-size:13px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:10px;text-align:left;vertical-align:middle;word-wrap:break-word"></td>
			</tr>
		<?
		}
		?>
	</table>
	<?
	unset($tableDataConfig);
}
?>