
/**
 * @component Toast
 * @author Champa
 */

'use strict';

function Toast(name, title, text) {
	
	this.name = name;
	this.placement = null;
	this.text = text;
	this.title = title;
}

Toast.prototype = {
	
	render: function() {

		var dom = '<div id="toast_'+ this.name +'" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">' +
			'<div class="toast-header">' +
				'<img src="..." class="rounded mr-2" alt="...">' +
				'<strong class="mr-auto">'+ this.title +'</strong>' +
				'<small>11 mins ago</small>' +
				'<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>' +
				'</button>' +
			'</div>' +
			'<div class="toast-body">' +
				this.text +
			'</div>' +
		'</div>';

		$(this.placement).html(dom);

		return this;
	},

	placeIn: function(placement) {

		this.placement = placement;

		return this;
	},

	destroy: function() {

		$("#" + this.placement).html('');
	}
}