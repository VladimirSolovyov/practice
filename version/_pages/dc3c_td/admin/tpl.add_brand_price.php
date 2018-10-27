<form action="/admin/td-conformity.html">
<?
//$brand = $_REQUEST['brand'];
$brand_info = $_USER['adapter']->getSqlResult("SELECT * FROM d_catalog3_navigation WHERE nav_id = " . (int)$_REQUEST['brand']);

$brand = $brand_info['nav_name'];

if(!empty($_REQUEST['add_pr_s']))
{
    $query = "INSERT INTO ".$__AR2['autoprice_db'].".producer_names SET prd_id = ".$_REQUEST['prd_id'].", name = '".$brand."'";
    $res = $_USER['adapter']->query($query);
	$prd_id = (int)$_REQUEST['prd_id'];
?>
    <b><?=tr('Производитель','dc');?> <?=$brand?> <?=tr('сохранён','dc');?>.</b><br /><?=tr('Можно закрыть данное всплывающее окно','dc');?>.
    <script>
        el = window.parent.document.getElementById("img_<?=$brand_info['nav_id']?>");
        el.parentNode.parentNode.removeChild(el.parentNode);
    </script>
<?
}
elseif (isset($_REQUEST['add_pr']))
{

	$prd_id = $this->addProducer($brand);
?>
    <b><?=tr('Производитель','dc');?> <?=$brand?> <?=tr('сохранён','dc');?>.</b><br /><?=tr('Можно закрыть данное всплывающее окно','dc');?>.
    <script>
        el = window.parent.document.getElementById("img_<?=$brand_info['nav_id']?>");
        el.parentNode.parentNode.removeChild(el.parentNode);
    </script>
<?
}
else
{
$query = "SELECT p.prd_id, UPPER(p.prd_name) as prd_name, UPPER(pn.name) as name FROM ".$__AR2['autoprice_db'].".producers p LEFT JOIN ".$__AR2['autoprice_db'].".producer_names pn ON p.prd_id = pn.prd_id ORDER BY prd_name";
$res = $_USER['adapter']->query($query);
while($row = $_USER['adapter']->fetch_row_assoc($res))
{
    $brands_price[$row['prd_name']][] = array($row['name'], $row['prd_id']);
}
//echo "<pre>".print_r($brands_price, true)."</pre>";
?>
<input type="hidden" name="brand" value="<?=(int)$_REQUEST['brand']?>"/>
<input type="hidden" name="step" value="add_brand"/>
<div style="border: #565656 solid 1px;padding:5px;">
    <p><b><?=tr('Добавить нового производителя','dc');?>.</b></p>
    <p><input type="submit" name="add_pr" value="<?=tr('Добавить производителя','dc');?> <?=$brand?>"/></p><br />
</div>
<br />
<b><?=tr('или','dc');?></b>
<br />
<br />
<div style="border: #565656 solid 1px;padding:5px;">
    <p><b><?=tr('Добавить возможного производителя для','dc');?>:</b></p>
    <p><select name="prd_id">
        <option value="">- <?=tr('не выбран','dc');?> -</option>
        <? 
        foreach($brands_price as $key => $br)
        {
            ?>
            <option value="<?=$br[0][1]?>"><?=$key?></option>
            <?
        }
        ?>
    </select>
    </p>
    <p><input type="submit" name="add_pr_s" value="<?=tr('Добавить возможного производителя','dc');?> <?=$brand?>"/></p><br />
</div>
<?
}

if ($prd_id && $_REQUEST['brand']) {
	$query = "UPDATE d_catalog3_td_pricelist SET prd_id = " . (int)$prd_id . " WHERE dat_par_id = " . (int)$_REQUEST['brand'];
	$_USER['adapter']->query($query);
}

?>
</form>