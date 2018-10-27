<h1><?=tr('Установка соответствия прайс-листа и каталога Шин/Дисков','dc');?></h1>
<script>
	var columns = new Array();
	<?for($i = 0; $i < $conf->max_cols; $i++){?>
	columns['<?=$i?>'] = 1;
	<?}?>
</script>
<style>
	.add-columns {
		background: url("/_syslib/import2basket/page_add.png") no-repeat scroll 0 0 transparent;
		display: block;
		height: 16px;
		width: 16px;
	}

	.remove-columns {
		background: url("/_syslib/import2basket/page_delete.png") no-repeat scroll 0 0 transparent;
		display: block;
		height: 16px;
		width: 16px;
	}

	.remove-div {
		margin-top: 5px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function () {

		var selects = $('.controlA')

		selects.change(function (event) {

			var value = this.value;

			selects.each(function (el) {

				if (el.value == value)
					el.value = '';
			});
			this.value = value;
		});


		$('#add').click(function (event) {
			$('#loader').addClass('loading');
			$('#tableForm').submit();

			event.stop();
		});

		$('.remove-add').click(function (event) {

			var td = $(this).parent('td').parent('tr');
			var inpt = $('input', td).eq(0);
			if (td.hasClass('skip')) {
				td.removeClass('skip');
				inpt.val(0);
			} else {
				td.addClass('skip');
				inpt.val(1);
			}

		});

		$('.add-columns').click(function (event) {

			var tr = $(this).parents('tr');
			sel = $('select', tr).eq(0);
			var td = $("td", tr).eq(0);
			var i = td.attr("id");
			var select = '<div><select name="col[' + i + '][' + columns[i] + ']" class="controlC">' + sel.html() + '</select></div>';
			columns[i]++;
			td.append(select);
			if (columns[i] == 2) {
				var td2 = $(this).parents('td');
				var div = $("<div></div>").addClass("remove-div");
				var a = $("<a></a>").addClass("remove-columns").attr("href", "#");
				a.click(function (event) {
					var tr = $(this).parents('tr');
					var td = $("td", tr).eq(0);
					var i = td.attr("id");
					sel = $('select', td).eq(columns[i] - 1).parent();

					sel.remove();
					columns[i]--;
					if (columns[i] == 1) $(this).parent().remove();

				});
				div.append(a);
				td2.append(div);

			}
		});

		$(".select-catalog").change(function (event) {
			<?for($i = 0; $i < $conf->max_cols; $i++){?>
			if ($(this).val() == 'tires')
				<?
				$columns = $this->getCatalogColumnsForSelect('tires');
				$str = '<select name="col['.$i.'][0]" class="controlC"><option value="">- '.tr('не выбран','dc').' -</option>';
				foreach ($columns as $key => $val) {
					$str .= '<option value="'.$key.'">'.$val.'</option>';
				}
				$str .= '</select>';
				 ?>
				var str = '<?=$str?>';
			else
				<?
				$columns = $this->getCatalogColumnsForSelect('discs');
				$str = '<select name="col['.$i.'][0]" class="controlC"><option value="">- '.tr('не выбран','dc').' -</option>';
				foreach ($columns as $key => $val) {
					$str .= '<option value="'.$key.'">'.$val.'</option>';
				}
				$str .= '</select>';
				 ?>
				var str = '<?=$str?>';
			var td = $('#<?=$i?>');
			td.html(str);
			var tr = td.parent();
			var td2 = $(".remove-div", tr);
			if (td2) td2.remove();

			<?}?>

		});

		$('.num_header').change(function (event) {

			var count = $(this).val();
			for (var i = 0; i < 7; i++) {
				var td = $(".remove-add").eq(i).parent('td').parent('tr');
				var inpt = $('input', td).eq(0);
				if (i >= count) {
					td.removeClass('skip');
					inpt.val(0);
				} else {
					td.addClass('skip');
					inpt.val(1);
				}
			}

		});

		var count = <?=$conf->num_head?>;
		for (var i = 0; i < 8; i++) {
			var td = $(".remove-add").eq(i).parent('td').parent('tr');
			var inpt = $('input', td).eq(0);
			if (i >= count) {
				td.removeClass('skip');
				inpt.val(0);
			} else {
				td.addClass('skip');
				inpt.val(1);
			}
		}

	});

	function setFilter() {
		/* var cols = new Array();
		<?for($i = 0; $i < $conf->max_cols; $i++){?>
		 cols['
		<?=$i?>'] = new Array();
		<?}?>
		 $(".controlC").each(function(index){
		 var str_a = new Array();
		 str_a = $(this).attr("name").split("[");
		 var i = str_a[1].replace("]","");
		 var j = str_a[2].replace("]","");
		 cols[i][j] = $(this).val();
		 });
		 var cols_str = "";
		 for (var key in cols) {
		 for (var key2 in cols[key]) {
		 if(key>0 && key2 == 0) cols_str += "|";
		 if(key2>0) cols_str += ",";
		 cols_str += cols[key][key2];
		 }
		 }
		 */

		var cols_str = "";
		$(".controlC").each(function (index) {
			var str_a = new Array();
			str_a = $(this).attr("name").split("[");
			var i = str_a[1].replace("]", "");
			var j = str_a[2].replace("]", "");
			var text = $(this).val();
			if (i > 0 && j == 0) cols_str += "|";
			if (j > 0) cols_str += ",";
			if (text != "") cols_str += text;
		});


		$('#showCatalog').html('<p><img src="/images/ajax-loader.gif" align="left" /> loading...</p>');
		$.ajax({type: 'POST', timeout: 180000, url: "/admin/td-conformity.html", data: {'step': 'showBrands', 'type': $(".select-catalog").val(), 'cols': cols_str, 'file_name': "<?=$_REQUEST['file_name']?>", 'pricelist_id': "<?=$_REQUEST['pricelist_id']?>", 'num_header': $('.num_header').val()}, success: function (data, html) {

			$("#showCatalog").html(data);

		},
			error: function (xhr, status, error) {
				$("#showCatalog").html("ERROR: " + xhr.responseText);
			}
		});
		return false;
	}

	function NewSelect(parId) {
		var parEl = document.getElementById(parId);
		var selectBox = document.createElement("Select");
		selectBox.name = "mySelectBox";
		var col0 = document.getElementById("col0");
		for (key in col0) {
			selectBox.add(new Option(key, col0[key]));
		}
		parEl.appendChild(selectBox);
	}
</script>
<div id="loader"></div>
<div style="margin: 10px 0;">
	<b><?=tr('Каталог','dc');?></b>:&nbsp;<select name="catalog" class="select-catalog">
		<option value="tires"<?= " selected='selected'"; //=($catalog_type == "tires"?" selected='selected'":"")?>>
			<?=tr('Шины','dc');?>
		</option>
		<option value="discs"<? //=($catalog_type == "discs"?" selected='selected'":"")?>><?=tr('Диски','dc');?></option>
	</select>
	&nbsp;&nbsp;
	<b><?=tr('Число строк шапки','dc');?>:&nbsp;</b><select name="num_header" class="num_header">
		<?
		$j = $conf->num_head > 50 ? $conf->num_head + 1 : 50;
		for ($i = 0; $i <= $j; $i++) {
			?>
			<option value="<?= $i ?>" <?= ($i == $conf->num_head ? "selected" : "") ?>><?= $i ?></option>
		<? } ?>
	</select>
</div>
<div id="content">
<? if(!$provider_id) {?>
	<div class="error"><?=tr('Не найдена информация о поставщике. Возможно была произведена некорректная загрузка прайса','dc');?>!</div>
<? }?>
	<div class="notice"><?=tr('Указание свойства "Производитель" обязательно','dc');?>!</div>
	<form action="<?= $scriptUrl ?>" method="post" id="tableForm">
		<div id="table-area" style="overflow: scroll;width:100%;height:300px;">
			<table width="100%" class="show-table" cellpadding="0" cellspacing="0">
				<!--<tr>
            <th></th>
            <? for ($i = 0; $i < $conf->max_cols; $i++): ?>
                <th>Столбец №<?= ($i + 1) ?></th>
            <? endfor ?>
        </tr>-->
				<tr>
					<!--<td></td>-->

					<? for ($i = 0; $i < $conf->max_cols; $i++): ?>
						<!-- Сейчас всегда колонки для шин - необходимо сделать зависимость от настроек  -->
						<th valign="top">
							<table cellpadding="1">
								<tr>
									<td id="<?= $i ?>" valign="top">
										<select name="col[<?= $i ?>][0]" class="controlC">
											<option value="">- <?=tr('не выбран','dc');?> -</option>
											<? $columns = $this->getCatalogColumnsForSelect('tires');
											foreach ($columns as $key => $val) {
												?>
												<option value="<?= $key ?>"><?= tr($val, 'dc') ?></option><?
											}
											?>
										</select>
									</td>
									<td valign="top">
										<a class="add-columns" href="#"></a>
									</td>
								</tr>
							</table>
						</th>
					<? endfor ?>
				</tr>

				<? foreach ($items as $k => $row): ?>
					<? if ($k > 70) break; ?>

					<tr class="<?= ($k % 2) ? 'odd' : 'even' ?>">
						<!--<td width="18" valign="top">
							<a href="#" class="remove-add"></a><input type="hidden" name="skip[]" value="0"></td>-->
						<? for ($i = 0; $i < $conf->max_cols; $i++): ?>
							<td>
								<div class="ceil_1">
									<?
									echo @$row[$i];
									?></div>
							</td>
						<? endfor ?>

					</tr>
				<? endforeach ?>

			</table>
		</div>
		<input type="hidden" name="step" value="add"/>
		<input type="hidden" name="clear" value="<?= $_POST['clear'] ?>"/>

		<div class="control">
			<a href="<?= $scriptUrl ?>" id="goback" class="button" style="float:left"><?=tr('выбрать другой прайс-лист','dc');?></a>
<? if ($allright) { ?>
			<a href="<?= $scriptUrl ?>" id="setFilter" class="button" style="float:right" onclick="return setFilter();"><?=tr('применить','dc');?>
				<?=tr('фильтры','dc');?></a>
<? } ?>
		</div>
	</form>

</div>
<div id="showCatalog" style="clear: both;padding: 10px 0px 10px 0px;"></div>
