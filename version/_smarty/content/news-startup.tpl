{%php%}

	$_PG_rowsAtPage = 3;

	include_once(__spellPATH("SMARTY_LIB:/content/_sysTables/module.table-template-func.php"));

	foreach($data as $row){
		$this->_tpl_vars['data'][] = $row;
	}
{%/php%}

<table width="100%"  style="margin-top: 20px; margin-bottom: 20px">	

					{%foreach key=dat_id item=row from=$data%}

	<tr>
		<td style="padding-bottom: 10px">


					<div style="color:#333333;font-size:10px"><b>{%$row.datetime|date_format:"%d/%m/%Y"%}</b></div>
					<div style="font-size:12px"><b>{%$row.caption%}</b></div>
					
					<div style="font-size:12px"><a href="/about/news/{%$row.id%}/">{%$row.short_text%}</a></div>

					</td>
					</tr>

					{%/foreach%}
					
					
				</tr>
			</table>
