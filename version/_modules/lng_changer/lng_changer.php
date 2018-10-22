<?
/**
 * Lng_ChangerModule - модуль переключатель языков на сайте
 *
 * @package    CMS
 * @subpackage module
 * @author     s.rostunov
 * @copyright  2016
 */
class Lng_ChangerModule extends ClientAccessModule {

	/**
	 * основная функция модуля
	 */
	function Process() {

		$arLng = Loader::getApi('translate')->getArLng();
		$baseCLUrl = rtrim($_SERVER["REQUEST_URI"], '?&').(strpos(rtrim($_SERVER["REQUEST_URI"], '?&'), '?') === false ? '?' : '&').'change-lng=';

		$this->xml_docs['arLng'] = $arLng;
		$this->xml_docs['baseCLUrl'] = $baseCLUrl;

	}

}