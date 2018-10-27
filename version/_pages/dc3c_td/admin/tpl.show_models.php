<?
    $pricelist_count = 7;
    $text = "";
?>
<script>

    
</script>
<div id="div_all_<?=$brand?>">
<?

if (count($price_rows)>0)
{
foreach($price_rows as $position_price)
{
    $text .= '<div style="margin-bottom: 40px;" id="pr_'.$position_price->num_row.'">';
    $text .= '<table class="stable-body" cellpadding="1" border="1" width="100%" style="background:#808080;color:#fff;" ><tr>';
    $text .= '<td width="15" align="center" style="background:#fff;"><img title="'.tr('удалить строку из прайса','dc').'" src="/_sysimg/ar_delete.png" style="cursor:pointer;" onclick="delete_price_row('."'".$position_price->num_row."'".');"/></td>';
    foreach($position_price->columns as $price_row)
    {
        $text .= "<td>".$price_row."</td>";
    }
    $text .= '</tr></table>';
    
    if (count($position_price->brands) >0)
    {
        $text .= '<table class="stable-body" cellpadding="0" cellspacing="0" border="1" width="100%" ><tr>';
        $text .= '<td></td>';
        foreach($type_to_colums[$conf->type_catalog] as $header => $key)
        {
            if ($header != "id" && $header != "article")
                $text .= '<th>' . tr($columns_name[$key], 'dc') . "</th>";
        }
        $text .= '</tr>';
        foreach ($position_price->brands as $brands)
        {
            $text .= "<tr>";
            $text .= '<td><input type="radio" name="'.$position_price->num_row.'" value="'.$brands['dat_id'].'" '.($position_price->select_dat_id == $brands['dat_id']?" checked='checked'":"").'/></td>';
            foreach($type_to_colums[$conf->type_catalog] as $header => $key)
            {
                if ($header != "id" && $header != "article")
                    $text .= '<td>' . $brands[$key] . "</td>";
            }
            $text .= "</tr>";
        }
        $text .= "</table>";    
    }
    
    $text .= '</div>';
}

}
if ($text == "")
    $text .= tr("К сожалению, соответствий не найдено. Попробуйте изменить фильтры.",'dc');
else $text .= '<div align="right" style="padding: 5px;"><a href="#" onclick="toogle_brand(document.getElementById('."'img_all_brand_".str_replace(" ","",$brand)."'".'), '."'".$brand."'".');return false;">'.tr('Свернуть','dc').'</a>&nbsp;</div>';
//&nbsp;<a class="button" onclick="SaveModelsToBrand('."'".str_replace(" ","",$brand)."'".')" style="cursor: pointer;">применить</a>

echo $text;

?>
</div>