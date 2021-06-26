<?= $this->extend('layouts/template');?>
<?= $this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Orang</h1>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Keyword pencarian..." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <!-- <a href="/komik/create" class="btn btn-primary mt-2">Tambah Komik</a> -->

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (6 * ($currentPage - 1));?>

                    <?php foreach($orang as $o) : ?>
                    <tr>
                        <th scope="row"><?= $no++;?></th>
                        <td><?= $o['nama'];?></td>
                        <td><?= $o['alamat'];?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal<?= $o['id_orang'];?>">
                                Detail
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination') ?>
        </div>
    </div>

    <?php foreach($orang as $o) : ?>
    <div class="modal fade" id="exampleModal<?= $o['id_orang'];?>" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" value="<?= $o['nama'];?>" class="form-control" id=""
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                rows="3"><?= $o['alamat'];?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>
<?= $this->endSection()?>