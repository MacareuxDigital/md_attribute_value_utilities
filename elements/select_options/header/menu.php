<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption|null $selectValueOption */
$selectValueOption = $selectValueOption ?? null;
?>
<form action="<?= UrlFacade::to('/dashboard/system/attributes/select_options/delete') ?>" method="get">
    <?php $token->output('delete_select_option_option') ?>
    <?php if ($selectValueOption) { ?>
        <input type="hidden" name="id" value="<?= $selectValueOption->getSelectAttributeOptionID() ?>"/>
    <?php } ?>
    <button class="btn btn-danger" type="submit"><?= t('Clear') ?></button>
</form>

