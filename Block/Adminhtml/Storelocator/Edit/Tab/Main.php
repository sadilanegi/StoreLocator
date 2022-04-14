<?php

namespace Iksula\Storelocator\Block\Adminhtml\Storelocator\Edit\Tab;

/**
 * Storelocator edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Iksula\Storelocator\Model\Status
     */
    protected $_status;

    protected $_grid;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Iksula\Storelocator\Model\Status $status,
        \Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid $grid,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->_grid = $grid;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Iksula\Storelocator\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('storelocator');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

		
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'address',
            'textarea',
            [
                'name' => 'address',
                'label' => __('Address'),
                'title' => __('Address'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'area',
            'text',
            [
                'name' => 'area',
                'label' => __('Area'),
                'title' => __('Area'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'city',
            'text',
            [
                'name' => 'city',
                'label' => __('City'),
                'title' => __('City'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'phone',
            'text',
            [
                'name' => 'phone',
                'label' => __('Phone Number'),
                'title' => __('Phone Number'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
				
                'disabled' => $isElementDisabled
            ]
        );
									
						
        /*$fieldset->addField(
            'store_id',
            'select',
            [
                'label' => __('Store'),
                'title' => __('Store'),
                'name' => 'store_id',
				'required' => true,
                'options' => $this->_grid->getAvailableStores(),
                'disabled' => $isElementDisabled
            ]
        );*/
						
						
        $fieldset->addField(
            'pincode',
            'text',
            [
                'name' => 'pincode',
                'label' => __('Pin Code'),
                'title' => __('Pin Code'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'lattitude',
            'text',
            [
                'name' => 'lattitude',
                'label' => __('Lattitude'),
                'title' => __('Lattitude'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'longitude',
            'text',
            [
                'name' => 'longitude',
                'label' => __('Longitude'),
                'title' => __('Longitude'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

         $fieldset->addField(
            'view360',
            'textarea',
            [
                'name' => 'view360',
                'label' => __('view 360 link'),
                'title' => __('view 360 link'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'landmark',
            'text',
            [
                'name' => 'landmark',
                'label' => __('Landmark'),
                'title' => __('Landmark'),
				
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'storeopentime',
            'text',
            [
                'name' => 'storeopentime',
                'label' => __('Store Open Time'),
                'title' => __('Store Open Time'),
                'disabled' => $isElementDisabled,
                'after_element_html' => '<small>Eg: 10 am,1 pm</small>'
            ]
        );

        $fieldset->addField(
            'storeclosetime',
            'text',
            [
                'name' => 'storeclosetime',
                'label' => __('Store Close Time'),
                'title' => __('Store Close Time'),
                'disabled' => $isElementDisabled,
                'after_element_html' => '<small>Eg: 10 am,1 pm</small>'
            ]
        );
        $fieldset->addField(
            'iframe360',
            'textarea',
            [
                'name' => 'iframe360',
                'label' => __('iframe360 link'),
                'title' => __('iframe360 link'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'mapiframe',
            'textarea',
            [
                'name' => 'mapiframe',
                'label' => __('mapiframe link'),
                'title' => __('mapiframe link'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'mapshareurl',
            'textarea',
            [
                'name' => 'mapshareurl',
                'label' => __('mapshareurl link'),
                'title' => __('mapshareurl link'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
									
						
        /*$fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
				'required' => true,
                'options' => \Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid::getOptionArray11(),
                'disabled' => $isElementDisabled
            ]
        );*/
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
