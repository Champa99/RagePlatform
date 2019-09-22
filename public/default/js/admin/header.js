
/**
 * @component admin/header
 * @author Champa
 */

'use strict';

jQuery(function($) {

    const $admin_search_input = $("#admin_search_input");
    const $admin_search_holder = $("#admin_search_holder");
    const $sidebar_menu_item = $(".sidebar-menu-item");
    const $admin_submenu = $(".admin-submenu");

    /**
     * Searchbar
     */
    $admin_search_input.focus(function() {

        $admin_search_holder.addClass('focus');
    }).blur(function() {

        $admin_search_holder.removeClass('focus');
    });

    /**
     * Sidebar menu/submenu
     */
    $sidebar_menu_item.hover(function() {
        
        const submenuId = $(this).data('id');

        $sidebar_menu_item.removeClass('active');
        $(this).addClass('active');

        $admin_submenu.hide();
        $("#admin_submenu_" + submenuId).show();
    });

    $admin_submenu.mouseleave(function() {

        $admin_submenu.hide();
        $sidebar_menu_item.removeClass('active');
    });
});