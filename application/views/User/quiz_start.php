<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1>Quiz</h1>
    <form action="<?= base_url('user_mipa/assessment')?>" method="post">
    <input type="hidden" name="quiz" value="<?= $_GET['quiz'];?>">
    <?php $i = 1; foreach ($questions as $question) : ?>
        <div>
             <p><?= $i; ?>. <?= $question['question']?></p></br>
            
            <?php foreach ($options[$question['id']] as $option) : ?>
                <input type="radio" name="<?= $i; ?>" value="<?= $option['id'];?>" id="option_<?= $option['id'];?>">
                <label for="option_<?= $option['id'];?>"><?= $option['answer'];?></label></br>
            <?php  endforeach; ?>
            
        </div>
        <hr>
    <?php $i++; endforeach; ?>
    <input type="hidden" name="max" value="<?= $i-1; ?>">
    <button type="submit">Selesai</button>
    </form>
</div>