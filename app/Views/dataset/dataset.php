<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dataset</li>
                </ol>
            </nav>
            <?php if ( session()->get('id_user') == 2) :?>
                <a href="<?= base_url('user/dataset/store')?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Tambah Data</a>
            <?php endif?>
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
                        <th scope="col">Nama Dataset</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataset) :?>
                            <?php $no=1; foreach ($dataset as $data) :?>
                                <tr>
                                    <th scope="row"><?= $no++?></th>
                                    <td><?= $data['nama_dataset']?></td>
                                    <td><?= $data['nama_keterangan']?></td>
                                    <td><?= $data['nama']?></td>
                                    <td>
                                        <?php if ( session()->get('id_user') == 1) :?>
                                            <a class="btn btn-info btn-sm" href="<?= base_url('admin/dataset/'.$data['id'].'/detail')?>" role="button">Detail</a>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/dataset/'.$data['id'].'/download')?>" role="button">Unduh</a>
                                        <?php else:?>
                                            <a class="btn btn-info btn-sm" href="<?= base_url('user/dataset/'.$data['id'].'/detail')?>" role="button">Detail</a>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('user/dataset/'.$data['id'].'/download')?>" role="button">Unduh</a>
                                            <a class="btn btn-warning btn-sm" href="<?= base_url('user/dataset/'.$data['id'].'/edit')?>" role="button">Edit</a>
                                            <button class="btn btn-danger btn-sm btn-hapus-dataset" data-kode=<?=$data['id']?> data-toggle="modal" data-target="#hapusModal" role="button">Hapus</button>
                                        <?php endif?>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        <?php else :?>
                            <tr>
                                <td colspan="5" class="text-center table-danger">Data Kosong</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection()?>