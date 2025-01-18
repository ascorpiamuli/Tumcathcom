<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
            <div class="col-sm-6"> <h3 class="mb-0 typingEffect">🙏 Prayers and Saints ✝</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Prayers and Saints</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4 bg-white text-black">
                  <div class="card-header">
                    <h3 class="card-title typingEffect"> Daily Prayer</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <p class="text-center">
                        <strong><?=$dailyprayer['title']?>🙌</strong>
                      </p>
                      <div><?=$dailyprayer['content']?></div>
                  </div>
                  <!-- ./card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4 bg-white text-black">
                  <div class="card-header">
                    <h3 class="card-title typingEffect">[Random Prayer (Number: <?=$prayer['id']?>)]</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <p class="text-center">
                        <strong><?=$prayer['title']?>🙌</strong>
                      </p>
                      <div><?=$prayer['content']?></div>
                  </div>
                  <!-- ./card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
                      <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4 bg-white text-black">
                  <div class="card-header">
                    <h2 class="card-title typingEffect"> <?= isset($mystery[0]['title']) ? htmlspecialchars($mystery[0]['title']) : 'Title not available'; ?>📌</h2>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <p class="text-center">
                      </p>
                      <?php if (!empty($mystery)): ?>
                        <ul>
                            <?php foreach ($mystery as $mystery_item): ?>
                                <h3 class="text-black "><?= esc($mystery_item['mystery_number']) ?></h3>
                                <h5 class="text-black"><?= esc($mystery_item['mystery_title']) ?></h5>
                                <p class="text-black"><?= esc($mystery_item['mystery_content']) ?></p>
                            <?php endforeach; ?>
                        </ul>
                      <?php else: ?>
                          <p>No readings available for today.</p>
                      <?php endif; ?>
                  </div>
                  <!-- ./card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
            <div class="card text-white bg-primary  border-white mb-6">
            <?php if (!empty($saint)): ?>
              <div class="card bg-white text-black">
                  <div class="card-header">
                      <h3 class="card-title"><h4 class="typingEffect"><?=$saint['title']?></h4></h3>
                  </div>
                  
                  <div class="card-body">
                      <ul>
                          <li><strong>Feast Day:</strong> <?= !empty($saint['feast_day']) ? esc($saint['feast_day']) : 'Not available' ?></li>
                          <li><strong>Patron:</strong> <?= !empty($saint['patron']) ? esc($saint['patron']) : 'Not available' ?></li>
                          <li>
                              <strong>YouTube Video:</strong>
                              <?php
                              if (!empty($saint['youtube_links'])):
                                  // Decode the links if they are JSON-encoded
                                  $youtubeLinks = json_decode($saint['youtube_links'], true);

                                  if (is_array($youtubeLinks) && !empty($youtubeLinks)):
                                      foreach ($youtubeLinks as $link): ?>
                                          <a href="<?= esc($link) ?>" target="_blank"><?=$saint['title']?></a><br>
                                      <?php endforeach; ?>
                                  <?php else: ?>
                                      <p>Invalid YouTube links format.</p>
                                  <?php endif; ?>
                              <?php else: ?>
                                  Not available
                              <?php endif; ?>
                          </li>
                      </ul>
                  </div>
              <?php else: ?>
                  <p>No Saint Data available</p>
              <?php endif; ?>
            </div>
          </div>
            <div class="card-footer border-0">
          </div>
        <!-- /.Start col -->
      </div>
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-md-15 mt-5">

                <!--begin::Latest Order Widget-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title typingEffect">Your Saint's Information (<?=$saint['title']?>)⛪</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-3">
                    <?=htmlspecialchars($saint['paragraphs'])?>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
<?= $this->endSection() ?>