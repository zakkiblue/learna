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
                <td><a class="badge success" href="<?= base_url(); ?>user_mipa/quiz_start?quiz=<?= $kuis['id']; ?>">Mulai</a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>