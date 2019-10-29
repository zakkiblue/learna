<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Input Materi Pembelajaran</h1>

    <div class="form-input">
        <?= form_open_multipart('admin/input_materi'); ?>
        <input type="text" name="chapter_name" placeholder="Chapter name">
        <small class="form-error"><?= form_error('name'); ?></small>
        <select name="mapel" id="mapel" class="styled-select">
            <option value="Matematika">Matematika</option>
            <option value="Kimia">Kimia</option>
            <option value="sejarah">Sejarah</option>
            <option value="Fisika">Fisika</option>
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