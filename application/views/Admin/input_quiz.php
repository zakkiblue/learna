<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Input Quiz</h1>
    <div class="form-input">
        <form action="<?= base_url(); ?>admin/input_quiz" method="post">
            <input type="text" name="quiz_name" placeholder="Nama Kuis">
            <small class="form-error"><?= form_error('name'); ?></small>
            <textarea name="question" rows="10" cols="30">Masukan pertanyaan</textarea>
            <small class="form-error"><?= form_error('name'); ?></small>
            <input type="text" name="option1" placeholder="Pilihan 1">
            <small class="form-error"><?= form_error('name'); ?></small>
            <input type="text" name="option2" placeholder="Pilihan 2">
            <small class="form-error"><?= form_error('name'); ?></small>
            <input type="text" name="option3" placeholder="Pilihan 3">
            <small class="form-error"><?= form_error('name'); ?></small>
            <input type="text" name="option4" placeholder="Pilihan 4">
            <small class="form-error"><?= form_error('name'); ?></small>
            <br>
            <input type="checkbox" name="option1_cek" id="option1_cek" value="Mipa">
            <label for="option1_cek">Pilihan 1</label>
            <br>
            <input type="checkbox" name="option2_cek" id="option2_cek" value="Mipa">
            <label for="option2_cek">Pilihan 2</label>
            <br>
            <input type="checkbox" name="option3_cek" id="option3_cek" value="Mipa">
            <label for="option3_cek">Pilihan 3</label>
            <br>
            <input type="checkbox" name="option4_cek" id="option1_cek" value="Mipa">
            <label for="option4_cek">Pilihan 4</label>
            <br>

            <button type="submit">Masukan</button>
        </form>
    </div>
</div>