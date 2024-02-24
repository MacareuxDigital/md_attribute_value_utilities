<?php

namespace Concrete\Package\MdAttributeValueUtilities\Controller\SinglePage\Dashboard\System\Attributes;

use Concrete\Core\Filesystem\Element;
use Concrete\Core\Filesystem\ElementManager;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Package\MdAttributeValueUtilities\Controller\Search\SelectOptions as SelectOptionsSearchController;
use Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption;
use Macareux\AttributeValueUtilities\Service\SelectValueOptionService;

class SelectOptions extends DashboardPageController
{
    /**
     * @var Element
     */
    protected $searchMenu;
    /**
     * @var Element
     */
    protected $headerMenu;

    protected function getSearchMenu()
    {
        if (!isset($this->searchMenu)) {
            $this->searchMenu = $this->app->make(ElementManager::class)
                ->get('select_options/search/menu', 'md_attribute_value_utilities');
        }

        return $this->searchMenu;
    }

    protected function getHeaderMenu()
    {
        if (!isset($this->headerMenu)) {
            $this->headerMenu = $this->app->make(ElementManager::class)
                ->get('select_options/header/menu', 'md_attribute_value_utilities');
        }

        return $this->headerMenu;
    }

    public function view()
    {
        $this->set('headerMenu', $this->getSearchMenu()->getElementController());

        /** @var SelectOptionsSearchController $search */
        $search = $this->app->make(SelectOptionsSearchController::class);
        $result = $search->getCurrentSearchObject();

        if (is_object($result)) {
            $this->set('result', $result);
        }
    }

    public function edit($id)
    {
        /** @var SelectValueOptionService $service */
        $service = $this->app->make(SelectValueOptionService::class);
        $option = $service->getSelectValueOptionByID($id);
        if ($option) {
            $this->set('option', $option);
            $optionOption = $service->getSelectValueOptionOption($option);
            $this->set('optionOption', $optionOption);
            $this->set('textColor', $optionOption ? $optionOption->getTextColor() : '');
            $this->set('backgroundColor', $optionOption ? $optionOption->getBackgroundColor() : '');
            $this->set('cssClass', $optionOption ? $optionOption->getCssClass() : '');
            $this->set('colorPicker', $this->app->make('helper/form/color'));

            $this->set('pageTitle', t('Edit Option for "%s"', $option->getSelectAttributeOptionDisplayValue()));
            $headerMenu = $this->getHeaderMenu()->getElementController();
            $headerMenu->set('selectValueOption', $option);
            $this->set('headerMenu', $headerMenu);
            $this->render('/dashboard/system/attributes/select_options/edit');
        } else {
            $this->view();
        }
    }

    public function submit()
    {
        /** @var SelectValueOptionService $service */
        $service = $this->app->make(SelectValueOptionService::class);

        $option = null;
        $id = $this->request->request->get('id');
        if ($id) {
            $option = $service->getSelectValueOptionByID($id);
            if (!$option) {
                $this->error->add(t('Invalid Option.'));
            }
        } else {
            $this->error->add(t('Invalid Option.'));
        }

        if (!$this->token->validate('submit_option_option')) {
            $this->error->add($this->token->getErrorMessage());
        }

        if (!$this->error->has()) {
            $optionOption = $service->getSelectValueOptionOption($option);
            if (!$optionOption) {
                $optionOption = new SelectValueOptionOption($option);
            }
            $optionOption
                ->setBackgroundColor($this->request->request->get('backgroundColor'))
                ->setTextColor($this->request->request->get('textColor'))
                ->setCssClass($this->request->request->get('cssClass'));

            $this->entityManager->persist($optionOption);
            $this->entityManager->flush();

            $this->flash('success', t('Option updated successfully.'));

            return $this->buildRedirect('/dashboard/system/attributes/select_options');
        }

        $this->edit($id);
    }

    public function delete()
    {
        /** @var SelectValueOptionService $service */
        $service = $this->app->make(SelectValueOptionService::class);
        $id = $this->request->query->get('id');
        if ($id) {
            $option = $service->getSelectValueOptionByID($id);
            if ($option) {
                $optionOption = $service->getSelectValueOptionOption($option);
                if ($optionOption) {
                    $this->entityManager->remove($optionOption);
                    $this->entityManager->flush();
                }
                $this->flash('success', t('Option deleted successfully.'));
            } else {
                $this->flash('error', t('Invalid Option.'));
            }
        } else {
            $this->flash('error', t('Invalid Option.'));
        }

        return $this->buildRedirect('/dashboard/system/attributes/select_options');
    }
}
