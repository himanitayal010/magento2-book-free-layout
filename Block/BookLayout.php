<?php

namespace Magneto\BookLayout\Block;

/**
 * BookLayout content block
 */
class BookLayout extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Book a Free 3D Layout'));
        
        return parent::_prepareLayout();
    }
}
