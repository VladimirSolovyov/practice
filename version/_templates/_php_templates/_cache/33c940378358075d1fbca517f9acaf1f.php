<?
$_PG_rowsAtPage = 3;
 ?><?
		$validTable = false;

		$_USER = &$GLOBALS['_USER'];
		$CONST = &$GLOBALS['CONST'];
		$_SYSTEM = &$GLOBALS['_SYSTEM'];

		if (!$tableObject) {
			
			$tableObject = $item?$item:$CONTENT[0];
			
		}

		$tableName = $_USER['adapter']->has_table($tableObject['str_name'])?
				$tableObject['str_name']:
				"struc_table_".$tableObject['str_id'];
				

		if ($_USER['adapter']->has_table($tableName)) {
		
			$validTable = true;

			$_PG_rowsAtPage = (int)$_PG_rowsAtPage;

			$_PG = (int)$_PG;
		
			$query = "
			
			SELECT *
			FROM _meta_fields
			WHERE mf_table = '".$tableName."'
			ORDER BY mf_order
			
			";
			
			$data = $_USER['adapter']->query($query);
			$tableInfo = array();
			
			while ($output = $_USER['adapter']->fetch_row_assoc($data)) {
			
				$tableInfo[$output['mf_name']] = $output;
			
			}
			
			$orderFields = array();
			
			foreach ($tableInfo as $field => $info) {
				
				if ($info['mf_sort_field'] != 'N') {
					
					$orderFields[] = $field." ".$info['mf_sort_field'];
					
				}
				
			}
			
			$tableDBInfo = $_USER['adapter']->list_fields($tableName);
			
			$query = "
			
			SELECT *
			FROM `".$tableName."`

			WHERE 1 = 1
			
			".(in_array("domain", $tableDBInfo)?" AND '".$_SYSTEM->DOMAIN."' 
				REGEXP concat('^', COALESCE(NULLIF(domain, ''), '.*'), '\$')":"")."
				
			".(in_array("lng", $tableDBInfo)?" AND '".$_SYSTEM->LNG."' = `lng`":"")."
			
			".(sizeof($orderFields)>0?"ORDER BY ".implode(", ", $orderFields):"");

		
//			__var_dump($query);
			
			if ($_PG_rowsAtPage > 0) {
				
				$_PG_object = new PaginationControl($query, $_USER['adapter'], $_PG_rowsAtPage);
				$data = $_PG_object->limitedResource();					
				
				$htmlRender = new HTML_DataRender();
			
				$_PG_buffer = $_PG_object->render($htmlRender);
				
			} else {
			
				$data = $_USER['adapter']->query($query);
					
			}

			$dataAssoc = [];
			if ($_USER['adapter']->num_rows($data) > 0) {

				while ($row = $_USER['adapter']->fetch_row_assoc($data)) {
					$date = explode(' ', $row['datetime']);
					$row['russian_date'] = russian_date($date[0], 'array');

					if (isset($row['short_text'])) {
						$translate = tr(['short_text', $row['id']], $tableName);
						if (!empty($translate)) {
							$row['short_text'] = $translate;
						}
					}

					$dataAssoc[] = $row;
				}
			}
			$data = $dataAssoc;

			
			
			$tableControlContent = new SiteContent();
			$tableControlsData = $tableControlContent->getContentQuery($tableObject['str_id']);
			
			while ($output = $_USER['adapter']->fetch_row_assoc($tableControlsData)) {
				
				$tableControls[$output['str_name']] = $output;
				
			}
						
			switch (true) {
				
				case (preg_match("/\.htm(l)?$/i", $tableObject['str_url'])): {
					
					$switchType = "?id=";
					
				} break;
				
				default: {
					
					$switchType = preg_match("|/$|i", $tableObject['str_url'])?"":"/";
					
				} break;
								
			}

		}
			

?><? 
if (!empty($data)) {
?>
<div class="last-news__header">
	<span class="last-news__title"><?=tr('Последние новости', 'Template')?></span>
	<a class="last-news__all" href="/about/news/"><?=tr('Все новости', 'Template')?></a>
</div>
<div class="row last-news__list">
	<? foreach ($data as $row) { ?>
		<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 last-news__item">
			<div class="last-news__date"><?=$row['russian_date']['day']?>.<?=substr($row['datetime'],5,2);?>.<?=$row['russian_date']['year']?></div>
			<a class="last-news__short-text" href="/about/news/<?=$row['id']?>/"><?=tr($row['caption'], 'MetaContent')?> <?=($row['short_text'] != $row['caption'] ? $row['short_text'] : '')?></a>
		</div>
	<? } ?>
</div>
<? } ?>