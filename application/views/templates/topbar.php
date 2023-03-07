<?php $page = basename($_SERVER['PHP_SELF']); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav style="background-color:background: rgb(15,4,69);
background: linear-gradient(0deg, rgba(15,4,69,1) 0%, rgba(0,0,0,1) 35%);"
      class="navbar navbar-expand-lg topbar mb-3 static-top shadow">
      <div class="container-fluid">
        <a class="navbar-brand mb h1">
          <img src="<?= base_url('images/pengaduan2.jpg') ?>" alt="" width="59" height="50"
            class="d-inline-block align-text-top">
        </a>
        <!-- <div class="sidebar-brand-text mx-3">HAMZAH APP <sup></sup></div> -->
        <h4 style="color:white; padding-right: 50px;">pengaduan hamzah</h4>



        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav justify-content ">

          <li class="nav-item ">
            <?php if ($this->session->userdata('nik')): ?>
              <a class="nav-link" href="<?= base_url('user'); ?>">
              <?php elseif ($this->session->userdata('level')): ?>
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                <?php endif; ?>
                <i style="color:white;" class="fas fa-fw fa-tachometer-alt"></i>
                <span style="color:white;">Dashboard</span></a>
          </li>

          <!-- Divider -->


          <!-- Heading -->
          <div class="sidebar-heading">
            <?php if ($this->session->userdata('level')): ?>

            <?php elseif ($this->session->userdata('nik')): ?>

            <?php endif; ?>
          </div>

          <?php if ($this->session->userdata('level')): ?>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if ($this->session->userdata('level') == 1): ?>

              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('master/petugas'); ?>">
                  <i style="margin-right:5px; color:white;" class="fas fa-user-tie"></i>

                  <span style="color:white;"> data petugas</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('master/masyarakat'); ?>">
                  <i style="margin-right:5px; color:white;" class="fas fa-user-alt"></i>
                  <span style="color:white;"> data masyarakat</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('generate '); ?>">
                  <i style="margin-right:5px; color:white;" class="fas fa-fw fa-download"></i>
                  <span style="color:white;">Buat Laporan</span></a>
              </li>

            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('pengaduan '); ?>">
                <i style="color:white;" style="margin-right:5px;" class="fas fa-fw fa-file"></i>
                <span style="color:white;">Data Pengaduan</span></a>
            </li>



          <?php elseif ($this->session->userdata('nik')): ?>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('laporan'); ?>">
                <i style="color:white;" class="fas fa-fw fa-book"></i>
                <span style="color:white;">Laporan Pengaduan</span></a>
            </li>
          <?php endif; ?>

          <!-- Sidebar Toggler (Sidebar) -->
        </ul>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Messages -->





          <!-- notification -->
          <?php if ($this->session->userdata('level') == 1): ?>
            <li class="nav-item dropdown no-arrow mx-1">

              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-success badge-counter">
                  <?= $this->db->get_where('tbl_pengaduan', ['status_notif' => 0])->num_rows(); ?>
                </span>
              </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  notifikasi
                </h6>
                <?php foreach ($notif as $n) { ?>
                  <?php if ($n->status_notif == 0): ?>
                    <a style="padding-right:40px;" id="status-btn" class="dropdown-item d-flex align-items-center"
                      href="<?= base_url('pengaduan/status_notif/') . md5($n->id_pengaduan); ?>">
                      <div class="mr-3">
                        <div class="icon-circle bg-primary">
                          <img src="<?= base_url('asset/upload/') . $n->foto; ?>" alt="" width="49" height="40"
                            class="d-inline-block align-text-top">

                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">
                          <?= $n->tgl_pengaduan; ?>
                        </div>
                        <span class="font-weight-bold">
                          <?= $n->isi_laporan; ?>
                        </span>

                      </div>
                    </a>
                  <?php endif; ?>
                <?php }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('pengaduan') ?>">tampilkan
                  semua aduan</a>
              </div>
            </li>
          <?php endif; ?>




          <!-- end of notification -->

          <!-- notification -->
          <?php if ($this->session->userdata('level') == 2): ?>
            <li class="nav-item dropdown no-arrow mx-1">

              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">
                  <?= $this->db->get_where('tbl_pengaduan', ['status_notif' => 0])->num_rows(); ?>
                </span>
              </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  notifikasi
                </h6>
                <?php foreach ($notif as $n) { ?>
                  <?php if ($n->status_notif == 0): ?>
                    <a style="padding-right:40px;" id="status-btn" class="dropdown-item d-flex align-items-center"
                      href="<?= base_url('pengaduan/status_notif/') . md5($n->id_pengaduan); ?>">
                      <div class="mr-3">
                        <div class="icon-circle bg-primary">
                          <img src="<?= base_url('asset/upload/') . $n->foto; ?>" alt="" width="49" height="40"
                            class="d-inline-block align-text-top">

                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">
                          <?= $n->tgl_pengaduan; ?>
                        </div>
                        <span class="font-weight-bold">
                          <?= $n->isi_laporan; ?>
                        </span>

                      </div>
                    </a>
                  <?php endif; ?>
                <?php }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('pengaduan') ?>">tampilkan
                  semua aduan</a>
              </div>
            </li>
          <?php endif; ?>




          <!-- end of notification -->

          <li class="nav-link dropdown no-arrow mx-1">
            <?php if ($this->session->userdata('nik')): ?>
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i style="color:#F6FBFC" class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-primary badge-counter">
                  <?= $ntf_jumlah ?>
                </span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  notifikasi
                </h6>
                <?php foreach ($ntf as $t) { ?>
                  <?php if ($t->notif_status == 0): ?>
                    <a style="padding-right:40px;" id="status-btn" class="dropdown-item d-flex align-items-center"
                      href="<?= base_url('laporan/notif_status/') . ($t->id_tanggapan); ?>">
                      <div class="mr-3">
                      </div>
                      <div>
                        <div class="small text-gray-500">
                          <?= $t->tgl_tanggapan; ?>
                        </div>
                        <span class="font-weight-bold">
                          <?= $t->tanggapan; ?>
                        </span>

                      </div>
                    </a>
                  <?php endif; ?>
                <?php }
                ?>
              </div>
            </li>
          <?php endif; ?>



          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span style="color:white;" class="mr-2 d-none d-lg-inline  small">
                <?= $pengguna['nama']; ?>
              </span>
              <img class="img-profile rounded-circle" src="<?= base_url('asset/img/images.png'); ?>">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

              <?php if ($this->session->userdata('nik')): ?>
                <a class="dropdown-item" href="<?= base_url('user'); ?>">
                <?php elseif ($this->session->userdata('level')): ?>
                  <a class="dropdown-item" href="<?= base_url('admin'); ?>">
                  <?php endif; ?>
                  <i style="margin-right:20px;" class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"><span></span></i>
                  <span>dashboard</span></a>

                <div class="dropdown-divider"></div>
                <?php if ($this->session->userdata('level')): ?>
                  <a class="dropdown-item" href="<?= base_url('admin/edit'); ?>">
                  <?php elseif ($this->session->userdata('nik')): ?>
                    <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
                    <?php endif; ?>
                    <i class="fas fa fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>Edit Profile</span></a>

                  <div class="dropdown-divider"></div>



                  <a class="dropdown-item logout" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>

            </div>

          </li>

        </ul>

    </nav>


    <!-- End of Topbar -->