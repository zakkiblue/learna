<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Pilih Chapter</h1>
    <a href="<?= base_url(); ?>admin/add_mapel" class="button">Tambah mapel</a>
    <a href="<?= base_url(); ?>admin/input_materi" class="button">Masukan materi</a>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Chapter Name</th>
        </tr>
        <?php $i = 1;
        foreach ($materi as $chapter) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <a class="badge success" href="<?= base_url('admin/naming_quiz'); ?>?chapter=<?= $chapter['id']; ?>"><?= $chapter['chapter_name']; ?></a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>