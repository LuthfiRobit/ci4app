<?= $this->extend('layouts/template');?>
<?= $this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Komik/create" class="btn btn-primary mt-2">Tambah Komik</a>
            <h1 class="mt-2">Daftar Komik</h1>
            <?php if(session()->getFlashdata('pesan')) :?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('pesan');?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach($komik as $k) : ?>
                    <tr>
                        <th scope="row"><?= $no++;?></th>
                        <td><?= $k['judul'];?></td>
                        <td>
                            <img src="/img/<?= $k['sampul'];?>" alt="naruto" class="sampul" />
                        </td>
                        <td>
                            <a href="/komik/<?= $k['slug'];?>" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection()?>