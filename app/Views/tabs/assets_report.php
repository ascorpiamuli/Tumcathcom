<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0"><?=$pageTitle?></h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$pageTitle?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title typingEffect">Monthly Reports </h3>
        </div>
        <div class="card-body p-0">
          <div style="overflow-x: auto; max-width: 100%;">
            <table class="table table-striped table-bordered table-sm" style="table-layout: fixed; width: 100%;">
              <thead>
                <tr>
                  <th style="width: 5%;">#</th>
                  <th>Report Month</th>
                  <th>Report Date</th>
                  <th>Report Publisher</th>
                  <th>Expenses Incurred</th>
                  <th>Revenues Earned</th>
                  <th>Download (PDF)</th>
                </tr>
              </thead>
              <tbody>

                    <tr class="align-middle">
                        <td><?= htmlspecialchars('1') ?></td>
                        <td><?= htmlspecialchars('January') ?></td>
                        <td><?= htmlspecialchars('2024-08-06') ?></td>
                        <td><?= htmlspecialchars('Francis Thuo') ?></td>
                        <td><?= htmlspecialchars('Shs 5000') ?></td>
                        <td><?= htmlspecialchars('Shs 12000') ?></td>
                        <td>
                        <div style="white-space: nowrap; display: flex; gap: 5px;">
                            <button class="btn btn-info btn-sm download-btn">Download Report</button>
                        </div>
                        </td>
                    </tr>
                    
              </tbody>


            </table>
            <footer class= "float-center text-center">
                Report Compiled and Published by <strong> Francis Thuo, Library & Assets Manager.</strong>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!--end::App Main-->

<script>
</script>



<?= $this->endSection() ?>
