<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Materi</h1>
    <table class="table">
        <tr>
            <th>Mata Pelajaran</th>

        </tr>
        <?php $i = 1;
        foreach ($mapels as $mapel) : ?>
            <tr>
                <td><?= $mapel['mapel_name']; ?></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>