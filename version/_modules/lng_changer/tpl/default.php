<? if(!empty($channel) and !empty($items)) { ?>
<div id="tsnews">
	<div class="notice">
		<h2><?=tr($channel['title'], '_admin_startup')?></h2>
		<div>
		<? foreach($items as $key => $item) { ?>
			<div class="tsnew">
				<b><?=date('d.m.Y H:i', strtotime($item['date']))?></b> <a id="atsnew<?=$key?>" title="<?=tr('Подробная информация', 'Common')?>" href="<?=$item['link']?>" target="_blank"><?=$item['title']?></a><br/>
				<div id="desctsnew<?=$key?>" class="desc"><?=$item['desc']?></div>
				<div id="texttsnew<?=$key?>" class="text"><?=$item['text']?></div>
			</div>
		<? } ?>
		</div>
		<div class="info">
			<small><a href="https://www.tradesoft.ru/products/internet-magazin-avtozapchastej/news/" target="_blank"><?=tr('Все новости', '_admin_startup')?></a></small>
			<? if($showLink) { ?>
			<small><a href="/admin/access/groups.html"><?=tr('Настройка отображения новостей', '_admin_startup')?></a></small>
			<span style="display: none">Что за хрень творится с виджетом???</span>
			<? } ?>
		</div>
	</div>
<? } ?>
</div>

<style>
	#tsnews .info {
		text-align: right;
	}
	#tsnews .info small {
		margin-left: 30px;
	}
	#tsnews div.text {
		display: none;
		padding-top: 5px;
		padding-left: 15px;
	}
	#tsnews div.desc {
		padding-top: 5px;
		padding-left: 15px;
	}
	#tsnews {
		margin-top: 50px;
	}
	#tsnews h2{
		margin-top: 0;
		margin-bottom: 15px;
	}
	#tsnews a {
		cursor: pointer;
		text-decoration: underline;
		margin-left: 5px;
	}
	#tsnews .tsnew {
		border-top:  1px solid #808080;
		padding: 10px 0;
	}
	#tsnews :first-child.tsnew {
		border-top:  none;
		padding-top: 0;
	}
</style>

<script type="text/javascript">
	function toogleNew(id) {
		if($('texttsnew'+id).getStyle('display') == 'none') {
			$('texttsnew'+id).setStyle('display', 'block');
			$('desctsnew'+id).setStyle('display', 'none');
			$('atsnew'+id).set('title', '<?=tr('Краткая информация', 'Common')?>');
		} else {
			$('texttsnew'+id).setStyle('display', 'none');
			$('desctsnew'+id).setStyle('display', 'block');
			$('atsnew'+id).set('title', '<?=tr('Подробная информация', 'Common')?>');
		}
	}
</script>
