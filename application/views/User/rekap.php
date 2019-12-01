<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Chapter </h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Quiz Name</th>
            <th>Chpater Name</th>
            <th>Nilai</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        <?php $i = 1;
        foreach ($rekap as $raport) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $raport['quiz_name']; ?></td>
                <td><?= $raport['chapter_name']; ?></td>
                <td><?= $raport['score']; ?></td>
                <td><?= $raport['status']; ?></td>
                <td><?= date('d/m/Y', $raport['time_taken']); ?></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>