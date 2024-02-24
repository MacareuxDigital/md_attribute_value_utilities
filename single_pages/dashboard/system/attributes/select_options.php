<?php

use Concrete\Core\Support\Facade\Url as UrlFacade;
use Macareux\AttributeValueUtilities\Service\SelectValueOptionService;

defined('C5_EXECUTE') or die('Access Denied.');

/** @var SelectValueOptionService $service */
$service = app(SelectValueOptionService::class);

/** @var \Macareux\AttributeValueUtilities\Search\SelectValueOption\Result\Result $result */
if (isset($result) && is_object($result)) {
    ?>
    <div class="ccm-dashboard-content-full">
        <div id="ccm-search-results-table" class="table-responsive">
            <table class="ccm-search-results-table">
                <thead>
                <tr>
                    <?php foreach ($result->getColumns() as $column) { ?>
                        <th class="<?= $column->getColumnStyleClass() ?>">
                            <?php if ($column->isColumnSortable()) { ?>
                                <a href="<?= h($column->getColumnSortURL()) ?>"><?= $column->getColumnTitle() ?></a>
                            <?php } else { ?>
                                <span><?= $column->getColumnTitle() ?></span>
                            <?php } ?>
                        </th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                /** @var \Macareux\AttributeValueUtilities\Search\SelectValueOption\Result\Item $item */
                foreach ($result->getItems() as $item) {
                    $option = $item->getSelectValueOption();
                    ?>
                    <tr data-details-url="<?= UrlFacade::to('/dashboard/system/attributes/select_options', 'edit', $option->getSelectAttributeOptionID()) ?>">
                        <?php foreach ($item->getColumns() as $column) { ?>
                            <td><?= $column->getColumnValue($item); ?></td>
                        <?php } ?>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="ccm-search-results-pagination">
        <?= $result->getPagination()->renderView('dashboard') ?>
    </div>
    <?php
}