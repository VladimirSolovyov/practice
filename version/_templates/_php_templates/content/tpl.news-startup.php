<?
$_PG_rowsAtPage = 3;
include(__spellPATH("PHP_TEMPLATES_LIB:/content/_sysTables/module.table-template-func.php"));
if (!empty($data)) {
?>
<div class="last-news__header">
	<span class="last-news__title"><?=tr('Последние новости', 'Template')?></span>
	<a class="last-news__all" href="/about/news/"><?=tr('Все новости', 'Template')?></a>
</div>
<div class="row last-news__list">
	<? foreach ($data as $row) { ?>
		<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 last-news__item">
			<div class="last-news__date"><?=$row['russian_date']['day']?>.<?=substr($row['datetime'],5,2);?>.<?=$row['russian_date']['year']?></div>
			<a class="last-news__short-text" href="/about/news/<?=$row['id']?>/"><?=tr($row['caption'], 'MetaContent')?> <?=($row['short_text'] != $row['caption'] ? $row['short_text'] : '')?></a>
		</div>
	<? } ?>
</div>
<? } ?>