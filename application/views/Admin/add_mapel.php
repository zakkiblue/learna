<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <a href="<?= base_url(); ?>/admin/manage_materi">&lt Back</a>
    <h1>Tambah Mata Pelajaran</h1>

    <div class="form-input">
        <form action="<?= base_url(); ?>admin/add_mapel" method="post">
            <input type="text" name="mapel_name" placeholder="Mata Pelajaran">
            <small class="form-error"><?= form_error('name'); ?></small>
            <input type="number" name="chapters" placeholder="Banyak Chapter">
            <small class="form-error"><?= form_error('name'); ?></small>

            <br>
            <button type="submit">Masukan</button>
        </form>
    </div>
</div>