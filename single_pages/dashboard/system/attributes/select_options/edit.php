<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');
/** @var \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption|null $option */
$option = $option ?? null;
/** @var \Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption|null $optionOption */
$optionOption = $optionOption ?? null;
$textColor = $textColor ?? '';
$backgroundColor = $backgroundColor ?? '';
$cssClass = $cssClass ?? '';
/** @var \Concrete\Core\View\View $view */
/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\Form\Service\Form $form */
/** @var \Concrete\Core\Form\Service\Widget\Color $colorPicker */
?>
<form action="<?= $view->action('submit') ?>" method="post">
    <?= $token->output('submit_option_option') ?>
    <input type="hidden" name="id" value="<?= $option->getSelectAttributeOptionID() ?>">
    <div class="form-group">
        <?= $form->label('textColor', t('Text Color')) ?>
        <div>
            <?php $colorPicker->output('textColor', $textColor) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label('backgroundColor', t('Background Color')) ?>
        <div>
            <?php $colorPicker->output('backgroundColor', $backgroundColor) ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->label('cssClass', t('CSS Class')) ?>
        <div>
            <?= $form->text('cssClass', $cssClass) ?>
        </div>
    </div>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?= UrlFacade::to('/dashboard/system/attributes/select_options') ?>"
               class="btn btn-secondary float-start btn-default"><?= t('Cancel') ?></a>
            <button class="btn btn-primary float-end pull-right"><?= t('Save') ?></button>
        </div>
    </div>
</form>