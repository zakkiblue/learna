<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Materi</h1>
    <table class="table">
        <tr>
            <th>Mata Pelajaran</th>

        </tr>
        <?php $i = 1;
        foreach ($materis as $materi) : ?>
            <tr>
                <td><?= $materi['chapter_no']; ?></td>
                <td><?= $materi['chapter_name']; ?></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>