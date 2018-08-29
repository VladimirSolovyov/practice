<? ob_clean(); ?>
	<link rel="stylesheet" href="/_syscss/style.min.css">
	<link rel="stylesheet" href="/_css/style.min.css">
<?  ?><style>

	table {
		border-collapse: collapse;
	}

	#detail_info ul {
		padding: 0;
		margin: 0;
	}

	.dinfo_head {
		line-height: 20px;
		margin-bottom: 10px;
	}

	.dinfo_producer {
		color: #000000;
		font-size: 20px;
		font-weight: bold;
		text-transform: uppercase;
	}

	.dinfo_article {
		color: #c62828;
		font-size: 20px;
		font-weight: normal;
	}

	#dinfo_tabs {
		margin-bottom: 15px;
		overflow: hidden;
	}

	#dinfo_tabs li {
		background-color: #f5f5f5;
		display: block;
		float: left;
		line-height: 44px;
		position: relative;
		overflow: visible;
		z-index: 600;
		height: 44px;
	}

	#dinfo_tabs li:hover,
	#dinfo_tabs li.active_tab {
		background-color: #c62828;
	}

	#dinfo_tabs li:hover a,
	#dinfo_tabs li.active_tab a {
		background-color: #c62828;
		color: #ffffff;
	}

	#dinfo_tabs a {
		font-size: 14px;
		font-weight: 400;
		color: #999999;
		text-decoration: none;
		background-repeat: no-repeat;
		background-position: left;
		padding: 0px 16.5px 0px 16.5px;
		display: block;
		width: auto;
		float: left;
		height: 44px;
		line-height: 44px;
	}

	#dinfo_tabs a span {
		color: #000000;
		font-weight: bold;
		font-size: 12px;
	}

	#dinfo_tabs a:hover span {
		border-bottom: transparent 2px solid;
	}

	.dinfo {
		min-width: 600px;
		overflow: hidden;
	}

	.dinfo-tab-item {
		height: 340px;
		overflow: auto;
	}

	.dinfo_info_block {
		color: #000000;
		padding-left: 30px;
		vertical-align: top;
	}

	.dinfo_info_block th {
		background: #ececec;
		font-size: 16px;
		font-weight: bold;
		padding: 3px 0px;
	}

	.dinfo_info_block td {
		font-size: 14px;
		padding: 8px 0px;
		border-bottom: 1px solid #eeeeee;
	}

	.dinfo_info_block tr:last-child td {
		border-bottom: none;
	}
	.dinfo_info_block .dinfo_td_name {
		padding-right: 10px;
		color: #999999;
	}

	.dinfo__comment {
		border-bottom: none;
		padding-top: 20px;
	}

	.dinfo__comment-title {
		font-size: 14px;
		font-weight: 500;
		margin-bottom: 0px;
		margin-top: 18px;
	}


	.dinfo_pictures_block {
		width: 280px;
		vertical-align: top;
	}

	#detail_picture_img {
		cursor: pointer;
	}

	#detail_picture_close {
		display: none;
		position: absolute;
		width: 30px;
		height: 30px;
		right: -15px;
		top: -15px;
		background: url(data:image/png;base64,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) no-repeat center;
		border: none;
	}

	#detail_picture {
		border: #eeeeee 1px solid;
		background: #FFF;
		padding: 1px;
		position: relative;
		margin-bottom: 10px;
	}
	
	#detail_picture img {
		max-height: 290px;
		object-fit: contain;
	}


	.detail_picture_preview {
		border: #eeeeee 1px solid;
		padding: 1px;
		cursor: pointer;
		height: 88px;
		width: 88px;
		display: flex;
		justify-content: center;
		align-items: center;
		overflow: hidden;
	}

	.active_picture {
		border: #999999 2px solid;
	}

	.dapply-data-scroll {
		overflow: auto;
		height: 420px;
	}


	.dapply {
		width: 100%;
		font-size: 14px;
		line-height: 14px;
		color: #333333;
		border: 1px solid #eeeeee;
	}

	.dapply-col {
		padding: 5px 10px;
		border: #eeeeee 1px solid;
		line-height: 16px;
		height: 36px;
	}

	.dapply__date {
		width: 80px;
		text-align: center;
	}

	.dapply__body {
		color: #999999;
	}

	.dapply__cc {
		width: 104px;
		text-align: center;
	}

	.dapply-header {
		background-color: #eeeeee;
		width: 100%;
	}

	.dapply-header__col {
		text-align: left;
		border: 1px solid #eeeeee;
		color: #666666;
		font-weight: normal;
		font-size: 12.5px;
		height: 38px;
		vertical-align: middle;
		padding-left: 12px;
	}

	.dapply-parrent {
		background-color: #ffffff;
	}

	.dapply-parrent__col {
		text-align: left;
		padding-left: 10px;
		height: 44px;
		vertical-align: middle;
		color: #333333;
		font-size: 15px;
		font-weight: 500;
		border: #eeeeee 1px solid;
	}

	.odd {
		background-color: #f8f8f8;
	}

	.even {

		background-color: #ffffff;
	}

	.hide {
		display: none
	}

	.dparams {
		width: 100%;
		font-size: 14px;
		line-height: 14px;
		color: #333333;
		border: 1px solid #eeeeee;
	}

	.dparams-header {
		background-color: #eeeeee;
	}

	.dparams-header__col {
		text-align: left;
		height: 37px;
		padding-left: 30px;
		padding-right: 30px;
	}

	.dparams-col {
		padding-left: 30px;
		color: #333333;
		height: 37px;
	}

	.dparams-col--caption {
		color: #999999;
	}



</style><?  ?>

	<script type="text/javascript" src="/_syslib/mootools.js"></script>
	<script type="text/javascript" src="/_syslib/lib.common.js"></script>
	<script type="text/javascript" src="/_syslib/mootools-more.js"></script>


	<div id="detail_info">

		<div class="dinfo_head">
			<span class="dinfo_producer"><?= $DetailInfo['producer_name'] ?></span>
			<span class="dinfo_article"> <?= ($DetailInfo['code_src'] != '' ? $DetailInfo['code_src'] : $DetailInfo['code']) ?></span>
		</div>

		<?if ($tecdocInfo or $schemaUrl):?>
			<div id="dinfo_tabs" class="flc">
				<ul>
					<li class="dinfo_tab active_tab" data-tab-name="dinfo"><a href="#"><?= $MSG['DetailInfoModule']['msg2'] ?></a><span class="tab_act"></span></li>
				<?if ($tecdocInfo):?>
					<li class="dinfo_tab" data-tab-name="dparams"><a href="#"><?= $MSG['DetailInfoModule']['msg20'] ?></a><span></span></li>
					<li class="dinfo_tab" data-tab-name="dapply"><a href="#"><?= $MSG['DetailInfoModule']['msg21'] ?></a><span></span></li>
					<?if (!empty($tecdocInfo['originalReplaces'])):?>
						<li class="dinfo_tab" data-tab-name="dreplace"><a href="#"><?= $MSG['DetailInfoModule']['msg28'] ?></a><span></span></li>
					<?endif;?>
				<?endif;?>
				<?if ($schemaUrl):?>
					<li>
						<a class="dinfo_schemaLink" data-tab-name="dschema" href="<?= $schemaUrl ?>" target="_blank"><?= tr('Посмотреть на схеме', 'DetailInfoModule') ?></a><span></span>
					</li>
				<?endif;?>
				</ul>
			</div>
		<?endif;?>

		<div class="dinfo" id="dinfo_div">

			<? if ($info_error) { ?>

				<p><?= $MSG['DetailInfoModule']['msg7'] ?></p>

			<? } else { ?>

				<table width="100%" id="dinfo" class="tab">
					<tr>
						<td class="dinfo_pictures_block">
							<div class="flc">
								<? $show = false; ?>
								<? if (count($pictures) > 0) { ?>
									<? foreach ($pictures as $key => $picture) { ?>
										<? if (empty($picture)) continue; ?>

										<? $show = true; ?>

										<?
										//для удаленных картинок с сервиса надо переделать подсчет размера
										//http://stackoverflow.com/questions/4635936/super-fast-getimagesize-in-php
										list($imgWidth, $imgHeight, $imgType, $imgStr) = getimagesize($picture);

										if (strpos($picture, $CONST['site_root']) === false) {

											if (strpos($picture, '/home/') !== false) {
												//картинка из общей директории текдока
												$image = str_replace('/home', '', str_replace('/home/www', '', $picture));
											} else {
												//картинка с другого сервера
												$image = $picture;
											}

										//если не подключена библиотека img
										} elseif (!function_exists("imagecreatefromjpeg") && preg_match("/jpg$/", $picture)) {

											$pictureName = str_replace($CONST['site_root'], "", $picture);
											$image = $pictureName;

										//делаем превьюшку локальной картинки
										} else {

											if ($imgWidth > 500 || $imgHeight > 500) {
												$imgWidth = $imgHeight = 500;
											}

											$image = getThumbPath($picture, $imgWidth, $imgHeight);

										}
										?>

										<? if ($key == 0) { ?>
											<div id="detail_picture">
												<img src="<?= $image ?>" id="detail_picture_img" style="width:280px" alt="" title="" onclick="resizeImage(this)"/>
												<a id="detail_picture_close" href="#" onclick="resizeImage(this)"></a>
											</div>
										<? } ?>

										<div id="dpict<?= $key ?>" class="leftside detail_picture_preview <?= ($key == 0 ? 'active_picture' : '') ?>">
											<img id="pict<?= $key ?>" src="<?= $image ?>" style="width:68px" alt="" title="" onclick="setImg(<?= $key ?>)"/>
										</div>

									<? } ?>

								<? } ?>
								<? if (!$show) { ?>
									<div id="detail_picture" style="height:150px; text-align:center; font-size: 12px; padding-top:120px;">
										<p><?= $MSG['ModulePicture']['msg9'] ?></p>
									</div>
								<? } ?>
							</div>
						</td>
						<td class="dinfo_info_block">
							<table width="100%">
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg10'] ?></td>
									<td class="dinfo_td_value"><?= ($DetailInfo['detail_name'] != '' ? $DetailInfo['detail_name'] : '&nbsp;') ?></td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg8'] ?></td>
									<td class="dinfo_td_value"><?= ($DetailInfo['code_src'] != '' ? $DetailInfo['code_src'] : $DetailInfo['code']) ?></td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg9'] ?></td>
									<td class="dinfo_td_value"><?= $DetailInfo['producer_name'] ?></td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg11'] ?></td>
									<?
										if ($usePartInfoWeight) {
											$weight = (float)$DetailInfo['weight'] > 0 ? (float)$DetailInfo['weight'] : (float)$tecdocInfo['weight'];
										} else {
											$weight = (float)$DetailInfo['weight'];
										}
									?>
									<td class="dinfo_td_value"><?= ($weight > 0 ? number_format($weight, 3, '.', ' ') : '-') ?></td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg14'] ?></td>
									<td class="dinfo_td_value"><?= (round($PriceInfo['final_price_display'] * 100) / 100) ?></td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg15'] ?></td>
									<td class="dinfo_td_value">
										<? if ($PriceInfo['remains'] != '') { ?>

											<? if (w2u($PriceInfo['remains']) == 'есть') { ?>

												<img src="/images/check.png"/>

											<? } else { ?>

												<?= $PriceInfo['remains'] ?>

											<? } ?>

										<? } else { ?>

											&nbsp;

										<? } ?>
									</td>
								</tr>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg16'] ?></td>
									<td class="dinfo_td_value"><?= ($PriceInfo['min_quantity'] != '' ? $PriceInfo['min_quantity'] : '&nbsp;') ?></td>
								</tr>
								<? if((int)$PriceInfo['final_price'] != 0) { ?>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg17'] ?></td>
									<td class="dinfo_td_value"><?= ($PriceInfo['term'] == 0 ? $MSG['DetailInfoModule']['msg15'] : $PriceInfo['term']) ?></td>
								</tr>
								<? } ?>
								<tr>
									<td class="dinfo_td_name"><?= $MSG['DetailInfoModule']['msg18'] ?></td>
									<td class="dinfo_td_value"><?= ($PriceInfo['refresh_date'] != '' ? $PriceInfo['refresh_date'] : '&nbsp;') ?></td>
								</tr>

								<? if ($PriceInfo['price_comment']): ?>
									<tr class="dinfo__comment">
										<td colspan="2">
											<div class="dinfo__comment-title"><?= $MSG['DetailInfoModule']['msg19'] ?></div>
											<div class="dinfo__comment-text"><?= $PriceInfo['price_comment'] ?></div>
										</td>
									</tr>
								<? endif ?>

								<? if ($DetailInfo['info']): ?>
									<tr>
										<td colspan="2"></td>
									</tr>
									<tr>
										<th colspan="2"><?= $MSG['DetailInfoModule']['msg12'] ?></th>
									</tr>
									<tr>
										<td colspan="2" class="dinfo_td_value"><?= $DetailInfo['info'] ?></td>
									</tr>
								<? endif ?>
							</table>
						</td>
					</tr>
				</table>

				<?if ($tecdocInfo):?>
					<div id="dparams" class="hide tab">
						<div class="dapply-data-scroll">
							<table class="dparams">
							<tr class="dparams-header">
								<th class="dparams-header__col" colspan="2">
									<?= $MSG['DetailInfoModule']['msg35'] ?>
								</th>
							</tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg29'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['code']?></td>
							<tr>
							<tr class="odd">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg30'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['brand']?></td>
							<tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg31'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['name']?></td>
							<tr>
							<tr class="odd">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg11'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['weight']?></td>
							<tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg32'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['prePacking']?></td>
							<tr>
							<tr class="odd">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg33'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['replaceCode']?></td>
							<tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= tr('Barcode', 'DetailInfoModule') ?></td>
								<td class="dparams-col"><?=$tecdocInfo['barCode']?></td>
							</tr>
							<?foreach ($tecdocInfo['parameters'] as $id => $param):?>
								<tr class="<?=($id % 2 == 0 ? "odd" : "even")?>">
									<td class="dparams-col dparams-col--caption"><?=$param['name']?></td>
									<td class="dparams-col"><?=$param['value']?></td>
								<tr>
							<?endforeach;?>
							<tr class="dparams-header">
								<th class="dparams-header__col" colspan="2">
									<?= $MSG['DetailInfoModule']['msg34'] ?>
								</th>
							</tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg30'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['brandInfo']['key']?></td>
							<tr>
							<tr class="odd">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg10'] ?></td>
								<td class="dparams-col"><?=$tecdocInfo['brandInfo']['name']?></td>
							<tr>
							<tr class="even">
								<td class="dparams-col dparams-col--caption"><?= $MSG['DetailInfoModule']['msg36'] ?></td>
								<? $url = preg_replace('~^(http://|https://|//)~Uis', '', $tecdocInfo['brandInfo']['site']); ?>
								<td class="dparams-col"><a href="//<?=$url?>" rel="nofollow" target="_blank"><?=$url?></a></td>
							<tr>
							<?foreach ($tecdocInfo['brandInfo']['additional'] as $id => $info):?>
								<tr class="<?=($id % 2 == 0 ? "odd" : "even")?>">
									<td class="dparams-col dparams-col--caption"><?=$info['name']?></td>
									<td class="dparams-col"><?=$info['value']?></td>
								<tr>
							<?endforeach;?>
						</table>
						</div>
					</div>

					<div id="dapply" class="hide tab">
						<div class="dapply-data-scroll">
							<table class="dapply">
								<tr class="dapply-header">
									<th class="dapply-header__col dapply__modif"><?= $MSG['DetailInfoModule']['msg22'] ?></th>
									<th class="dapply-header__col dapply__date"><?= $MSG['DetailInfoModule']['msg23'] ?></th>
									<th class="dapply-header__col dapply__kw"><?= $MSG['DetailInfoModule']['msg24'] ?></th>
									<th class="dapply-header__col dapply__hp"><?= $MSG['DetailInfoModule']['msg25'] ?></th>
									<th class="dapply-header__col dapply__cc"><?= $MSG['DetailInfoModule']['msg26'] ?></th>
								</tr>
								<?foreach($tecdocInfo['apply'] as $brand => $brandCarList):?>
									<tr class="dapply-parrent">
										<th class="dapply-parrent__col"><?=$brand?></th>
										<th class="dapply-parrent__col"></th>
										<th class="dapply-parrent__col"></th>
										<th class="dapply-parrent__col"></th>
										<th class="dapply-parrent__col"></th>
									</tr>
									<?foreach($brandCarList as $id => $car):?>
										<tr class="dapply__row <?=($id % 2 == 0 ? "even" : "odd")?>">
											<td class="dapply-col dapply__modif">
												<?=$brand?> <?=$car['model']?> <?=$car['modif']?>
												<div class="dapply__body"><?=$car['body']?></div>
											</td>
											<td class="dapply-col dapply__date"><?=substr($car['dateFrom'], 3); ?>-<?=substr($car['dateTo'], 3);?></td>
											<td class="dapply-col dapply__kw"><?=$car['kw']?></td>
											<td class="dapply-col dapply__hp"><?=$car['hp']?></td>
											<td class="dapply-col dapply__cc"><?=$car['cc']?></td>
										</tr>
									<?endforeach;?>
								<?endforeach;?>
							</table>
						</div>
					</div>
					<div id="dreplace" class="hide tab">
						<table class="dapply">
							<tr class="dapply-header">
								<th class="dapply-header__col"><?= $MSG['DetailInfoModule']['msg30'] ?></th>
								<th class="dapply-header__col"><?= $MSG['DetailInfoModule']['msg8'] ?></th>
							</tr>
							<?foreach($tecdocInfo['originalReplaces'] as $id => $replace):?>
								<tr class="dapply__row <?=($id % 2 == 0 ? "even" : "odd")?>">
									<td class="dapply-col"><?=$replace['brand']?></td>
									<td class="dapply-col"><?=implode(', ', $replace['codes']);?></td>
								</tr>
							<?endforeach;?>
						</table>
					</div>
				<?endif;?>

				<?if ($schemaUrl):?>
					<div id="dschema" class="dschema hide tab">
						<iframe src="<?=$schemaUrl?>" height="100%" width="100%" id="dschema_frame" name="dschema_frame" class="autoHeight" frameborder="0"></iframe>
					</div>
				<?endif;?>

        <?  ?><script type="text/javascript">
	//TODO убрать это безобразие
	var resized = false;

  var tabs = document.querySelectorAll('.dinfo_tab');
  var schemaLink = document.querySelector('.dinfo_schemaLink');

  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener('click', function() {
      changeClass(this, this.getAttribute('data-tab-name'));
    }, false);
  }
  if (schemaLink) {
    schemaLink.addEventListener('click', function(e) {
      if (!window.parent.isMobile) {
        changeClass(this.parentNode, this.getAttribute('data-tab-name'));
        e.preventDefault();
      }
    }, false)
  }

	function setImg(key) {
		$('detail_picture_img').src = $('pict' + key).src;
		$$('.detail_picture_preview').removeClass('active_picture');
		$('dpict' + key).addClass('active_picture');
		resized = false;
	}

	function changeClass(elem, Tab) {

		$$('li.active_tab').each(function(el){
			el.removeClass('active_tab');
		});

		$$('.tab').each(function(el){
			el.addClass('hide');
		});

		elem.addClass('active_tab');

		document.id(Tab).removeClass('hide');
	}

	function resizeImage(elem) {

		var maxWidth = 640;
		var maxHeight = 410;
		var ratio = 0;

		var img = $('detail_picture');

		var width = img.getWidth();
		var height = img.getHeight();

		if(width > height){
			height = height * (maxWidth / width);
			width = maxWidth;

			if (height > maxHeight) {
				width = maxWidth * (maxHeight / height);
				height = maxHeight;
			}

		} else {
			width = width * (maxHeight / height);
			height = maxHeight;
		}

		var position = 'absolute';

		if (resized) {
			width = '270';
			height = null;
			position = 'initial';
			$('detail_picture_close').hide();
			resized = false;
		} else {
			position = 'absolute';
			$('detail_picture_close').show();
			resized = true;
		}

		var morph = new Fx.Morph(img, {
			onComplete: function(el){
				el.style.position = position;
			}
		});

		morph.start({
			'width' : width,
			'height' : height,
			'position' : 'absolute'
		});

		$('detail_picture_img').morph({
			'width' : width,
			'height' : height
		});
	}
  if (!window.parent.isMobile) {
    var schemaFrame = document.getElementById('dschema_frame');
    if(schemaFrame) {
		schemaFrame.addEventListener('load', function () {
			var frameWindow = this.contentWindow;
			var setSize = function() {
				var h = frameWindow.document.documentElement.scrollHeight;
				var w = frameWindow.document.documentElement.scrollWidth;
				var parentFrame = window.parent.getElementById('modal-container-frame');

				if (w > 600) {
					parentFrame.width = w + 50;
				}
				this.height = h;
				this.width = w;

			};
			setInterval(setSize.bind(this), 500);
		}, false);
	}
  }

</script><?  ?>
			<? } ?>

		</div>

	</div>

	</body>
<? exit(); ?>