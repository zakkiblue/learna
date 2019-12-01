<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Chapter </h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Quiz Name</th>
            <th>Action</th>
        </tr>
        <?php $i = 1;
        foreach ($quiz as $kuis) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><a class="badge" href="#"><?= $kuis['quiz_name']; ?></a></td>
                <td><a class="badge success" href="<?= base_url(); ?>admin/see_question?quiz=<?= $kuis['id']; ?>">Lihat</a> | <a class="badge failed" href="#">Hapus</a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>