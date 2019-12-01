<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Manage Materi</h1>
    <a href="<?= base_url(); ?>admin/add_mapel" class="button">Tambah mapel</a>
    <a href="<?= base_url(); ?>admin/input_materi" class="button">Masukan materi</a>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Mata Pelajaran</th>
            <th>Banyak chapter</th>
            <th>Action</th>
        </tr>
        <?php $i = 1;
        foreach ($mapels as $mapel) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $mapel['mapel_name']; ?></td>
                <td><?= $mapel['chapters']; ?></td>
                <td> <a class="badge success" href="<?= base_url('admin/materi_list?mapel=') ?><?= $mapel['id']; ?>">Buka</a> | <a class="badge failed" href="<?= base_url('admin/delete_mapel') ?>?mapel=<?= $mapel['id']; ?>" onclick="return confirm('Are you sure want to delete ? Semua data tentang mata pelajaran dan materi yang tekait akan ikut terhapus');">Delete</a> | <a class="badge blue" href="<?= base_url('admin/quiz_for'); ?>?mapel=<?= $mapel['id']; ?>">Input Kuis</a></td>

            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>