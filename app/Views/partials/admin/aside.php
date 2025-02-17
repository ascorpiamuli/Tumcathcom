<aside class="app-sidebar" style="background-color: #800080; color: white;" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?=site_url('admin/dashboard')?>" class="brand-link">
            <!--begin::Brand Image-->
            <img src="../../dist/assets/img/cathcomlogo.jpg" alt="CathcomLogo" class="brand-image rounded-circle"/>
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text">TUMCATHCOM</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?=site_url('admin/dashboard')?>" class="nav-link">
                        <i class="nav-icon bi bi-house-door-fill"></i> <!-- Dashboard Icon -->
                        <p>Admin Dashboard</p>
                    </a>
                </li>
                
                <!-- Family Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-lines-fill"></i> <!-- Family Icon -->
                        <p>Family
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('admin/semester-registration')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-pdf"></i> <!-- Reports Icon -->
                                <p>Registration Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/family')?>" class="nav-link">
                                <i class="nav-icon bi bi-megaphone"></i> <!-- Announcements Icon -->
                                <p>Family Announcements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/family_project')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-code"></i> <!-- Project Diagram Icon -->
                                <p>Project</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Liturgy Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-journal-text"></i> <!-- Liturgy Icon -->
                        <p>Liturgy
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('admin/readings')?>"class="nav-link">
                                <i class="nav-icon bi bi-book"></i> <!-- Readings Icon -->
                                <p>Post Readings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/prayers')?>" class="nav-link">
                                <i class="nav-icon fas fa-praying-hands"></i> <!-- Font Awesome Praying Hands Icon -->
                                <p>Prayers & Novenas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/liturgy_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-people"></i> <!-- Classes Registration Icon -->
                                <p>Classes Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Assets & Hospitality Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-briefcase"></i> <!-- Assets Icon -->
                        <p>Assets & Hospitality
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('admin/assets_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-bookmark-plus"></i> <!-- Book Asset Icon -->
                                <p>Publish Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/assets_conditions')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-text"></i> <!-- File Icon -->
                                <p>Assets Checkup</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=site_url('admin/assets_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-bar-chart-line"></i> <!-- Report Icon -->
                                <p>Booking History & Status </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Choir Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-music-note"></i> <!-- Music Icon -->
                        <p>Choir 
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('admin/choir_registration')?>" class="nav-link">
                                <i class="nav-icon bi bi-mic"></i> <!-- Choir Registration Icon -->
                                <p>Registration Status</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/post_songs')?>"class="nav-link">
                                <i class="nav-icon bi bi-music-note-beamed"></i> <!-- Songs & Lyrics Icon -->
                                <p>Post Songs & Lyrics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/choir_project')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-code"></i> <!-- Project Diagram Icon -->
                                <p>Project</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=site_url('admin/choir_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-people"></i> <!-- Classes Registration Icon -->
                                <p>Registration Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Calendar of Events -->
                <li class="nav-item">
                    <a href="<?=site_url('admin/events')?>" class="nav-link">
                        <i class="nav-icon bi bi-calendar"></i> <!-- Calendar Icon -->
                        <p>Publish Events</p>
                    </a>
                </li>
                <!-- Welfare Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-heart-fill"></i> <!-- Welfare Icon -->
                        <p>Welfare</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url('admin/welfare_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-person-plus"></i> <!-- Welfare Registrations Icon -->
                                <p>Welfare Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('admin/medical')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-medical"></i> <!-- Medical Registry Icon -->
                                <p>Medical Registry</p>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <!-- Treasury Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-coin"></i> <!-- Treasury Icon -->
                        <p>Treasury</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Manage Transactions Sub-tab -->
                        <li class="nav-item">
                            <a href="<?=site_url('admin/manage_transactions')?>" class="nav-link">
                                <i class="nav-icon bi bi-currency-exchange"></i> <!-- Currency Exchange Icon -->
                                <p>Manage Transactions</p>
                            </a>
                        </li>
                        <!-- Generate Report Sub-tab -->
                        <li class="nav-item">
                            <a href="<?=site_url('admin/generate_report')?>" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-spreadsheet"></i> <!-- Spreadsheet Icon -->
                                <p>Generate Report</p>
                            </a>
                        </li>
                        <!-- View Audit Log Sub-tab -->
                        <li class="nav-item">
                            <a href="<?=site_url('admin/view_audit_log')?>" class="nav-link">
                                <i class="nav-icon bi bi-journal-text"></i> <!-- Journal Icon -->
                                <p>View Audit Log</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- FAQ Section -->
                <li class="nav-item">
                    <a href="<?=site_url('tabs/faq')?>" class="nav-link">
                        <i class="nav-icon bi bi-question-circle-fill"></i> <!-- FAQ Icon -->
                        <p>FAQ & Help</p>
                    </a>
                </li>

                <!-- About Section -->
                <li class="nav-item">
                    <a href="<?=site_url('tabs/about')?>" class="nav-link">
                        <i class="nav-icon bi bi-patch-check-fill"></i> <!-- About Icon -->
                        <p>About TUMCATHCOM</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
