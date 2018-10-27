		<script type="text/javascript">
		
		function uploadFile(){
			/*$('content').set('opacity', 0.5);
			$('loader').addClass('loading');
            */
			
			$('uploadForm').submit();
		};
		</script>
		<div id="loader"></div>
		<div id="content">
			<h1><?=tr('Установка соответствия прайс-листа и каталога Шин/Дисков','dc');?></h1>
			<?if (count($this->errors)>0){?>
                <div class="error">
    				<?foreach($this->errors as $error):?>
    					<?=$error?><br/>
    				<?endforeach?>
    			</div> 
             <?}?>
			
			
            <table width="100%" cellpadding="4" cellspacing="0" border="1" class="admin_blank_table">
            <tr>
                <th><?=tr('Локальный путь к прайс-листу','dc');?></th>
                <th><?=tr('Путь к файлу на сайте','dc');?></th>
                <th><?=tr('Установка соответствия','dc');?></th>
            </tr>
            <? foreach($price_list as $key => $row):?>
            <tr>
                <td>
                    <?=$row['filename']?>
                    <div><b><?=tr('Дата обновления','dc');?>:</b> <?=($row['refresh_date']!=""?date("d-m-Y h:i:s",strtotime($row['refresh_date'])):tr('"файл ещё не обновлялся"','dc'))?></div>
                    <?//echo "<pre>".print_r($row, true)."</pre>";?>
                </td>
                <td>
                    <form id="uploadForm" action="<?=$scriptUrl?>" method="POST" enctype="multipart/form-data">
    					<table cellpadding="2">
                            <tr>
                                <td>
                                   <div><input type="file" name="file" /></div>
    					           <input type="hidden" name="step" value="uploadfile" />
                                   <input type="hidden" name="pricelist_id" value="<?=$row['pricelist_id']?>" />                                    
                                </td>
                                <td>
                                    <div class="control">
                                        <input type='submit' class='button' value='<?=(!empty($row['path_to_site'])?tr("обновить",'dc'):tr("загрузить",'dc'))?>' />
                                    </div>    
                                </td>
                            </tr>
                        </table>
    				</form>
                    <div style="margin-top: 10px;"><?if (!empty($row['path_to_site'])) echo $row['path_to_site'];?></div>
                    <div><b><?=tr('Дата загрузки','dc');?>:</b> <?=($row['date_upload']!="0000-00-00 00:00:00"?date("d-m-Y h:i:s",strtotime($row['date_upload'])):tr("файл ещё не загружен",'dc'))?></div>
                </td>
                <td align="center">
                    <?if (!empty($row['path_to_site']))
                    {?>
                        <form method="get" action="">
                            <input type="hidden" value="conformity" name="step"/>
                            <input type="hidden" name="pricelist_id" value="<?=$row['pricelist_id']?>" />
                            <input type="hidden" name="file_name" value="<?=$row['path_to_site']?>" />
                            <input type="submit" class="button" value="<?=tr('Перейти к установке соответствия','dc');?>"/>
                        </form>
                        <div><b><?=tr('Дата установки соответствия','dc');?>:</b> <?=($row['date_sync']!="0000-00-00 00:00:00"?date("d-m-Y h:i:s",strtotime($row['date_sync']))."":tr("Соответствие ещё не устанавливалось",'dc'))?>
                    <?}
                    else {
                        echo "<b>".tr('Загрузите, пожалуйста, прайс-лист на сайт!','dc')."</b>";
                    }?>
                </td>
            </tr>            
            <?endforeach?>
            </table>
			</div>
		</div>                                                                                   
		<div class="control" style="margin-top: 15px;"><a href="/admin/td-pricelists.html" id="add_catalog" class="button"><?=tr('Редактировать список прайс-листов','dc');?></a></div>
        

<script type="text/javascript">
			$(document).ready(function() {
				$("a[id=add_catalog]").fancybox({
					'hideOnContentClick':false,
					'frameWidth'    : 420,
					'frameHeight'   : 420,
					'callbackOnStart': function ()
					{
						//function validate_order_form(arg) {};
					}
				});
			});

</script>


<?
  /*
    echo "<pre>".print_r($_REQUEST, true)."</pre>";
    echo "<pre>".print_r($_SESSION, true)."</pre>";
    echo "<pre>".print_r($CONST, true)."</pre>";
  */
?>