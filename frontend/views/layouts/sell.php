<?php
    $this->beginContent('@app/views/layouts/bootstrap.php');
    $this->title = 'Search';
?>
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="/">Home</a> / <?=$this->title ?></span>
        <h2><?=$this->title ?></h2>
    </div>
</div>
    <div class="container">
        <?=$content ?>
    </div>
<?php $this->endContent(); ?>

