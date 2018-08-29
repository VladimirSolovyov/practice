<?php /* Smarty version 2.6.14, created on 2017-09-18 15:39:37
         compiled from /home/www/materikavto.ru/www/_smarty/content/mail.tpl */ ?>
<div>
<?php if ($this->_tpl_vars['submit'] == 1): ?>

	<div class="message message_type_success">
		<div class="message__text">
			Ваше сообщение успешно отправлено. <a href="/message/">Вернуться к форме отправки сообщений</a>.
		</div>
	</div>
<?php else: ?>
	
		<?php echo $this->_tpl_vars['list']; ?>


<?php endif; ?>

<?php if ($this->_tpl_vars['form_show'] == '1'): ?>

<?php if ($this->_tpl_vars['hc_code'] == '1'): ?>
	<div class="message message_type_error">
		<div class="message__text">
			Введенные вами цифры не совпадают с данными на изображении
		</div>
	</div>
<?php endif; ?>

<?php echo $this->_tpl_vars['form']; ?>

<?php endif; ?>
</div>