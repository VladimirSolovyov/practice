<style>

	#primary_select_lang
	{
		margin-top: 1px;
		margin-left: -15px;
		float: left;
		color: #dfdfdf;
	}

	#primary_select_lang ul
	{
		list-style:none;
		position:relative;
		float:left;
		margin:0;
		padding:0;
		width: 150px;
	}

	#primary_select_lang ul a
	{
		display:block;
		color:#333;
		text-decoration:none;
		font-weight:700;
		font-size:12px;
		line-height:18px;
		padding:0px 15px;
		font-family:"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif;
	}

	#primary_select_lang ul li
	{
		position:relative;
		float:left;
		margin:0;
		padding:0;

	}

	#primary_select_lang ul li.current-menu-item
	{
		background:#ddd;
	}

	#primary_select_lang ul li:hover
	{
		background:#b1b1b1;
	}

	#primary_select_lang ul ul
	{
		display:none;
		position:absolute;
		top:100%;
		left:0;
		background:#fff;
		padding:0;
	}

	#primary_select_lang ul ul li
	{
		float:none;
	}

	#primary_select_lang ul ul a
	{
		line-height:18px;
		padding:0px 15px;
	}

	#primary_select_lang ul ul ul
	{
		top:0;
		left:100%
	}

	#primary_select_lang ul li:hover > ul
	{
		display:block;
	}

	#primary_select_lang .select-country__current {
		display: block;
	}

	#primary_select_lang .select-country__caret-current {
		border-left: 4px solid rgba(0, 0, 0, 0);
		border-right: 4px solid rgba(0, 0, 0, 0);
		border-top: 4px solid;
		border-color: #333333 transparent transparent transparent;
		display: inline-block;
		height: 0;
		margin-left: 2px;
		vertical-align: middle;
		width: 0;
	}

	#primary_select_lang .select-country__flag {
		margin-left: 1px;
		margin-right: 2px;
		margin-bottom: 1px;
		vertical-align: middle;
	}

	#primary_select_lang .select-country__name {
		display: inline-block;
		vertical-align: middle;
	}

	#primary_select_lang .select-country__name.visible-lg {
	}

	#primary_select_lang .current_lng:hover {
		background-color: transparent;
		text-decoration: none;
	}

</style>

<? if (count($arLng) > 1) { ?>

	<tr>
		<td bgcolor="#FFFFFF">
			<strong><?=tr('язык', 'AdminLeftMenu')?>:</strong></td>
		<td bgcolor="#FFFFFF" style="padding-left: 2px">

			<div id="primary_select_lang">
				<ul>
					<li class="current_lng">
						<? if(isset($arLng[$_SYSTEM->LNG])) { ?>
							<a class="select-country__current" title="<?=($msg=tr('сейчас выбран этот язык', '_languages'))?>" alt="<?=$msg?>">
								<img alt="s1" class="select-country__flag" src="/images/country_flags/<?=strtolower($_SYSTEM->LNG)?>.png">
								<span class="select-country__name visible-lg"><?= strtoupper($_SYSTEM->LNG); ?> / <?= $arLng[$_SYSTEM->LNG] ?></span>
								<span class="select-country__caret-current"></span>
							</a>
						<? } ?>
						<ul>
							<? foreach ($arLng as $lng => $name) { ?>
								<? if(strtoupper($_SYSTEM->LNG) != strtoupper($lng)) { ?>
									<li>
										<a class="select-country__inner" target="_parent" title="<?=($msg=trp('переключить язык административной части на %s', '_languages', $name))?>" alt="<?=$msg?>" onclick="changeAdminLng('<?=strtolower($lng)?>', this); return false;">
											<img alt="s1" class="select-country__flag" src="/images/country_flags/<?=strtolower($lng)?>.png">
											<span class="select-country__name"><?= strtoupper($lng); ?> / <?= $name ?></span>
										</a>
									</li>
								<? } ?>
							<? } ?>
						</ul>
					</li>
				</ul>
			</div>

		</td>
	</tr>
<? } ?>