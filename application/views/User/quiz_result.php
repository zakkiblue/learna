<div class="main-content">
    <?= $this->session->flashdata('massage'); ?>
    <h1><?= $user['name']; ?></h1>
    <div>
        <p><?= $result['score']; ?></p></br>
        <p><?= $result['status']; ?></p>
    </div>
</div>