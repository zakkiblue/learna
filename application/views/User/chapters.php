<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <a href="<?= base_url(); ?>user_mipa/materi">&lt Back</a>
    <h1>Materi</h1>
    <table class="table">
        <tr>
            <th>Chapter No</th>
            <th>Chapter Name</th>
            <th>Format</th>
            <th>Action</th>
        </tr>
        <?php $i = 1;
        foreach ($materis as $materi) : ?>

            <tr>
                <td><?= $materi['chapter_no']; ?></td>
                <td><?= $materi['chapter_name']; ?></td>
                <td><?= $materi['file_type']; ?></td>
                <td><a class="badge success" href="<?= base_url('user_mipa/materi_view/?chapter='); ?><?= $materi['id']; ?>">Open</a></td>
            </tr>


        <?php $i++;
        endforeach; ?>
    </table>
</div>