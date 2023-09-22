<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman - <?= $title?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url()?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url()?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-gradient-info topbar mb-4 static-top shadow">
                    <!-- Logo -->
                    <a class="navbar-brand" href="#">
                        <img src="<?= base_url()?>img/visual.png" alt="Logo" class="img-fluid" width="100">
                    </a>
                    <!-- Tombol Toggle untuk Tampilan Responsif -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse.show" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Daftar Navigasi -->
        <div class="navbar" id="navbar">
            <ul class="navbar-nav nav-fill">
                <?php if (session()->get('role_id') == 1) :?>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "user")? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('admin/user')?>">
                            <i class="fas fa fa-users"></i>
                            <span>User</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "dataset")? 'active' : '' ?>">
                        <a class="nav-link" href="<?=base_url('admin/dataset')?>">
                            <i class="fas fa fa-book"></i>
                            <span>Dataset</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "visual")? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('admin/visual')?>">
                            <i class="fas fa fa-file"></i>
                            <span>Data Visualisasi</span>
                        </a>
                    </li>
                </div>
                <?php endif?>
                <?php if (session()->get('role_id') == 2) :?>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "about")? 'active' : '' ?>">
                        <a class="nav-link " href="<?=base_url('user/about')?>">
                            <i class="fas fa fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "dataset")? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('user/dataset')?>">
                            <i class="fas fa fa-book"></i>
                            <span>Dataset</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (\Config\Services::request()->uri->getSegment(2) == "visual")? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('user/visual')?>">
                            <i class="fas fa fa-file"></i>
                            <span>Data Visualisasi</span>
                        </a>
                    </li>
                </div>
                <?php endif?>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="navbarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small"><?= $autor?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url()?>img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('logout')?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a> -->
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('content');?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Visual and Report <?= date('Y')?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">Apakah anda ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-sm" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url()?>js/base.js"></script>
    <script src="<?= base_url()?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url()?>js/sb-admin-2.min.js"></script>
    <script src="<?= base_url()?>js/jasindo.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url()?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url()?>js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url()?>js/demo/chart-pie-demo.js"></script>

</body>

</html>