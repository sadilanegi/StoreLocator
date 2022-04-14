<?php

namespace Iksula\Storelocator\Controller\Adminhtml\Import;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Importcsv extends \Magento\Backend\App\Action
{
	protected $csv;
	protected $model;
	protected $_messageManager;
	protected $_storeManager;
	protected $resultRedirect;

    public function __construct(
    	Context $context,
    	PageFactory $resultPageFactory,
	    \Magento\Framework\File\Csv $csv,
	    \Magento\Framework\Message\ManagerInterface $messageManager,
	    \Magento\Store\Model\StoreManagerInterface $storeManager,
	    \Magento\Framework\Controller\ResultFactory $result,
	    \Iksula\Storelocator\Model\Storelocator $model
	){
		parent::__construct($context);
	    $this->csv = $csv;
	    $this->resultPageFactory = $resultPageFactory;
	    $this->_messageManager = $messageManager;
	    $this->_storeManager = $storeManager;
	    $this->resultRedirect = $result;
	    $this->model = $model;
	}

	public function execute()
	{
		//print_r($this->getRequest()->getPostValue());die;
		if($this->getRequest()->isAjax()){
			if($_FILES['csv']['tmp_name']){
				$csvData = $this->csv->getData($_FILES['csv']['tmp_name']);
				$error = false;
				foreach ($csvData as $row => $data) {
					if ($row > 0){
						if(!($data[1] && $data[2] && $data[4] && $data[8] && $data[9] && $data[10] && $data[12])){
							if(!$error){
								$error = true;
								$rowNumbers = $row;
							}else{
								$rowNumbers = $rowNumbers.', '.$row;
							}
						}
					}
				}
				if($error){
					echo json_encode(array('status'=>0, 'message'=>'Fill all the required fields of row number(s) '.$rowNumbers));
					exit;
				}else{
					echo json_encode(array('status'=>1, 'message'=>'File is proper to import'));
					exit;
				}
			}else{
				echo json_encode(array('status'=>0, 'message'=>'Please select a file to upload'));
				exit;
			}
		}else{
			if($this->getRequest()->getPostValue()){
				if (!isset($_FILES['csv']['tmp_name'])) {
					throw new \Magento\Framework\Exception\LocalizedException(__('Invalid file upload attempt.'));
				}

				$csvData = $this->csv->getData($_FILES['csv']['tmp_name']);
				$storeModel = $this->model;
				$storeId = $this->_storeManager->getStore()->getId();

				$error = false;
				$rowNumbers = '';
				foreach ($csvData as $row => $data) {
					if ($row > 0){
						if($data[1] && $data[2] && $data[4] && $data[8] && $data[9] && $data[10] && $data[12]){
							if($data[12] == 'Active'){
								$data[12] = 1;
							}else if($data[12] == 'Inactive'){
								$data[12] = 0;
							}
							if($data[0]){
								$storeModel->setId($data[0])
			                        ->setData('name', $data[1])
			                        ->setData('address', $data[2])
			                        ->setData('area', $data[3])
			                        ->setData('city', $data[4])
			                        ->setData('phone', $data[5])
			                        ->setData('email', $data[6])
			                        ->setData('pincode', $data[8])
			                        ->setData('lattitude', $data[9])
			                        ->setData('longitude', $data[10])
			                        ->setData('landmark', $data[11])
			                        ->setData('status', $data[12])
			                        ->save();						
							}else{
								$storeModel->setData('name', $data[1])
			                        ->setData('address', $data[2])
			                        ->setData('area', $data[3])
			                        ->setData('city', $data[4])
			                        ->setData('phone', $data[5])
			                        ->setData('email', $data[6])
			                        // ->setData('store_id', $storeId)
			                        ->setData('pincode', $data[8])
			                        ->setData('lattitude', $data[9])
			                        ->setData('longitude', $data[10])
			                        ->setData('landmark', $data[11])
			                        ->setData('status', $data[12])
			                        ->save();
							}
							
							$storeModel->unsetData();
						}else{
							if(!$error){
								$error = true;
								$rowNumbers = $row;
							}else{
								$rowNumbers = $rowNumbers.', '.$row;
							}
						}
					}
				}
				if(!$error){
					return $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT)->setPath('*/storelocator/index');
				}else{
					$resultPage = $this->resultPageFactory->create();
					$this->_messageManager->addError('Fill all the required fields of row number(s) '.$rowNumbers);
					return $resultPage;
				}
			}else{
				$resultPage = $this->resultPageFactory->create();
				return $resultPage;
			}
		}
	}
}

?>