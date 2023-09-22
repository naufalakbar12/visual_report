<?= $this->extend('layout/template_auth');?>
<?= $this->section('content-auth');?>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create New Account</h1>
                        </div>
                        <?php if (session()->getFlashdata('type')) :?>
                        <div class="alert <?= session()->getFlashdata('type')?> alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan')?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif?>
                        <form class="user" method="post" action="<?=base_url('register')?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= ($validation->hasError('nama') ? 'is-invalid' : '')?>" id="" name="nama" placeholder="Nama Pengguna">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama')?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= ($validation->hasError('username') ? 'is-invalid' : '')?>" id="" name="username"
                                    placeholder="Username">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user <?= ($validation->hasError('password') ? 'is-invalid' : '')?>"
                                        id="" name="password" placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password')?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user <?= ($validation->hasError('password_repeat') ? 'is-invalid' : '')?>"
                                        id="" name="password_repeat" placeholder="Ulangi Password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password_repeat')?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-user btn-block">Create</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small text-success" href="<?= base_url('login')?>">Have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>