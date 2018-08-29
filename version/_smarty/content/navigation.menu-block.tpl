{%strip%}

{%foreach key=key item=item from=$CONTENT%}
	
	{%if $level == $item.str_level && $item.str_left>=$left && $item.str_right<=$right%}
		{
		"text": '{%$CONTENT[$key].str_title%}'
		
		{%if $item.str_url!=''%}
		, "action": { "url": "{%$item.str_url%}" }
		{%/if%}
			
		{%if $item.str_left + 1 < $item.str_right && $level < $CONTENT[0].str_level + 3 %}
							
					, "menu": {
							
			{%if $item.str_level == $CONTENT[0].str_level + 1%}
			
					"style": {
						"id":"client_v","css":"ar_client_v","box":"TRUE","size":[170,25],"direction":"v","imgendon":{"src":"/images/arrow_over.gif","width":11,"height":11},"imgendoff":{"src":"/images/arrow.gif","width":11,"height":11}},"itemover":{ "css":"ar_client_v_over" },"position":{"menuoffset" : {"x":"-135", "y":"26"}
						},
			
				
			{%elseif $item.str_level == $CONTENT[0].str_level + 2%}
			
					"position": {
						"menuoffset" : {"x":"5", "y":"0"}
						},
				
			{%/if%}
			
			"items":[
				
				{%if $level <= $CONTENT[0].str_level + 3%}
				{%include file=$SETTINGS.smarty_dir|cat:"/content/navigation.menu-block.tpl" level=$level+1 left=$item.str_left right=$item.str_right%}
				{%/if%}
			]
						
				}
						
		{%/if%}	
		
		}	
		
		,	
		
	{%/if%}		
	
{%/foreach%}
{%/strip%}