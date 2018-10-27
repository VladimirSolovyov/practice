<?php
global $_USER;
$modificationId = (int)$_REQUEST['dat_field3'];
$car = $_USER['adapter']->getSqlResult("SELECT * FROM d_catalog3_tad WHERE mdf_id = " . $modificationId);

if (empty($car)) {
	// получаем список модификаций, для которых есть информация о шинах и дисках
	$res = $_USER['adapter']->getSqlResultArraySingle("
SELECT c1.crmf_id, c1.crmf_crm_id as crm_id 
FROM car_modif c1 
INNER JOIN d_catalog3_tad 
ON mdf_id = c1.crmf_id 
INNER JOIN car_modif c2 
ON c2.crmf_id = " . $modificationId . "
WHERE c1.crmf_crm_id = c2.crmf_crm_id", 'crmf_id', 'crm_id');
	$crm_id = reset($res);
	$res = array_keys($res);
	$yearList = $modifyList = $mapAssign = [];
	Loader::getApi('car')->generateYearAndModifyListByModel((int)$crm_id, $yearList, $modifyList, $mapAssign);
	$firstYear = reset($yearList); // получаем самый ранний год

	$modifs = array_intersect($res, $mapAssign[$firstYear]); // получаем модификации из раннего года с инфой о шинах. берем инфу для первой
	$modif = reset($modifs);
	$modificationId = (int)$modif;
	$car = $_USER['adapter']->getSqlResult("SELECT * FROM d_catalog3_tad WHERE mdf_id = " . (int)$modif);
}

$params = $dc3->getCarFiltersTechName();

foreach ($params as $key1=>$key2) {
	$car[$key1] = $car[$key2];
}


if ($car['vendor'] == '' || $car['car'] == '' || $car['modification'] == ''){
	$carInfo = Loader::getApi('car')->getCarNameByModification($modificationId);
	if($carInfo){
		$car['vendor'] = $carInfo['brand'];
		$car['car'] = $carInfo['model'];
		$car['modification'] = $carInfo['modification'];		
	}
}


function parseTiresParams($str) {

	if (empty($str)) {
		return array();
	}

	$params = array();

	$str = explode('|', $str);

	foreach ($str as $tmp) {

		$tmp = explode('#', $tmp);

		foreach ($tmp as $key => $tmp2) {

			$tmp2 = str_replace(',', '.', $tmp2);
			preg_match('#^([\d\.,]*)\s*/\s*([\d\.,]*)\s*R([\d\.,]*)$#Uis', trim($tmp2), $matches);

			$params[] = array(
				'width' => $matches[1],
				'height' => $matches[2],
				'diameter' => $matches[3],
				'type' => (!$tmp[1] ? 'all' : ($key === 0 ? 'front' : 'rear'))
			);

		}

	}

	return $params;

}

function parseDiscsParams($str) {

	if (empty($str)) {
		return array();
	}

	$params = array();

	$str = explode('|', $str);

	foreach ($str as $tmp) {

		$tmp = explode('#', $tmp);

		foreach ($tmp as $key => $tmp2) {

			$tmp2 = str_replace(',', '.', $tmp2);
			preg_match('#^([\d\.,]*)\s* x \s*([\d\.,]*)\s*ET([\d\.,]*)$#Uis', trim($tmp2), $matches);

			$params[] = array(
				'width' => $matches[1],
				'diameter' => $matches[2],
				'ET' => $matches[3],
				'type' => (!$tmp[1] ? 'all' : ($key === 0 ? 'front' : 'rear'))
			);

		}

	}

	return $params;

}

function showTiresBlock($params, $name) {

	if (!empty($params)) { ?>
		<div class="dc-td-options">
			<div class="dc-td-options__header"><?= $name ?></div>
			<div class="dc-td-options__container">
			<?	
			foreach ($params as $original) {
			?>
				<form class="dc-td-options__form" id="sub" action="/tires-discs-search/tires/" method="GET">
					<input type="hidden" name="dat_field5" value="<?=$original['width']?>" />
					<input type="hidden" name="dat_field6" value="<?=$original['height']?>" />
					<input type="hidden" name="dat_field7" value="<?=$original['diameter']?>" />
					<input type="submit" class="submitButton submitButton--option" name="send" value="<?=$original['width']?>/<?=$original['height']?> R<?=$original['diameter']?>" />
				</form>
			<?
			}		
			?>
			</div>
		</div>
		<?
	}

	return true;

}

function showDiscsBlock($params, $name) {

	if (!empty($params)) {?>
		<div class="dc-td-options">
			<div class="dc-td-options__header"><?= $name ?></div>
			<div class="dc-td-options__container">
			<?	
			foreach ($params as $original) {
			?>
			<form class="dc-td-options__form"  id="sub" action="/tires-discs-search/discs/" method="GET">
				<input type="hidden" name="dat_field3" value="<?=$original['width']?>" />
				<input type="hidden" name="dat_field4" value="<?=$original['diameter']?>" />
				<input type="hidden" name="dat_field8" value="<?=$original['ET']?>" />
				<input type="hidden" name="dat_field5" value="<?=$original['LZ']?>" />
				<input type="hidden" name="dat_field6" value="<?=$original['PCD']?>" />
				<input type="hidden" name="dat_field7" value="<?=$original['DIA']?>" />
				<input type="submit" class="submitButton submitButton--option" name="send" value="<?=$original['width']?> x <?=$original['diameter']?> ET<?=$original['ET']?>" />
			</form>
		<?
			}		
			?>
			</div>
		</div>
		<?
	}

	return true;

}


function addCustomParam($parName, $car) {
	
	$ar['discs_original']=$car['discs_original'];
	$ar['discs_replace']=$car['discs_replace'];
	$ar['discs_tuning']=$car['discs_tuning'];
	foreach ($ar as $key=>$val){
		foreach ($val as $rKey=>$row) {
			$ar[$key][$rKey][$parName]=str_replace(',','.',$car[$parName]);
		}
		
	}
	
	return $ar;
	
}

?>
<h1 class="dc-title dc-title--margin">
<?=tr("Подбор шин и дисков для",'dc')?> 
<span class="dc-title__addon"><?=$car['vendor']?> <?=$car['car']?> <?=$car['modification']?></span>		
</h1>	

<div class="dc-td-search">
	<div class="dc-td-search__container">
		
		<div class="dc-td-search__item">
			<div class="dc-td-search-item">
				<div class="dc-td-search-item__header dc-td-search-item__header--tire">
					<?=tr('Шины','dc');?>
				</div>
				<div class="dc-td-search-item__form">
					<?
					$car['tires_original'] = parseTiresParams($car['tires_original']);
					$car['tires_replace'] = parseTiresParams($car['tires_replace']);
					$car['tires_tuning'] = parseTiresParams($car['tires_tuning']);

					showTiresBlock($car['tires_original'], tr('Заводские параметры','dc'));
					showTiresBlock($car['tires_replace'], tr('Параметры замены','dc'));
					showTiresBlock($car['tires_tuning'], tr('Тюнинг','dc'));
					?>
				</div>				
			</div>
		</div>

		<div class="dc-td-search__item">
			<div class="dc-td-search-item">
				<div class="dc-td-search-item__header dc-td-search-item__header--disk">
					<?=tr('Диски','dc');?>
				</div>
				<div class="dc-td-search-item__form">
					<?	
					$paramArr=$dc3->getPropertyesByCatCode('discs');

					$car['discs_original'] = parseDiscsParams($car['discs_original']);
					$car['discs_replace'] = parseDiscsParams($car['discs_replace']);
					$car['discs_tuning'] = parseDiscsParams($car['discs_tuning']);

					if($paramArr['LZ_FILTER']=='Y') {

						$addParam=addCustomParam('LZ', $car);
						$car['discs_original']=$addParam['discs_original'];
						$car['discs_replace']=$addParam['discs_replace'];
						$car['discs_tuning']=$addParam['discs_tuning'];

					}

					if($paramArr['DIA_FILTER']=='Y') {

						$addParam=addCustomParam('DIA', $car);
						$car['discs_original']=$addParam['discs_original'];
						$car['discs_replace']=$addParam['discs_replace'];
						$car['discs_tuning']=$addParam['discs_tuning'];

					}

					if($paramArr['PCD_FILTER']=='Y') {

						$addParam=addCustomParam('PCD', $car);
						$car['discs_original']=$addParam['discs_original'];
						$car['discs_replace']=$addParam['discs_replace'];
						$car['discs_tuning']=$addParam['discs_tuning'];

					}

					showDiscsBlock($car['discs_original'], tr('Заводские параметры','dc'));
					showDiscsBlock($car['discs_replace'], tr('Параметры замены','dc'));
					showDiscsBlock($car['discs_tuning'], tr('Тюнинг','dc'));
					?>
				</div>				
			</div>
		</div>	
	</div>
</div>