<?php
namespace Iksula\Storelocator\Block\Adminhtml\Storelocator;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Iksula\Storelocator\Model\storelocatorFactory
     */
    protected $_storelocatorFactory;

    /**
     * @var \Iksula\Storelocator\Model\Status
     */
    protected $_status;

    protected $_storeManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Iksula\Storelocator\Model\storelocatorFactory $storelocatorFactory
     * @param \Iksula\Storelocator\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Iksula\Storelocator\Model\StorelocatorFactory $StorelocatorFactory,
        \Iksula\Storelocator\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storelocatorFactory = $StorelocatorFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_storelocatorFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'name',
					[
						'header' => __('Name'),
						'index' => 'name',
					]
				);

                $this->addColumn(
                    'address',
                    [
                        'header' => __('Address'),
                        'index' => 'address',
                    ]
                );
				
				$this->addColumn(
					'area',
					[
						'header' => __('Area'),
						'index' => 'area',
					]
				);
				
				$this->addColumn(
					'city',
					[
						'header' => __('City'),
						'index' => 'city',
					]
				);
				
				$this->addColumn(
					'phone',
					[
						'header' => __('Phone Number'),
						'index' => 'phone',
					]
				);
				
				$this->addColumn(
					'email',
					[
						'header' => __('Email'),
						'index' => 'email',
					]
				);
				
						
						/*$this->addColumn(
							'store_id',
							[
								'header' => __('Store'),
								'index' => 'store_id',
								'type' => 'options',
								'options' => \Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid::getAvailableStores()
							]
						);*/
						
						
				$this->addColumn(
					'pincode',
					[
						'header' => __('Pin Code'),
						'index' => 'pincode',
					]
				);
				
				$this->addColumn(
					'lattitude',
					[
						'header' => __('Lattitude'),
						'index' => 'lattitude',
					]
				);
				
				$this->addColumn(
					'longitude',
					[
						'header' => __('Longitude'),
						'index' => 'longitude',
					]
				);
				
				$this->addColumn(
					'landmark',
					[
						'header' => __('Landmark'),
						'index' => 'landmark',
					]
				);
				
						
					/*	$this->addColumn(
							'status',
							[
								'header' => __('Status'),
								'index' => 'status',
								'type' => 'options',
								'options' => \Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid::getOptionArray11()
							]
						);*/
						
						


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('storelocator/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('storelocator/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Iksula_Storelocator::storelocator/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('storelocator');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('storelocator/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        // $this->getMassactionBlock()->addItem(
        //     'status',
        //     [
        //         'label' => __('Change status'),
        //         'url' => $this->getUrl('storelocator/*/massStatus', ['_current' => true]),
        //         'additional' => [
        //             'visibility' => [
        //                 'name' => 'status',
        //                 'type' => 'select',
        //                 'class' => 'required-entry',
        //                 'label' => __('Status'),
        //                 'values' => $statuses
        //             ]
        //         ]
        //     ]
        // );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('storelocator/*/index', ['_current' => true]);
    }

    /**
     * @param \Iksula\Storelocator\Model\storelocator|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'storelocator/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray6()
		{
            $data_array=array(); 
			$data_array[0]='Jack&Jones';
			$data_array[1]='Only';
			$data_array[2]='2XL';
			$data_array[3]='Veromoda';
            
            return($data_array);
		}
		static public function getValueArray6()
		{
            $data_array=array();
			foreach(\Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid::getAvailableStores() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		static public function getOptionArray11()
		{
            $data_array=array(); 
			$data_array[0]='Inactive';
			$data_array[1]='Active';
            return($data_array);
		}
		static public function getValueArray11()
		{
            $data_array=array();
			foreach(\Iksula\Storelocator\Block\Adminhtml\Storelocator\Grid::getOptionArray11() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}

        public function getAvailableStores()
        {
            $storeManagerDataList = $this->_storeManager->getStores();
            $options = array();
            foreach ($storeManagerDataList as $key => $value) {
                       $options[$key] = $value['name'];
            }
            //print("<pre>");print_r($options);print("</pre>");exit;
            return $options;
        }
		

}