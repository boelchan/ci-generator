<div class="page-sidebar-wrapper">
	<!-- BEGIN SIDEBAR -->
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<?php $page_sidebar_menu_closed = ($this->input->cookie('sidebar_closed')) ? 'page-sidebar-menu-closed' : '' ; ?>
		<?php  ?>

		<ul class="page-sidebar-menu <?php echo $page_sidebar_menu_closed ?> " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="nav-item <?php if ($this->uri->segment(1) == 'Dashboard') echo 'active' ?> ">
				<a href="<?php echo site_url('dashboard') ?>" class="nav-link">
					<i class="icon-bar-chart"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
			
			<li class="heading">
				<h3 class="uppercase">Master</h3>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'mKantor') echo 'active' ?> ">
				<a href="<?php echo site_url('mKantor') ?>" class="nav-link">
					<i class="icon-home"></i>
					<span class="title">Kantor</span>
				</a>
			</li>			
			<?php if ($this->group_id == 1) : ?>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'laporan') echo 'active' ?> ">
				<a href="<?php echo site_url('laporan') ?>" class="nav-link">
					<i class="icon-printer"></i>
					<span class="title">Laporan</span>
				</a>
			</li>			
			<li class="nav-item <?php if ($this->uri->segment(1) == 'mKualitas') echo 'active' ?> ">
				<a href="<?php echo site_url('mKualitas') ?>" class="nav-link">
					<i class="icon-list"></i>
					<span class="title">Kualitas</span>
				</a>
			</li>			
			<?php endif ?>

			<?php if ($this->group_id == 1) : ?>
			<li class="heading">
				<h3 class="uppercase">Pengaturan</h3>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'page') echo 'active' ?> ">
				<a href="<?php echo site_url('page') ?>" class="nav-link">
					<i class="icon-settings"></i>
					<span class="title">Halaman</span>
				</a>
			</li>
			<?php endif ?>

			<li class="heading">
				<h3 class="uppercase">Akun</h3>
			</li>
			<?php if ($this->group_id == 1) : ?>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'Users') echo 'active' ?> ">
				<a href="<?php echo site_url('Users') ?>" class="nav-link">
					<i class="icon-users"></i>
					<span class="title">Operator</span>
				</a>
			</li>
			<?php endif ?>
            <li class="nav-item <?php if ($this->uri->segment(1) == 'UbahKataSandi') echo 'active' ?> ">
				<a href="<?php echo site_url('UbahKataSandi') ?>" class="nav-link">
					<i class="icon-key"></i>
                    <span class="title">Ubah Kata Sandi</span>
                </a>
            </li>
            <li class="nav-item  ">
				<a href="<?php echo site_url('auth/logout') ?>" class="nav-link ">
					<i class="icon-logout"></i>
                    <span class="title">Keluar</span>
                </a>
            </li>

		</ul>

		<!-- END SIDEBAR MENU -->
	</div>
	<!-- END SIDEBAR -->
</div>
