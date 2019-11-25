<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>

    <h1>Input Quiz <?= $id_chapter; ?></h1>
    <div class="form-input">
        <form action="<?= base_url(); ?>admin/naming_quiz?chapter=<?= $id_chapter; ?>" method="post">
            <input type="text" name="quiz_name" placeholder="Nama Kuis">
            <small class="form-error"><?= form_error('quiz_name'); ?></small>

            <button type="submit">Masukan</button>
        </form>
    </div>
</div>