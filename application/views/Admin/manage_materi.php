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
                <td><?= $i; ?>
                </td>
                <td><?= $mapel['mapel_name']; ?>
                </td>
                <td><?= $i; ?>
                </td>
                <td><?= $i; ?>
                </td>
                <td><?= $mapel['chapters']; ?>
                </td>
                <td> Edit | Delete
                </td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>