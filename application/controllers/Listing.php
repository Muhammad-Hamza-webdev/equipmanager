<?php

use Phpass\Loader;

defined('BASEPATH') or exit('No direct script access allowed');

class listing extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Generic_model', 'generic');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function addListing()
	{

		if (isset($_GET['listingID'])) {
			$this->data['listing'] = $this->generic->GetData('shopitem', array('itemID' => $_GET['listingID']));
			if (isset($_GET['edit'])) {
				if ($this->data['listing'][0]['itemType'] == 1) {
					$this->data['listingOptions'] = $this->generic->GetData('shopequipments', array('itemID' => $_GET['listingID']));
				} else {
					$this->data['listingOptions'] = $this->generic->GetData('shopworkforce', array('itemID' => $_GET['listingID']));
				}
			}
			$this->load->view('listingMarketplace/addlistingstep3', $this->data);
		} else if (isset($_GET['skill'])) {
			if ($_GET['skill'] == 1) {
				//get equipment
				$this->data['eqp'] = $this->generic->GetData('equipment', array('companyID' => $this->session->userdata('companyDetails')['companyID']));
				$this->data['webcat'] = $this->generic->GetWebCategoryData(array('p.pageStatus' => 1, 'wc.web_cat_type' => 1));
				//if edit mode is enabled
				if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
					$this->data['shopItem'] = $this->generic->GetMarketPlaceListingData(array('si.itemID' => $_GET['itemID']));
					//get equipment availablity 
					$this->data['eqpAvailablity'] = $this->generic->GetAllAssignedEquipment(array('pel.equipmentID' => $this->data['shopItem'][0]['equipmentID'], 'p.itemID!=' => $this->data['shopItem'][0]['itemID']));
				}
				$this->load->view('listingMarketplace/addlistingstep2', $this->data);
			} else {
				//get workforce 
				$this->data['employe'] = $this->generic->GetData('workforce', array('companyID' => $this->session->userdata('companyDetails')['companyID']));
				$this->data['webcat'] = $this->generic->GetWebCategoryData(array('p.pageStatus' => 1, 'wc.web_cat_type' => 2));
				//if editing mode is enabled
				if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
					$this->data['shopItem'] = $this->generic->GetMarketPlaceListingData(array('si.itemID' => $_GET['itemID']));
					//get work force availablity 
					$this->data['workforceAvailability'] = $this->generic->GetWorkforceofPRoject(array('pwl.workforceID' => $this->data['shopItem'][0]['workforceID'], 'p.itemID!=' => $this->data['shopItem'][0]['itemID']));
				}
				$this->load->view('listingMarketplace/addlistingstep2', $this->data);
			}
		} else {
			if (isset($_GET['itemID'])) {
				$this->data['itemData'] = $this->generic->GetData('shopitem', array('itemID' => $_GET['itemID']));
				$this->load->view('listingMarketplace/addlistingstep1', $this->data);
			} else {
				$this->load->view('listingMarketplace/addlistingstep1');
			}
		}
	}
	public function addEquipmentListingData()
	{
		$shopItem = array(
			'userID' => $this->session->userdata('loginData')['userID'],
			'companyID' => $this->session->userdata('companyDetails')['companyID'],
			'itemType' => 1,
			'saleType' => $_GET['rentalType'],
			'itemStatus' => 0
		);
		if ($this->input->post('itemID') == '') {
			$this->generic->InsertData('shopitem', $shopItem);
			$itemID = $this->generic->GetMaxID('shopitem', 'itemID');
		} else {
			$this->generic->Update('shopitem', array('itemID' => $this->input->post('itemID')), $shopItem);
			$itemID[0]['result'] = $this->input->post('itemID');
		}

		//add equipment details
		$equipmentData = array(
			'itemID' => $itemID[0]['result'],
			'equipmentID' => $this->input->post('eqpID'),
			'web_catID' => $this->input->post('eqpCat'),
			'equipQty' => $this->input->post('eqpQty'),
			'eqpBrandModel' => $this->input->post('eqpBrand'),
			'eqpSpecs' => $this->input->post('eqpSpec'),
			'eqpCondition' => $this->input->post('eqpCond'),
			'eqpLocCity' => $this->input->post('cityInput'),
			'eqpAdd' => $this->input->post('eqpadd'),
			'eqpPrice' => $this->input->post('price'),
			'eqpAvailableStart' => $this->input->post('avlStart'),
			'eqpAvailableEnd' => $this->input->post('avlEnd')
		);
		if ($_GET['rentalType'] == 0) {
			$equipmentData['eqpRentalType'] = $this->input->post('priceType');
		}

		// Upload up to 10 images
		$uploadDir = './assets/website/images/';

		// Create directory if it doesn't exist
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		// Check if files were uploaded. Normalize single-file upload to array structure.
		if (isset($_FILES['eqpImgs'])) {
			// If name is not an array (browser sent single file without []), normalize it
			if (!is_array($_FILES['eqpImgs']['name'])) {
				$fileArr = array(
					'name' => array($_FILES['eqpImgs']['name']),
					'type' => array($_FILES['eqpImgs']['type']),
					'tmp_name' => array($_FILES['eqpImgs']['tmp_name']),
					'error' => array($_FILES['eqpImgs']['error']),
					'size' => array($_FILES['eqpImgs']['size'])
				);
			} else {
				$fileArr = $_FILES['eqpImgs'];
			}

			if (!empty($fileArr['name'][0])) {
				$fileCount = count($fileArr['name']);
				$maxImages = min($fileCount, 10); // Limit to 10 images

				for ($i = 0; $i < $maxImages; $i++) {
					if (isset($fileArr['error'][$i]) && $fileArr['error'][$i] === UPLOAD_ERR_OK) {
						$tmpName = $fileArr['tmp_name'][$i];
						$fileName = $fileArr['name'][$i];

						// Generate unique filename
						$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
						$uniqueFileName = $itemID[0]['result'] . '_' . ($i + 1) . '_' . time() . '.' . $fileExt;
						$uploadPath = $uploadDir . $uniqueFileName;

						// Move file to upload directory
						if (move_uploaded_file($tmpName, $uploadPath)) {
							// Add image path to equipment data array
							$columnName = 'eqpimg' . ($i + 1);
							$equipmentData[$columnName] = $uniqueFileName;
						}
					}
				}
			}
		}

		// Insert equipment data into database or update accordingly 
		if ($this->input->post('itemID') != '') {
			$this->generic->Update('shopequipments', array('itemID' => $this->input->post('itemID')), $equipmentData);
			//update project dates
			$newdates = array(
				'pStartDate' => $this->input->post('avlStart'),
				'pEndDate' => $this->input->post('avlEnd')
			);
			$this->generic->Update('projects', array('itemID' => $itemID[0]['result']), $newdates);

			$this->session->set_flashdata('updated', 'Please fill all fields!');
			redirect(base_url('add-listing?listingID=' . $this->input->post('itemID') . '&edit=1'));
		} else {
			$this->generic->InsertData('shopequipments', $equipmentData);
			$itemID = $this->generic->GetMaxID('shopitem', 'itemID');
			$this->session->set_flashdata('drafted', 'Please fill all fields!');
			redirect(base_url('add-listing?listingID=' . $itemID[0]['result']));
		}
	}



	public function fetchEquipmentAvailablity()
	{
		$equipmentProjects = $this->generic->GetAllAssignedEquipment(array('pel.equipmentID' => $this->input->post('eqpID')));
		$out = array();
		if ($equipmentProjects) {
			foreach ($equipmentProjects as $p) {
				$start = isset($p['pStartDate']) ? date('Y-m-d', strtotime($p['pStartDate'])) : null;
				$end = isset($p['pEndDate']) ? date('Y-m-d', strtotime($p['pEndDate'])) : null;
				if ($start && $end) {
					$out[] = array('start' => $start, 'end' => $end);
				}
			}
		}

		//get equpiment available quantity
		$eqpData = $this->generic->GetData('equipment', array('equipmentID' => $this->input->post('eqpID')));
		$availableQuantity = $eqpData[0]['equipTotalQuantity'] - $eqpData[0]['equipInUseQuantity'];
		header('Content-Type: application/json');
		echo json_encode(array('ranges' => $out, 'availableQty' => $availableQuantity));
	}
	public function fetchWorkforceAvailablity()
	{
		$workforceProjects = $this->generic->GetWorkforceofPRoject(array('pwl.workforceID' => $this->input->post('workforceID')));
		$out = array();
		if ($workforceProjects) {
			foreach ($workforceProjects as $p) {
				$start = isset($p['pStartDate']) ? date('Y-m-d', strtotime($p['pStartDate'])) : null;
				$end = isset($p['pEndDate']) ? date('Y-m-d', strtotime($p['pEndDate'])) : null;
				if ($start && $end) {
					$out[] = array('start' => $start, 'end' => $end);
				}
			}
		}

		header('Content-Type: application/json');
		echo json_encode(array('ranges' => $out, 'availableQty' => (empty($out) ? 1 : 0)));
	}

	public function addWorkforceListingData()
	{
		$shopItem = array(
			'userID' => $this->session->userdata('loginData')['userID'],
			'companyID' => $this->session->userdata('companyDetails')['companyID'],
			'itemType' => 2,
			'saleType' => $_GET['rentalType'],
			'itemStatus' => 0
		);
		if ($this->input->post('itemID') == '') {
			$this->generic->InsertData('shopitem', $shopItem);
			$itemID = $this->generic->GetMaxID('shopitem', 'itemID');
		} else {
			$this->generic->Update('shopitem', array('itemID' => $this->input->post('itemID')), $shopItem);
			$itemID[0]['result'] = $this->input->post('itemID');
		}

		$workforceData = array(
			'itemID' => $itemID[0]['result'],
			'workforceID' => $this->input->post('workforce'),
			'web_catID' => $this->input->post('eqpCat'),
			'workforceCity' => $this->input->post('cityInput'),
			'WorkforceAdd' => $this->input->post('eqpadd'),
			'workforceRentalType' => $this->input->post('priceType'),
			'workforcePrice' => $this->input->post('workforcePrice'),
			'workforceAvailableStart' => $this->input->post('avlEmpStart'),
			'workforceAvailableEnd' => $this->input->post('avlEmpEnd')
		);

		// upload cv and certificate
		$uploadDir = './assets/website/documents/';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		// Helper to handle single file upload
		$handleSingle = function ($fieldName, $prefix) use ($uploadDir, $itemID) {
			if (isset($_FILES[$fieldName]) && isset($_FILES[$fieldName]['tmp_name']) && is_uploaded_file($_FILES[$fieldName]['tmp_name'])) {
				$origName = $_FILES[$fieldName]['name'];
				$ext = pathinfo($origName, PATHINFO_EXTENSION);
				$unique = $itemID[0]['result'] . '_' . $prefix . '_' . time() . '.' . $ext;
				$dest = $uploadDir . $unique;
				if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $dest)) {
					return $unique;
				}
			}
			return null;
		};

		// Check if files are posted before processing
		$cvFile = null;
		$certFile = null;

		if (isset($_FILES['cv'])) {
			$cvFile = $handleSingle('cv', 'cv');
		}
		if (isset($_FILES['certificate'])) {
			$certFile = $handleSingle('certificate', 'cert');
		}
		if ($cvFile) {
			$workforceData['workforceCV'] = $cvFile;
		}
		if ($certFile) {
			$workforceData['workforceCertif'] = $certFile;
		}

		// insert or update  workforce listing row
		if ($this->input->post('itemID') != '') {
			$this->generic->Update('shopworkforce', array('itemID' => $this->input->post('itemID')), $workforceData);
			//update project
			$newdates = array(
				'pStartDate' => $this->input->post('avlEmpStart'),
				'pEndDate' => $this->input->post('avlEmpEnd')
			);
			$this->generic->Update('projects', array('itemID' => $itemID[0]['result']), $newdates);

			$this->session->set_flashdata('updated', 'Please fill all fields!');
			redirect(base_url('add-listing?listingID=' . $this->input->post('itemID') . '&edit=1'));
		} else {
			$this->generic->InsertData('shopworkforce', $workforceData);
			$itemID = $this->generic->GetMaxID('shopitem', 'itemID');
			$this->session->set_flashdata('drafted', 'Please fill all fields!');
			redirect(base_url('add-listing?listingID=' . $itemID[0]['result']));
		}
	}

	public function step3Data()
	{

		$listing = $this->generic->GetData('shopitem', array('itemID' => $_GET['listingID']));
		if ($listing[0]['itemType'] == 1) {
			$deliveryData = array(
				'eqpDeliveryOpt' => $this->input->post('devliveryOpt'),
				'eqpRules' => $this->input->post('rules'),
			);
		}else{
			$deliveryData = array(
			'workforceDeliveryOpt' => $this->input->post('devliveryOpt'),
			'workforceRules' => $this->input->post('rules'),
		);
		}
		if ($listing[0]['saleType'] == 0) { //rental equipment
			if($listing[0]['itemType'] == 1){
			$deliveryData['noteForRenter'] = $this->input->post('rentalNotes');
			$deliveryData['addRequirments'] = $this->input->post('rentalReq');
			}else{
				$deliveryData['workforcenoteForRenter'] = $this->input->post('rentalNotes');
			$deliveryData['workforceaddRequirments'] = $this->input->post('rentalReq');
			}
			//add equipment to projects for em tracking 
			//--get added equipment details
			if ($this->input->post('edit') == '') {
				if ($listing[0]['itemType'] == 1) {
					$addedequipment = $this->generic->GetData('shopequipments', array('itemID' => $_GET['listingID']));
					$projectdata = array(
						'companyID' => $this->session->userdata('companyDetails')['companyID'],
						'pCatID' => 0,
						'itemID' => $listing[0]['itemID'],
						'pName' => 'Website Marketplace Listing',
						'pLocation' => $addedequipment[0]['eqpAdd'],
						'pStartDate' => $addedequipment[0]['eqpAvailableStart'],
						'pEndDate' => $addedequipment[0]['eqpAvailableEnd'],
						'pDesc' => 'Equipment Listing on website Marketplace',
						'pStatus' => 2,
					);
					$this->generic->InsertData('projects', $projectdata);
				} else {
					$addedWorkforce = $this->generic->GetData('shopworkforce', array('itemID' => $_GET['listingID']));
					$projectdata = array(
						'companyID' => $this->session->userdata('companyDetails')['companyID'],
						'pCatID' => 0,
						'itemID' => $listing[0]['itemID'],
						'pName' => 'Website Marketplace Listing',
						'pLocation' => $addedWorkforce[0]['WorkforceAdd'],
						'pStartDate' => $addedWorkforce[0]['workforceAvailableStart'],
						'pEndDate' => $addedWorkforce[0]['workforceAvailableEnd'],
						'pDesc' => 'Workforce Listing on website Marketplace',
						'pStatus' => 2,
					);
					$this->generic->InsertData('projects', $projectdata);
				}
				$projectMaxID = $this->generic->GetMaxID('projects', 'ProjectID');
				//add project equipment link 
				if ($listing[0]['itemType'] == 1) {
					$projectEqpLinkData = array(
						'equipmentID' => $addedequipment[0]['equipmentID'],
						'ProjectID' => $projectMaxID[0]['result'],
						'equipmentQTY' => $addedequipment[0]['equipQty'],
					);
					$this->generic->InsertData('projectequipmentlink', $projectEqpLinkData);
					//update quantity in use in equipment table 
					//--get equipment detail 
					$equipment = $this->generic->GetData('equipment', array('equipmentID' => $addedequipment[0]['equipmentID']));
					$updateInUseQuantity = $equipment[0]['equipInUseQuantity'] + $addedequipment[0]['equipQty'];
					$this->generic->Update('equipment', array('equipmentID' => $addedequipment[0]['equipmentID']), array('equipInUseQuantity' => $updateInUseQuantity));
					//update the equipment list in the equipment shop link 
					$this->generic->Update('shopequipments', array('itemID' => $_GET['listingID']), $deliveryData);
				} else {
					//workforce projectlisting
					//-- get shopworkforce detail for workforceid

					$workforceProjectLink = array(
						'ProjectID' => $projectMaxID[0]['result'],
						'workforceID' => $addedWorkforce[0]['workforceID'],
					);
					$this->generic->InsertData('projectworkforcelink', $workforceProjectLink);
					//update the workforce list in the equipment shop link 
					$this->generic->Update('shopworkforce', array('itemID' => $_GET['listingID']), $deliveryData);
				}
			}
		}

		//update shop list for approval 
		$this->generic->Update('shopitem', array('itemID' => $_GET['listingID']), array('itemStatus' => 2));
		$this->session->set_flashdata('listingAddedForApproval', 'Please fill all fields!');
		redirect(base_url('add-listing'));
	}


	//all listing module
	//== company admin side
	public function allListing()
	{
		$where = array(
			'si.companyID' => $this->session->userdata('companyDetails')['companyID'],
		);
		if (isset($_GET['ItemType']) && $_GET['ItemType'] != '') {
			$where['si.itemType'] = $_GET['ItemType'];
		}
		if (isset($_GET['listingType']) && $_GET['listingType'] != '') {
			$where['si.saleType'] = $_GET['ItemType'];
		}
		if (isset($_GET['listingStatus']) && $_GET['listingStatus'] != '') {
			$where['si.itemStatus'] = $_GET['listingStatus'];
		}
		$this->data['listing'] = $this->generic->GetMarketPlaceListingData($where);
		$this->load->view('listingMarketplace/all-listing', $this->data);
	}
	public function dltListing()
	{
		//update equipment quantity
		$itemListing=$this->generic->GetData('shopitem', array('itemID' => $_GET['itemID']));
		if($itemListing[0]['itemType']==1){
			$eqpListing=$this->generic->GetData('shopequipments', array('itemID' => $_GET['itemID']));
			//get equipment
			$equipment=$this->generic->GetData('equipment',array('equipmentID'=>$eqpListing[0]['equipmentID']));
			$newqty=$equipment[0]['equipInUseQuantity']-$eqpListing[0]['equipQty'];
			$this->generic->Update('equipment',array('equipmentID'=>$eqpListing[0]['equipmentID']),array('equipInUseQuantity'=>$newqty));
		}
		$this->generic->Delete('shopitem', array('itemID' => $_GET['itemID']));
		$this->generic->Delete('shopequipments', array('itemID' => $_GET['itemID']));
		$this->generic->Delete('shopworkforce', array('itemID' => $_GET['itemID']));
		//delet from projects
		$project = $this->generic->GetData('projects', array('itemID' => $_GET['itemID']));
		$this->generic->Delete('projects', array('itemID' => $_GET['itemID']));
		$this->generic->Delete('projectequipmentlink', array('ProjectID' => $project[0]['ProjectID']));
		$this->generic->Delete('projectworkforcelink', array('ProjectID' => $project[0]['ProjectID']));
		$this->session->set_flashdata('listingdeleted', 'Please fill all fields!');
		redirect(base_url('all-listing'));
	}

	/**
	 * Get pricing and availability for equipment/workforce
	 * Returns JSON response with price and stock info
	 */
	public function getPricing()
	{
		header('Content-Type: application/json');
		
		$itemType = $this->input->post('itemType'); // 'equipment' or 'workforce'
		$itemID = $this->input->post('itemID');
		
		if (!$itemType || !$itemID) {
			echo json_encode(['success' => false, 'message' => 'Invalid request']);
			return;
		}

		try {
			if ($itemType === 'equipment') {
				$data = $this->generic->GetData('shopequipments', array('itemID' => $itemID));
				
				if ($data) {
					echo json_encode([
						'success' => true,
						'rentalPrice' => floatval($data[0]['eqpPrice']),
						'availableQty' => intval($data[0]['equipQty']),
						'availableStart' => $data[0]['eqpAvailableStart'],
						'availableEnd' => $data[0]['eqpAvailableEnd'],
						'itemType' => 'equipment'
					]);
				} else {
					echo json_encode(['success' => false, 'message' => 'Equipment not found']);
				}
			} else if ($itemType === 'workforce') {
				$data = $this->generic->GetData('shopworkforce', array('itemID' => $itemID));
				
				if ($data) {
					echo json_encode([
						'success' => true,
						'rentalPrice' => floatval($data[0]['workforcePrice']),
						'availableQty' => 1, // Workforce typically quantity 1
						'availableStart' => $data[0]['workforceAvailableStart'],
						'availableEnd' => $data[0]['workforceAvailableEnd'],
						'itemType' => 'workforce'
					]);
				} else {
					echo json_encode(['success' => false, 'message' => 'Workforce not found']);
				}
			} else {
				echo json_encode(['success' => false, 'message' => 'Invalid item type']);
			}
		} catch (Exception $e) {
			echo json_encode(['success' => false, 'message' => 'Server error']);
		}
	}

	/**
	 * Process rent request with real-time stock validation
	 * Uses database transactions to ensure atomic updates
	 */
	public function processRentRequest()
	{
		header('Content-Type: application/json');

		$itemType = $this->input->post('itemType');
		$itemID = $this->input->post('itemID');
		$quantity = intval($this->input->post('quantity'));
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$company = $this->security->xss_clean($this->input->post('company'));
		$notes = $this->security->xss_clean($this->input->post('notes'));

		// Basic validation
		if (!$itemType || !$itemID || $quantity < 1 || !$startDate || !$endDate || !$company) {
			echo json_encode(['success' => false, 'message' => 'All fields are required']);
			return;
		}

		// Validate dates
		$start = strtotime($startDate);
		$end = strtotime($endDate);
		
		if ($end < $start) {
			echo json_encode(['success' => false, 'message' => 'End date cannot be before start date']);
			return;
		}

		// Calculate days (minimum 2 days)
		$days = ceil(($end - $start) / 86400) + 1;
		
		if ($days < 2) {
			echo json_encode(['success' => false, 'message' => 'Minimum rental period is 2 days']);
			return;
		}

		// Start transaction for atomic operation
		$this->db->trans_start();

		try {
			if ($itemType === 'equipment') {
				// Get current stock with row lock
				$equipment = $this->generic->GetData('shopequipments', array('itemID' => $itemID));
				
				if (!$equipment) {
					throw new Exception('Equipment not found');
				}

				$availableQty = intval($equipment[0]['equipQty']);
				$pricePerDay = floatval($equipment[0]['eqpPrice']);

				// Validate stock availability
				if ($quantity > $availableQty) {
					throw new Exception('Insufficient stock. Only ' . $availableQty . ' units available');
				}

				// Calculate total cost
				$totalCost = $pricePerDay * $quantity * $days;

				// Decrement stock (prevents double booking)
				$this->db->where('itemID', $itemID);
				$this->db->set('equipQty', 'equipQty - ' . $quantity, FALSE);
				$this->db->update('shopequipments');

				// Store rental record in projects table (reusing existing structure)
				$projectData = array(
					'companyID' => 1, // Default company
					'itemID' => $itemID,
					'pName' => 'Rental Request - ' . $company,
					'pLocation' => $company,
					'pStartDate' => $startDate,
					'pEndDate' => $endDate,
					'pDesc' => 'Equipment Rental - ' . $notes,
					'pStatus' => 1, // Pending status
					'pDraftStatus' => 1
				);

				$this->generic->InsertData('projects', $projectData);

			} else if ($itemType === 'workforce') {
				// Get workforce data
				$workforce = $this->generic->GetData('shopworkforce', array('itemID' => $itemID));
				
				if (!$workforce) {
					throw new Exception('Workforce not found');
				}

				$pricePerDay = floatval($workforce[0]['workforcePrice']);

				// Workforce is typically booked as 1 unit
				if ($quantity != 1) {
					$quantity = 1;
				}

				// Calculate total cost
				$totalCost = $pricePerDay * $days;

				// Store rental record
				$projectData = array(
					'companyID' => 1,
					'itemID' => $itemID,
					'pName' => 'Workforce Rental - ' . $company,
					'pLocation' => $company,
					'pStartDate' => $startDate,
					'pEndDate' => $endDate,
					'pDesc' => 'Workforce Rental - ' . $notes,
					'pStatus' => 1,
					'pDraftStatus' => 1
				);

				$this->generic->InsertData('projects', $projectData);
			}

			// Complete transaction
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed. Please try again.');
			}

			echo json_encode([
				'success' => true,
				'message' => 'Rental request submitted successfully!',
				'totalCost' => number_format($totalCost, 2),
				'days' => $days
			]);

		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode([
				'success' => false,
				'message' => $e->getMessage()
			]);
		}
	}

	/**
	 * Process buy request (equipment only)
	 * Permanently decrements stock using atomic transaction
	 */
	public function processBuyRequest()
	{
		header('Content-Type: application/json');

		$itemID = $this->input->post('itemID');
		$quantity = intval($this->input->post('quantity'));
		$company = $this->security->xss_clean($this->input->post('company'));
		$notes = $this->security->xss_clean($this->input->post('notes'));

		// Basic validation
		if (!$itemID || $quantity < 1 || !$company) {
			echo json_encode(['success' => false, 'message' => 'All fields are required']);
			return;
		}

		// Start transaction
		$this->db->trans_start();

		try {
			// Get current stock
			$equipment = $this->generic->GetData('shopequipments', array('itemID' => $itemID));
			
			if (!$equipment) {
				throw new Exception('Equipment not found');
			}

			$availableQty = intval($equipment[0]['equipQty']);
			$pricePerUnit = floatval($equipment[0]['eqpPrice']);

			// Validate stock
			if ($quantity > $availableQty) {
				throw new Exception('Insufficient stock. Only ' . $availableQty . ' units available');
			}

			// Calculate total
			$totalCost = $pricePerUnit * $quantity;

			// Permanently decrement stock
			$this->db->where('itemID', $itemID);
			$this->db->set('equipQty', 'equipQty - ' . $quantity, FALSE);
			$this->db->update('shopequipments');

			// Store purchase record in projects table
			$projectData = array(
				'companyID' => 1,
				'itemID' => $itemID,
				'pName' => 'Purchase Request - ' . $company,
				'pLocation' => $company,
				'pStartDate' => date('Y-m-d'),
				'pEndDate' => date('Y-m-d'),
				'pDesc' => 'Equipment Purchase - Qty: ' . $quantity . ' - ' . $notes,
				'pStatus' => 1,
				'pDraftStatus' => 1
			);

			$this->generic->InsertData('projects', $projectData);

			// Complete transaction
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Transaction failed. Please try again.');
			}

			echo json_encode([
				'success' => true,
				'message' => 'Purchase request submitted successfully!',
				'totalCost' => number_format($totalCost, 2)
			]);

		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode([
				'success' => false,
				'message' => $e->getMessage()
			]);
		}
	}
}
