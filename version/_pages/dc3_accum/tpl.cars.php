<? 
if ($_GET['mdf_id']) {
	$modify = $this->getModifyInfo($_GET['mdf_id']);
?>
<?=tr('Аккумуляторы для', 'dc')?>: <b><?=$modify['crmf_name']?></b>
<?
} else {
?>
<?=tr('Подбор по автомобилю', 'dc')?>
<script>
	function selectMark(val) {
		jqWar.ajax({
		  url: "/accum/?ajax=1&crb_id=" + val,
		  success: function(data) {
			  jqWar('#carModel_div').html(data);
		  }
		});
		clearSelect('carModify');
		clearSelect('carYear');
	}
	function selectModel(val) {
		jqWar.ajax({
		  url: "/accum/?ajax=1&crm_id=" + val,
		  success: function(data) {
			  jqWar('#carModif_div').html(data);
		  }
		});
		clearSelect('carYear');
	}
	function selectModif(val) {
		jqWar.ajax({
		  url: "/accum/?ajax=1&crmf_id=" + val,
		  success: function(data) {
			  jqWar('#carYear_div').html(data);
		  }
		});
	}
	function selectYear(val) {
		mdfEl = jqWar('#carModify');
		if (mdfEl) {
			mdf_id = mdfEl.val();
		}
		if (val && mdf_id)
		jqWar.ajax({
		  url: "/accum/?ajax=1&year=" + val + "&mdf_id=" + mdf_id,
		  dataType: 'json',
		  success: function(data) {
			  if (data.url) {
				  location.href = data.url;
			  }
		  }
		});
	}
	
	function clearSelect(id) {
		el = jqWar('#' + id);
		if (el) {
			el.html('<option value="0">---</option>');
		}
	}
</script>
<?
$brands = $this->getCarMarks();
echo $this->renderCarSelect('carMark', 'selectMark', $brands);
?>
<div id="carModel_div"></div>
<div id="carModif_div"></div>
<div id="carYear_div"></div>
<?
}