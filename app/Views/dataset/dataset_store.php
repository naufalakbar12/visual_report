<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dataset')?>">Dataset</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Dataset</li>
                </ol>
            </nav>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-12">
                                <form action="<?= base_url('user/dataset/store')?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Nama Dataset</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_dataset') ? 'is-invalid' : '')?>" id="" name="nama_dataset" placeholder="Masukan Nama Dataset">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_dataset')?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Upload Dataset</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_dataset" class="custom-file-input <?= ($validation->hasError('file_dataset') ? 'is-invalid' : '')?>" id="" required accept=".xls, .xlsx, .csv">
                                            <label class="custom-file-label" for="">Masukan Data Atau File yang Sesuai</label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('file_dataset')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : '')?>" id="" name="deskripsi" rows="3" placeholder="Jelaskan Tentang Data Anda"></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi')?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>