
/**
 * @component languageAdder
 * @author Champa
 */

'use strict';

jQuery(function($) {

    const $install_language = $("#install_language");
    const $install_file = $("#install_file");

	var installing = false;
	
	var selectFileToast = new Toast('select_toast', 'Install error', 'Please select a language file');

	selectFileToast.placeIn("#select_file_alert").render();

    $install_file.change(function() {

        var props = $(this).prop('files')[0];
		var image_data = new FormData();

		image_data.append('file', props);
		image_data.append('_token', _token);
	});

    $install_language.click(function() {

        if(!installing && $install_file.val() != '') {

            installing = true;

            $.ajax({
				url: '/admin/module/installer',
				type: 'POST',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: image_data,
				success: function(res) {

					uploadingModule = false;
				}
			});
        }
    });
});