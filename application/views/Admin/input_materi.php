<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <a href="<?= base_url(); ?>/admin/manage_materi">&lt Back</a>
    <h1>Input Materi Pembelajaran</h1>

    <div class="form-input">
        <?= form_open_multipart('admin/input_materi'); ?>
        <input type="text" name="chapter_name" placeholder="Chapter name">
        <small class="form-error"><?= form_error('name'); ?></small>
        <select name="mapel" id="mapel" class="styled-select">
            <?php foreach ($mapels as $mapel) : ?>
                <option value="<?= $mapel['mapel_name']; ?>"><?= $mapel['mapel_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <select name="chapter_no" id="chapter_no" class="styled-select">

            <?php
            for ($i = 1; $i < 13; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>

        <select name="type-file" id="type_file" class="styled-select">
            <option value="pdf">PDF</option>
            <option value="video">Video</option>
        </select>
        <div class="file-materi">
            <input type="file" name="filename">
            <small class="form-error"><?= form_error('filename'); ?></small>
        </div>

        <br>
        <button type="submit">Masukan</button>
        </form>
    </div>
</div>