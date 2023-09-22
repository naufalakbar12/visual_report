<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <?php if (session()->getFlashdata('type')) :?>
                    <div class="alert <?= session()->getFlashdata('type')?> alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan')?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif?>
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($user) :?>
                            <?php $no=1; foreach ($user as $data) :?>
                                <tr>
                                    <th scope="row"><?= $no++?></th>
                                    <td><?= $data['nama']?></td>
                                    <td><?= $data['username']?></td>
                                    <td><?= $data['nama_role']?></td>
                                </tr>
                            <?php endforeach?>
                        <?php else :?>
                            <tr>
                                <td colspan="4" class="text-center table-danger">Data Kosong</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection()?>