<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dataset')?>">Dataset</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Dataset</li>
                </ol>
            </nav>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-12">
                                <form action="<?= base_url('user/dataset/update')?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Nama Dataset</label>
                                        <input type="hidden" name="id" value="<?= $id?>">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_dataset') ? 'is-invalid' : '')?>" id="" name="nama_dataset" placeholder="Nama Dataset" value="<?= $dataset[0]->nama_dataset?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_dataset')?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : '')?>" id="" name="deskripsi" rows="3" placeholder="Deskripsi tentang dataset yang diupload"><?= $dataset[0]->deskripsi?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi')?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Upload Dataset</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="file_dataset_lama" value="<?= $dataset[0]->nama_file?>">
                                            <input type="file" name="file_dataset" class="custom-file-input <?= ($validation->hasError('file_dataset') ? 'is-invalid' : '')?>" id="" accept=".xls, .xlsx, .csv">
                                            <label class="custom-file-label" for="">Pilih File</label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('file_dataset')?>
                                            </div>
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