<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <?= $this->include('partials/head'); ?>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <!--begin::Header-->
      <?php if ($userprofile['user_id'] && isset($admindata['admin_id'])): ?>
          <?= $this->include('partials/admin/navbar'); ?> <!-- Admin Navbar -->
      <?php else: ?>
          <?= $this->include('partials/navbar'); ?> <!-- Regular User Navbar -->
      <?php endif; ?>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <?php if ($userprofile['user_id'] && isset($admindata['admin_id'])): ?>
          <?= $this->include('partials/admin/aside'); ?> <!-- Admin Sidebar -->
      <?php else: ?>
          <?= $this->include('partials/aside'); ?> <!-- Regular User Sidebar -->
      <?php endif; ?>
      <!--end::Sidebar-->
      <?php if (isset($showModal) && $showModal): ?>
        <?= $this->include('modals/announcements_modal_view'); ?>
      <?php endif; ?>

      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            
            <?=$this->renderSection('content');?>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <?= $this->include('partials/footer'); ?>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="<?= base_url('assets/main.js') ?>" defer></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../dist/js/adminlte.js"></script>
    <script src="<?=base_url('/js/scripts.js')?>"></script> 
     <script type="module" src="<?=base_url('/js/app.js')?>"></script> 
    <?= $this->renderSection('scripts'); ?>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
