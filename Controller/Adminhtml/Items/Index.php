<?php

namespace Magneto\BookLayout\Controller\Adminhtml\Items;

class Index extends \Magneto\BookLayout\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magneto_BookLayout::test');
        $resultPage->getConfig()->getTitle()->prepend(__('Free 3D Layout requests'));
        $resultPage->addBreadcrumb(__('Magneto'), __('Magneto'));
        $resultPage->addBreadcrumb(__('BookLayout'), __('BookLayout'));
        return $resultPage;
    }
}