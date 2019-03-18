<?php
namespace Magneto\BookLayout\Model;

use Magento\Framework\Model\AbstractModel;

class BookLayout extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Magneto\BookLayout\Model\ResourceModel\BookLayout');
    }
}