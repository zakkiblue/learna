<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Answer </h1>

    <table class="table">
        <tr>
            <th class="numb">#</th>
            <th>Answer</th>
        </tr>
        <?php $i = 1;
        foreach ($answers as $answer) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><a href="#" class="badge <?php if ($answer['is_correct'] == 'yes') {
                                                        echo "success";
                                                    } ?>"><?= $answer['answer'] ?></a></td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </table>
</div>