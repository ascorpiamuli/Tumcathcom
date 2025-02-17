<aside class="app-sidebar" style="background-color:rgb(112, 7, 112); color: white;" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="<?=site_url('tabs/dashboard')?>" class="brand-link">
            <img src="../../dist/assets/img/cathcomlogo.jpg" alt="CathcomLogo" class="brand-image" />
            <span class="brand-text">TUMCATHCOM</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?=site_url('tabs/dashboard')?>" class="nav-link">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Family Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi-person-lines-fill"></i>
                        <p>Family <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/semester-registration')?>" class="nav-link">
                                <i class="nav-icon bi bi-pencil-square"></i>
                                <p>Semester Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/family')?>" class="nav-link">
                                <i class="nav-icon bi bi-bell"></i>
                                <p>Family Announcements</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Liturgy Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-book"></i>
                        <p>Liturgy <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/readings')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-text"></i>
                                <p>Readings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/prayers')?>" class="nav-link">
                                <i class="nav-icon bi bi-heart"></i>
                                <p>Prayers and Saints</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/liturgical_classes')?>" class="nav-link">
                                <i class="nav-icon bi bi-calendar-event"></i>
                                <p>Classes Registration</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Assets & Hospitality Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-building"></i>
                        <p>Assets & Hospitality <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/assets')?>" class="nav-link">
                                <i class="nav-icon bi bi-box"></i>
                                <p>Book Asset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/booking-history')?>" class="nav-link">
                                <i class="nav-icon bi bi-clock-history"></i>
                                <p>Booking History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/assets_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-bar-chart"></i>
                                <p>Assets Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Choir Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-music-note-beamed"></i>
                        <p>Choir <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('tabs/choir-registration')?>" class="nav-link">
                                <i class="nav-icon bi bi-person-plus"></i>
                                <p>Choir Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-music-note"></i>
                                <p>Songs and Lyrics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-store"></i>
                                <p>Choir Store</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-clipboard"></i>
                                <p>Classes Registration</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Calendar of Events -->
                <li class="nav-item">
                    <a href="<?=site_url('tabs/events')?>" class="nav-link">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <p>Calendar of Events</p>
                    </a>
                </li>

                <!-- Welfare -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-heart-fill"></i>
                        <p>Welfare</p>
                    </a>
                </li>

                <!-- Treasury -->
                <li class="nav-item">
                    <a href="<?=site_url('tabs/treasury_report')?>" class="nav-link">
                        <i class="nav-icon bi bi-wallet"></i>
                        <p>Treasury</p>
                    </a>
                </li>

                <!-- FAQ & Help -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-question-circle-fill"></i>
                        <p>FAQ & Help</p>
                    </a>
                </li>

                <!-- About TUMCATHCOM -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-info-circle-fill"></i>
                        <p>About TUMCATHCOM</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
