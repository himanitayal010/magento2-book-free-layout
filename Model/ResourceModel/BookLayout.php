<?php

namespace Magneto\BookLayout\Model\ResourceModel;

class BookLayout extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('magneto_booklayout', 'booklayout_id');
    }
}