<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Form\Service\Form $form */
$form = app('helper/form');
?>

<div class="ccm-header-search-form ccm-ui" data-header="select-options-manager">
    <form class="row row-cols-auto g-0 align-items-center" method="get" action="<?= UrlFacade::to('/dashboard/system/attributes/select_options') ?>">

        <div class="ccm-header-search-form-input input-group">
            <?php
            // @todo Add Advanced and Reset Search buttons in v9
            ?>
            <?= $form->search('keywords', [
                'placeholder' => t('Search'),
                'class' => 'form-control border-end-0',
                'autocomplete' => 'off',
            ]);
            ?>

            <button type="submit" class="input-group-icon">
                <svg width="16" height="16">
                    <use xlink:href="#icon-search"/>
                </svg>
            </button>
        </div>
    </form>
</div>
