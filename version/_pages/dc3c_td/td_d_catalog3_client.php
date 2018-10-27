<?php

require_once(__spellPATH("LIB:/content/d_catalog31_client/d_catalog3_client.php"));

class td_d_catalog3_client extends d_catalog31_client {

	var $searchUrl = '/tires-discs-search/';

	/**
	 * @var Mysql_DataAdapter
	 */
	var $adapter = null;

	var $hideNavigation = true;
	
	function main() {
		
		parent::main();
		$_data['catalog'] = $this->catalog_info();
		
		
		
		if (($_data['catalog']['cat_techname']=='tdauto') and (!$_data['catalog']['cat_visible'])){
			
			require_once $this->tpl('tpl.main.php', 'main');
			
		}
		
	}

	function td_d_catalog3_client($path, $options = array()) {

		global $_USER, $_SYSTEM;
		
		$this->adapter = $_USER['adapter'];
		parent::__construct($path, $options);

		$this->dcCarApi = Loader::getApi('dctadcar');

		$this->catalogInfo = $this->catalog_info();
		
	}
	
	function getAjaxAction () {
		$result = parent::getAjaxAction();
		if (empty($result)) {
			if (preg_match("/\/tires-discs-search\/?ajax\/(.*)\/" . "/", $this->url, $match)) {
				$result = $match[1];
			}
		}
		return $result;
	}
	
	
	/*
	 * ajaxActions
	 * возвращаем данные, запрошенные с помощью AJAX 
	 * 
	 */
	function ajaxActions($mod) {
		$this->dcCarApi = Loader::getApi("dctadcar");
		parent::ajaxActions($mod);
	}


	function render() {

		global $_SYSTEM, $__BUFFER;

		if (empty($_SYSTEM->PAGES[2])) {
			
			/*
			 * Пока ручное формирование, т.к. метод $this->way() требует cat_id, 
			 * которого для этой страницы поиска нет.
			 */			
			if ( Loader::checkModule('ClientBreadcrumbs')) {
				$arBreadCrumbs = [[tr('Каталоги онлайн', 'dc'), (($this->catalogsUrl) ? $this->catalogsUrl : '')]];
				$arBreadCrumbs[] = [tr('Шины и диски', 'dc'), $this->searchUrl];
				Loader::getLib('BreadCrumbs')->replaceBreadcrumbs($arBreadCrumbs, 1, true);
			}
			
			$this->SEO('SITE_TITLE', tr('Подбор шин и дисков', 'dc'));
			
			$__BUFFER->addScript('/_pages/dc3c_td/dc-td-accordion.js');
			$__BUFFER->addScript('/_syslib/dc31/carFilterCollapse.js');
			
			require_once $this->tpl('tpl.tires-discs-search.php');

			
			
		} else {
			
			parent::render();

		}

	}

	function items($item_id = 0) {

		$res = parent::items($item_id);

		/*
		 * подхват изображений по модели
		 */
		if (!empty($res)) {

			$images = array();

			foreach ($res as $key=>$row) {

				if (empty($row['image'])) {

					if (empty($images[$row['name']])) {

						$query = "
							SELECT nav_id FROM d_catalog3_navigation WHERE nav_name = '".add_slashes($row['name'])."' AND nav_cat_id = '".(int)$this->cat_id."' ORDER BY nav_id DESC LIMIT 1
						";
						$nav = $this->adapter->getSqlResult($query);

						$query = "
							SELECT cfg_value FROM d_catalog3_config WHERE cfg_type='nav_image' AND cfg_name = 'treeitem".add_slashes($nav['nav_id'])."' AND cfg_cat_id = '".(int)$this->cat_id."' LIMIT 1
						";
						$image = $this->adapter->getSqlResult($query);
						$images[$row['name']] = $image['cfg_value'];

					}

					if (!empty($images[$row['name']])) {
						$res[$key]['image'][] = $images[$row['name']];
					}

				}

			}

		}

		return $res;

	}

	function resetVars() {

		global $_SYSTEM;

		$this->property = array();
		$this->filter_query = '';
		$this->full_url = '';
		if (empty($_SYSTEM->PAGES[2])) {
			unset($this->ses['filter']);
		}
		$this->sProperty = array();
		$this->allPropertyLoad = array();

		return true;

	}

	function modifyFiltersToAssoc(&$filters) {

		if (empty($filters)) return array();

		$assocKeys = $this->property['data_techname'];

		$tmpFilters = array();
		foreach ($filters as $filter) {

			$assocKey = $assocKeys[$filter['name']];

			$tmpFilters[$assocKey] = $filter;

		}

		$filters = $tmpFilters;

		return $filters;

	}
	
	function getPropertyesByCatCode($code){

		$query="SELECT * FROM d_catalog3_catalogs WHERE cat_techname='".addslashes($code)."'";
		$res = $this->adapter->query($query);
	
		if ($row = $this->adapter->fetch_row_assoc($res)) {

			$tmpParamArr=explode('||', $row['cat_metadata']);
	
			foreach ($tmpParamArr as $val) {
				$parVal=explode('==', $val);
				$paramArr[$parVal[0]]=$parVal[1];
			}
	
			return $paramArr;
	
		} else {
			return array();
		}
	
	}
	
	function getCarFiltersTechName($key) {
		$arr = [
			'vendor' => 'dat_field0',
			'car' => 'dat_field1',
			'year' => 'dat_field2',
			'modification' => 'dat_field3',
			
			'LZ' => 'dat_field4',
			'PCD' => 'dat_field5',
			'DIA' => 'dat_field6',
			'tires_original' => 'dat_field7',
			'tires_replace' => 'dat_field8',
			'tires_tuning' => 'dat_field9',
			'discs_original' => 'dat_field10',
			'discs_replace' => 'dat_field11',
			'discs_tuning' => 'dat_field12'
		];
		
		if ($key) {
			return $arr[$key];
		} else {
			return $arr;
		}
		
	}

	/**
	 * Получение списка полей для фильтра по автомобилю
	 *
	 * @return array
	 */
	function getCarFilterFields() {

		$query = '
SELECT DISTINCT(crb_id) as `value`, crb_name as `title`
FROM d_catalog3_tad
	INNER JOIN car_modif ON crmf_id = mdf_id
	INNER JOIN car_model ON crm_id = crmf_crm_id
	INNER JOIN car_brand ON crb_id = crm_crb_id
ORDER BY crb_name
		';

		$arCarBrands = $this->adapter->getSqlResultArray($query);

		$result = [
			'brand'  => [
				'name'     => $this->getCarFiltersTechName('vendor'),
				'ajax'     => $this->searchUrl . 'ajax/models/',
				'required' => true,
				'values'   => $arCarBrands
			],
			'model'  => [
				'name'     => $this->getCarFiltersTechName('car'),
				'ajax'     => $this->searchUrl . 'ajax/modifies/',
				'required' => true
			],
			'modify' => [
				'name' => $this->getCarFiltersTechName('modification'),
				'required' => true
			],
			'year'   => [
				'name' => $this->getCarFiltersTechName('year')
			]
		];

		return $result;

	}

	/**
	 * Получение action url для формы фильтра по автомобилю
	 *
	 * @return string
	 */
	function getCarFilterActionUrl() {

		return $this->searchUrl . 'tdauto/';

	}

}