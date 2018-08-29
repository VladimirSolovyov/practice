{%if $SETTINGS.SYSTEM->REQUESTED_PAGE == "/shop/basket_check.html"%}
{%assign var=basket_check value="1"%}
    {%php%}
        $this->_tpl_vars['desire_price'] = $_SESSION['basket']['control']['desire_price'];
        $this->_tpl_vars['desire_term'] = $_SESSION['basket']['control']['desire_term'];        
    {%/php%}
{%/if%}

{% if $SearchSetting.authUserSearchOnly != 1 || $SearchSetting.cst_category_id >= 1 || $SearchSetting.admin_search == 1 %}

{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.empty_search%}
	
	{%$AR_MSG.SearchModule.msg1%}	

<ul>
{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.search_from_catalog%}
	<li><p><a href="{%$SearchSetting.catalog_search_url%}">{%$AR_MSG.SearchModule.msg2%}</a></p>
	{%/if%}	

{%* ------------------------------------------------------------------------------------------ *%}
	
	<li><nobr>{%$AR_MSG.SearchModule.msg3%}</nobr><br>
 {%$AR_MSG.SearchModule.msg4%} <a href="/vin/form.html">{%$AR_MSG.SearchModule.msg5%}</a>.


{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.catalog_search%}
	<li><a href="{%$SearchSetting.catalog_search_url%}">{%$AR_MSG.SearchModule.msg6%}</a>
	{%/if%}

</ul>
{%/if%}	
	
{%* ------------------------------------------------------------------------------------------ *%}

{%if $alternatives && !$__search_results && !$SearchSetting.empty_search%}

{%$AR_MSG.SearchModule.msg1%}	

{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.search_from_catalog%}
	<li><p><a href="{%$SearchSetting.catalog_search_url%}">{%$AR_MSG.SearchModule.msg2%}</a></p>
	{%/if%}	

{%* ------------------------------------------------------------------------------------------ *%}

<table border="0" class="web_ar_datagrid">

<tr>
{%foreach key=hdr_id item=column from=$alternatives.header%}
{%if $column.visible==true%}
<th>{%$column.caption%}</th>
{%/if%}
{%/foreach%}
</tr>

{%foreach key=dat_id item=row from=$alternatives.data%}
<tr class="{%if $dat_id mod 2 == 0%}even{%else%}odd{%/if%}">
	{%foreach key=hdr_id item=column from=$alternatives.header%}
		{%if $column.visible==true%}
		<td align="{%cycle values="center,left,center%}">
		{%$row.$hdr_id%}
		{%if $hdr_id=='spare'%}
			
			{%if $row.superseded_by!=''%}
			{%$row.code%} - {%$AR_MSG.SearchModule.msg7%}{%$row.superseded_by%}
			{%/if%}
			
			{%if $row.replacement_for!=''%}
			{%$row.code%} - {%$AR_MSG.SearchModule.msg8%}{%$row.replacement_for%}
			{%/if%}
			
		{%/if%}
			
		</td>
		{%/if%}
	{%/foreach%}
</tr>
{%/foreach%}

</table>

{%/if%}

{%* ------------------------------------------------------------------------------------------ *%}

{%if $__search_results && !$SearchSetting.empty_search%}

{%if !$SearchSetting.admin_search%}

<table border="0" width="100%">

<tr>
<td>
<nobr>

{%$AR_MSG.SearchModule.msg1%}	
</nobr>

{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.catalog_search%}
	<li><a href="{%$SearchSetting.catalog_search_url%}">{%$AR_MSG.SearchModule.msg6%}</a>
	{%/if%}


{%* ------------------------------------------------------------------------------------------ *%}

</td><td align="right" valign="top">

{%if $__search_results && !$SearchSetting.empty_search%}

<b>{%$AR_MSG.SearchModule.msg9%}</b>&nbsp;{%$cid%}

{%/if%}

</td>
<td valign="top" style="padding-left: 10px">{%if $SearchSetting.groups_count > 1%}<b>{%$AR_MSG.SearchModule.msg41%}</b>&nbsp;
	
	{%php%}
		$sLink = new cLink($_SERVER['REQUEST_URI'], '');
		$sLink->removeQueryParam("g");
        $sLink->removeQueryParam("article");
		$sLink->removeQueryParam("brand");
	{%/php%}
	
	
	<select onchange="window.location.href = '{%php%}echo $sLink->link{%/php%}&g='+this.value.replace(/:.*$/,'')+'&article='+this.value.replace(/^.*:/,'')">

	{%foreach key=dat_id item=row from=$alternatives%}
	
			<option value="{%$row.id%}:{%$row.code%}" {%php%}if ($_REQUEST['g']==$this->_tpl_vars['row']['id'] || strtoupper($_REQUEST['brand']) == strtoupper($this->_tpl_vars['row']['brand'])) echo "SELECTED";{%/php%}>
				{%$row.brand%}
			</option>
		
	
	{%/foreach%}

	</select>
	
	{%/if%}

</td></tr>
</table>

{%if $basket_check != 1%}

{%assign var="st_c" value="0"%}
<table border="0" cellpadding='1' cellspacing="0" width="100%" style="border-top: 1px solid #A0A0A0; border-bottom: 1px solid #A0A0A0">

<caption>
{%$AR_MSG.SearchModule.msg42%}
</caption>

{%foreach key=key item=searchN from=$searchStat%}

{%if $st_c mod 7 ==0%}<tr>{%/if%}

{%assign var="st_c" value=$st_c+1%}
{%php%}

	        $link = new cLink($_SERVER['REQUEST_URI'], '');
            
            $link->removeQueryParam("g");
            $link->removeQueryParam("article");
            
            $link->addQueryParam("article", $this->_tpl_vars['searchN']['sse_search_number']);
            
            $this->_tpl_vars['link'] = $link->link;
{%/php%}

<td><a href="{%$link%}"><b>{%$searchN.sse_search_number%}</b></a></td>

{%if $st_c mod 7 ==0%}<tr>{%/if%}

{%/foreach%}

</table><br>
{%/if%}

{%else%}

{%$AR_MSG.SearchModule.msg1%}	

{%/if%}

{%* ------------------------------------------------------------------------------------------ *%}

	{%if $SearchSetting.search_from_catalog%}
	<li><p><a href="{%$SearchSetting.catalog_search_url%}">{%$AR_MSG.SearchModule.msg2%}</a></p>
	{%/if%}	

{%* ------------------------------------------------------------------------------------------ *%}
	{%if $SearchSetting.searchMode == "An"%}
		
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
	
	<script language=JavaScript src="/_syslib/custom.dtree.js"></script>
	
	<script language="JavaScript">
	<!--
	
		{%php%}
		
		$loopbackCheck = array($this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['detail_id'] => 1);
		
		{%/php%}
		
		tecdocTree = new dTree('tecdocTree', '/images/ar2-tree');
		
		
{%php%}

	$rowStr    = "<nobr><div class=\"analogTreeNode\">";
	
	$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";
	
	$rowStr  .= "<span class=\"scol_1\">".$this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['code']."</span>";
	
	$rowStr  .= "<span class=\"scol_2\">".$this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['prd_name']."</span>";
	
	$rowStr  .= "<span class=\"scol_3\">".$this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['name']."</span>";
	
	$rowStr  .= "</div></nobr>";
	
	$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);

	echo "tecdocTree.add(".$this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['detail_id'].", -1, '$rowStr', '/admin/webavtr/analogs.html?d1_code=".strip_tags($this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['code'])."&prd1_name=".strip_tags($this->_tpl_vars['SearchSetting']['searchCodeInfo'][0]['prd_name'])."&partSearch=1', '".$this->_tpl_vars['AR_MSG']['SearchModule']['11']."', '_blank');";
	
{%/php%}
				
		{%foreach key=dat_id item=row from=$__search_results.data%}			
					
			{%php%}	
				
			if ($this->_tpl_vars['row']['detail_id'] != $this->_tpl_vars['row']['cross_detail_id'] && !isset($loopbackCheck[$this->_tpl_vars['row']['detail_id']])) {
					
				$rowStr    = "<div class=\"analogTreeNode".$this->_tpl_vars['row']['cross_level']."\">";
	
				$rowStr  .= "<span class=\"scol_0\">&nbsp;</span>";	
				$rowStr  .= "<span class=\"scol_1\">&nbsp;".$this->_tpl_vars['row']['article']."</span>";
				$rowStr  .= "<span class=\"scol_2\">".strtoupper($this->_tpl_vars['row']['brand'])."</span>";
				$rowStr  .= "<span class=\"scol_3\">".$this->_tpl_vars['row']['spare_info']."</span>";
				
				$rowStr  .= "</div></nobr>";
				
				$rowStr = preg_replace("#[\r\n\t]+#Uis"," ",$rowStr);
										
				echo "tecdocTree.add(".$this->_tpl_vars['row']['detail_id'].", ".$this->_tpl_vars['row']['cross_detail_id'].", '".$rowStr."', '/admin/webavtr/analogs.html?d1_code=".strip_tags($this->_tpl_vars['row']['article'])."&prd1_name=".strip_tags($this->_tpl_vars['row']['brand'])."&partSearch=1', '".$this->_tpl_vars['AR_MSG']['SearchModule']['11']."', '_blank');";
				
			}
			
			$loopbackCheck[$this->_tpl_vars['row']['detail_id']] = 1;
			
			{%/php%}		
			
		{%/foreach%}
		
		document.write(tecdocTree);	
		
	//-->	
	</script>
	
	{%else%}

{%if $__search_results.controls%}

{%foreach key=hdr_id item=control from=$__search_results.controls%}

<div class="{%if $hdr_id == "filter"%}notice{%/if%}" style="padding-top: 0px; padding-bottom: 0px">
	{%$control%}
</div>

{%/foreach%}

{%/if%}

<form action="{%$SearchSetting.basketURL%}" method="POST">

{%if $SearchSetting.useOrderColumn == 1%}
<input type="hidden" name="func" value="add">
<div class="searchPrderButton"><input type="submit" value="{%$AR_MSG.SearchModule.msg46%}"></div><br>
{%/if%}

<table border="0" class="web_ar_datagrid" width="100%">

<tr>
{%foreach key=hdr_id item=column from=$__search_results.header%}
{%if $column.visible==true%}
<th>{%$column.caption%}</th>
{%/if%}
{%/foreach%}
{%if $basket_check%}
 <th>{%$__search_results.header.final_price_val.caption%}</th>
 <th>{%$__search_results.header.percent_term.caption%}</th>
{%/if%}
</tr>

{%php%} $showDelivery = array(); {%/php%}

{%foreach key=dat_id item=row from=$__search_results.data%}

{%if $row.info_only == 1%}


		{%if ($SearchSetting.searchCode != $row.parsed_article || $ZeroResultShown == 1)%}
		    {%php%}continue;{%/php%}
		{%else%}
		
		    {%foreach key=dat_id2 item=row2 from=$__search_results.data%}				    
    			{%if ($row.parsed_article == $row2.parsed_article) && $dat_id != $dat_id2 && $row2.info_only == 0%}{%php%}continue 2;{%/php%}{%/if%}
    		{%/foreach%}
  		  
		    {%assign var="ZeroResultShown" value="1"%}
                        
		{%/if%}
	

{%/if%}

<tr {%if $row.sts_style!=''%}style="{%$row.sts_style%}"{%else%}class="{%if $isProvider.provider_id == $row.provider_id && $row.provider_id>0%}provider_row{%elseif $dat_id mod 2 == 0%}even{%else%}odd{%/if%}"{%/if%}>

	{%counter start=0 print=false assign="colNum"%}

	{%foreach key=hdr_id item=column from=$__search_results.header%}
		{%if $column.visible==true%}
		
		<td align="{%if $hdr_id == 'spare_info'%}left{%elseif $hdr_id == 'final_price'%}right{%elseif $hdr_id == 'customer_price'%}right{%elseif $hdr_id == 'dlv_weight_tax'%}right{%elseif $hdr_id == 'price_brutto'%}right{%else%}center{%/if%}">
			
		{%if $hdr_id == 'term'%}

			{%if $row.term > 0 && $row.info_only == 0%}
			{%$row.$hdr_id%}
			{%elseif $row.term == 0 && $row.info_only != 1%}
			{%$AR_MSG.SearchModule.msg12%}	
			{%elseif $row.info_only == 1%}
			-
			{%/if%}

		{%elseif $hdr_id == 'evaluation'%}	


			{%if $row.info_only != 1 && $SearchSetting.statShow == 1 %}
			<a href="#" onclick="prov_stat = window.open('/shop/provider_stat.html?pv={%$row.provider_id%}&t={%$row.term%}', '', 'width=800,height=600'); prov_stat.focus();">
			{%/if%}
			
			{%if $row.info_only != 1%}			
			{%$row.evaluation%}
			{%/if%}
			
			{%if $row.info_only != 1 && $SearchSetting.statShow == 1 %}
			</a>
			{%/if%}
											
		{%elseif $hdr_id == 'article'%}	
			
		<span {%if $row.parsed_article == $SearchSetting.searchCode%}class="web_ar_search_code"{%/if%}>
		<nobr>{%$row.article%}</nobr>

		
			{%if $row.superseded_by!=''%}
			{%assign var="show_replacement_conditions" value="1"%}
			<span style="color: #990000"><sup>
			<a title="{%$AR_MSG.SearchModule.msg14%} {%$row.superseded_by%}" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default">З</a>
			</sup></span>
		
			{%elseif $row.replacement_for!=''%}
			{%assign var="show_replacement_conditions" value="1"%}
			<span style="color: #990000"><sup>
			<a title="{%$AR_MSG.SearchModule.msg15%} {%$row.replacement_for%}" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default">Н</a>
			</sup></span>
			{%/if%}
			
		</span>
	
		{%elseif $hdr_id == 'brand'%}
				
		<div {%if $row.brand_full_name!=""%}title="{%$row.brand_full_name%}"{%/if%}>
		{%if $row.oem_brand == 1%}
		<span id="web_ar_oem_brand">
		{%$row.brand%}
		</span>
		{%else%}
		{%$row.brand%}
		{%/if%}
		</div>
		
		{%elseif $hdr_id == 'remains' %}	
				
			{%if $row.info_only == 0%}
				
				{%if $row.remains == 'есть'%}
				<img src="/images/check.png" title="{%$AR_MSG.SearchModule.msg16%}" alt="{%$AR_MSG.SearchModule.msg16%}"/>
			{%elseif $SearchSetting.showExactRemains == 1 && $row.remains != ''%}
				{%$row.remains%}
			{%elseif $row.remains>0%}	
				{%$row.remains%}
			{%else%}
				-
			{%/if%}
			
			{%else%}
				-
			{%/if%}
			
		{%elseif $hdr_id == 'destination_display'%}
		
			{%$row.destination_display%}
		
		{%elseif $hdr_id == 'action'%}	
			
			{%if $row.info_only!='1' ||  $row.provider_price>0%}
			{%$row.$hdr_id%}
			{%/if%}
			
		{%elseif $hdr_id == 'orderm'%}	
			
			{%if $row.info_only!='1' ||  $row.provider_price>0%}
			{%$row.$hdr_id%}
			{%/if%}				
			
			
		{%elseif $hdr_id == 'min_quantity'%}	
			
			{%if $row.min_quantity > 0%}
			{%$row.$hdr_id%}
			{%/if%}
			
		{%elseif $hdr_id == 'info'%}	
						
            {%php%}

                $detailInfo = array(
                    "article" => $this->_tpl_vars['row']['parsed_article'],
                    "brand" => $this->_tpl_vars['row']['brand']
                );

                $this->_tpl_vars['detailLink'] = data2str($detailInfo, true, true);

            {%/php%}		
			
			<a href="#" onclick="window.open('/info/detail.html?sid={%$row._search_id%}&detailLink={%$detailLink%}','','width=800,height=600,scrollbars=yes'); return false;"><img src="/images/info.gif" border="0" title="{%$AR_MSG.SearchModule.msg17%}" alt="{%$AR_MSG.SearchModule.msg17%}" hspace="1" align="absmiddle"/></a>			
			
									
			{%if $row.picture%}
			<a href="#" onclick="window.open('/info/picture.html?sid={%$row._search_id%}&did={%$row.detail_id%}&detailLink={%$detailLink%}','','width=800,height=600,scrollbars=no');return false;"><img src="/_sysimg/icons/picture.gif" border="0" title="{%$AR_MSG.SearchModule.msg18%}" alt="{%$AR_MSG.SearchModule.msg18%}" hspace="1" align="absmiddle"/></a>
			{%/if%}
			
			{%if $row.weight && $row.weight > 0%}
			<img src="/_sysimg/ar2/weight.gif" border="0" title="{%$AR_MSG.SearchModule.msg19%} = {%$row.weight|string_format:"%0.3f"%}" alt="{%$AR_MSG.SearchModule.msg19%} = {%$row.weight|string_format:"%0.3f"%}" hspace="1" align="absmiddle"/>
			{%/if%}
		
		{%elseif $hdr_id == 'price_brutto'%}
		
			{%if $row.weight > 0 && $row.cost_per_weight > 0%}
			
				{%$row.price_brutto%}
			
			{%/if%}
				
		{%elseif $hdr_id == 'final_price'%}
					
			{%if $row.provider_price == 0%}
			-
			{%elseif $row.provider_price == ''%}		
			-
			{%else%}	
            {%assign var=final_price value=$row.$hdr_id%}
			<nobr>{%$row.$hdr_id%}
			
			<sup>
			<font color="#990000">
			
			{%section name=dlv loop=$Deliveries%}
			
				{%if $Deliveries[dlv].delivery_condition == $row.delivery_condition%}
									
					{%if $row.weight == 0 and $Deliveries[dlv].tax > 0 || $Deliveries[dlv].tax == 0 || $Deliveries[dlv].tax == ''%}
					
						{%php%}
							if (!safeArrayKey($showDelivery, $this->_tpl_vars['row']['delivery_condition'])) {
								$showDelivery[$this->_tpl_vars['row']['delivery_condition']] = $this->_tpl_vars['Deliveries'][$this->_sections['dlv']['index']];
							} 
							echo array_search($this->_tpl_vars['row']['delivery_condition'], array_keys($showDelivery))+1;
						{%/php%}							
					
					{%/if%}
				
				
				{%/if%}
			
			{%/section%}
			</font>
			</sup>
					
			{%/if%}
			</nobr>
			
			{%if $row.phand_value != 0%}
			
			<br/>
			<small><span id="phand">{%$AR_MSG.SearchModule.msg20%}&nbsp;<nobr>{%$row.detail_phand%}</nobr></span></small>
			
			{%/if%}
            
		{%elseif $hdr_id == 'date'%}

			{%if $row.info_only!='1' ||  $row.provider_price>0%}
			{%$row.$hdr_id%}
			{%else%}
			-
			{%/if%}
		
		{%else%}
		
		{%$row.$hdr_id%}
				
		{%/if%}
		</td>
		
		{%/if%}

	{%/foreach%}
     {%if $basket_check == 1%}
             <td align="right">{%if $row.final_price_val && $desire_price !=0%}{%math equation="(x - y) / y *100" x=$row.final_price_val y=$desire_price format="%.2f"%}{%/if%}</td>
             <td align="right">{%if $row.max_term && $desire_term !=0%}
             		{%math equation="(x - y) / y *100" x=$row.max_term y=$desire_term format="%.2f"%}
             	 {%elseif $row.term && $desire_term !=0%}
             		{%math equation="(x - y) / y *100" x=$row.term y=$desire_term format="%.2f"%}        	
             	 {%/if%}
             </td>
     {%/if%}
</tr>
{%/foreach%}

</table>

</form>

	{%/if%}

{%* -------------------------------------------------- *%}

{%if !$SearchSetting.admin_search%}

<noindex>
<p><small><a href="/shop/report_error.html?errid=E2&article={%$SearchSetting.searchCode%}&brand={%$SearchSetting.searchBrand%}"><img src="/_sysimg/info2.gif" align="absmiddle" hspace="5" border="0"/>{%$AR_MSG.SearchModule.msg21%}</a></small></p>
</noindex>

{%if $clientData.cst_category_id > 1 && !$clientData.retail%}

<div style="background: #D0D0D0; padding: 10px; margin-top: 10px; margin-bottom: 10px;">

<b>{%$AR_MSG.SearchModule.msg22%}</b>

</div>

{%/if%}

{%/if%}

{%* -------------------------------------------------- *%}

{%php%} 
	
	if (sizeof($showDelivery)>0 || $this->_tpl_vars['show_replacement_conditions']) {
	$this->_tpl_vars['Deliveries'] = $showDelivery;
	$this->_tpl_vars['k'] = 0;
	
{%/php%}


<div class="notice"><b>{%$AR_MSG.SearchModule.msg23%}</b>

{%foreach key=dlv item=delivery from=$Deliveries%}

{%php%}
	
	$this->_tpl_vars['k']++;
	
{%/php%}	

<div style="padding: 10px">

<sup><font color="#990000">{%$k%}</font></sup>		
{%$delivery.dlv_text%}&nbsp;
</div>
						
{%/foreach%}

{%if $show_replacement_conditions==1%}

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="{%$row.superseded_by%}" style="font-weight: bold; width: 10px; background: #990000; color: #FFFFFF; padding: 1px; cursor: default">З</a>
			</sup></span>		
{%$AR_MSG.SearchModule.msg24%}&nbsp;
</div>

<div style="padding: 5px">
<span style="color: #990000"><sup>
			<a title="{%$row.replacement_for%}" style="width: 10px; background: #000000; color: #FFFFFF; padding: 1px; cursor: default">Н</a>
			</sup></span>	
{%$AR_MSG.SearchModule.msg25%}&nbsp;
</div><br/>

{%/if%}

</div>

{%php%} 
	}
{%/php%}


{%* -------------------------------------------------- *%}

{%/if%}

{%* ------------------------------------------------------------------------------------------ *%}

{%if $SearchSetting.invalid_search%}

	{%$AR_MSG.SearchModule.msg26%}
	
	{%$AR_MSG.SearchModule.msg27%}
	
	{%$AR_MSG.SearchModule.msg28%}
	
	{%$AR_MSG.SearchModule.msg29%}
	
	{%$AR_MSG.SearchModule.msg30%}
	
	{%$AR_MSG.SearchModule.msg31%}

{%/if%}


{%else%}
	
	<h2>{%$AR_MSG.SearchModule.msg39%}</h2>
	
<p>{%$AR_MSG.SearchModule.msg40%}</p>

{%/if%}