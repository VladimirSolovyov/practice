<h1>{%php%}echo tr('Акции');{%/php%}</h1>
<a href="/about/actions/" class="pageLink">{%php%}echo tr('Перечень акций');{%/php%}</a>
{%strip%}

<div class="pageContent">

{%php%}

	include(__spellPATH("SMARTY_LIB:/content/_sysTables/module.detail-template-func.php"));
	
	if ($validRequest) {

	global $_SYSTEM;
	if (!isset($_SYSTEM->PROMO_PARTS["site_title"]["prm_content"])) $_SYSTEM->SITE_TITLE = $this->_tpl_vars['caption'];
	if (!isset($_SYSTEM->PROMO_PARTS["description"]["prm_content"])) $_SYSTEM->DESCRIPTION = $this->_tpl_vars['caption'];
	
	$date = explode(' ',$this->_tpl_vars['datetime']);
	$this->_tpl_vars['russian_date'] = russian_date($date[0], 'array');
{%/php%}
<br />
<div class="actions">
	<div class="actions_caption2"><h2>{%$caption%}</h2></div>
	
	{%if $img%}
		<div class="actions_image">
			<img src="{%$img%}" alt="{%$caption%}" title="{%$caption%}" />
		</div>
	{%/if%}
	{%if $full_text%}
		<div class="actions_fulltext">
			{%eval var=$full_text %}
		</div>
	{%/if%}
	<div class="actions_bottom_date">{%php%}echo _c_strftime('%d %B %Y', strtotime($this->_tpl_vars['datetime']));{%/php%}</div>
</div>

{%php%}

	}

{%/php%}

</div>

{%/strip%}