<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Daftar Siswa</h1>
    <a href="<?= base_url(); ?>admin/monitor_siswa" class="button"> All </a>
    <a href="<?= base_url(); ?>admin/murid/2" class="button"> Mipa </a>
    <a href="<?= base_url(); ?>admin/murid/3" class="button"> Ips </a>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        <?php $i = 1;
        foreach ($siswa as $murid) : ?>
            <tr>
                <td><?= ++$start; ?></td>
                <td><a class="badge" href="<?= base_url('admin/detail_siswa'); ?>?siswa=<?= $murid['id']; ?>"><?= $murid['name']; ?></a></td>
                <td><?= $murid['email']; ?></td>
            </tr>
        <?php
        endforeach; ?>
    </table>
    <?= $this->pagination->create_links(); ?>
</div>