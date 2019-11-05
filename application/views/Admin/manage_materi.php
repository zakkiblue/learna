<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Manage Materi</h1>
    <a href="<?= base_url(); ?>admin/add_mapel" class="button">Tambah mapel</a>
    <a href="<?= base_url(); ?>admin/input_materi" class="button">Masukan materi</a>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Mata Pelajaran</th>
            <th>Mipa</th>
            <th>Ips</th>
            <th>Banyak chapter</th>
            <th>Action</th>
        </tr>
        <?php $i = 1;
        foreach ($mapels as $mapel) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $mapel['mapel_name']; ?></td>
                <td> ? </td>
                <td> ? </td>
                <td><?= $mapel['chapters']; ?></td>
                <td> <a class="badge success" href="<?= base_url('admin/edit_mapel') ?>">Edit</a> | <a class="badge failed" href="<?= base_url('admin/delete_mapel') ?>" onclick="return confirm('Are you sure want to delete ? ');">Delete</a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>