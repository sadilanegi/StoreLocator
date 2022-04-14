<?php
namespace Iksula\Storelocator\Block;
class Storelocator extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;
    protected $_storeFactory;
    protected $_scopeConfig;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Iksula\Storelocator\Model\StorelocatorFactory $db,
	    \Magento\Store\Model\StoreManagerInterface $storeManager,
	    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
	) {
		parent::__construct($context);
		$this->_storeFactory = $db;
	    $this->_storeManager = $storeManager;
	    $this->_scopeConfig = $scopeConfig;
	}
	
    public function getStoreArea(){
    	$storeId = $this->_storeManager->getStore()->getId();
        $store_area = $this->_storeFactory->create()->getCollection();
		$store_area->addFieldToSelect('city')
					//->addFieldToFilter('status', 1)
					//->addFieldToFilter('store_id', $storeId)
					->getSelect()
					->group('city');
		return $store_area->getData();
    }    

    public function getGoogleMapApiKey()
    {
    	return $this->_scopeConfig->getValue('storelocator/general/apikey', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);    	
    }

    public function getBannerImage()
    {
    	return $this->_scopeConfig->getValue('storelocator/banner_upload/storelocator_banner', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); 
    }

     public function getBannerTitle()
    {
    	return $this->_scopeConfig->getValue('storelocator/banner_upload/bannertitle', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); 

    }
     public function getBannerDescription()
    {
    	return $this->_scopeConfig->getValue('storelocator/banner_upload/bannerdesc', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); 
    	
    }
    public function getBannerTextColor()
    {
    	return $this->_scopeConfig->getValue('storelocator/banner_upload/bannertextcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); 
    	
    }
    public function getStoreLocatorText() {	
   		$storeId = $this->_storeManager->getStore()->getId();
	    return $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId('storelocator_text')->setStoreId($storeId)->toHtml();
	}

	public function getStoreCollectionCityWise($getCity){

		if($getCity!='') {
        	$store_area = $this->_storeFactory->create()->getCollection()->addFieldToFilter('city',array('eq' => $getCity))->getData();
    	} else {
    		$store_area = $this->_storeFactory->create()->getCollection()->getData();    		
    	}
    	$result = $this->group_by('city',$store_area);
		return $result;
	}

	public function group_by($key, $data) {
	    $result = array();

	    foreach($data as $val) {
	        if(array_key_exists($key, $val)){
	            $result[$val[$key]][] = $val;
	        }else{
	            $result[""][] = $val;
	        }
	    }

    	return $result;
	}

	public function imagePath(){
		return $store = $this->_storeManager->getStore()->getBaseUrl().'pub/media';
	}
}