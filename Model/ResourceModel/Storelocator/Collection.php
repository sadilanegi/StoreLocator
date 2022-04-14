<?php

namespace Iksula\Storelocator\Model\ResourceModel\Storelocator;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Iksula\Storelocator\Model\Storelocator', 'Iksula\Storelocator\Model\ResourceModel\Storelocator');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>