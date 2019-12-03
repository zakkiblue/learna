<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Quiz</h1>
    <form action="<?= base_url('user_mipa/assessment') ?>" method="post">
        <input type="hidden" name="quiz" value="<?= $_GET['quiz']; ?>">
        <?php $i = 1;
        foreach ($questions as $question) : ?>
            <div style="margin-bottom: 20px; border-radius: 10px; background-color:lightblue; padding:10px;">
                <p><?= $i; ?>. <?= $question['question'] ?></p></br>
                <?php
                    if ($question['question_image'] != null) {
                        echo "<img src=" . base_url() . "assets/files/quiz/" . $question['question_image'] . ">";
                    }
                    ?>

                <?php foreach ($options[$question['id']] as $option) : ?>
                    <input type="radio" name="<?= $i; ?>" value="<?= $option['id']; ?>" id="option_<?= $option['id']; ?>">
                    <label for="option_<?= $option['id']; ?>"><?= $option['answer']; ?></label></br>
                <?php endforeach; ?>

            </div>
            <hr>
        <?php $i++;
        endforeach; ?>
        <input type="hidden" name="max" value="<?= $i - 1; ?>">
        <button type="submit" style="padding: 10px; background:#71C9CE; margin-top:40px;">Selesai</button>
    </form>
</div>