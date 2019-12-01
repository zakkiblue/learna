<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Manage Kuis</h1>

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
                <td><a class="badge" href="<?= base_url('admin/quiz_list'); ?>?mapel=<?= $mapel['id']; ?>"><?= $mapel['mapel_name']; ?></a></td>
                <td><?= $mapel['chapters']; ?></td>
                <td><a class="badge blue" href="<?= base_url('admin/quiz_for'); ?>?mapel=<?= $mapel['id']; ?>">Input Kuis</a> | <a class="badge success" href="<?= base_url('admin/see_quiz_for'); ?>?mapel=<?= $mapel['id']; ?>">Lihat Kuis</a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>