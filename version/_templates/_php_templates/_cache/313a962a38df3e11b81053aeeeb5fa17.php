<div id="CustomerBasketId">

	<div class="auth-block">
	<? if (!empty($login)) { ?>

		<?= $login['validationScript'] ?>

			<div class="auth-title" id="myModalLabel"><?= truc('Авторизация', 'Forms') ?></div>

			<form id="<?= $login['id'] ?>" name="<?= $login['name'] ?>" action="<?= $login['action'] ?>" method="<?= $login['method'] ?>" onsubmit="<?= $login['onsubmit'] ?>">
				<?= $login['fields']['loginform']['html'] ?>
				<div class="auth-input <?=(!empty($LOGIN_ERROR)) ? 'auth-input--login-error': ''?>">
					<label class="auth-label"><?= truc('Логин', 'LoginFormModule') ?></label>
					<?= $login['fields']['userlogin']['html'] ?>
				</div>
				<div class="auth-input <?=(!empty($LOGIN_ERROR)) ? 'auth-input--login-error': ''?>">
					<label class="auth-label"><?= truc('Пароль', 'Forms') ?></label>
					<span id="form_required_field"><?= $login['fields']['userpassword']['html'] ?></span>
				</div>

				<div class="auth-input">
					<input id="form-remember-mobile" class="auth-input__cbx" type="checkbox" name="remember">
					<label for="form-remember-mobile">Запомнить</label>
				</div>

				<? if (!empty($LOGIN_ERROR)) { ?>
					<div class="login-error-text"><?= $LOGIN_ERROR ?></div>

					<? $__BUFFER->addJsInit("
							jqWar('.navbar-push__inner').addClass('navbar-push__inner--show');
							jqWar('.navbar-push').css('z-index','5');
							jqWar('.shadow').fadeIn();
							jqWar('.mobile-nav').removeClass('mobile-nav--back').addClass('mobile-nav--forward');
						") ?>
				<? } ?>
				<input class="btn btn--auth-submit" type="submit" value="<?= truc('Войти', 'LoginFormModule') ?>"><br>
				<? if (!empty($authButtons)) { ?>
					<div class="auth-input">
						<? foreach ($authButtons as $authButton) { ?>
							<?= $authButton ?>
						<? } ?>
					</div>
				<? } ?>
				<a class="auth-link" href="/recover_password.html"><?= truc('Забыли пароль?', 'LoginFormModule') ?></a>
			</form>


	<? } ?>
	</div>

</div>