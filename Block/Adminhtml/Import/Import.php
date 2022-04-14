<?php

namespace Iksula\Storelocator\Block\Adminhtml\Import;

class Import extends \Magento\Backend\Block\Widget\Container
{
    public function __construct(\Magento\Backend\Block\Widget\Context $context,array $data = [])
    {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        $this->buttonList->add('back', array(
            'label'   => __('Back'),
            'onclick' => "setLocation('{$this->getUrl('*/storelocator/index')}')",
            'class'   => 'back'
        ));

        return parent::_prepareLayout();
    }

}
