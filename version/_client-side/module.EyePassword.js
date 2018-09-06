/**
 * Created by a.sirotkin on 04.04.2017.
 *
 * добавляет функциональность скрыть/показать пароль
 */

var EyePassword = function(props) {

	this.container = props.container;
	this.input = props.input;
	this.visible = false;
	this.containerClass = props.containerClass || 'eye-password';
	this.buttonClass = props.buttonClass || 'eye-password__button';
	this.buttonClassShowed = props.buttonClassShowed || 'eye-password__button--showed';
	this.inputClass = props.inputClass || 'eye-password__input';
	this.inputClassShowed = props.inputClassShowed || 'eye-password__input--showed';

	this.init();

};

EyePassword.prototype.init = function() {

	this.createEyeButton();
	this.container.classList.add(this.containerClass);
	this.input.classList.add(this.inputClass);

};

EyePassword.prototype.createEyeButton = function() {

	var button = document.createElement('button');
	button.type = "button";
	button.classList.add(this.buttonClass);
	this.button = button;
	this.container.appendChild(button);
	var self = this;
	button.addEventListener( "click", function(e){
		e.preventDefault();
		self.passwordToggle();
	});

};

EyePassword.prototype.passwordToggle = function(){

	if(this.visible) {
		this.hidePassword();
	} else {
		this.showPassword();
	}

};

EyePassword.prototype.showPassword = function() {

	this.visible = true;
	this.button.classList.add(this.buttonClassShowed);
	this.input.classList.add(this.inputClassShowed);
	this.input.type = 'text';

};

EyePassword.prototype.hidePassword = function() {

	this.visible = false;
	this.button.classList.remove(this.buttonClassShowed);
	this.input.classList.remove(this.inputClassShowed);
	this.input.type = 'password';

};