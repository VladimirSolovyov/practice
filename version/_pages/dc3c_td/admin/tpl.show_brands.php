<script>

var del_brands = new Array();
var brand_price = new Array();

    function ScrollToElement(theElement){
    
        var selectedPosX = 0;
        var selectedPosY = 0;
                  
        while(theElement != null){
            selectedPosX += theElement.offsetLeft;
            selectedPosY += theElement.offsetTop;
            theElement = theElement.offsetParent;
        }
                            		      
        window.scrollTo(selectedPosX,selectedPosY-50);
    
    }

    function delete_brand(brand)
    {
        del_brands[brand] = 'all';
                
        var no_catalog = false;
        if (!$("#deleted_div").length)
        {
            no_catalog = true;
            $("#showCatalog").prepend('<div id="deleted_div" style="background:#e0e0e0;padding:8px;margin-bottom:15px;"><div style="margin-bottom:5px;"><b><?=tr('Отменённые марки/строки из прайса','dc');?>:</b></div></div>');
        }
        $("#deleted_clear").remove();
        
        var brand_n = brand.split(" ").join("");
        
        $("#deleted_div").append('<div id="res_'+brand_n+'" style="border: #a0a0a0 solid 1px;float:left;padding:5px 10px;margin:0 10px 5px 0;">'+brand+' <img src="/_sysimg/ar_add.png" onclick="restore_brand('+"'"+brand_n+"'"+');" style="cursor:pointer;" title="<?=tr('восстановить бренд','dc');?> '+brand+'"/></div>')
        $("#deleted_div").append('<div id="deleted_clear" style="clear:both;"></div>');
            
        
        $("#showCatalog").find("#div_"+brand_n).css("display", "none");
           
    }
    
    function restore_brand(brand)
    {
        delete del_brands[brand];
        var brand_n ="#res_"+brand; 
        $(brand_n).remove();
        brand_n ="#div_"+brand;
        $("#showCatalog").find(brand_n).css("display", "");
        if ($("#deleted_div").html() == '<div style="margin-bottom: 5px;"><b><?=tr('Отменённые марки/строки из прайса','dc');?>:</b></div><div id="deleted_clear" style="clear: both;"></div>')
            $("#deleted_div").remove();
               
    }
    
    
    
    function showModels(brand) {
        if($("#cont_"+brand).css("display") == "none")
        {
            $('#cont_'+brand).html('<p><img src="/images/ajax-loader.gif" align="left" /> loading...</p>');
            $("#cont_"+brand).css("display", "");
            $.ajax({type: 'POST', url: "/admin/td-conformity.html", data: {'step': 'showPrices', 'type':$(".select-catalog").val(), 'brand': brand, 'cols':'<?=$_REQUEST['cols']?>', 'file_name':"<?=$_REQUEST['file_name'];?>", 'pricelist_id':"<?=$_REQUEST['pricelist_id']?>", 'num_header': $('.num_header').val(), 'filter_id': '<?=$conf->filter_id?>', 'new_filter':'<?=$conf->is_new_filter?>'},  
                success: function(data, html){		
                    $("#cont_"+brand).html(data);
                },
                error: function(xhr, status, error){
                    $("#save_error").html("ERROR: "+xhr.responseText);
                }
            });
        }
    }
    
    function toogle_brand(el, brand)
    {
        if ($("#cont_"+brand).css('display') == "none")
        {
            el.src = "/images/ar2-tree/nolines_minus.gif";
            if (document.getElementById("cont_"+brand).innerHTML == "")
            {
                showModels(brand);
            }
            else {
                $("#cont_"+brand).css('display', "");
			}
        }
        else
        {
            $("#cont_"+brand).css('display', "none");
            el.src = "/images/ar2-tree/nolines_plus.gif";
            ScrollToElement(document.getElementById("div_"+brand));
        }
        
    }
// модель
var del_model = "";

    function toogle_one(el, brand)
    {
        if ($("#div_one_"+brand).css('display') == "none")
        {
            $("#div_one_"+brand).css('display', "");
            el.src = "/images/ar2-tree/nolines_minus.gif";
            el.title = "<?=tr('Нажмите чтобы свернуть','dc');?>";
        }
        else
        {
            $("#div_one_"+brand).css('display', "none");
            el.src = "/images/ar2-tree/nolines_plus.gif";
            el.title = "<?=tr('Нажмите чтобы развернуть','dc');?>";
            ScrollToElement(document.getElementById("div_"+brand));
        }
    }

    function toogle_conf(el, brand)
    {
        if ($("#div_conf_"+brand).css('display') == "none")
        {
            $("#div_conf_"+brand).css('display', "");
            el.src = "/images/ar2-tree/nolines_minus.gif";
            el.title = "<?=tr('Нажмите чтобы свернуть','dc');?>";
        }
        else
        {
            $("#div_conf_"+brand).css('display', "none");
            el.src = "/images/ar2-tree/nolines_plus.gif";
            el.title = "<?=tr('Нажмите чтобы развернуть','dc');?>";
        }
    }
    
    /*
    function delete_element(brand, model)
    {
        model = typeof(model) != 'undefined' ? model : "";
        <?if($brand_request != ""){?>
            if (brand != "")
                brand = brand + '|<?=$brand_request;?>';
            else
                brand = '<?=$brand_request;?>';
        <?}?>
        if (brand!="")
                brand = brand + "|" + del_brand;
            else
                brand = del_brand;
        <?if($model_request!=""){?>
            if (model != "")
                model = model + '|<?=$model_request;?>';
            else
                model = '<?=$model_request;?>';
                         
        <?}?>
        if (model!="")
                model = model + "|" + del_model;
            else
                model = del_model;
         
        $('#showCatalog').html('<p><img src="/images/ajax-loader.gif" align="left" /> loading...</p>');    
        $.ajax({type: 'POST', url: "/admin/td-conformity.html", data: {'step': 'showCatalog', 'delete_element':'yes', 'brand': brand, 'model':model, 'type':$(".select-catalog").val(), 'cols':'<?=$_REQUEST['cols']?>', 'file_name':"<?=$_REQUEST['file_name']?>", 'pricelist_id':"<?=$_REQUEST['pricelist_id']?>", 'num_header': $('.num_header').val()},  success: function(data, status){		
            if (data == "") data = status;
            $("#showCatalog").html(data);
            
        },
        error: function(xhr, status, error){
            $("#showCatalog").html("ERROR: "+status+"<br/>"+xhr.responseText);
        }
        });
    }
    */    
    function delete_price_row(num_row)
    {
        if (!$("#deleted_div").length)
        {
            no_catalog = true;
            $("#showCatalog").prepend('<div id="deleted_div" style="background:#e0e0e0;padding:8px;margin-bottom:15px;"><div style="margin-bottom:5px;"><b><?=tr('Отменённые марки/строки из прайса','dc');?>:</b></div></div>');
        }
        $("#deleted_clear").remove();
        
        $("#deleted_div").append('<div id="res_'+num_row+'" style="border: #a0a0a0 solid 1px;float:left;padding:5px 10px;margin:0 10px 5px 0;">'+num_row+' <img src="/_sysimg/ar_add.png" onclick="restore_price_row('+"'"+num_row+"'"+');" style="cursor:pointer;" title="<?=tr('восстановить строку','dc');?> №'+ num_row +'из прайса"/></div>')
        $("#deleted_div").append('<div id="deleted_clear" style="clear:both;"></div>');
     
        $("#showCatalog").find("#pr_"+num_row).css("display", "none");   
    }
    
    function restore_price_row(num_row)
    {
        $("#res_"+num_row).remove();
        $("#showCatalog").find("#pr_"+num_row).css("display", "");
        if ($("#deleted_div").html() == '<div style="margin-bottom: 5px;"><b><?=tr('Отменённые марки/строки из прайса','dc');?>:</b></div><div id="deleted_clear" style="clear: both;"></div>')
            $("#deleted_div").remove();        
    }  
    
    function SaveModelsToBrand(brand)
    {
        var s = $("#div_"+brand);
        $("input[type=radio]:checked", s).each(function(index){
            var el = $(this).parents("div").eq(0);
            if (el.css("display") != "none") {
                el = $(this).parents("div").eq(3);
                if (el.css("display") != "none") 
                {
                    brand_price[this.value] = $(this).attr("name");
                    
                }    
            }
            
               
        });
        
        var bp = "";
        for (var key in brand_price) {
           var val = brand_price[key];
            if (bp != "") bp += "|";
            bp += key + '~' + val; 
        }

        $.ajax({type: 'POST', url: "/admin/td-conformity.html", data: {'step': 'saveBrand', 'filtr_id': '<?=$conf->filter_id?>',  'data': bp},  success: function(data, html){		
            alert('<?=tr('соответствия сохранены','dc');?>.');
        },
        error: function(xhr, status, error){
            $("#save_error").html("ERROR: "+xhr.responseText);
        }
        });
        
    }
    
    
</script>

<?
$text = "";

foreach($brands as $brand)
{
    $text .= '<div id="div_'.str_replace(" ", "",$brand['nav_id']).'" style="background:#e0e0e0;padding:8px 0;margin-bottom:5px;">';
    $text.= '<table style="background:#d0d0d0;" width="100%"><tr><td align="left">'.$brand['nav_name'].' <img id="img_brand_'.str_replace(" ", "",$brand['nav_id']).'" title="'.tr('удалить бренд','dc').' '.$brand['nav_name'].'" src="/_sysimg/ar_delete.png" style="cursor:pointer;" onclick="delete_brand('."'".$brand['nav_id']."'".')"/>&nbsp;&nbsp;';
    
    if (empty($brand['prd_id']))
    {
        $text .= ' <a class="iframe" href="/admin/td-conformity.html?step=add_brand&brand='.strtoupper($brand['nav_id']).'" id="add_brand_price"><img id="img_'.strtoupper($brand['nav_id']).'" src="/_sysimg/ar_add.png" style="cursor:pointer;" title="'.tr('Производитель отсутствует в справочнике производителей в автопрайсе.Нажмите, чтобы добавить','dc').'." /></a>';
    }
    
    $text .='</td><td width="20" align="right"><img id="img_all_brand_'.str_replace(" ","",$brand['nav_id']).'" title="'.tr('Нажмите чтобы развернуть','dc').'" style="cursor:pointer;" src="/images/ar2-tree/nolines_plus.gif" onclick="toogle_brand(this,'."'".str_replace(" ","",$brand['nav_id'])."'".')"/></td></tr></table>';
    $text .= '<div id="cont_' . $brand['nav_id'] . '" style="display:none;margin-top: 10px;"></div>';
    $text .= "</div>";
}

if ($text == "")
    $text .= tr("К сожалению, соответствий не найдено. Попробуйте изменить фильтры",'dc').".";
else
{
    $text .= '<div style="text-align: right;margin:10px 0;">';
    $text .= '<a id="update_all" class="button" style="cursor:pointer;"><nobr>'.tr('применить все','dc').'</nobr></a>';
    $text .= '<div id="save_error"></div></div>';    
}
echo $text;
?>
<script>
$(document).ready(function() {
    $("a[id=add_brand_price]").fancybox({
		'hideOnContentClick':false,
		'frameWidth'    : 420,
		'frameHeight'   : 420
	});
    $("#update_all").click(function(event)
    {
        var text ="";
        $("input[type=radio]:checked").each(function(index){
            var el = $(this).parents("div").eq(0);
            if (el.css("display") != "none") {
                el = $(this).parents("div").eq(3);
                if (el.css("display") != "none") 
                {
                    text = text + "|" + $(this).attr("name") + "~" + this.value;
                    
                }    
            }
               
        });
        text = text.substr(1, text.length-1);
        
        var brands = "";
        var models = ""
        for (var key in del_brands) {
           var row = del_brands[key];
           if (row == "all"){
                if (brands != "") brands += "|";
                brands += key;            
           }
  
        }
        $("#showCatalog").html('<p><img src="/images/ajax-loader.gif" align="left" /> saving...</p><p><?=tr('Подождите некоторое время, пока результаты сохранятся','dc');?>.</p>');
        $.ajax(
		{
			type: 'POST', 
			url: "/admin/td-conformity.html", 
			data: {'step': 'saveCatalog', 'type':$(".select-catalog").val(), 'data': text, 'file_name':"<?=$_REQUEST['file_name'];?>", 'pricelist_id':"<?=$_REQUEST['pricelist_id']?>", 'num_header': $('.num_header').val(), 'filter_id': '<?=$conf->filter_id?>', 'brand': brands, 'model': models, 'cols': '<?=$_REQUEST['cols']?>'},  
			success: function(data, html){
				alert('<?=tr('Cоответствия сохранены. Идёт загрузка обновлённых данных','dc');?>.');
				$("#showCatalog").html('<p><img src="/images/ajax-loader.gif" align="left" /> loading...</p>');
				$.ajax({type: 'POST', url: "/admin/td-conformity.html", data: {'step': 'showBrands', 'type':$(".select-catalog").val(), 'cols':'<?=$_REQUEST['cols']?>', 'file_name':"<?=$_REQUEST['file_name'];?>", 'pricelist_id':"<?=$_REQUEST['pricelist_id']?>", 'num_header': $('.num_header').val()},  success: function(data, html){		
					
					$("#showCatalog").html(data);
					
				},
				error: function(xhr, status, error){
					$("#showCatalog").html("ERROR: "+xhr.responseText);
				}
				});
			},
			error: function(xhr, status, error){
			alert('<?=tr('При сохранении произошел сбой','dc');?>: '+xhr.responseText);
			$("#showCatalog").html('');
            //$("#save_error").html("ERROR: "+xhr.responseText);
        }
        });
    });
   
});
</script>