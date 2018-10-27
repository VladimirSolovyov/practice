<?
if (!isset($_REQUEST['step']) || $_REQUEST['step'] == "uploadfile" || $_REQUEST['step'] == "conformity"){
$__BUFFER->flushBuffer('HEADER');
ob_clean();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<link href="/_syscss/admin-3.0.css" type="text/css" rel="stylesheet"/>
	<script src="/_syslib/lib.common.js" type="text/javascript"></script>
	<script src="/_syslib/advanced.select.js" type="text/javascript"></script>
	<script src="/_syslib/menu/codethatsdk.js" type="text/javascript"></script>
	<script src="/_syslib/menu/codethatmenupro.js" type="text/javascript"></script>
	<script src="/_syslib/calendar/calendar_settings.js" type="text/javascript"></script>
	<script src="/_syslib/directory/lib.directory.js" type="text/javascript"></script>
	<script src="/_syslib/calendar/lib.calendar.js" type="text/javascript"></script>
	<script src="/_syslib/custom.dtree.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="/_syslib/import2basket/style.css"/>
	<link href="/_client-side/jQ/jquery.fancybox.css" type="text/css" rel="stylesheet"/>
	<script src="/_client-side/jQ/jquery-1.3.2.js" type="text/javascript"></script>
	<script src="/_client-side/jQ/jquery.easing.js" type="text/javascript"></script>
	<script src="/_client-side/jQ/jquery.fancybox.js" type="text/javascript"></script>

</head>
<body>

<?
}
set_time_limit(0);
$path_syslib = $CONST["documents_path"] . "/_syslib";

require_once($path_syslib . "/import2basket/class_import2basket.php");

class position_price {

	var $num_row; // номер строки
	var $columns = array(); // значение колонок
	var $brands = array(); // соответствующие позиции из каталога
	var $select_dat_id = 0; // выбранная позиция из каталога

}

class settings {

	var $columns = array(); // свойства фильтра
	var $columns_str = ""; // свойства фильтра в строковом виде
	var $type_catalog; // тип каталога
	var $file_name; // название файла
	var $num_head = 0; // кол-во строк шапки
	var $max_cols = 0; //кол-во колонок в прайс-листе
	var $ncol_brand = -1; // номер колонки с производителем
	var $ncol_name = -1; // номер колонки с моделью
	var $filter_id; // id строки со значениями фильтра в базе
	var $is_new_filter = false; // фильтр был только что сохранён или обновлён
}

class brand {

	var $dat_id; // id детали в каталоге
	var $brand; // производитель
	var $columns; // остальные колонки
	var $is_deleted = false; // удалён или нет
}


$step = $_POST['step'] ? $_POST['step'] : $_GET['step'];
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
$options = array(
	'scriptUrl'         => "/admin/td-conformity.html",
	'checDataScript'    => "USER_LIB:/autovision/import_to_catalog/catalog_importcheck.php",
	'checkDataFilePath' => "",
	'action'            => $action

);

class import2catalog extends import2basket {

	var $cat_id = false;

	function import2catalog($step, $options = array()) {

		global $CONST, $_SYSTEM, $_USER;
		$this->options = array_merge($this->options, $options);

		if (session_id() == '') session_start();

		// полключение пользовательского скрипта проверки импортируемых даных
		if ($options['checDataScript'] != '') {
			$this->checDataScript = $options['checDataScript'];
			$_SESSION[md5(__FILE__ . "script")] = $options['checDataScript'];
		} elseif ($_SESSION[md5(__FILE__ . "script")] != '') {
			$this->checDataScript = $_SESSION[md5(__FILE__ . "script")];
		}

		//путь к папке с файлом проверки данных
		if ($this->options['checkDataFilePath'] == '') {
			$this->options['checkDataFilePath'] = $CONST["libs_dir"] . "/projects/autoresource/autoshop/"; //по умолчанию общий для всех
		}

		if (!empty($_REQUEST['type'])) {
			$query = "SELECT cat_id FROM `d_catalog3_catalogs` WHERE `cat_techname` = '" . add_slashes($_REQUEST['type']) . "'";
			$res = $_USER["adapter"]->query($query);
			$row = $_USER["adapter"]->fetch_row_assoc($res);
			$this->cat_id = $row["cat_id"];
		}

		switch ($step) {

			case "uploadfile":
			{
				$this->uploadFile();
				break;
			}
			case "conformity":
			{
				$this->conformityFrom();
				break;
			}
			case "showBrands":
			{
				$this->ShowBrands();
				break;
			}
			case "showPrices":
			{
				$this->ShowPrices();
				break;
			}
			case "saveCatalog":
			{
				$this->saveCatalog();
				break;
			}
			case "saveBrand":
			{
				$this->saveBrand();
				break;
			}
			case "add_brand":
			{
				$this->addBrandPrice();
				break;
			}
			case "uploadfrom":
			default:
				{
				$this->uploadFrom();
				break;
				}
		}
	}

	//end import2basket

	function ReadFile($file_name, $num_head = 0) {

		global $CONST;

		$data = array();
		switch (substr($file_name, -3)) {

			case "csv":
			{
				$data = $this->parseCSV($CONST["site_root"] . $file_name);
				break;
			}
			case 'xls':
			{
				$data = $this->parseXLS($CONST["site_root"] . $file_name);
				break;
			}
		}

		// удаление строк шапки
		for ($i = 0; $i < $num_head; $i++) {
			array_shift($data);
		}

		return $data;
	}
	
	function getPriceListData($num_head = 0, $cond = '') {
		global $_USER;
		
		$fields = [];

		for ($i = 0; $i <= 50; $i++) {
			$fields[] = 'dat_field' . $i . " as `" . $i . "`";
		}
		
		$fields[] = 'dat_id';
		$fields[] = 'dat_ids';
		
		if ($cond) {
			$where = "WHERE " . $cond;
		} else {
			$where = '';
		}
		
		$query = "SELECT " . implode(", ", $fields) . " FROM d_catalog3_td_pricelist $where LIMIT " . (int)$num_head . ", 1000000";

		$data = $_USER['adapter']->getSqlResultArray($query);
		return $data;
	}

	function parseXLS($file) {

		global $_SYSTEM, $__AR2, $_USER, $path_syslib;

		$old_encoding=mb_internal_encoding();
		ini_set('mbstring.internal_encoding', 'windows-1251');

		require_once($path_syslib . "/import2basket/xlsparser/reader.php");

		$data = new Spreadsheet_Excel_Reader();
		$data->_rowoffset = 0;
		$data->_coloffset = 0;
		$data->setOutputEncoding($_SYSTEM->CHARSET);
		$data->read($file);

		$num_sheet = 0;
		$query = "SELECT tablename FROM " . $__AR2['autoprice_db'] . ".pricelist WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$res = $_USER['adapter']->query($query);
		$row = $_USER['adapter']->fetch_row_assoc($res);
		$boundsheets = trim($row['tablename'], "'$");

		foreach ($data->boundsheets as $key => $boundsheet) {
			if ($boundsheet['name'] == $boundsheets) {
				$num_sheet = $key;
				break;
			}
		}

		if ($data->sheets[$num_sheet]['numCols'] > 0)
			$this->maxCols = $data->sheets[$num_sheet]['numCols'];

		ini_set('mbstring.internal_encoding',mb_internal_encoding($old_encoding));

		return $data->sheets[$num_sheet]['cells'];

	}

	function conformityFrom() {

		global $_USER, $__AR2, $CONST;

		$pricelist_id = (int)$_REQUEST['pricelist_id'];
		
		$query = "SELECT * FROM " . $__AR2['autoprice_db'] . ".__pricelist_catalog WHERE pricelist_id = " . $pricelist_id  . " AND is_visible = 'Y'";
		$res = $_USER['adapter']->query($query);
		$row = $_USER["adapter"]->fetch_row_assoc($res);
		
		if (empty($row)) {
			$this->errors[] = tr("Информация о прайс-листе не найдена. Возможно загрузка была произведена некорректно", 'dc');
			$this->uploadFrom();
			return;
		}
		
		$name = $row['path_to_site'];
		$file = $CONST["site_root"] . $name;
		//$file_name = $CONST["site_root"] . "/_upload/catalogs/" . $name;

		switch (substr($name, -3)) {
			case "csv":
			{
				$res = $this->parseCSV($file);
				//if ($res) $this->showTable($res);
				break;
			}
			case 'xls':
			{
				$res = $this->parseXLS($file);
				//$data = $this->ReadFile($file);
				break;
			}
			default:
				{
				$this->errors[] = tr("Указанный тип файла не поддерживается. Пожалуйста выберите текстовые файлы (расширение \"csv\", разделитель - точка с запятой) или файлы Excel (расширение \"xls\").", "dc");
				$this->uploadFrom();
				break;
				}
		}
		
		if ($res) {

			$fields = [
				['name' => 'prd_id', 'type' => 'int'],
				['name' => 'dat_ids', 'type' => 'text']
			];
			//Loader::getApi('dc31')->createTempTable(50, 'd_catalog3_td_pricelist', $fields);
			$_USER["adapter"]->query("DROP TABLE IF EXISTS d_catalog3_td_pricelist");
			$_USER["adapter"]->query("CREATE TABLE `d_catalog3_td_pricelist` (
  `dat_id` int(11) NOT NULL AUTO_INCREMENT,
  `dat_cat_id` int(11) DEFAULT NULL,
  `dat_par_id` int(11) DEFAULT NULL,
  `from_other_cat` int(1) DEFAULT NULL,
  `dat_field0` text,
  `dat_field1` text,
  `dat_field2` text,
  `dat_field3` text,
  `dat_field4` text,
  `dat_field5` text,
  `dat_field6` text,
  `dat_field7` text,
  `dat_field8` text,
  `dat_field9` text,
  `dat_field10` text,
  `dat_field11` text,
  `dat_field12` text,
  `dat_field13` text,
  `dat_field14` text,
  `dat_field15` text,
  `dat_field16` text,
  `dat_field17` text,
  `dat_field18` text,
  `dat_field19` text,
  `dat_field20` text,
  `dat_field21` text,
  `dat_field22` text,
  `dat_field23` text,
  `dat_field24` text,
  `dat_field25` text,
  `dat_field26` text,
  `dat_field27` text,
  `dat_field28` text,
  `dat_field29` text,
  `dat_field30` text,
  `dat_field31` text,
  `dat_field32` text,
  `dat_field33` text,
  `dat_field34` text,
  `dat_field35` text,
  `dat_field36` text,
  `dat_field37` text,
  `dat_field38` text,
  `dat_field39` text,
  `dat_field40` text,
  `dat_field41` text,
  `dat_field42` text,
  `dat_field43` text,
  `dat_field44` text,
  `dat_field45` text,
  `dat_field46` text,
  `dat_field47` text,
  `dat_field48` text,
  `dat_field49` text,
  `dat_field50` text,
  `prd_id` int(11) DEFAULT NULL,
  `dat_ids` text,
  PRIMARY KEY (`dat_id`),
  KEY `dat_cat_id` (`dat_cat_id`),
  KEY `dat_id` (`dat_id`),
  KEY `dat_field0` (`dat_field0`(10)),
  KEY `dat_field1` (`dat_field1`(10)),
  KEY `dat_field2` (`dat_field2`(10)),
  KEY `dat_field3` (`dat_field3`(10)),
  KEY `dat_field4` (`dat_field4`(10)),
  KEY `dat_field5` (`dat_field5`(10)),
  KEY `dat_field6` (`dat_field6`(10)),
  KEY `dat_field7` (`dat_field7`(10)),
  KEY `dat_field8` (`dat_field8`(10)),
  KEY `dat_field9` (`dat_field9`(10)),
  KEY `dat_field10` (`dat_field10`(10)),
  KEY `dat_field11` (`dat_field11`(10)),
  KEY `dat_field12` (`dat_field12`(10)),
  KEY `dat_field13` (`dat_field13`(10)),
  KEY `dat_field14` (`dat_field14`(10)),
  KEY `dat_field15` (`dat_field15`(10)),
  KEY `dat_field16` (`dat_field16`(10)),
  KEY `dat_field17` (`dat_field17`(10)),
  KEY `dat_field18` (`dat_field18`(10)),
  KEY `dat_field19` (`dat_field19`(10)),
  KEY `dat_field20` (`dat_field20`(10)),
  KEY `dat_field21` (`dat_field21`(10)),
  KEY `dat_field22` (`dat_field22`(10)),
  KEY `dat_field23` (`dat_field23`(10)),
  KEY `dat_field24` (`dat_field24`(10)),
  KEY `dat_field25` (`dat_field25`(10)),
  KEY `dat_field26` (`dat_field26`(10)),
  KEY `dat_field27` (`dat_field27`(10)),
  KEY `dat_field28` (`dat_field28`(10)),
  KEY `dat_field29` (`dat_field29`(10)),
  KEY `dat_field30` (`dat_field30`(10)),
  KEY `dat_field31` (`dat_field31`(10)),
  KEY `dat_field32` (`dat_field32`(10)),
  KEY `dat_field33` (`dat_field33`(10)),
  KEY `dat_field34` (`dat_field34`(10)),
  KEY `dat_field35` (`dat_field35`(10)),
  KEY `dat_field36` (`dat_field36`(10)),
  KEY `dat_field37` (`dat_field37`(10)),
  KEY `dat_field38` (`dat_field38`(10)),
  KEY `dat_field39` (`dat_field39`(10)),
  KEY `dat_field40` (`dat_field40`(10)),
  KEY `dat_field41` (`dat_field41`(10)),
  KEY `dat_field42` (`dat_field42`(10)),
  KEY `dat_field43` (`dat_field43`(10)),
  KEY `dat_field44` (`dat_field44`(10)),
  KEY `dat_field45` (`dat_field45`(10)),
  KEY `dat_field46` (`dat_field46`(10)),
  KEY `dat_field47` (`dat_field47`(10)),
  KEY `dat_field48` (`dat_field48`(10)),
  KEY `dat_field49` (`dat_field49`(10)),
  KEY `dat_field50` (`dat_field50`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");
			foreach ($res as $k => $row) {

				/*if ($addSheet) {
					array_unshift($row, $data->boundsheets[$sheetId]['name']);
				}*/

				$names = $values = [];
				foreach ($row as $k => $v) {
					if ($k >= 50) break;
					$names[] = "`dat_field" . $k . "`";
					$values[] = "'" . addslashes($v) . "'";
				}

				$query = "INSERT INTO d_catalog3_td_pricelist (" . implode(",", $names) . ") VALUES (" . implode(",", $values) . ")";
				$_USER["adapter"]->query($query);
			}
			$this->showTable($res);
		}
		//end switch
	}

	function uploadFile() {

		global $CONST, $__AR2, $_USER;

		if (!file_exists($CONST["site_root"] . "/_upload/catalogs/"))
			mkdir($CONST["site_root"] . "/_upload/catalogs/");

		$name = $_FILES['file']['name'];
		$file = $_FILES['file']['tmp_name'];
		switch (substr($name, -3)) {
			case "csv":
			case 'xls':
			{
				if (($handle = fopen($file, "r")) !== false) {
					$file = fread($handle, filesize($file));
					fclose($handle);
					$file_name = "/_upload/catalogs/" . $name;
					$file_path = $CONST["site_root"] . $file_name;
					$fp = fopen($file_path, "w");
					fwrite($fp, $file);
					fclose($fp);
				}

				$query = "UPDATE " . $__AR2['autoprice_db'] . ".__pricelist_catalog SET date_upload = '" . date("Y-m-d h:i:s") . "', path_to_site = '" . $file_name . "' WHERE pricelist_id = '" . $_REQUEST['pricelist_id'] . "'";
				$_USER['adapter']->query($query);

				break;
			}

			default:
				{
				$this->errors[] = tr("Указанный тип файла не поддерживается. Пожалуйста выберите текстовые файлы (расширение \"csv\", разделитель - точка с запятой) или файлы Excel (расширение \"xls\").", "dc");
				$this->uploadFrom();
				break;
				}
		}
		//end switch

		//$this->showTable($res);

		$this->uploadFrom();
	}

	function uploadFrom() {

		global $_USER, $__AR2;
		$query = "SELECT * FROM " . $__AR2['autoprice_db'] . ".__pricelist_catalog pc
                    LEFT JOIN " . $__AR2['autoprice_db'] . ".pricelist p ON p.pricelist_id = pc.pricelist_id
                    LEFT JOIN " . $__AR2['autoprice_db'] . ".datafile df ON p.datafile_id = df.datafile_id
                    WHERE pc.is_visible = 'Y'";
		$res = $_USER['adapter']->query($query);
		$price_list = array();
		while ($row = $_USER["adapter"]->fetch_row_assoc($res)) {
			$price_list[] = $row;
		}
		require_once("tpl.catalog_upload.php");
	}

	function showTable($items) {

		global $_SYSTEM, $_USER, $__AR2;
		$allright = true;
		$_SESSION[md5(__FILE__)] = $items;
		$conf = new settings;

		if ($this->maxCols > 0) {
			$conf->max_cols = $this->maxCols;
		} else {
			$conf->max_cols = count(current($items));
		}

		$scriptUrl = $this->options['scriptUrl'];

		$query = "
			SELECT skipstr_num, provider_id
			FROM " . $__AR2['autoprice_db'] . ".pricelist
			WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$res = $_USER['adapter']->query($query);
		$row = $_USER['adapter']->fetch_row_assoc($res);
		$skipstr_num = $row['skipstr_num'];
		$provider_id = $row['provider_id'];
		
		if (empty($provider_id)) {
			$allright = false;
		}
		
		$catalog_type = "tires";
		
		$query = "SELECT * FROM _wd_filters WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$res = $_USER['adapter']->query($query);

		if ($_USER['adapter']->num_rows($res) > 0) {
			$filters_conf = $_USER['adapter']->fetch_row_assoc($res);
			$conf->num_head = $filters_conf['num_header'];
			$conf->type_catalog = $filters_conf['type'];
			$conf->columns_str = $filters_conf['cols'];
		}

		require_once("tpl.catalog_showtable.php");
	}

	function ShowBrands() {

		global $CONST, $__AR2, $_USER;
		ob_clean();

		$conf = new settings;
		// список производителей из автопрайса и их замены
		$brands_price = array();
		$query = "
			SELECT prd_id, UPPER(name) as name
			FROM " . $__AR2['autoprice_db'] . ".producer_names pn";
		$res = $_USER['adapter']->query($query);
		while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
			$brands_price[$row['name']] = $row['prd_id'];
		}

		$brand_request = "";
		$model_request = "";

		$cols_ar = explode("|", $_REQUEST['cols']);
		foreach ($cols_ar as $row) {
			$conf->columns[] = explode(",", $row);
		}
		//echo "<pre>".print_r($cols, true)."</pre>";

		//определение столбца c производителем

		foreach ($conf->columns as $key => $col) {
			foreach ($col as $row_catalog) {
				if ($row_catalog == "brand") {
					$conf->ncol_brand = $key;
				}
				if ($row_catalog == "name") {
					$conf->ncol_name = $key;
				}
			}
		}

		if ($conf->ncol_brand < 0) {
			echo '<b>' . tr('Ни для одной колонки не выбрано свойство "Производитель"!', 'dc') . '</b>';
			exit();
		}


$_USER['adapter']->query("UPDATE d_catalog3_td_pricelist p1
LEFT JOIN " . $CONST['autoprice_db'] .".producer_names pn ON p1.dat_field" . $conf->ncol_brand . " LIKE CONCAT('%',pn.name,'%')
SET p1.prd_id = pn.prd_id
WHERE p1.prd_id IS NULL
"); //определяем производителя в прайсе из справочника

		$_USER['adapter']->query("UPDATE
(
SELECT d.nav_id, d.nav_name, pn.prd_id, pn.name FROM d_catalog3_navigation d
LEFT JOIN " . $CONST['autoprice_db'] .".producer_names pn ON d.nav_name = pn.name
WHERE nav_par_id = 0 AND nav_cat_id = " . (int)$this->cat_id . "
) as d
INNER JOIN d_catalog3_td_pricelist p ON (p.prd_id = d.prd_id OR p.prd_id IS NULL AND d.prd_id IS NULL AND p.dat_field" . $conf->ncol_brand . " LIKE CONCAT('%',d.nav_name,'%'))
SET p.dat_par_id = d.nav_id
WHERE p.dat_par_id IS NULL
"); //определяем производителя в ДК из справочника и определяем соответствие между производителем в каталоге и прайсе
		$file_name = $_REQUEST['file_name'];

		// считывание прайс-листа
		//$data = $this->ReadFile($file_name, $_REQUEST['num_header']);
		//$data = $this->getPriceListData($_REQUEST['num_header']);
		// сохранение значение фильтров
		$columns['tires'] = $this->getCatalogColumns('tires');
		$type_to_colums['tires'] = $columns['tires']['techNamesFields'];
		$type_to_colums['tires']['id'] = 'dat_id';

		$columns['discs'] = $this->getCatalogColumns('discs');
		$type_to_colums['discs'] = $columns['discs']['techNamesFields'];
		$type_to_colums["discs"]['id'] = 'dat_id';		
		$conf->type_catalog = $_REQUEST['type'];

			$where_query = "";
			foreach ($conf->columns as $key => $col) {
				$select_ar = array();
				foreach ($col as $row_catalog) {
					if ($row_catalog != "") {
						if ($row_catalog == "brand") {
							$conf->ncol_brand = $key;
						} else {
							if ($row_catalog == "name") {
								$conf->ncol_name = $key;
							}
							$select_ar[$key][] = $type_to_colums[$conf->type_catalog][$row_catalog];
						}
					}
				}

				foreach ($select_ar as $key => $sel) {
					$str = "";
					foreach ($sel as $s) {
						$str .= ", d." . $s . ", '%'";
					}
//					if (!empty($price_row[$key]) && trim($price_row[$key]) != "") $where_query .= " AND '" . $price_row[$key] . "' LIKE CONCAT('%'" . $str . ")";
					$field_name = 'p.dat_field' . $key;
					$where_query .= " AND " . $field_name . " LIKE CONCAT('%'" . $str . ")";
				}
			}

if ($where_query) { // ищем подходящие варианты для всего прайса одним запросом
		$_USER['adapter']->query("DROP TABLE IF EXISTS _dc3_td");
		$_USER['adapter']->query("CREATE TEMPORARY TABLE _dc3_td
SELECT p.dat_id as id, GROUP_CONCAT(d.dat_id) as datids, p.* 
FROM d_catalog3_data d
INNER JOIN d_catalog3_navigation n1 ON n1.nav_id = d.dat_par_id
INNER JOIN d_catalog3_td_pricelist p ON p.dat_par_id = n1.nav_par_id
WHERE d.dat_cat_id = " . $this->cat_id . "
" . $where_query . "
GROUP BY p.dat_id;");
		/*$query = "UPDATE d_catalog3_data d
INNER JOIN d_catalog3_navigation n1 ON n1.nav_id = d.dat_par_id
INNER JOIN d_catalog3_td_pricelist p ON p.dat_par_id = n1.nav_par_id
WHERE d.dat_cat_id = " . $this->cat_id . "
" . $where_query . "
GROUP BY p.dat_id
ORDER BY p.dat_id
		";		*/
$_USER['adapter']->query("UPDATE d_catalog3_td_pricelist pr
INNER JOIN _dc3_td t ON pr.dat_id = t.id
SET pr.dat_ids = t.datids;");
}		
		$query = "
			SELECT *
			FROM _wd_filters
			WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$res = $_USER['adapter']->query($query);
		if ($_USER['adapter']->num_rows($res) > 0) {
			$row = $_USER['adapter']->fetch_row_assoc($res);
			$query = "
				UPDATE _wd_filters
				SET cols = '" . $_REQUEST['cols'] . "',
					filename = '" . $file_name . "',
					num_header = " . $_REQUEST['num_header'] . ",
					type = '" . $_REQUEST['type'] . "'
				WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
			$_USER['adapter']->query($query);

			$conf->filter_id = $row['id'];
			$conf->is_new_filter = true;
		} else {
			$query = "
				INSERT INTO _wd_filters
				SET pricelist_id = " . $_REQUEST['pricelist_id'] . ",
					cols = '" . $_REQUEST['cols'] . "',
					filename = '" . $file_name . "',
					num_header = " . $_REQUEST['num_header'] . ",
					type = '" . $_REQUEST['type'] . "'";
			$_USER['adapter']->query($query);
			$conf->filter_id = $_USER['adapter']->last_insert_id();
		}
		// end сохранение фильтров

//		$type_catalog = $_REQUEST['type'];
		
		$brands = $_USER['adapter']->getSqlResultArray("
SELECT nav_id, nav_name, prd_id
FROM d_catalog3_navigation
INNER JOIN d_catalog3_td_pricelist ON dat_par_id = nav_id
WHERE nav_cat_id = " . $this->cat_id ." AND nav_level = '0'
GROUP BY nav_id
ORDER BY nav_name		
		");
		
		
/*
		$query = "
			SELECT *
			FROM d_catalog3_navigation
			WHERE nav_cat_id = " . (int)$this->cat_id . " AND nav_level = '0'
			ORDER BY nav_name";
		$res = $_USER['adapter']->query($query);
//ed($conf->ncol_brand);
		while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
		
			$catalog_brand = mb_strtoupper($row['nav_name'], 'UTF-8');

			$q = "
				SELECT pn2.name
				FROM " . $__AR2['autoprice_db'] . ".producer_names pn
				LEFT JOIN " . $__AR2['autoprice_db'] . ".producer_names pn2 ON pn.prd_id = pn2.prd_id
				WHERE pn.name = '" . add_slashes($catalog_brand) . "'
			";

			$r = $_USER['adapter']->query($q);
			$cat_brands = array(); // список замен производителя
			if ($_USER['adapter']->num_rows($r) == 0)
				$cat_brands[] = $catalog_brand;
			else {
				while ($cat_brand = $_USER['adapter']->fetch_row_assoc($r)) {
					$cat_brands[] = mb_strtoupper($cat_brand['name'], 'UTF-8');
				}

			}

			foreach ($data as $row_price) {

				$price_brand = mb_strtoupper($row_price[$conf->ncol_brand], 'UTF-8');
				if (!empty($price_brand)) {
					$is_brand = false;
					foreach ($cat_brands as $c_brand) {
						if (strpos($price_brand, $c_brand) !== false) {
							$is_brand = true;
							break;
						}
					}
					if ($is_brand) break;
				}
				if ($is_brand) break;
			}
			if ($is_brand) $brands[] = $catalog_brand;
		}*/
		if (count($brands) == 0) $brands = array();

		require_once("tpl.show_brands.php");

	}

	function addBrandPrice() {

		global $_USER, $__AR2;

		$brand = $_REQUEST['brand'];

		require_once("tpl.add_brand_price.php");

		exit();
	}

	function ShowPrices() {

		global $CONST, $__AR2, $_USER;
		ob_clean();
		//$fileSystemCharset = $CONST['file_system_charset']?$CONST['file_system_charset']:"windows-1251";
		//$_REQUEST['brand'] = $_SYSTEM->CHARSET=="windows-1251"?mb_convert_encoding($_REQUEST['brand'], $fileSystemCharset, "UTF-8"):iconv("UTF-8", $fileSystemCharset, $_REQUEST['brand']);

		$conf = new settings;

		//$brand = $_REQUEST['brand'];
		$brand_info = $_USER['adapter']->getSqlResult("SELECT * FROM d_catalog3_navigation WHERE nav_cat_id = " . $this->cat_id . " AND nav_id = " . (int)$_REQUEST['brand']);
		//ed($brand_info);
		$brand = $brand_info['nav_name'];

		//считывание колонок
		$cols_ar = explode("|", $_REQUEST['cols']);
		foreach ($cols_ar as $row) {
			$conf->columns[] = explode(",", $row);
		}

		$file_name = $_REQUEST['file_name'];
		// считывание прайс-листа
		//$data = $this->ReadFile($file_name, $_REQUEST['num_header']);
		$data = $this->getPriceListData(0, "dat_par_id = " . (int)$_REQUEST['brand'] . " AND dat_ids IS NOT NULL");
		//echo $_REQUEST['file_name']."<pre>".print_r($_REQUEST,true)."</pre>";

		// ранее подтверженные
		$confirmed = array();
		if ($_REQUEST['new_filter'] == "yes" || 1 == 1) { // проверка на новизну фильтра не нужна ?? проверить
			$conf->filter_id = $_REQUEST['filter_id'];
			$conf->is_new_filter = true;

			$query = "
				SELECT *
				FROM _wd_data
				WHERE wd_filtr_id = " . $conf->filter_id;
			$res = $_USER['adapter']->query($query);
			while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
				$confirmed[$row['num_row']] = $row['dat_id'];
			}
		}

		$columns['tires'] = $this->getCatalogColumns('tires');
		$type_to_colums['tires'] = $columns['tires']['techNamesFields'];
		$type_to_colums['tires']['id'] = 'dat_id';

		$columns['discs'] = $this->getCatalogColumns('discs');
		$type_to_colums['discs'] = $columns['discs']['techNamesFields'];
		$type_to_colums["discs"]['id'] = 'dat_id';

		$conf->type_catalog = $_REQUEST['type'];

		$columns_name = array();
		$query = "
			SELECT cfg_name, cfg_value
			FROM d_catalog3_config
			WHERE cfg_cat_id = " . (int)$this->cat_id . " AND cfg_type = 'data_colname'";
		$res = $_USER['adapter']->query($query);
		while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
			$columns_name[$row['cfg_name']] = $row['cfg_value'];
		}
		/*$query = "
			SELECT *
			FROM d_catalog3_data
			WHERE dat_cat_id = " . (int)$this->cat_id . " AND " . $columns[$conf->type_catalog]['techNamesFields']['brand'] . " = '" . $brand . "'
			ORDER BY " . $columns[$conf->type_catalog]['techNamesFields']['name'] . "";
		$res = $_USER['adapter']->query($query);*/
		//echo $query."<br/>";

		$price_rows = array();

		foreach ($conf->columns as $key => $col) {
			$select_ar = array();
			foreach ($col as $row_catalog) {
				if ($row_catalog != "") {
					if ($row_catalog == "brand") {
						$conf->ncol_brand = $key;
					} elseif ($row_catalog == 'name') {
						$conf->ncol_name = $key;
					}
				}
			}
		}

		foreach ($data as $num_row => $price_row) {
			$where_query = "";/*
			foreach ($conf->columns as $key => $col) {
				$select_ar = array();
				foreach ($col as $row_catalog) {
					if ($row_catalog != "") {
						if ($row_catalog == "brand") {
							$conf->ncol_brand = $key;
						} else
							$select_ar[$key][] = $type_to_colums[$conf->type_catalog][$row_catalog];
					}
				}
				foreach ($select_ar as $key => $sel) {
					$str = "";
					foreach ($sel as $s) {
						$str .= ", " . $s . ", '%'";
					}
					if (!empty($price_row[$key]) && trim($price_row[$key]) != "") $where_query .= " AND '" . $price_row[$key] . "' LIKE CONCAT('%'" . $str . ")";
				}
			}*/
			//echo $price_row[$conf->ncol_brand]."<br/>";

			//определение синонимов производителя
			$is_price_brand = false;
			$catalog_brand = mb_strtoupper($brand, 'UTF-8');


			if (1 || $is_price_brand) {

				$query = "
					SELECT *
					FROM d_catalog3_data
					WHERE dat_cat_id = " . (int)$this->cat_id . " AND dat_id IN(" . $price_row['dat_ids'] . ")
					ORDER BY " . $columns[$conf->type_catalog]['techNamesFields']['name'] . "";
					
					//ed($query);
				$res = $_USER['adapter']->query($query);
				if ($_USER['adapter']->num_rows($res) > 0) {
					$position_price = new position_price;
					$position_price->num_row = $price_row['dat_id'];
					$position_price->columns = $price_row;
					if (!empty($confirmed[$num_row])) $position_price->select_dat_id = $confirmed[$num_row];
					while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
						//ed($row[$columns[$conf->type_catalog]['techNamesFields']['name']]);
						//ed($position_price->columns[$conf->ncol_name]);
						$position_price->brands[] = $row;
					}

					$this->selectCatalogRow($conf, $columns, $position_price);
				
					
					$price_rows[] = $position_price;
				}
			}
		}


		require_once("tpl.show_models.php");

	}
	
	function selectCatalogRow($conf, $columns, &$position_price) {
		if ($position_price->select_dat_id == 0 || count($position_price->brands) == 1) {
			$position_price->select_dat_id = $position_price->brands[0]['dat_id'];
		}
		if ($position_price->select_dat_id == 0 || count($position_price->brands) > 1) {
			foreach ($position_price->brands as $brand) {

				if (mb_strtoupper($brand[$columns[$conf->type_catalog]['techNamesFields']['name']]) == mb_strtoupper ($position_price->columns[$conf->ncol_name])) {
					$position_price->select_dat_id = $brand['dat_id'];
					break;
				}
			}
		}
	}

	function saveBrand() {

		global $CONST, $__AR2, $_USER;
		ob_clean();
		if (!empty($_REQUEST['data'])) {
			$data_ar = explode("|", $_REQUEST['data']);
			foreach ($data_ar as $data_t) {
				$t = explode("~", $data_t);
				$q = "
					INSERT INTO _wd_data
					SET wd_filtr_id = " . $_REQUEST['filtr_id'] . ",
						dat_id = " . $t[0] . ",
						num_row = " . $t[1] . "
                    ON DUPLICATE KEY UPDATE dat_id = " . $t[0];
				$_USER['adapter']->query($q);
			}
		}
		exit();
	}

	function saveCatalog() {

		global $CONST, $__AR2, $_USER;
		ob_clean();

		$conf = new settings;

		//считывание колонок
		$cols_ar = explode("|", $_REQUEST['cols']);
		foreach ($cols_ar as $row) {
			$conf->columns[] = explode(",", $row);
		}

		// автоматическое добавление производителей
		$brandAdd = $_USER['adapter']->getSqlResultArray("SELECT nav_id, nav_name FROM d_catalog3_td_pricelist 
		INNER JOIN d_catalog3_navigation ON nav_id = dat_par_id
		WHERE dat_par_id IS NOT NULL AND prd_id IS NULL AND nav_cat_id = " . (int)$this->cat_id . "
		GROUP BY dat_par_id");
		foreach($brandAdd as $row) {
			$prd_id = $this->addProducer($row['nav_name']);
			if ($prd_id) {
				$query = "UPDATE d_catalog3_td_pricelist SET prd_id = " . (int)$prd_id . " WHERE dat_par_id = " . (int)$row['nav_id'];
				$_USER['adapter']->query($query);
			}
		}
		
		$file_name = $_REQUEST['file_name'];
		// считывание прайс-листа
		//$data = $this->ReadFile($file_name, $_REQUEST['num_header']);
	
		$data = $this->getPriceListData(0," dat_par_id IS NOT NULL AND prd_id IS NOT NULL AND dat_ids IS NOT NULL");
		//echo "<pre>".print_r($data)."</pre>";die;
		// ранее подтверженные
		$confirmed = array();
		$conf->filter_id = $_REQUEST['filter_id'];
		//$conf->is_new_filter = true;

		$query = "
			SELECT *
			FROM _wd_data
			WHERE wd_filtr_id = " . $conf->filter_id;
		$res = $_USER['adapter']->query($query);
		while ($row = $_USER['adapter']->fetch_row_assoc($res)) {
			$confirmed[$row['num_row']] = $row['dat_id'];
		}

		if (!empty($_REQUEST['data'])) {
			//сохранение отмеченных клиентом
			$str_data = $_REQUEST['data'];
			$data_tmp = explode("|", $str_data);
			foreach ($data_tmp as $tmp) {
				$tmp_ar = explode("~", $tmp);
				$confirmed[$tmp_ar[0]] = $tmp_ar[1];
			}
		}

		$columns['tires'] = $this->getCatalogColumns('tires');
		$type_to_colums['tires'] = $columns['tires']['techNamesFields'];
		$type_to_colums['tires']['id'] = 'dat_id';

		$columns['discs'] = $this->getCatalogColumns('discs');
		$type_to_colums['discs'] = $columns['discs']['techNamesFields'];
		$type_to_colums["discs"]['id'] = 'dat_id';

		$conf->type_catalog = $_REQUEST['type'];

		$price_rows = array();
		$select_ar = array();
		foreach ($conf->columns as $key => $col) {
			foreach ($col as $key2 => $row_catalog) {
				if ($row_catalog != "") {
					if ($row_catalog == "brand") {
						$conf->ncol_brand = $key;
					} elseif ($row_catalog == "name") {
						$conf->ncol_name = $key;
					}
					$select_ar[$key][] = $type_to_colums[$conf->type_catalog][$row_catalog];
				}
			}
		}

		$query = "
			SELECT DISTINCT " . $columns[$conf->type_catalog]['techNamesFields']['brand'] . " as brand
			FROM d_catalog3_data
			WHERE dat_cat_id = " . (int)$this->cat_id;

		foreach ($data as $num_row => $price_row) {
			$position_price = new position_price;
			$position_price->num_row = $price_row['dat_id'];// - 1 - (int)$_REQUEST['num_header'];
			$position_price->columns = $price_row;
			if (!empty($confirmed[$position_price->num_row])) $position_price->select_dat_id = $confirmed[$position_price->num_row];
			$position_price->brands = $_USER['adapter']->getSqlResultArray("SELECT * FROM d_catalog3_data WHERE dat_id IN (" . $price_row['dat_ids'] . ")");

			$this->selectCatalogRow($conf, $columns, $position_price);

			$price_rows[] = $position_price;
		}


		$query = "
			SELECT *
			FROM " . $__AR2['autoprice_db'] . ".pricelist
			WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$res = $_USER['adapter']->query($query);
		$row = $_USER['adapter']->fetch_row_assoc($res);

		$col_art_prov = $row['col_artikul_provider'];

		preg_match('/[0-9]+/', $col_art_prov, $matches);
		$col_art_prov=(int)$matches[0]-1;

		$provider_id = (int)$row['provider_id'];
		$datafile_id = (int)$row['datafile_id'];

		$tablename = $row['tablename'];
		$skipstr_num = $row['skipstr_num'];
		$prd_id = ((int)$row['prd_id'])?(int)$row['prd_id']:1;
		$for_provider = $row['for_provider'];
		$for_producer = $row['for_producer'];

		//нахождение prl_id
		$query = '
			SELECT *
			FROM ' . $__AR2['autoprice_db'] . '.provider_article_lists
			WHERE tablename = "' . $tablename . '" AND datafile_id = ' . $datafile_id . " AND provider_id = " . $provider_id;
		$res = $_USER['adapter']->query($query);
		if ($_USER['adapter']->num_rows($res) > 0) {
			$row = $_USER['adapter']->fetch_row_assoc($res);
			$prl_id = $row['prl_id'];
		} else {
			$query = "
				INSERT INTO " . $__AR2['autoprice_db'] . '.provider_article_lists
				SET tablename = "' . $tablename . '",
					col_prov_article = "F' . ($col_art_prov + 1) . '",
					skipstr_num = "' . $skipstr_num . '",
					load_time = "00:00:44",
					for_producer = ' . $for_producer . ',
					for_provider = ' . $for_provider . ',
					datafile_id = ' . $datafile_id . ',
					prd_id = ' . $prd_id . ',
					provider_id = ' . $provider_id . ',
					loaded_file_date = "' . date("Y-m-d h:i:s") . '"
			';
			$_USER['adapter']->query($query);
			$prl_id = $_USER['adapter']->last_insert_id();
		}

		$data_pr = array();
		
		// составление массива соответствия детали в каталоге и номера строчки в прайс-листе
		foreach ($price_rows as $position_price) {
			$n_brand = 0;
			foreach ($position_price->brands as $key => $brands) {
				if ($brands['dat_id'] == $position_price->select_dat_id) {
					$n_brand = $key;
					break;
				}

			}

			$q = "
				INSERT INTO _wd_data
				SET wd_filtr_id = " . $conf->filter_id . ",
					dat_id = " . $position_price->brands[$n_brand]['dat_id'] . ",
					num_row = " . $position_price->num_row . "
                ON DUPLICATE KEY UPDATE num_row = " . $position_price->num_row;
			$_USER['adapter']->query($q);
			$data_pr[] = array("dat_id" => $position_price->brands[$n_brand]['dat_id'], "price_num_row" => $position_price->num_row, "article" => trim($position_price->columns[$col_art_prov]));
		}

		foreach ($data_pr as $data_val) {
			$query = "
				SELECT *
				FROM d_catalog3_data
				WHERE dat_id = " . $data_val["dat_id"];
			$res = $_USER['adapter']->query($query);
			$row = $_USER['adapter']->fetch_row_assoc($res);
			$brand = $row[$columns[$conf->type_catalog]['techNamesFields']['brand']];
			$art_prov = $data_val['article'];

			$type = $_REQUEST['type'];
			switch ($type) {
				case "discs":
				{
					$article = $row[$columns[$conf->type_catalog]['techNamesFields']['article']];
					break;
				}
				case "tires":
				{
					$article = $row[$columns[$conf->type_catalog]['techNamesFields']['article']];
					break;
				}
			}
			if ($article == "") continue; // временно, пока каталог не заполнен аритикулами

			// нахождение prd_id
			$query = "
				SELECT prd_id
				FROM " . $__AR2['autoprice_db'] . ".producers
				WHERE prd_name = '" . $brand . "' OR prd_full_name = '" . $brand . "'
                UNION ALL
                SELECT prd_id FROM " . $__AR2['autoprice_db'] . ".producer_names WHERE name = '" . $brand . "'
                LIMIT 1
            ";

			$res = $_USER['adapter']->query($query);
			if ($_USER['adapter']->num_rows($res) == 0) { // ?? что делать есть такого производитея нет?

				// добавляется новый производитель.
				$query = "
					INSERT INTO " . $__AR2['autoprice_db'] . ".producers
					SET prd_name = '" . $brand . "',
						prd_full_name = '" . $brand . "',
						prd_oem = 1, unknown=0,
						prd_use_lpad=0,
						prd_use_rpad=0,
						isnew =0
				";
				$_USER['adapter']->query($query);
				$prd_id = $_USER['adapter']->last_insert_id();
				$query = "
					INSERT INTO " . $__AR2['autoprice_db'] . ".producer_names
					SET prd_id = " . $prd_id . ",
						name = '" . $brand . "'
				";
				$_USER['adapter']->query($query);
			} else {
				$row = $_USER['adapter']->fetch_row_assoc($res);
				$prd_id = $row['prd_id'];
			}

			// нахождение detail_id
			$query = "
				SELECT detail_id
				FROM " . $__AR2['autoprice_db'] . ".detail
				WHERE prd_id = " . $prd_id . " AND code = '" . $article . "'
			";
			$res = $_USER['adapter']->query($query);
			if ($_USER['adapter']->num_rows($res) > 0) {
				$row = $_USER['adapter']->fetch_row_assoc($res);
				$detail_id = $row['detail_id'];
			} else {
				$query = "
					INSERT INTO " . $__AR2['autoprice_db'] . ".detail
					SET code ='" . $article . "',
						class_id = 1,
						prd_id = " . $prd_id;
				$_USER['adapter']->query($query);
				$detail_id = $_USER['adapter']->last_insert_id();
			}

			// нахождение соответсвия
			$query = "
				REPLACE INTO " . $__AR2['autoprice_db'] . ".provider_articles
				SET pra_detail_id = " . $detail_id . ",
					pra_provider_id = " . $provider_id . ",
					pra_article = '" . add_slashes($art_prov) . "',
					pra_prl_id = " . $prl_id;
			$_USER['adapter']->query($query);
		}
		$query = "
			UPDATE " . $__AR2['autoprice_db'] . ".__pricelist_catalog
			SET date_sync = '" . date("Y-m-d h::i:s") . "'
			WHERE pricelist_id = " . $_REQUEST['pricelist_id'];
		$_USER['adapter']->query($query);

		exit();
	}

	function getCatalogColumns($techName) {

		static $columns;

		if (!empty($columns[$techName])) {
			return $columns[$techName];
		}

		require_once(__spellPATH("/dc3c_td/td_d_catalog3_client.php"));

		$dc3 = new td_d_catalog3_client(__FILE__);
		$tiresCatalog = $dc3->getCatalogInfoByTechName($techName);
		$dc3->cat_id = $tiresCatalog['id'];
		$dc3->resetVars();
		$dc3->loadAllProperty($dc3->cat_id);

		$columns[$techName] = array(
			'techNamesFields' => array_flip($dc3->property['data_techname']), // article => dat_field0
			'fieldsNames'     => $dc3->property['data_colname'], // dat_field0 => Артикул
			'techNamesNames'  => array_combine($dc3->property['data_techname'], $dc3->property['data_colname']) // article => Артикул
		);

		return $columns[$techName];

	}

	function getCatalogColumnsForSelect($techName) {

		$columns = $this->getCatalogColumns($techName);
		$columns = $columns['techNamesNames'];
		unset($columns['price']);
		unset($columns['ar_price']);
		unset($columns['article']);

		return $columns;

	}
	
	function addProducer($brand) {
		global $CONST, $_USER;
		$query = "INSERT INTO ".$CONST['autoprice_db'].".producers SET prd_name = '".$brand."', prd_full_name = '".$brand."', prd_oem = 1, unknown=0, prd_use_lpad=0, prd_use_rpad=0, isnew =0";

		$res = $_USER['adapter']->query($query);
		$prd_id = $_USER['adapter']->last_insert_id();
		$query = "INSERT INTO ".$CONST['autoprice_db'].".producer_names SET prd_id = " . $prd_id . ", name = '".$brand."'";
		$res = $_USER['adapter']->query($query);
		return $prd_id;
	}

}

$import = new import2catalog($step, $options);


?>
</body>
</html>