
/**
 * @component register/index
 * @author Champa
 */

'use strict';

jQuery(function($) {

	const $user_login = $("#user_login");
	const $register_button = $("#register_button");

	$user_login.submit(function(e) {

		e.preventDefault();

		$register_button.showButtonLoader();

		$.ajax({
			type: 'POST',
			url: '/register',
			data: $(this).serialize(),
			success: function(res) {
				console.log(res);
				
				res = JSON.parse(res);

				if(res.success) {

					window.location.href = '/login/success';
				}

				$register_button.hideButtonLoader();
			}
		});
	});
});