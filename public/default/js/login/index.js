
/**
 * @component login/index
 * @author Champa
 */

'use strict';

jQuery(function($) {

	const $user_login = $("#user_login");
	const $login_button = $("#login_button");

	$user_login.submit(function(e) {

		e.preventDefault();

		$login_button.showButtonLoader();

		$.ajax({
			type: 'POST',
			url: '/login',
			data: $(this).serialize(),
			success: function(res) {
				
				res = JSON.parse(res);

				if(res.success) {
					
					window.location.href = '/';
				}

				$login_button.hideButtonLoader();
			}
		})
	});
});