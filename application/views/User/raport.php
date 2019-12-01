<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Materi</h1>
    <table class="table">
        <tr>
            <th>Mata Pelajaran</th>

        </tr>
        <?php
        foreach ($mapels as $mapel) : ?>
            <tr>
                <td><a href="<?= base_url('user_mipa/rekap?mapel='); ?><?= $mapel['mapel_id']; ?>"><?= $mapel['mapel_name']; ?></a></td>
            </tr>
        <?php
        endforeach; ?>
    </table>
</div>