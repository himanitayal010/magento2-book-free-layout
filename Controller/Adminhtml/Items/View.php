<?php

namespace Magneto\BookLayout\Controller\Adminhtml\Items;

class View extends \Magneto\BookLayout\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $model = $this->_objectManager->create('Magneto\BookLayout\Model\BookLayout');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('magneto_booklayout/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_magneto_booklayout_items', $model->getData());
        $this->_initAction();
        $block = $this->_view->getLayout()->getBlock('items_items_view');

        $this->_view->renderLayout();
    }
}
