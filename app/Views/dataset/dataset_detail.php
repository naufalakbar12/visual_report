<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if ( session()->get('id_user') == 1) :?>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dataset')?>">Dataset</a></li>
                    <?php else :?>
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dataset')?>">Dataset</a></li>
                    <?php endif?>
                    <li class="breadcrumb-item active" aria-current="page">Detail Dataset</li>
                </ol>
            </nav>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-12">
                                <dl class="row">
                                    <dt class="col-sm-3">Nama Dataset</dt>
                                    <dd class="col-sm-9"><?= $dataset[0]->nama_dataset?></dd>
                                    <dt class="col-sm-3">Deskripsi Dataset</dt>
                                    <dd class="col-sm-9"><?= $dataset[0]->deskripsi?></dd>
                                    <dt class="col-sm-3">Nama File</dt>
                                    <dd class="col-sm-9">
                                        <?= $dataset[0]->nama_file?><br>
                                        <?php if ( session()->get('id_user') == 1) :?>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/dataset/'.$downlaod.'/download')?>" role="button">Unduh</a>
                                        <?php else:?>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url('user/dataset/'.$downlaod.'/download')?>" role="button">Unduh</a>
                                        <?php endif?>
                                    </dd>
                                    <dt class="col-sm-3">Keterangan</dt>
                                    <dd class="col-sm-9">
                                        <?php if ($dataset[0]->id_keterangan == 1) :?>
                                            <span class="badge badge-danger"><?= $dataset[0]->nama_keterangan?></span>
                                        <?php elseif ($dataset[0]->id_keterangan == 2) :?>
                                            <span class="badge badge-info"><?= $dataset[0]->nama_keterangan?></span>
                                        <?php else :?>
                                            <span class="badge badge-success"><?= $dataset[0]->nama_keterangan?></span>
                                        <?php endif?>
                                    </dd>
                                    <dt class="col-sm-3">User</dt>
                                    <dd class="col-sm-9"><?= $dataset[0]->nama?></dd>
                                    <dd class="col-sm-12">
                                        <?php if ($dataset[0]->id_keterangan == 3) :?>
                                            <a class="btn btn-success" href="<?= base_url('/admin/visual')?>" role="button">Lihat Visualisasi Dataset</a>
                                        <?php endif?>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>