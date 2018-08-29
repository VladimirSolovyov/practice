<? if ($table_caption_cell['sorted']) { ?>
	<div class="web-table-header__sort-col">
		<?=$table_caption_cell['a']->render($this)?>
		<a class="web-table-header__sort-link web-table-header__sort-link_<?=$table_caption_cell['aImg']->sort_direction?>" href="<?=$table_caption_cell['aImg']->link?>"></a>
	</div>
<? } else { ?>
<?=$table_caption_cell['caption']?>
<? } ?>