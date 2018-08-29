<script>

	var CT_IMG_BLANK="/_sysimg/1x1.gif";
	var {%$CONTENT[0].str_name%}_cfg = {
	
	"otime":100,
	"style":
		{
			"id":"client_h",
			"css":"ar_client",
			"box":"TRUE",
				"size":[130,25],
				"direction":"h"
		},
	
	"itemover":
		{
			"css":"ar_client_over"
		},
		
	"position":
		{
		"absolute": true,
				"pos": [20,65]
		},
		
	"items":[

{%include file=$SETTINGS.smarty_dir|cat:"/content/navigation.menu-block.tpl" level=$CONTENT[0].str_level+1 left=$CONTENT[0].str_left right=$CONTENT[0].str_right%}

		]

	}
	
	var {%$CONTENT[0].str_name%} = new CMenu({%$CONTENT[0].str_name%}_cfg, '{%$CONTENT[0].str_name%}');
	{%$CONTENT[0].str_name%}.create();
	{%$CONTENT[0].str_name%}.run();

</script>
