		
<style>

	body {
		font-size: 11px
	}

	.scol_0 {
		width: 600px;
	}
	
	.scol_1 {

		position: absolute;
		left: 100px;
		width: 150px;
		margin-right: 5px;
		vertical-align: top;

	}

	.scol_2 {
		position: absolute;
		left: 250px;
		width: 200px;
		margin-right: 5px;

	}
	
	.scol_3 {
		position: absolute;
		left: 400px;
		width: 300px;
		margin-right: 5px;

	}
	
	.scol_4 {

		width: 50px;
		margin-right: 5px;
		text-align: center;

	}
	
	.scol_5 {

		width: 30px;
		margin-right: 5px;
		text-align: center;

	}
	
	.searchBox {
		width: 100%;
		border: #B3E0FF solid 1px;
		background: #F9F9F9;
	}
	
	img {
		border: 0px;
	}
	
	a {
		text-decoration: none;
		cursor: hand;
	}
	
	
	a.normal {
		text-decoration: underline;
		cursor: hand;
	}
	
	div.analogTreeNode {
		width: 100%; padding-left: 50px;
		background: #FFFFFF;
	}
	
	div.analogTreeNode1 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
	}
	
	div.analogTreeNode2 {
		width: 100%; padding-left: 50px;
		background: #C0C0C0;
	}
	
	div.analogTreeNode3	 {
		width: 100%; padding-left: 50px;
		background: #A0A0A0;
		color: #FFFFFF;
	}
	
</style>
	
	<script type="text/javascript" src="/_syslib/custom.dtree.js"></script>
	
	<script type="text/javascript">

	
		<?	$loopbackCheck = array(); ?>
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
<?

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$SearchSetting['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$SearchSetting['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$SearchSetting['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	global $CMS_API;
	$href = $CMS_API->checkAccess("/admin/webavtr/analogs\.html");

	echo "tecdocTree.add(".$SearchSetting['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($SearchSetting['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($SearchSetting['searchCodeInfo'][0]['prd_name'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
	
		
		foreach ($__search_results['data'] as $dat_id=>$row) { 

				
			if ($row['detail_id'] != $row['cross_detail_id'] && !isset($loopbackCheck[$row['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$row['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$row['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($row['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$row['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$row['detail_id'].", ".$row['cross_detail_id'].", '".$rowStr."', ".($href ? "'/admin/webavtr/analogs.html?d1_code=".strip_tags($row['article'])."&prd1_name=".strip_tags($row['brand'])."&partSearch=1'" : "''").", '".$AR_MSG['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$row['detail_id']] = 1;		
			
		} ?>
		
		document.write(tecdocTree);	
		

	</script>