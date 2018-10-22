<style>

	#primary_select_lang {
		color: #dfdfdf;
		display: inline-block;
		vertical-align: middle;
	}

	#primary_select_lang ul
	{
		list-style:none;
		position:relative;
		float:left;
		margin:0;
		padding:0;
	}

	#primary_select_lang ul a {
		display:block;
		text-decoration:none;
		font-size:14px;
		padding: 11px 32px 11px 40px;
		font-family:"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif;
	}

	@media (max-width: 768px) {
		#primary_select_lang ul a {
			margin: 0;
		}
	}

	#primary_select_lang ul li
	{
		position:relative;
		float:left;
		margin:0;
		padding:0;
		padding-top:5px;
		padding-bottom:5px;
		z-index: 100;
	}

	#primary_select_lang ul li.current-menu-item
	{
		background:#ddd;
	}

	#primary_select_lang .current_lng {
		padding:0;
	}

	#primary_select_lang ul li:hover
	{
		background: #f5f5f5;
		color: #c62828;
	}

	#primary_select_lang ul ul
	{
		display: none;
		position: absolute;
		top: 100%;
		left: 0;
		background: #fff;
		padding: 10px;
		width: 124px;
		box-shadow: 0px 5px 10px 0px rgba(0,0,0,0.1);
		border: 1px solid #eeeeee;
	}

	#primary_select_lang ul ul li {
		float:none;
	}

	#primary_select_lang ul ul a {
		line-height:18px;
		padding:0px 15px;
		font-size: 13px;
		text-align: left;
		color: #999999;
	}

	#primary_select_lang ul ul ul {
		top:0;
		left:100%
	}

	#primary_select_lang ul li:hover > ul {
		display:block;
	}

	#primary_select_lang .select-country__current {
		display: block;
	}

	#primary_select_lang .select-country__caret-current {
		border-left: 4px solid rgba(0, 0, 0, 0);
		border-right: 4px solid rgba(0, 0, 0, 0);
		border-top: 4px solid;
		border-color: #dfdfdf transparent transparent transparent;
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
		position: relative;
	}

	#primary_select_lang .current_lng:hover {
		background-color: #eeeeee;
		text-decoration: none;
	}

	@media (max-width: 767px) {
		#primary_select_lang ul,
		#primary_select_lang ul li {
			float: none;
		}

		#primary_select_lang ul ul {
			width: 100%;
			border: none;
			box-shadow: none;
			background-color: #f5f5f5;
		}

		#primary_select_lang {
			display: block;
		}

		.select-country__current:active {
			box-shadow: none;
		}

		.select-country__current .select-country__name:after {
			content: '';
			display: block;
			background-image: url("../../../images/template/ico-lang-small.png");
			background-repeat: no-repeat;
			width: 12px;
			height: 12px;
			position: absolute;
			top: 50%;
			left: -17px;
			margin-top: -6px;
		}

		#primary_select_lang .current_lng:hover {
			background-color: transparent;
		}


	}

</style>

<? if (count($arLng) > 1) { ?>
	<div id="primary_select_lang">
		<ul>
			<li class="current_lng">
				<? if(isset($arLng[$_SYSTEM->LNG])) { ?>
					<a class="btn btn--lang select-country__current" title="<?=($msg=tr('сейчас выбран этот язык', '_languages'))?>" alt="<?=$msg?>">
						<span class="select-country__name"><?= mb_ucfirst($arLng[$_SYSTEM->LNG]) ?></span>
					</a>
				<? } ?>
				<ul>
					<? foreach ($arLng as $lng => $name) { ?>
						<? if(strtoupper($_SYSTEM->LNG) != strtoupper($lng)) { ?>
							<li>
								<a class="select-country__inner" href="<?=$baseCLUrl.strtolower($lng)?>"  title="<?=($msg=trp('переключить язык клиентской части на %s', '_languages', $name))?>" alt="<?=$msg?>">
									<span class="select-country__name"><?= mb_ucfirst($name) ?></span>
								</a>
							</li>
						<? } ?>
					<? } ?>
				</ul>
			</li>
		</ul>
	</div>
<? } ?>