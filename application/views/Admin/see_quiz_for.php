<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Pilih Chapter</h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Chapter Name</th>
        </tr>
        <?php $i = 1;
        foreach ($materi as $chapter) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <a class="badge success" href="<?= base_url('admin/see_quiz'); ?>?chapter=<?= $chapter['id']; ?>"><?= $chapter['chapter_name']; ?></a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>