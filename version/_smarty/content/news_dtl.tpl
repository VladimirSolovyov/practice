<div class="news-detail">
	<div class="news-detail__header">
		<h1 class="news-detail__title">{%php%}echo tr('Новости'){%/php%}</h1>
		<a class="news-detail__all" href="/about/news/">{%php%}echo tr('Перечень новостей'){%/php%}</a>
	</div>
{%strip%}

{%php%}

	include(__spellPATH("SMARTY_LIB:/content/_sysTables/module.detail-template-func.php"));
	
	if ($validRequest) {

	global $_SYSTEM;
	if (!isset($_SYSTEM->PROMO_PARTS["site_title"]["prm_content"])) $_SYSTEM->SITE_TITLE = $this->_tpl_vars['caption'];
	if (!isset($_SYSTEM->PROMO_PARTS["description"]["prm_content"])) $_SYSTEM->DESCRIPTION = $this->_tpl_vars['caption'];
	
	$date = explode(' ',$this->_tpl_vars['datetime']);
	$this->_tpl_vars['russian_date'] = russian_date($date[0], 'array');
{%/php%}

<div class="news-detail__item">

	<h2 class="news-detail__subject">{%$caption%}</h2>

	<div class="news-detail__date">{%php%}echo _c_strftime('%d %B %Y', strtotime($this->_tpl_vars['datetime']));{%/php%}</div>

	{%if $full_text%}
		<div class="news-detail__text">
			{%eval var=$full_text %}
		</div>
	{%/if%}

</div>

{%php%}

	}

{%/php%}

</div>

{%/strip%}