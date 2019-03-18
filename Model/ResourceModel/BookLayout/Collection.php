<?php
namespace Magneto\BookLayout\Model\ResourceModel\BookLayout;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'booklayout_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Magneto\BookLayout\Model\BookLayout',
            'Magneto\BookLayout\Model\ResourceModel\BookLayout'
        );
    }
}