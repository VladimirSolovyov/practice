<?php

require_once(__spellPATH("LIB:/human_check/lib.humancheck.php"));

$hc = new HumanCheck();
$smarty = new MySmarty();
$render = new PHP_DataRender();
$form_process = new Process("form_process", $render);
$formToDB = new FormToDatabase($_USER['adapter'], "mail", 'check_data', 'onSuccess', null);

$smarty->assign("form_show", "1");

$hc->image_href = '/_phplib/human_check/';

function onSuccess() {

	global $smarty, $CONST;
	$header = "FROM: " . $_REQUEST["email"];

	notifyAdmin($_REQUEST['caption'],
		'<meta http-equiv=content-type Content-Type: text/plain; charset="utf-8"; >
		<table  width="400">
		<tr>
		<td><strong>' . tr('Тема сообщения', 'Forms') . ':</strong></td>
		<td>' . $_REQUEST['caption'] . '</td>
</tr>
<tr>
<td><strong>' . tr('Текст сообщения', 'Forms') . ':</strong></td>
<td>' . $_REQUEST['text'] . '</td>
</tr>
<tr>
<td><strong>' . tr('Контактный  E-mail', 'Forms') . ':</strong></td>
<td>' . $_REQUEST['email'] . '</td>
</tr>
</table>', $header);

	$smarty->assign("form_show", "0");
	$smarty->assign("submit", "1");
}

function check_data() {

	global $hc, $smarty, $form_show;

	$res = true;

	if (!$hc->check("hc_code")) {
		$smarty->assign("submit", "0");
		$smarty->assign("form_show", "1");
		$smarty->assign("hc_code", "1");
		$res = false;
	}

	return $res;
}

//**************************************************************************************
//форма
//**************************************************************************************

$form = new CustomForm("zapis", $_SERVER["REQUEST_URI"], "POST");

$form->bindField(new TextArea("text", "@REQUEST", "350px", "100px"), "Текст сообщения", true);

$form->bindField(new Hidden("date", date("Y-m-d H:m:s")));

$form->bindField(new TextBox("caption", "@REQUEST", "350px"), "Тема сообщения", true);

$form->bindField(new EmailTextBox("email", "@REQUEST", "350px"), "Контактный  E-mail", true);

$form->bindField(new Hidden("date", date("Y-m-d H:m:s")));
$form->bindField(new ImageSubmit("submit", "/images/button_send.gif"));

$form->bindField(new HumanCheckImage("hc_image"));
$form->bindField(new TextBox("hc_code", "", "225px"), "Введите цифры на изображении", true);

$form->bindField(new Hidden("_prid", $form->instanceCount));
$form->bindField(new Hidden("subj", get_class($formToDB) . $formToDB->instanceCount));

$form->setStyle('
<div class="row">
	<div class="col-xs-12 col-md-8">
<div class="universal-form__subgroup">
<div class="form-gr form-gr--secondw universal-form__row">
	<label class="form-gr__label" for="caption"><%FormControl:caption@caption%></label>
	<div class="form-gr__control form-gr__control--required">
		<%FormControl:caption%>
	</div>
</div>
<div class="form-gr form-gr--secondw universal-form__row">
	<label class="form-gr__label" for="email"><%FormControl:email@caption%></label>
	<div class="form-gr__control form-gr__control--required">
		<%FormControl:email%>
	</div>
</div>
<div class="form-gr form-gr--secondw universal-form__row">
	<label class="form-gr__label" for="email"><%FormControl:text@caption%></label>
	<div class="form-gr__control form-gr__control--required">
		<%FormControl:text%>
	</div>
</div>
<div class="form-gr form-gr--secondw form-gr_horizontal_center universal-form__row">
			<label class="form-gr__label" for="hc_code"><%FormControl:hc_code@caption%></label>
			<div class="form-gr__control form-gr__control--hc form-gr__control--required">
				<%FormControl:hc_code%>
			</div>
			<div class="form-gr__tooltip form-gr__tooltip--hc">
				<img class="HumanCheck" style="display:inline-block;margin: 3px;" vspace="10" src="/_phplib/human_check/hc_image.php?sid=' . session_id() . '">
			</div>
		</div>
	<div class="form-gr form-gr--secondw form-gr_horizontal_center">
		<div class="form-gr__label"></div>
			<div class="form-gr__control">
				<button type="submit" class="btn" >'.$_interface->MSG['Feedback']['send'].'</button>
			</div>
		</div>
	</div>

		<%FormControl:date%>
		<%FormControl:_prid%>
		<%FormControl:subj%>
</div>
		</div>
');

//**************************************************************************************
//
//**************************************************************************************
$formToDB->bindForm($form);
$form_process->addState($form);
$form_process->addState($formToDB);
$smarty->assign("form", $form_process->render($render));

//**************************************************************************************
//вывод сообщений или дерева тем
//**************************************************************************************
echo $smarty->fetch("USER_SMARTY:/content/mail.tpl");