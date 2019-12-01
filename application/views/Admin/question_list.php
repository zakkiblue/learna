<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Quiz </h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Question</th>
            <th>Action</th>
        </tr>
        <?php $i = 1;
        foreach ($questions as $question) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><a class="badge" href="<?= base_url('admin/answer_list') ?>?question=<?= $question['id']; ?>"><?= $question['question']; ?></a></td>
                <td><a class="badge failed" href="<?= base_url('admin/delete_question') ?>?quiz=<?= $_GET['quiz']; ?>&question=<?= $question['id']; ?>" onclick="return confirm('Anda Yakin ? menghapus pertanyaan juga berarti menghapus semua pilihan jawaban yang terkait');">Hapus</a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>