<header>
    <?= $this->partial('main/header') ?>
</header>
<div class="wrapper-in">

    <div id="main">

        <?= $this->getContent() ?>

        <?php if (isset($seo_text) && !isset($seo_text_inner)) { ?>
            <div class="seo-text">
                <?= $seo_text ?>
            </div>
        <?php } ?>

    </div>
</div>
<footer class="footer">
    <?= $this->partial('main/footer') ?>
</footer>

<!--<?php if ($this->registry->cms['PROFILER']) { ?>
    <?= $this->helper->dbProfiler() ?>
<?php } ?>-->

<?= $this->helper->javascript('body') ?>