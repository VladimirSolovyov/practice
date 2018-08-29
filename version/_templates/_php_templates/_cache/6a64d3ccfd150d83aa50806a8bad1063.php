<?
if ($CONST['DOCTYPE_OFF'] !== true or ($CONST['DOCTYPE_ON'] === true and $CONST['DOCTYPE_OFF'] !== true)) {
	if (isset($CONST['DOCTYPE'])) {
		echo $CONST['DOCTYPE'];
	} else {
		if ($_SYSTEM->CHARSET == 'utf-8') {
			echo '<!DOCTYPE html>';
		}
	}
}
?>
<html lang="<?= $_SYSTEM->LNG ?>"<?= ($CONST["HtmlTagText"] ? ' ' . $CONST["HtmlTagText"] : '') ?>>
<head>
<?
global $__BUFFER, $CMS_API;

echo $__BUFFER->flushBuffer(PageBuffer::BUFFER_INDEX_HEADER_TOP); ?>
<?
if (!empty($_SYSTEM->SITE_TITLE)) {
	if (!$CONST['hide_meta_title']) {
?>
<meta name="title" content="<?= flushPageInfo($_SYSTEM->SITE_TITLE) ?>"/>
<?
	}
?>
<title><?= flushPageInfo($_SYSTEM->SITE_TITLE) ?></title>
<?
}

if (!empty($_SYSTEM->KEYWORDS)) {
?>
<meta name="keywords" content="<?= flushPageInfo($_SYSTEM->KEYWORDS) ?>"/>
<?
}

if (!empty($_SYSTEM->DESCRIPTION)) {
?>
<meta name="description" content="<?= flushPageInfo($_SYSTEM->DESCRIPTION) ?>"/>
<?
}

$favicon = !empty($CONST['favicon']) ? $CONST['favicon'] : "/favicon.ico";
?>
<link rel="shortcut icon" href="<?= $favicon ?>" type="image/x-icon"/>
<link rel="icon" href="<?= $favicon ?>" type="image/x-icon"/>

<? if (!$CONST['use_default_favicon']) { ?>
	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/images/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/images/favicons/manifest.json">
	<link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#c62828">
	<meta name="msapplication-TileColor" content="#b71c1c">
	<meta name="msapplication-TileImage" content="/images/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
<? } ?>

<?
if (!empty($_SYSTEM->CLASSIFICATION)) {
?>
<meta name="classification" content="<?= flushPageInfo($_SYSTEM->CLASSIFICATION) ?>"/>
<?
}

if (!empty($_SYSTEM->ADD_META_FIELDS)) {
	if (is_array($_SYSTEM->ADD_META_FIELDS) && count($_SYSTEM->ADD_META_FIELDS) > 0) {
		foreach ($_SYSTEM->ADD_META_FIELDS as $var => $value) {
			if ($var and $value) {
?>
<meta name="<?= $var ?>" content="<?= $value ?>"/>
<?
			}
		}
	}
}

if (!empty($_SYSTEM->ROBOTS)) {
?>
<meta name="robots" content="<?= $_SYSTEM->ROBOTS ?>"/>
<?
}

if (!empty($_SYSTEM->CHARSET)) {
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?= $_SYSTEM->CHARSET ?>"/>
<?
}

//блок использования компрессора
//подключим компрессор
if ($CONST['compress_output'] == true) {
	include_once(__spellPATH("LIB_UN:/compressor/compressor.php"));
	$Compressor = new Compressor();
}

$all_scripts = $all_styles = array();
if (is_array($_SYSTEM->CLIENT_SCRIPT_LIBS)) {
	foreach ($_SYSTEM->CLIENT_SCRIPT_LIBS as $client_script) {
		if (!trim($client_script)) {
			continue;
		}
		switch (true) {
			case strpos($client_script, 'SYSLIB:') !== false:
				$all_scripts [] = str_replace('SYSLIB:', '/_syslib', $client_script);
				break;
			case strpos($client_script, CMS_API::getProtocol(). '://') !== false:
			case strpos($client_script, '//') === 0:
				$all_scripts [] = $client_script;
				break;
			default:
				$all_scripts [] = $CONST["site_sub_dir"] . $CONST["client_script_libs_dir"] . $client_script;
		}
	}
}


$temp_scriptsPathA = $__BUFFER->scripts_path;
$__BUFFER->resetScripts();
if (is_array($temp_scriptsPathA)) $all_scripts = array_merge($all_scripts, $temp_scriptsPathA);
$excludeScripts = [];
if (!ADMIN_PAGE) {
	$excludeClientScripts = [
		'/_syslib/slide_menu/slide_menu.js',
		'/_syslib/squeezebox/squeezebox.js'
	];
	$excludeScripts = $excludeClientScripts;
}

$all_scripts = array_diff($all_scripts, $excludeScripts);

if ($CONST['compress_output'] == true) {
	foreach ($all_scripts as $client_script) $Compressor->js [] = $client_script;
	$__BUFFER->addScript($Compressor->LoadJs()); //формирование одной ссылки
} else {
	foreach ($all_scripts as $client_script) {
		$__BUFFER->addScript($client_script);
	}
}

//-------------------------------------------------------------------------
if (is_array($_SYSTEM->CSS_TABLES)) {
	foreach ($_SYSTEM->CSS_TABLES as $css) {
		if (!preg_match("/^SYSCSS:/", $css) and !preg_match("/^SYSLIB:/", $css)) {
			$css = $CONST["site_sub_dir"] . $CONST["css_dir"] . $css;
		} else {
			$css = preg_replace("/^SYSCSS:/", "/_syscss", $css);
			$css = preg_replace("/^SYSLIB:/", "/_syslib", $css);
		}
		$all_styles[] = $css;
	}
}
$temp_cssPathA = $__BUFFER->css_path;
$__BUFFER->resetStyles();
if (is_array($temp_cssPathA)) $all_styles = array_merge($all_styles, $temp_cssPathA);
$exclude_styles = [
	'/_syslib/slide_menu/slide_menu.css',
	'/_syslib/squeezebox/squeezebox_info.css',
	'/_css/client_styles.css',
];
$all_styles = array_diff($all_styles, $exclude_styles);
if(($key = array_search('/_css/client_styles.css', $all_styles)) !== false) {
	unset($all_styles[$key]);
}
$all_styles[] = '/_css/client_styles.css';

if ($CONST['compress_output'] == true) {
	foreach ($all_styles as $client_style) {
		$Compressor->css[] = $client_style;
	}
	$Compressor->css[] = '/_css/client_styles.css';
	$__BUFFER->addStyle($Compressor->LoadCss()); //формирование одной ссылки
} else {
	foreach ($all_styles as $client_style) {
		$__BUFFER->addStyle($client_style);
	}
	$__BUFFER->addStyle('/_css/client_styles.css');
}
//-------------------------------------------------------------------------

echo $__BUFFER->flushAll();
?>

<script>
	var jsTr = {<?=$__BUFFER->flushTrJs()?>};
</script>

</head>
