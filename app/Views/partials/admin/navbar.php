<nav class="app-header navbar navbar-expand bg-body" style="background-color: purple;">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav align-items-center">
            <!-- Sidebar Toggle Button -->
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>

            <!-- Post Announcement Link -->
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#announcementModal"> Announcements</a>
            </li>

            <!-- Daily Readings Link -->
            <li class="nav-item d-none d-md-block">
                <a href="<?=site_url('tabs/readings')?>" class="nav-link">Daily Readings</a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::Navbar Search-->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item flex-grow-1 me-auto">
                <form class="form-inline d-flex">
                    <div class="input-group w-100">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-sidebar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
        </ul>
        <!--end::Navbar Search-->

        <!--begin::Navbar Links-->
        <ul class="navbar-nav align-items-center">
            <!-- Messages Dropdown -->
            <li class="nav-item dropdown ms-3">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a href="#" class="dropdown-item">See All Messages</a>
                </div>
            </li>

            <!-- Notifications Dropdown -->
            <li class="nav-item dropdown ms-3">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item ms-3">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- User Menu Dropdown -->
            <li class="nav-item dropdown user-menu ms-3">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?= base_url('/index.php/uploads/' . (isset($userprofile['profile_image']) && !empty($userprofile['profile_image']) ? $userprofile['profile_image'] : 'default.webp')); ?>" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline"><?= isset($fullName) ? $fullName : 'Member' ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="<?= base_url('/index.php/uploads/' . (isset($userprofile['profile_image']) && !empty($userprofile['profile_image']) ? $userprofile['profile_image'] : 'default.webp')); ?>" class="user-image rounded-circle shadow" alt="User Image">
                        <p>
                            <?=isset($fullName) ? $fullName:'Member'?> - <?=isset($family) ?$family:'Null'?>
                            <small> You Joined <?=isset($datelogged) ? $datelogged:'null'?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <a href="<?=site_url('tabs/profile')?>" class="btn btn-default btn-flat">My Profile</a>
                        <a href="<?=site_url('auth/logout');?>" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end::Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!-- Load the Modal View -->
<?= view('modals/announcements_modal') ?>