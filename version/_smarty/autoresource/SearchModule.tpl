{%if $SearchSetting.csSearchTemplate == "groups"%}
{%include file=$SETTINGS.smarty_libs_dir|cat:"/autoresource/SearchModule_groups.tpl"%}
{%else%}
{%include file=$SETTINGS.smarty_libs_dir|cat:"/autoresource/SearchModule_classic.tpl"%}
{%/if%}