<?php
namespace Iksula\Storelocator\Model\ResourceModel;

class Storelocator extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('store_location', 'id');
    }
}
?>