<?= $this->extend('layout/template')?>
<?= $this->section('content')?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if (session()->get('id_user') == 1) :?>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/visual')?>">Data Visualisasi</a></li>
                    <?php else :?>
                        <li class="breadcrumb-item"><a href="<?= base_url('user/visual')?>">Data Visualisasi</a></li>
                    <?php endif?>
                    <li class="breadcrumb-item active" aria-current="page">Upload Data Visualisasi</li>
                </ol>
            </nav>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-12">
                                <form action="<?= base_url('user/visual/upload')?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Nama Dataset</label>
                                        <input type="hidden" name="id_visual" value="<?= $visual_id?>">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_dataset') ? 'is-invalid' : '')?>" id="" name="nama_dataset" placeholder="Nama Dataset" value="<?= $visual[0]->nama_dataset?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_dataset')?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : '')?>" id="" name="deskripsi" rows="3" placeholder="Deskripsi tentang dataset yang diupload" readonly><?= $visual[0]->deskripsi?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi')?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Upload Data Visualisasi</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_visual" class="custom-file-input <?= ($validation->hasError('file_visual') ? 'is-invalid' : '')?>" id="" required accept=".pdf">
                                            <label class="custom-file-label" for="">Pilih File</label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('file_visual')?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>