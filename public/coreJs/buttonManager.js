
/**
 * @component buttonManager
 * @author Champa
 */

'use strict';

jQuery(function($) {

    var isDragging = false;
    var dragObj = null;
    var dragBtnId = -1;
    var targetExpandable = false;
    var addingButton = false;

    const $body = $("body");
    const $button_is_expandable = $("#button_is_expandable");
    const $button_is_child = $("#button_is_child");
    const $parent_button = $("#parent_button");
    const $button_is_expandable_holder = $("#button_is_expandable_holder");
    const $button_is_child_holder = $("#button_is_child_holder");
    const $add_button_form = $("#add_button_form");
    const $add_button = $("#add_button");
    const $save_order_button = $("#save_order_button");

    $save_order_button.click(function() {

        var buttons = {};
        var display_order = 0;

        $save_order_button.showButtonLoader();

        $(".button-preview").each(function() {

            buttons[$(this).data('btn-id')] = {
                parent: $(this).data('parent'),
                display_order: display_order
            };

            display_order += 1;
        });

        $.ajax({
            type: 'POST',
            url: '/admin/settings/menumanager/saveorder',
            type: 'POST',
            data: {
                _token: _token,
                buttons: buttons
            },
            success: function(res) {

                res = JSON.parse(res);

                if(res.success) {

                    Swal.fire('Success', 'Successfully saved the button layout', 'success');
                }

                $save_order_button.hideButtonLoader();
            },
            error: function() {

                $save_order_button.hideButtonLoader();
            }
        })
    });

    $add_button_form.submit(function(e) {

        e.preventDefault();

        if(!addingButton) {

            $add_button.showButtonLoader();
            addingButton = true;

            $.ajax({
                type: 'POST',
                url: '/admin/settings/menumanager/add',
                data: $(this).serialize(),
                success: function(res) {

                    res = JSON.parse(res);

                    if(res.success) {

                        Swal.fire('Success!', '', 'success');

                        if(res.payload.parent == 0) {

                            $("#button_list").append(res.payload.html);
                        } else {

                            $("#children_btn_" + res.payload.parent).append(res.payload.html);
                        }
                    } else {

                        Swal.fire('Something went wrong', res.message, 'error');
                    }

                    addingButton = false;
                    $add_button.hideButtonLoader();
                }
            });
        }
    });

    $button_is_expandable.change(function() {

        if($button_is_expandable.is(':checked')) {

            $button_is_child.attr('checked', false);
            $button_is_child_holder.hide();
            $parent_button.hide();
        } else {

            $button_is_child_holder.show();
        }
    });

    $button_is_child.change(function() {

        if($button_is_child.is(':checked')) {

            $button_is_expandable.attr('checked', false);
            $button_is_expandable_holder.hide();

            $parent_button.show();
        } else {

            $button_is_expandable_holder.show();

            $parent_button.hide();
        }
    });

    $(document).delegate('.move-icon', 'mousedown', function() {

        dragBtnId = $(this).data('btn-id');

        isDragging = true;
        dragObj = $("#btn_preview_" + dragBtnId);

        if(!$("#collapse_btn_" + dragBtnId).data('collapsed')) {

            $("#children_btn_" + dragBtnId).hide();
        }

        const width = dragObj.outerWidth();
	    const height = dragObj.outerHeight();

        dragObj.css({'width': width + 'px', 'height': height + 'px'});
        dragObj.addClass('moving');

        $body.addClass('drop-here');

        $(".button-preview").addClass('not-moving');
        dragObj.removeClass('not-moving');
    });

    $(document).mousemove(function(e) {

        if(isDragging) {

            dragObj.css({
                'top': (e.clientY + 20) + 'px',
                'left': (e.clientX + 20) + 'px'
            });

            const $target = $(e.target);

            if($target.hasClass('button-preview')) {

                targetExpandable = $target.data('expandable');

                $(".drop-indicator").remove();

                $target.after('<div class="drop-indicator" id="drop_indicator"></div>');

                if(targetExpandable) {

                    const targetBtnId = $target.data('btn-id');
                    const $tmpChldBtn = $("#children_btn_" + targetBtnId);
                    const $tmpCollBtn = $("#collapse_btn_" + targetBtnId);

                    $tmpCollBtn.data('collapsed', false);
                    $tmpCollBtn.children('i').removeClass('fa-caret-down').addClass('fa-caret-up');
                    
                    if ($tmpChldBtn.children().length == 0) {
                        $tmpChldBtn.append('<div class="drop-indicator-make-child" id="make_child_'+ targetBtnId +'"></div>')
                    }

                    $tmpChldBtn.slideDown("fast");
                }
            }
        }
    });

    $(document).mouseup(function(e) {

        if(isDragging) {

            const $target = $(e.target);

            if($target.hasClass('button-preview') || $target.hasClass('drop-indicator')
                || $target.hasClass('drop-indicator-make-child')) {

                dragObj.css({'width': 'auto', 'height': 'auto'});
                dragObj.removeClass('moving');

                if(!$("#collapse_btn_" + dragBtnId).data('collapsed')) {

                    $("#children_btn_" + dragBtnId).slideDown("fast");
                }

                if($target.parent().hasClass('children-buttons')) {

                    dragObj.data('parent', $target.parent().data('btn-id'));
                }

                dragObj.insertAfter("#" + $target.attr('id'));

                $(".drop-indicator").remove();

                $body.removeClass('drop-here');

                $(".button-preview").removeClass('not-moving');

                $(".drop-indicator-make-child").remove();
                
                isDragging = false;
                dragObj = null;
                dragBtnId = -1;
            }
        }
    });

    $(document).delegate('.collapse-icon', 'click', function() {

        const id = $(this).data('btn-id');

        $("#children_btn_" + id).slideToggle();

        if($(this).data('collapsed')) {

            $(this).data('collapsed', false);

            $(this).children('i').removeClass('fa-caret-down').addClass('fa-caret-up');
        } else {

            $(this).data('collapsed', true);

            $(this).children('i').removeClass('fa-caret-up').addClass('fa-caret-down');
        }
    });
});