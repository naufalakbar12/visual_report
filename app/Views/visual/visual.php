<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Data Visualisasi</li>
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
                        <th scope="col">Nama Dataset</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($visual) :?>
                            <?php $no=1; foreach ($visual as $data) :?>
                                <tr>
                                    <th scope="row"><?= $no++?></th>
                                    <td><?= $data['nama_dataset']?></td>
                                    <td><?= $data['nama_keterangan']?></td>
                                    <td><?= $data['nama']?></td>
                                    <td>
                                        <?php if (($data['id_keterangan'] != 1) && (session()->get('id_user') == 1)) :?>
                                            <?php if ($data['nama_file'] != null) :?>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url('admin/visual/'.$data['id'].'/edit')?>" role="button">Edit</a>
                                                <button class="btn btn-danger btn-sm btn-hapus-datavisual" data-toggle="modal" data-target="#hapusModal" data-kode="<?=$data['id']?>" role="button">Hapus</button>
                                                <a class="btn btn-info btn-sm" href="<?= base_url('admin/visual/'.$data['id'].'/view/pdf')?>" target="_self" role="button">lihat PDf</a>
                                            <?php else:?>
                                                <a class="btn btn-primary btn-sm" href="<?= base_url('admin/visual/'.$data['id'].'/upload')?>" role="button">Upload</a>
                                            <?php endif?>
                                        <?php elseif (($data['nama_file'] != null) && (session()->get('id_user') == 2)):?>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('user/visual/'.$data['id'].'/download')?>" role="button">Download</a>
                                            <a class="btn btn-info btn-sm" href="<?= base_url('user/visual/'.$data['id'].'/view/pdf')?>" target="_self" role="button">Show Cart</a>
                                        <?php elseif(session()->get('id_user') == 1):?>
                                            <div class="alert alert-danger" role="alert">
                                                Silahkan download didataset terlebih dahulu
                                            </div>
                                        <?php else:?>
                                            <div class="alert alert-warning" role="alert">
                                                Menuggu analisis data
                                            </div>
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