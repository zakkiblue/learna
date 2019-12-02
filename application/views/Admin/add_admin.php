<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <a href="<?= base_url(); ?>admin/profil" class="button">back</a>
    <h1><?= $user['name']; ?> </h1>
    <div class="form-input" style="font-size:20px;">
        <?= form_open_multipart('admin/add_admin'); ?>
        <input type="text" name="name" placeholder="Name">
        <small class="form-error"><?= form_error('name'); ?></small>
        <input type="email" name="email" placeholder="Email">
        <small class="form-error"><?= form_error('email'); ?></small>
        <input type="password" name="password1" placeholder="Password" id="password1">
        <small class="form-error"><?= form_error('password1'); ?></small>
        <input type="password" name="password2" placeholder="Password" id="password2">

        <button type="submit">Simpan</button>
        </form>
    </div>
</div>