<?php

/**
	* Dinamic Catalog 3 Client
	* 
	* Для корректной работы необходимы файлы:
	*
	**/

require_once(__spellPATH("LIB:/content/d_catalog31_client/d_catalog3_client.php")); 
class d_catalog31_client_accum extends d_catalog31_client {
	
	
	function __construct($path, $options = array()) {
		
		global $_SYSTEM, $_SERVER;
		parent::__construct($path, $options);

		$this->dcCarApi = Loader::getApi('dcaccumcar');

		if ($_GET['carfilter']) {
			$this->carFilterResultRedirect();		
		}
	}
	
	/*
	 * ajaxActions
	 * возвращаем данные, запрошенные с помощью AJAX 
	 * 
	 */
	function ajaxActions($mod) {
		$this->dcCarApi = Loader::getApi("dcaccumcar");
		parent::ajaxActions($mod);
	}
	
	/*
	 * carFilterResultRedirect
	 * при использовании автофильтра берем модификацию
	 * и получаем по ней список параметров подходящих аккумов.
	 * После получения формируем урл с параметрами и делаем 301 редирект на него.
	 * 
	 * На всякий: если не получили параметров - редирект на основную страницу каталога.
	 * 
	 * TODO
	 * сделать без редиректов, если возможно.
	 * 
	 */
	function carFilterResultRedirect() {
		$url = $this->url();
		if ($_GET['crmf_id']) {
			$res = $this->getAccumParams($_GET['crmf_id']);
			
			if ($res) {
				$params = [];
				$params['crb_id'] = $_GET['crb_id'];
				$params['crm_id'] = $_GET['crm_id'];
				$params['crmf_id'] = $_GET['crmf_id'];
				$params['car_year'] = $_GET['car_year'];				
			
				$params['nav_id'] = $this->nav_id;
				$params['mdf_id'] = $_GET['crmf_id'];
				$params['year'] = $_GET['year'];
				
				$params = array_merge($params, $res);
				
				$url = $this->url($params);				
			}
		}
		
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: ".$url);
		exit(); 
		
	}
	
	function getModifyInfo($mdf_id) {
		$result = $this->adapter->getSqlResult("SELECT * FROM car_modif INNER JOIN car_model ON crm_id = crmf_crm_id INNER JOIN car_brand ON crb_id = crm_crb_id WHERE crmf_id = " . (int)$mdf_id);
		return $result;
	}
	
	function getAccumParams($mdf_id) {
		$res = $this->adapter->getSqlResult("SELECT * FROM d_catalog3_accum WHERE mdf_id = " . (int)$mdf_id);
//ed($res);
		if (empty($res)) {
			$options = $this->adapter->getSqlResultArraySingle("SELECT c1.crmf_id, c1.crmf_crm_id as crm_id FROM car_modif c1 INNER JOIN d_catalog3_accum ON mdf_id = c1.crmf_id 
INNER JOIN car_modif c2 ON c2.crmf_id = " . (int)$mdf_id . " WHERE c1.crmf_crm_id = c2.crmf_crm_id", 'crmf_id', 'crm_id');

			$crm_id = reset($options);
			$options = array_keys($options);

			$yearList = $modifyList = $mapAssign = [];
			Loader::getApi('car')->generateYearAndModifyListByModel((int)$crm_id, $yearList, $modifyList, $mapAssign);
			$firstYear = reset($yearList); // получаем самый ранний год

			$modifs = array_intersect($options, $mapAssign[$firstYear]); // получаем модификации из раннего года с инфой о шинах. берем инфу для первой
			$modif = reset($modifs);
			$res = $this->adapter->getSqlResult("SELECT * FROM d_catalog3_accum WHERE mdf_id = " . (int)$modif);
		}

		switch ($res['polarity']){
			case 'прямая':
				$polarity = '1-прямая';
				break;
			case 'обратная':
				$polarity = '0-обратная';
				break;
			default :
				$polarity = '';
		}
		
		$result = [];
		
		if (!empty($polarity)) {
			$result['dat_field9'] = $polarity;
		}
		if (!empty($res['length'])) {
			$result['dat_field4'] = trim($res['length']);
		}
		if (!empty($res['width'])) {
			$result['dat_field5'] = trim($res['width']);
		}
		if (!empty($res['height'])) {
			$result['dat_field6'] = trim($res['height']);
		}
		//ed($result);
		return $result;
	}
	
	
	function where() {
		
		//ed($this->ses['filter'], 1);
		//$filterKeys = array_key_exists
		foreach ($this->ses['filter'] as $key => $value) {
			if (in_array($key,['dat_field4','dat_field5','dat_field6','dat_field9'])) {
				if (strripos($value,',') !== false) {
					$vals = explode(',', $value);
					//ed($vals, 1);
					$this->filter_query_arr[$key] = "`$key` IN ('" . implode("','", $vals) . "')";
				}
			}
			if (in_array($key,['dat_field4','dat_field5','dat_field6'])) {
				if (strripos($value,'-') !== false) {
					$vals = explode('-', $value);
					//ed($vals, 1);
					if (!empty($vals[0]) && !empty($vals[1]))
					$this->filter_query_arr[$key] = "`$key` BETWEEN " . (int)$vals[0] . " AND " . (int)$vals[1];
				}
			}
		}
		
		$result = parent::where();
		return $result;
	}

	/**
	 * Получение списка полей для фильтра по автомобилю
	 *
	 * @return array
	 */
	function getCarFilterFields() {

		$result = [
			'brand'  => [
				'name'     => 'crb_id',
				'ajax'     =>  $this->url() . 'ajax/models/',
				'required' => true
			],
			'model'  => [
				'name'     => 'crm_id',
				'ajax'     =>  $this->url() . 'ajax/modifies/',
				'required' => true
			],
			'modify' => [
				'name'     => 'crmf_id',
				'required' => true
			],
			'year'   => [
				'name' => 'car_year'
			]
		];

		return $result;

	}

}
$dc3 = new d_catalog31_client_accum(__FILE__);

$dc3->render();	
?>