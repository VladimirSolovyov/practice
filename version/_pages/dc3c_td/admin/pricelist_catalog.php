<?
if (isset($_REQUEST['save'])) {
	if (isset($_REQUEST['pricelist'])) {
		$q = "
			SELECT *
			FROM " . $__AR2['autoprice_db'] . ".__pricelist_catalog
		";
		$r = $_USER["adapter"]->query($q);
		while ($row = $_USER["adapter"]->fetch_row_assoc($r)) {
			if (in_array($row['pricelist_id'], $_REQUEST['pricelist'])) {
				$query = "
					UPDATE " . $__AR2['autoprice_db'] . ".__pricelist_catalog
					SET is_visible = 'Y'
					WHERE pricelist_id = '" . $row['pricelist_id'] . "'
				";
				$res = $_USER["adapter"]->query($query);
				unset($_REQUEST['pricelist'][array_search($row['pricelist_id'], $_REQUEST['pricelist'])]);
			} else {
				$query = "
					UPDATE " . $__AR2['autoprice_db'] . ".__pricelist_catalog
					SET is_visible = 'N'
					WHERE pricelist_id = '" . $row['pricelist_id'] . "'
				";
				$res = $_USER["adapter"]->query($query);
			}

		}

		foreach ($_REQUEST['pricelist'] as $key => $row) {
			$q = "
				INSERT INTO " . $__AR2['autoprice_db'] . ".__pricelist_catalog
				SET pricelist_id = '" . $row . "',
					path_to_site = '',
					date_upload = '0000-00-00 00:00:00',
					date_sync= '0000-00-00 00:00:00'
				";
			$res = $_USER["adapter"]->query($q);

		}
	}

	header('Location: /admin/td-conformity.html');

	exit;
}
$q = "
	SELECT *
	FROM " . $__AR2['autoprice_db'] . ".__pricelist_catalog
	WHERE is_visible = 'Y'
";
$res = $_USER["adapter"]->query($q);
$pricelist = array();
while ($row = $_USER["adapter"]->fetch_row_assoc($res)) {
	$pricelist[] = $row['pricelist_id'];
}

?>
<h3><?=tr('Выберите все прайс-листы, которые относятся к каталогу "Шины/Диски"','dc');?>:</h3>
<form method="post" action="/admin/td-pricelists.html">
	<?php
	$query = "
		SELECT pricelist_id, filename
      	FROM " . $__AR2['autoprice_db'] . ".datafile d
      	LEFT JOIN " . $__AR2['autoprice_db'] . ".pricelist p ON d.datafile_id = p.datafile_id
        ORDER BY pricelist_id DESC
    ";
	$res = $_USER["adapter"]->query($query);
	echo '<select multiple="multiple" name="pricelist[]" id="pricelist" size="20">';
	while ($row = $_USER["adapter"]->fetch_row_assoc($res)) {
		echo '<option ' . (isset($pricelist) && in_array($row['pricelist_id'], $pricelist) ? "SELECTED" : "") . ' value="' . $row['pricelist_id'] . '">' . $row['filename'] . "</opinion>";
	}
	echo '</select>';
	?>
	<br/>
	<a onclick="subj = document.getElementById('pricelist'); subj.selectedIndex=-1" href="javascript:void(0)"><?=tr('Убрать все выделения','dc');?></a> <input type="submit" name="save" value="<?=tr('Применить','dc');?>"/>

</form>