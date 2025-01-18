<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?=base_url('/assets/css/dashboard-content.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0 typingEffect">Karibu, <?=$fullName?>😊</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
                <?= view('partials/messages') ?>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h4>Choir Registration</h4>
                    <p>TBC!! Coming Soon</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                     d="M3 4C3 3.44772 3.44772 3 4 3H15C16.1046 3 17 3.89543 17 5V19C17 20.1046 16.1046 21 15 21H4C3.44772 21 3 20.5523 3 20V4ZM15 5H4V19H15V5ZM19 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20H19V4ZM7 7H12V8H9V10H12V11H9V13H12V14H7V7Z"
                    ></path>
                  </svg>
                  <a
                    href="<?=site_url('/tabs/choir')?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h4>Readings</h4>
                  <p><?= $todayscatholicdate->summary ?? 'No data available' ?></p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M3 4C3 3.44772 3.44772 3 4 3H9C10.1046 3 11 3.89543 11 5V19C11 20.1046 10.1046 21 9 21H4C3.44772 21 3 20.5523 3 20V4ZM9 5H4V19H9V5ZM15 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H15C13.8954 21 13 20.1046 13 19V5C13 3.89543 13.8954 3 15 3ZM15 5V19H20V5H15Z"
                    ></path>
                  </svg>
                  <a
                    href="<?=site_url('/tabs/readings')?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box" style="background-color:rgb(229, 226, 226); color:rgb(69, 69, 69); position: relative;">
                    <div class="inner">
                        <h4>Prayers & Saints</h4>
                        <p><?=$saintoftheday?>(Today's Saint)</p>
                    </div>
                    <!-- Catholic cross as background -->
                    <svg
                        class="small-box-icon"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2; width: 80px; height: 80px;"
                    >
                        <path
                            d="M12 2V22M2 12H22"
                            stroke="#2a2a2a"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                    <a
                        href="<?=site_url('tabs/prayers')?>"
                        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                    >
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                <!--end::Small Box Widget 3-->
            </div>

              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                  <h4>Reports</h4>
                  <p>Get all Exclusive TUMCATHCOM Reports</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="<?=site_url('tabs/treasury_report')?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-lg-7 connectedSortable">
                <div class="card mb-4">
                <a href="<?=site_url('/tabs/prayers')?>" class="text-decoration-none">
                  <div class="card-body bg-warning text-black border-white radius-7">
                  <?php if (!empty($prayer)): ?>
                    <div class="card-header">
                        <h2 class="card-title"><h4 class="typingEffect"><?= esc($dailyprayer['title']) ?> - (Today's Prayer)</h4></h2>
                    </div>
                      <?php
                          // Limit the paragraph content to 40 words
                          $words = explode(' ', $dailyprayer['content']);
                          $limitedParagraph = implode(' ', array_slice($words, 0, 40));
                        ?>
                        <p><?= esc($limitedParagraph) ?><?= count($words) > 40 ? '...' : '' ?></p>
                  <?php else: ?>
                      <p>No prayer available for today. Please try again later.</p>
                  <?php endif; ?>

                  </div>
                </div>
                  </a>
                <div class="card mb-4">
                <a href="<?=site_url('/tabs/prayers')?>" class="text-decoration-none">
                  <div class="card-body bg-danger text-white">
                    <?php if (!empty($saint)): ?>
                      <div class="card-header">
                        <h2 class="card-title">
                          <h3 class="typingEffect"><?= esc($saint['title']) ?>✨</h3>
                        </h2>
                      </div>
                      <?php
                        // Limit the paragraph content to 40 words
                        $words = explode(' ', $saint['paragraphs']);
                        $limitedParagraph = implode(' ', array_slice($words, 0, 40));
                      ?>
                      <p><?= esc($limitedParagraph) ?><?= count($words) > 40 ? '...' : '' ?></p>
                    <?php else: ?>
                      <p>No Saint Data available. Please try again later.</p>
                    <?php endif; ?>
                  </div>
                </a>

                </div>
                <!-- /.card -->
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-primary mb-4">
                  <div class="card-header">
                    <h3 class="card-title typingEffect">Drop Your Suggestion about TUMCATHCOM</h3>
                    <div class="card-tools">
                      <span title="3 New Messages" class="badge text-bg-primary"> 3 </span>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-tool"
                        title="Contacts"
                        data-lte-toggle="chat-pane"
                      >
                        <i class="bi bi-chat-text-fill"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <!-- Message. Default to the start -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-start"> Antony Angwenyi- Former Chairperson </span>
                          <span class="direct-chat-timestamp float-end"> 23 Nov 2:00 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="../../dist/assets/img/user1-128x128.jpg"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text typingEffect">
                          Karibuni Nyote kwa St Francis of Assisi,TUM Catholic Community.
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message to the end -->
                      <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-end"> Dennis Mutua-Former Treasurer </span>
                          <span class="direct-chat-timestamp float-start"> 23 July 2:05 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="../../dist/assets/img/user3-128x128.jpg"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text typingEffect">You are all Lucky to be in this Community</div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message. Default to the start -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-start"> Francis Thuo - Assets Manager  </span>
                          <span class="direct-chat-timestamp float-end"> 21 Dec 5:37 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="../../dist/assets/img/user1-128x128.jpg"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text typingEffect">
                          Very nice and welcoming council and leaders.Drop Your Suggestions.
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message to the end -->
                      <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-end"> Stephen Muli - Liturgical Commitee </span>
                          <span class="direct-chat-timestamp float-start"> 23 Jan 6:10 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="../../dist/assets/img/user3-128x128.jpg"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text typingEffect">We also welcome you to Daily Prayers,Readings and Novenas</div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                    </div>
                    <!-- /.direct-chat-messages-->
                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                      <ul class="contacts-list">
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user1-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Count Dracula
                                <small class="contacts-list-date float-end"> 2/28/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> How have you been? I was... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user7-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Sarah Doe
                                <small class="contacts-list-date float-end"> 2/23/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> I will be waiting for... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user3-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nadia Jolie
                                <small class="contacts-list-date float-end"> 2/20/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> I'll call you back at... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user5-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nora S. Vans
                                <small class="contacts-list-date float-end"> 2/10/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Where is your new... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user6-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                John K.
                                <small class="contacts-list-date float-end"> 1/27/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Can I take a look at... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="../../dist/assets/img/user8-128x128.jpg"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Kenneth M.
                                <small class="contacts-list-date float-end"> 1/4/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Never mind I found... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                      <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                        <input
                          type="text"
                          name="message"
                          placeholder="Type Message ..."
                          class="form-control"
                        />
                        <span class="input-group-append">
                          <button type="button" class="btn btn-primary">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- /.direct-chat -->
              </div>
              <!-- /.Start col -->
              <!-- Start col -->
               
              <div class="col-lg-5 connectedSortable">
              <a href="<?=site_url('/tabs/readings')?>" class="text-decoration-none">
                <div class="card text-white bg-primary bg-primary border-primary mb-4">
                  <div class="card-header">
                    <h1 class="card-title">Today's Readings</h1>
                  </div>
                  <div class="card-body">
                  <p>
                    <?php if (!empty($readings['content'])): ?>
                        <ul>
                            <?php foreach ($readings['content'] as $reading): ?>
                                <li id="typingEffect"><?= esc($reading['topic']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Internet Error.Refresh the Page to Fetch Readings</p>
                    <?php endif; ?>
                    </p>
                  </div>
                  <div class="card-footer border-0">
                </div>  
              </div>
              </a>
              <a href="<?=site_url('/tabs/prayers')?>" class="text-decoration-none">
                  <div class="card text-black bg-white bg-primary border-white mb-4">
                    <div class="card-header">
                        <h1 class="card-title typingEffect"><?= isset($mystery[0]['title']) ? htmlspecialchars($mystery[0]['title']) : 'Title not available'; ?></h1>
                        
                    </div>
                    <div class="card-body">
                        <p>
                            <?php if (!empty($mystery)): ?>
                                <ul>
                                    <?php foreach ($mystery as $mystery_item): ?>
                                        <h4 class="text-black "><?= esc($mystery_item['mystery_number']) ?></h4>
                                        <li class="text-black"><?= esc($mystery_item['mystery_title']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No readings available for today.</p>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="card-footer border-0">
                    </div>
                </div>
             </a>

              <div class="info-box mb-3 text-bg-primary" style="background-color: #007bff; color: #ffffff;">
                <span class="info-box-icon" style="display: flex; align-items: center; justify-content: center; padding: 10px;">
                    <i class="bi bi-people-fill" style="font-size: 36px; color: #ffffff;"></i>
                </span>
                <div class="info-box-content">
                 <span class="info-box-number typingEffect" style="font-size: 24px; font-weight: bold;">Members Registered</span>
                  <div style="display: flex; align-items: baseline;">
                      <span class="info-box-number" id="membersCount" style="font-size: 23px; font-weight: bold;">0</span>
                  </div>
              </div>
                <!-- /.info-box-content -->
            </div>

            <div class="info-box mb-3 bg-danger " style="background-color:rgb(27, 236, 30); color: #ffffff;">
              <span class="info-box-icon">
                  <i class="bi bi-person-circle" style="font-size: 36px; color: #ffffff;"></i>
              </span>
              <div class="info-box-content">
               <span class="info-box-number typingEffect" style="font-size: 24px; font-weight: bold;">Saints Available</span>
                  <div style="display: flex; align-items: baseline;">
                      <span class="info-box-number" id="saintCount" style="font-size: 23px; font-weight: bold;">0</span>
                  </div>
              </div>
          </div>
          <div class="info-box mb-3 " style="background-color:rgb(236, 236, 236); color:rgb(0, 0, 0);">
            <span class="info-box-icon">
                <i class="bi bi-journal-text" style="font-size: 36px; color:rgb(0, 0, 0);"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-number typingEffect" style="font-size: 24px; font-weight: bold;">Prayers Available</span>
                <div style="display: flex; align-items: baseline;">
                    <span class="info-box-number" id="prayersCount" style="font-size: 23px; font-weight: bold;">0</span>
                </div>
            </div>
        </div>
        <div class="info-box mb-3 " style="background-color:rgb(0, 255, 68); color:rgb(0, 0, 0);">
            <span class="info-box-icon">
                <i class="bi bi-hand-thumbs-up-fill" style="font-size: 36px; color:rgb(0, 0, 0);"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-number typingEffect" style="font-size: 24px; font-weight: bold;">Likes Received</span>
                <div style="display: flex; align-items: baseline;">
                    <span class="info-box-number" id="likesCount" style="font-size: 23px; font-weight: bold;">0</span>
                </div>
            </div>
        </div>


            <!-- /.row (main row) -->
          </div>
          
          <!--end::Container-->
        </div>
      </main>
<?= $this->endSection() ?>
<?= $this->section('scripts')?>
<script>
  function animateCount(id, target) {
      let count = 0;
      const interval = setInterval(() => {
          if (count >= target) {
              clearInterval(interval);
              document.getElementById(id).innerText = `${target}+`;
          } else {
              document.getElementById(id).innerText = `${++count}`;
          }
      }, 10); // Adjust interval speed as needed
  }

  // Start the counts
  document.addEventListener("DOMContentLoaded", () => {
      animateCount("saintCount", 700);   // Target count for Saints
      animateCount("membersCount", 400); // Target count for Members
      animateCount("prayersCount", 900); // Target count for Locations
      animateCount("likesCount",650);
  });

</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const typingElements = document.querySelectorAll(".typingEffect"); // Select all elements with the class 'typingEffect'

    typingElements.forEach((typingElement) => {
        const text = typingElement.innerHTML; // Get the current content of each element
        let index = 0;

        function typeText() {
            if (index < text.length) {
                typingElement.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeText, 100); // Adjust typing speed (15ms per character)
            }
        }

        typingElement.innerHTML = ""; // Clear content before starting the typing effect
        typeText();
    });
});

</script>

<?= $this->endSection() ?>

