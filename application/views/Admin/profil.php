<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <a href="<?= base_url(); ?>admin/add_admin" class="button">Tambah Admin</a>
    <h1><?= $user['name']; ?> </h1>
    <div class="form-input" style="font-size:20px;">
        <?= form_open_multipart('admin/profil'); ?>
        <input type="text" name="name" value="<?= $user['name']; ?>">
        <small class="form-error"><?= form_error('name'); ?></small>
        <input type="email" name="email" placeholder="Email" value="<?= $user['email']; ?>" readonly>
        <input type="file" name="image">

        <button type="submit">Simpan</button>
        </form>
    </div>
</div>