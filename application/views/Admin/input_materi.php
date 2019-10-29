<div class="main-content">
    <h1>Input Materi Pembelajaran</h1>

    <div class="form-input">
        <?= form_open_multipart('admin/input_materi'); ?>
        <input type="text" name="chapter_name" placeholder="Chapter name">
        <small class="form-error"><?= form_error('name'); ?></small>
        <select name="mapel" id="mapel" class="styled-select">
            <option value="Matematika">Matematik</option>
            <option value="Kimia">Kimia</option>
            <option value="sejarah">Sejarah</option>
            <option value="Fisika">Fisika</option>
        </select>
        <select name="chapter_no" id="chapter_no" class="styled-select">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
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