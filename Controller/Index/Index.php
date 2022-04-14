<?php
namespace Iksula\Storelocator\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_storeFactory;
	protected $resultJsonFactory;
	protected $_storeManager;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Iksula\Storelocator\Model\StorelocatorFactory $db,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		$this->_pageFactory = $pageFactory;
		$this->_storeFactory = $db;
		$this->resultJsonFactory = $resultJsonFactory;
		$this->_storeManager = $storeManager;
		return parent::__construct($context);
	}

	public function execute()
	{
		$resultJson = $this->resultJsonFactory->create();
		$img_path = $store = $this->_storeManager->getStore()->getBaseUrl().'pub/media';
		if($this->getRequest()->isAjax()){
			$city = $this->getRequest()->getParam('city');
			$data = $this->_storeFactory->create()->getCollection();
			// echo $data->getSelect();exit;	
			$storeId = $this->_storeManager->getStore()->getId();
			$storeData = $data->addFieldToFilter('city', $city);
							//->addFieldToFilter('status', 1);
							//->addFieldToFilter('store_id', $storeId);
			//print_r($storeData->getData('city'));
			$addressHtml = '<div class="address__section"><div class="address__list">';
			foreach($storeData as $store){
				//echo "<pre>";print_r($store->getData());
				//echo $store['iframe360'];exit;
				//alert("welcome");
				//echo "<pre>";print_r($store->getData());exit;
			$storeIds = array(203,211,221,263,264,265,227);
		 	$getDirection = in_array($store->getId(), $storeIds)? '' : 'Get Directions';
			$addressHtml .= '
					<div class="map-data address__block" data-address="'.$store->getAddress().'" data-lattitude="'.$store->getLattitude().'" data-longitude="'.$store->getLongitude().'">
						<div class="store-container address__location">
							<div class="store_container_img address__pic">
                                <img class="address__img" src="'.$img_path.'/'.$store->getImage().'"/>';
                                
                                		$addressHtml .= "<div class='side_icons'>";
                                		if ($store->getData('view360') != "" && $store->getData('view360') != null){

							                $addressHtml .="<div class='click_here pos_360 text-center' data-address='".$store['iframe360']."'>
							                    <a id='360' class='btn'><i class='icon-360-degree'></i> Store View</a>
							                </div>";
                                		 
                                					                	
										}			                
							             
							            $addressHtml .="</div>";
                                
                                
                            $addressHtml .= '	</div>
							<div class="store_container_text address__content">
								
								<p>'.$store->getName().'</p>
								<div>'.$store->getAddress().'</div>
								<div>'.$store->getCity().' - '.$store->getPincode().'</div>';
								if($store->getPhone() != "" && $store->getPhone() != null){
									$addressHtml .= '<div>Phone : '.$store->getPhone().'</div>';
								}
				$addressHtml .= '<strong class="click1_here" data-address="'.$store->getAddress().'" data-lattitude="'.$store->getLattitude().'" data-longitude="'.$store->getLongitude().'">
									<a href="https://www.google.com/maps/search/'.$store->getAddress().'" target="_blank" class="link-btn" >'.$getDirection.'</a>
								</strong>
							</div>
                            <div class="address__map">							            
							            <div class="map" id="map">
                                         <div class="iframe__block iframe__block--full">
                                            <div class="iframe__screen">
                                                  <p> '.$store->getData('mapiframe') .' </p>                                 
                                            <div class="share_link">
                                            <a class="tw-share" href="http://www.twitter.com/share?url='.$store->getData('mapshareurl').'" title="Share on Twitter" target="_blank" >
																			<i class="icon-ICON_Twitter"></i>
																			
																		</a>
																		<a class="fb-share" href="https://www.facebook.com/sharer.php?u='.$store->getData('mapshareurl').'" title="Share on Facebook" target="_blank">
																			<i class="icon-ICON_facebook"></i>
																		</a>
																		<a class="email-share" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=youremail@gmail.com&body='.$store->getData('mapshareurl').'" title="Share on Email" target="_blank">
																			<i class="icon-new-email-envelope-back-symbol-in-circular-outlined-button"></i>
																		</a>	
                                            </div>
                                           </div>
                                         </div>
							            </div>
							        </div>
						</div>
					</div>';
			}
            $addressHtml .='</div></div>';

			return $resultJson->setData(['html'=>$addressHtml]);
		}else{
			return $this->_pageFactory->create();
		}
	}
}