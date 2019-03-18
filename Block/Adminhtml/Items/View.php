<?php

namespace Magneto\BookLayout\Block\Adminhtml\Items;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry = null;
    protected $_productRepository;
    protected $backendHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $_coreRegistry,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Backend\Helper\Data $backendHelper
    ) {
        $this->_productRepository = $productRepository;
        $this->_coreRegistry = $_coreRegistry;
        $this->backendHelper = $backendHelper;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {   
        $this->pageConfig->getTitle()->set(__('Book a Free 3D Layout'));
        return parent::_prepareLayout();
    }

    public function getModelData()
    {
        return $this->_coreRegistry->registry('current_magneto_booklayout_items');
    }

    public function getProduct($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function getProductUrl($id)
    {
        return $this->backendHelper->getUrl('catalog/product/edit',['id' => $id]);
    }
}