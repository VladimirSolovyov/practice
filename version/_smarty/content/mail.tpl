<div>
{%if $submit == 1%}

	<div class="message message_type_success">
		<div class="message__text">
			Ваше сообщение успешно отправлено. <a href="/message/">Вернуться к форме отправки сообщений</a>.
		</div>
	</div>
{%else%}
	
		{%$list%}

{%/if%}

{%if $form_show == "1"%}

{%if $hc_code == "1"%}
	<div class="message message_type_error">
		<div class="message__text">
			Введенные вами цифры не совпадают с данными на изображении
		</div>
	</div>
{%/if%}

{%$form%}
{%/if%}
</div>