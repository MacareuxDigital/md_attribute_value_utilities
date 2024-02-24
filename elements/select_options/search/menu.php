<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die("Access Denied.");

/** @var \Concrete\Core\Form\Service\Form $form */
$form = app('helper/form');
?>

<div class="ccm-header-search-form ccm-ui">
    <form class="form-inline" method="get" action="<?= UrlFacade::to('/dashboard/system/attributes/select_options') ?>">

        <div class="ccm-header-search-form-input">
            <?php
            // @todo Add Advanced and Reset Search buttons in v9
            ?>
            <?= $form->text('keywords', ['placeholder' => t('Search')]) ?>
        </div>

        <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
