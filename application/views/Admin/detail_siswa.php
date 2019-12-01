<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1><?= $siswa['name']; ?> </h1>
    <div class="foto-profil" style="border: 1px solid #eee; margin-top: 20px;margin-left:0px;">
        <img src="<?= base_url('assets/img/profile/'); ?><?= $siswa['image']; ?>" alt="Profile foto">
    </div>
    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Quiz Name</th>
            <th>Chapter</th>
            <th>Mapel</th>
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
                <td><?= $raport['mapel_name']; ?></td>
                <td><?= $raport['score']; ?></td>
                <td><?= $raport['status']; ?></td>
                <td><?= date('d/m/Y', $raport['time_taken']); ?></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>