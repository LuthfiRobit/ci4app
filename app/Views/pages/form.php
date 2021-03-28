<?= $this->extend('layouts/template');?>
<?= $this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Form</h1> 
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" value="<?= $email;?>">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">
            <?= $alamat;?>
            </textarea>
            </div> 
        </div>
    </div>
</div>
<?=$this->endSection();?>
