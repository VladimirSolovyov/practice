{%if !$level%}
	{%assign var=level value=$CONTENT.0.str_level+1%}
	{%assign var=left value=$CONTENT.0.str_left%}
	{%assign var=right value=$CONTENT.0.str_right%}
{%/if%}
<ul style="margin:0px;padding:0px;margin:5px 0 15px 30px;">
	{%foreach key=key item=item from=$CONTENT name=cikl%}

		{%if $item.str_level == $level and $item.str_left > $left and $item.str_right < $right%}
			{%if $item.has_childs%}
			<li style="text-align:left;">
			{%if $item.str_url != ""%}<a href="{%$item.str_url%}">{%$item.str_title%}</a>{%else%}{%$item.str_title%}{%/if%}
				{%include file=$SETTINGS.smarty_dir|cat:"/content/left_menu.tpl" level=$level+1 left=$item.str_left right=$item.str_right%}
			</li>
			{%else%}
			<li style="padding:0px;margin:0px;text-align:left;">
				<a href="{%$item.str_url%}">{%$item.str_title%}</a>
			</li>
			{%/if%}		
		{%/if%}	
	{%/foreach%}
</ul>