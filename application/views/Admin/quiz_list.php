<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>List Chapter <?= $mapel['mapel_name'] ?></h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Chapter Name</th>
        </tr>
        <?php $i = 1;
        foreach ($chapter as $materi) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><a class="badge" href="<?= base_url('admin/chapter_quiz'); ?>?chapter=<?= $materi['id']; ?>"><?= $materi['chapter_name']; ?></a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>