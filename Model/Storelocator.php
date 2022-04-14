<?php
namespace Iksula\Storelocator\Model;

class Storelocator extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Iksula\Storelocator\Model\ResourceModel\Storelocator');
    }
}
?>