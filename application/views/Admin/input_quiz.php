<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>

    <h1>Input Quiz <?= $id_quiz; ?></h1>
    <div class="form-input">

        <!-- <?= form_open_multipart('admin/input_quiz?quiz=' . $id_quiz); ?> -->
        <textarea name="question">Masukan pertanyaan</textarea>
        <!-- <input type="file" name="image"> -->
        <small class="form-error"><?= form_error('question'); ?></small>
        <input type="text" name="option1" placeholder="Pilihan 1">
        <small class="form-error"><?= form_error('option1'); ?></small>
        <input type="text" name="option2" placeholder="Pilihan 2">
        <small class="form-error"><?= form_error('opyion2'); ?></small>
        <input type="text" name="option3" placeholder="Pilihan 3">
        <small class="form-error"><?= form_error('option3'); ?></small>
        <input type="text" name="option4" placeholder="Pilihan 4">
        <small class="form-error"><?= form_error('option4'); ?></small>
        <br>
        <input type="checkbox" name="option1_cek" id="option1_cek" value="yes">
        <label for="option1_cek">Pilihan 1</label>
        <br>
        <input type="checkbox" name="option2_cek" id="option2_cek" value="yes">
        <label for="option2_cek">Pilihan 2</label>
        <br>
        <input type="checkbox" name="option3_cek" id="option3_cek" value="yes">
        <label for="option3_cek">Pilihan 3</label>
        <br>
        <input type="checkbox" name="option4_cek" id="option1_cek" value="yes">
        <label for="option4_cek">Pilihan 4</label>
        <br>

        <button type="submit">Masukan</button>
        </form>
    </div>
</div>