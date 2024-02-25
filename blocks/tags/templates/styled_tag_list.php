<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var \Macareux\AttributeValueUtilities\Service\SelectValueOptionService $optionService */
$optionService = app(\Macareux\AttributeValueUtilities\Service\SelectValueOptionService::class);
?>

<?php if (isset($options) && count($options) > 0) { ?>
    <div class="ccm-block-tags-wrapper">
        <?php if ($title) { ?>
            <div class="ccm-block-tags-header">
                <h5><?= $title ?></h5>
            </div>
        <?php } ?>

        <?php foreach ($options as $option) {
            /** @var \Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption $optionOption */
            $optionOption = $optionService->getSelectValueOptionOption($option);
            $style = $class = '';
            if ($optionOption) {
                $style = $optionOption->getStyle();
                $class = $optionOption->getCssClass();
            }
            ?>
            <?php if (isset($target) && $target) { ?>
                <a href="<?= $controller->getTagLink($option) ?>">
                    <?php if (isset($selectedTag) && mb_strtolower(h($option->getSelectAttributeOptionValue())) == mb_strtolower($selectedTag)) { ?>
                        <span class="ccm-block-tags-tag ccm-block-tags-tag-selected <?= h($class) ?>" style="<?= h($style) ?>"><?= $option->getSelectAttributeOptionDisplayValue() ?></span>
                    <?php } else { ?>
                        <span class="ccm-block-tags-tag <?= h($class) ?>" style="<?= h($style) ?>"><?= $option->getSelectAttributeOptionDisplayValue() ?></span>
                    <?php } ?>
                </a>
            <?php } else { ?>
                <?php if (isset($selectedTag) && mb_strtolower(h($option->getSelectAttributeOptionValue())) == mb_strtolower($selectedTag)) { ?>
                    <span class="ccm-block-tags-tag ccm-block-tags-tag-selected <?= h($class) ?>" style="<?= h($style) ?>"><?= $option->getSelectAttributeOptionDisplayValue() ?></span>
                <?php } else { ?>
                    <span class="ccm-block-tags-tag <?= h($class) ?>" style="<?= h($style) ?>"><?= $option->getSelectAttributeOptionDisplayValue() ?></span>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
