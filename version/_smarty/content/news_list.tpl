<div class="news-list">
{%php%}
	//TODO  выпилить это извращение
  echo "<h1 class='news-list__h1'>".tr($this->_tpl_vars['CONTENT'][0]['str_title'], 'AdminLeftMenu')."</h1>";

	include(__spellPATH("SMARTY_LIB:/content/_sysTables/module.table-template-func.php"));

	if ($validTable) {
		
		echo $_PG_buffer;

		if (!empty($data)) {

			foreach($data as $row){

			{%/php%}

				<div class="news-list__item">
					<div class="news-list__date">{%php%}echo $row['russian_date']['day']{%/php%}.{%php%}echo substr($row['datetime'],5,2);{%/php%}.{%php%}echo substr($row['datetime'],0,4);{%/php%}</div>
					<div class="news-list__caption">
						<a href="/about/news/{%php%}echo $row['id']{%/php%}/">{%php%}
							echo trim($row['short_text']) ? $row['short_text'] : $row['full_text']{%/php%}
						</a>
					</div>
				</div>
				
			{%php%}
			}

		} else {
				
			echo "<div class=\"pressListDate\">";
			
			echo $tableControls['_sysTableEmptyMessage']['str_text'];
			
			echo "</div>";
		
		}	
		
	}

{%/php%}
</div>