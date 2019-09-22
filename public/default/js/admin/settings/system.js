
/**
 * @component admin/settings/system
 * @author Champa
 */

'use strict';

jQuery(function($) {

    var saving = false;

    const $system_settings_form = $("#system_settings_form");
    const $save_settings_button = $("#save_settings_button");

    $system_settings_form.submit(function(e) {

        e.preventDefault();

        if(!saving) {

            $save_settings_button.showButtonLoader();
            saving = true;

            $.ajax({
                type: 'POST',
                url: '/admin/settings/system',
                data: $(this).serialize(),
                success: function(res) {

                    res = JSON.parse(res);

                    if(res.success) {

                        Swal.fire('Success!', 'Changes successfully saved', 'success');
                    }

                    saving = false;
                    $save_settings_button.hideButtonLoader();
                },
                error: function() {

                    saving = false;
                    $save_settings_button.hideButtonLoader();
                }
            });
        }
    });
});