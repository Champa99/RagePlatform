/**
 * @component ButtonLoader
 * @author Champa
 */

'use strict';

var ButtonLoader = {};

ButtonLoader.buttons = {};

$.fn.showButtonLoader = function() {

	var buttonName = this.attr('id');

	if (typeof buttonName === typeof undefined || buttonName === false) {

		buttonName = this.data('button-name');

		if(typeof buttonName === 'undefined') {

			console.error('No button id or button-name data tag have been defined');
			return;
		}
	}

	ButtonLoader.buttons[buttonName] = this.html();

	const width = this.outerWidth();
	const height = this.outerHeight();

	this.attr('disabled', 'disabled');

	this.css({'width': width + 'px', 'height': height + 'px'});

	this.html('<div class="spinner-grow text-light spinner-grow-small" role="status"> <span class="sr-only">Loading...</span> </div>');
};

$.fn.hideButtonLoader = function() {

	var buttonName = this.attr('id');

	if (typeof buttonName === typeof undefined || buttonName === false) {

		buttonName = this.data('button-name');

		if(typeof buttonName === 'undefined') {

			console.error('No button id or button-name data tag have been defined');
			return;
		}
	}

	this.html(ButtonLoader.buttons[buttonName]);

	this.css({'width': 'auto', 'height': 'auto'});

	this.removeAttr('disabled');

	ButtonLoader.buttons[buttonName] = '';
}