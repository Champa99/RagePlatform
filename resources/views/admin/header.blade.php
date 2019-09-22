<nav class="navbar navbar-light bg-light fixed-top admin-top-first-navbar">
	<div class="admin-link-tree">
		<div class="tree-breadcrumb"><i class="fas fa-tachometer-alt"></i> Dashboard</div>
		<div class="tree-breadcrumb">Neka stranica</div>
	</div>

	<div class="admin-topbar-items">
		<div class="admin-search" id="admin_search_holder">
			<input type="text" id="admin_search_input" placeholder="@lang('admin_header.search')">
			<div class="icon"><i class="fas fa-search"></i></div>
		</div>

		<div class="right-top-menu">
			<div class="item"><i class="fas fa-question"></i></div>
			<div class="item"><i class="fas fa-bell"></i></div>
			<div class="item"><i class="fas fa-power-off"></i></div>
		</div>
	</div>
</nav>

<div class="admin-spacing"></div>

<section class="admin-sidebar">
	<div class="sidebar-wrapper">
		<div class="sidebar h-100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 text-center admin-logo-parent">
						<img src="{{ getTheme() }}/img/logo.png" alt="rage-logo">
						<h5>Admin panel</h5>
					</div>
				</div>
			</div>

			<div class="sidebar-menu-items">
				<div class="sidebar-menu-item" data-id="0">
					<div class="icon"><i class="fas fa-cogs"></i></div>
					<p>@lang('admin_header.system')</p>
				</div>

				<div class="sidebar-menu-item" data-id="1">
					<div class="icon"><i class="fas fa-users"></i></div>
					<p>@lang('admin_header.members')</p>
				</div>

				<div class="sidebar-menu-item" data-id="2">
					<div class="icon"><i class="fas fa-layer-group"></i></div>
					<p>@lang('admin_header.page_builder')</p>
				</div>
			</div>
			
			<footer class="sidebar-admin-footer">
				<p class="rage">&#169; RAGE Ind.</p>
				<p class="version">v{{ \App\Packages\System\Versionist::getVersion() }}</p>
			</footer>
		</div>
	</div>
</section>

<div class="admin-submenu" id="admin_submenu_0" style="display: none;">
	<div class="submenu-section">
		<h5>@lang('admin_header.general')</h5>
	
		<p><a href="#"><i class="fas fa-angle-right"></i> @lang('admin_header.dashboard')</a></p>
	</div>

	<div class="submenu-section">
		<h5>@lang('admin_header.settings')</h5>
	
		<p><a href="/admin/settings/system"><i class="fas fa-angle-right"></i> @lang('admin_header.system')</a></p>
		<p><a href="#"><i class="fas fa-angle-right"></i> @lang('admin_header.cachevisor')</a></p>
		<p><a href="/admin/settings/menumanager"><i class="fas fa-angle-right"></i> @lang('admin_header.menu_manager')</a></p>
		<p><a href="/admin/settings/languages"><i class="fas fa-angle-right"></i> @lang('admin_header.languages')</a></p>
		<p><a href="#"><i class="fas fa-angle-right"></i> @lang('admin_header.plugins')</a></p>
		<p><a href="#"><i class="fas fa-angle-right"></i> @lang('admin_header.logs')</a></p>
	</div>
</div>