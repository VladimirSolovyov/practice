<?php /* Smarty version 2.6.14, created on 2017-12-08 13:04:48
         compiled from /home/www/materikavto.ru/www/_smarty/content/news_dtl.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', '/home/www/materikavto.ru/www/_smarty/content/news_dtl.tpl', 30, false),)), $this); ?>
<div class="news-detail">
	<div class="news-detail__header">
		<h1 class="news-detail__title"><?php echo tr('Новости') ?></h1>
		<a class="news-detail__all" href="/about/news/"><?php echo tr('Перечень новостей') ?></a>
	</div>
<?php echo '';  

	include(__spellPATH("SMARTY_LIB:/content/_sysTables/module.detail-template-func.php"));
	
	if ($validRequest) {

	global $_SYSTEM;
	if (!isset($_SYSTEM->PROMO_PARTS["site_title"]["prm_content"])) $_SYSTEM->SITE_TITLE = $this->_tpl_vars['caption'];
	if (!isset($_SYSTEM->PROMO_PARTS["description"]["prm_content"])) $_SYSTEM->DESCRIPTION = $this->_tpl_vars['caption'];
	
	$date = explode(' ',$this->_tpl_vars['datetime']);
	$this->_tpl_vars['russian_date'] = russian_date($date[0], 'array');
  echo '<div class="news-detail__item"><h2 class="news-detail__subject">';  echo $this->_tpl_vars['caption'];  echo '</h2><div class="news-detail__date">';  echo _c_strftime('%d %B %Y', strtotime($this->_tpl_vars['datetime']));  echo '</div>';  if ($this->_tpl_vars['full_text']):  echo '<div class="news-detail__text">';  echo smarty_function_eval(array('var' => $this->_tpl_vars['full_text']), $this); echo '</div>';  endif;  echo '</div>';  

	}

  echo '</div>'; ?>