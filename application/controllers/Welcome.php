<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
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
	public function index()
	{
		//get website setting
		$setting = $this->generic->GetData('web_setting');
		if (isset($this->session->userdata('loginData')['userType']) && $this->session->userdata('loginData')['userType'] == 1) {
			$admintype = true;
		} else {
			$admintype = false;
		}
		if ($setting[0]['websiteStatus'] == 1 || $admintype == true) {
			if ($this->uri->segment(1)) {
				$page = $this->generic->GetData('web_pages', array('slug' => $this->uri->segment(1)));
				if ($page) {
					if ($page[0]['pageType'] == 1) {
						$this->data['pageData'] = $this->generic->GetPageData(array('p.pageID' => $page[0]['pageID']));
						//all utality pages will load 
						if ($page[0]['slug'] == 'about-us') {
							$this->load->view('website/about', $this->data);
						} else if ($page[0]['slug'] == 'contact-us') {
							$this->load->view('website/contact-us', $this->data);
						} else if ($page[0]['slug'] == 'how-it-works') {
							$this->load->view('website/how-it-works', $this->data);
						} else if ($page[0]['slug'] == 'features') {
							$this->load->view('website/features', $this->data);
						} else if ($page[0]['slug'] == 'marketplace') {
							$this->load->view('website/marketplace', $this->data);
						}
					}
				} else {
					redirect(base_url('login'));
				}
			} else {
				// uri segment is empty so it is home page 
				$this->data['pageData'] = $this->generic->GetPageData(array('p.slug' => ''));
				//load testimonial
				$this->data['testimonials'] = $this->generic->GetData('web_testimonial', array('web_testimonialStatus' => 1));
				//load stats
				$this->data['stats'] = $this->generic->GetData('web_success', array('web_successStatus' => 1));
				//load company logos
				$this->data['logos'] = $this->generic->GetData('web_company', array('web_companyStatus' => 1));
				//load market place categories
				$this->data['categories'] = $this->generic->GetWebCategoryData(array('p.pageStatus' => 1));


				$this->load->view('website/home', $this->data);
			}
		} else {
			$this->load->view('comingsoon/comingsoon');
		}
	}
	public function login()
	{
		$this->load->view('login');
	}
	// <!-- ============================================================== -->
	// <!-- Website Marketplace functions -->
	// <!-- ============================================================== -->

	public function workforceMarketPlace()
	{
		//load cateogry for workforce 
		$this->data['workforceCat'] = $this->generic->GetWebCategoryData(array('wc.web_cat_type' => 2, 'p.pageStatus' => 1));
		$this->data['workforcelisting'] = $this->generic->GetMarketPlaceWorkforceData(array('si.itemStatus' => 1, 'si.liveStatus' => 1));
		$this->load->view('website/workforceMarketplace', $this->data);
	}
	public function equipmentMarketPlace()
	{
		//load cateogry for workforce 
		$this->data['equipmentCat'] = $this->generic->GetWebCategoryData(array('wc.web_cat_type' => 1, 'p.pageStatus' => 1));
		$this->data['equipmentlisting'] = $this->generic->GetMarketPlaceEquipmentData(array('si.itemStatus' => 1, 'si.liveStatus' => 1));
		$this->load->view('website/equipmentMarketplace', $this->data);
	}
	public function equipmentDetailMarketPlace(){
		$itemid=$this->input->get('item', TRUE);
		$decoded=base64_decode(strtr($itemid, '-_', '+/'));
		$itemid=explode('|', $decoded)[0];
		$this->data['equipment'] = $this->generic->GetMarketPlaceEquipmentData(array('si.itemStatus' => 1, 'si.liveStatus' => 1,'si.itemID'=>$itemid));
		$this->load->view('website/equipmentDetail',$this->data);
	}
	public function WorkforceDetailMarketPlace(){
		$itemid=$this->input->get('item', TRUE);
		$decoded=base64_decode(strtr($itemid, '-_', '+/'));
		$itemid=explode('|', $decoded)[0];
		$this->data['workforce'] = $this->generic->GetMarketPlaceWorkforceData(array('si.itemStatus' => 1, 'si.liveStatus' => 1,'si.itemID'=>$itemid));
		$this->load->view('website/WorkforceDetail',$this->data);
	}
		// <!-- ============================================================== -->
	// <!-- Utality pages -->
	// <!-- ============================================================== -->
public function ContactFormData(){
	$contactData=array(
		'contactName'=>$this->input->post('name'),
		'contactEmail'=>$this->input->post('email'),
		'contactSubject'=>$this->input->post('subject'),
		'contactMsg'=>$this->input->post('msg'),
	);
	$this->generic->InsertData('web_contact_form',$contactData);
	$this->session->set_flashdata('messageSent', 1);
	redirect(base_url('contact-us'));
}
	
	// <!-- ============================================================== -->
	// <!-- Login function -->
	// <!-- ============================================================== -->

	public function loginData()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		//check if email and password exists
		$user = $this->generic->GetData('users', array('userEmail' => $email, 'userPass' => $password, 'userStatus' => 1));
		if ($user) {
			// Security: regenerate session ID to prevent session fixation attacks
			$this->session->sess_regenerate(TRUE);
			$this->session->set_userdata('loginData', $user[0]);
			//check if user is admin or vendor
			if ($user[0]['userType'] == 1) {
				//if admin then redirect to admin dashboard
				redirect(base_url('admin-dashboard'));
			} elseif ($user[0]['userType'] == 2) {
				//get company details
				$companyDetails = $this->generic->GetData('companydetail', array('userId' => $user[0]['userID']));
				$this->session->set_userdata('companyDetails', $companyDetails[0]);
				//if vendor then redirect to vendor dashboard	
				redirect(base_url('company-dashboard'));
			} elseif ($user[0]['userType'] == 3) {
				//if manager then redirect to manager dashboard	
				redirect(base_url('manager-dashboard'));
			} elseif ($user[0]['userType'] == 4) {
				//if normal user then redirect to home page	
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('error', 1);
			redirect(base_url());
		}
	}
	public function RegisterView()
	{
		$this->load->view('signup');
	}

	public function comapnyRegisterationData()
	{
		// die('comapnyRegisterationData');
		$comName = $this->input->post('comName');
		$userName = $this->input->post('userName');
		$cPhone = $this->input->post('cPhone');
		$email = $this->input->post('Cemail');
		$password = md5($this->input->post('Cpassword') ?? '');
		// check if email already exists
		$checkEmail = $this->generic->GetData('users', array('userEmail' => $email));
		if ($checkEmail) {
			$this->session->set_flashdata('alreadyRegistered', 1);
			redirect(base_url('register'));
		} else {

			$companyData = array(
				'userName' => $userName,
				'userPhone' => $cPhone,
				'userEmail' => $email,
				'userPass' => $password,
				'userType' => 2,
				'userStatus' => 2,
			);
			$this->generic->InsertData('users', $companyData);
			//get max user id
			$maxUserId = $this->generic->GetMaxID('users', 'userID');
			$companyData = array(
				'companyName' => $comName,
				'userId' => $maxUserId[0]['result'],
			);
			$this->generic->InsertData('companydetail', $companyData);
			//setup Authentaction
			$authCode = rand(1000, 9999);
			$authTocken = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
			// check if token is generated already exists
			$checkAuthTocken = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'authStatus' => 0));
			if ($checkAuthTocken) {
				// if exists then generate new token
				$authTocken = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
			}
			$authData = array(
				'userId' => $maxUserId[0]['result'],
				'authCode' => $authCode,
				'authTocken' => $authTocken,
				'authStatus' => 0,
			);
			$this->generic->InsertData('userauth', $authData);
			//send email
			$subject = 'Equip Manager - Account Verification';
			$message = 'Your account has been created successfully. Your verification code is: ' . $authCode;
			$this->send_email($email, $subject, $message);
			redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $maxUserId[0]['result']));
		}
	}

	public function userRegistersationData()
	{
		// die('userRegistersationData');
		$userName = $this->input->post('usrName');
		$cPhone = $this->input->post('UPhone');
		$email = $this->input->post('uemail');
		$password = md5($this->input->post('upassword') ?? '');
		// check if email already exists
		$checkEmail = $this->generic->GetData('users', array('userEmail' => $email));
		if ($checkEmail) {
			$this->session->set_flashdata('alreadyRegistered', 1);
			redirect(base_url('register'));
		} else {
			$userData = array(
				'userName' => $userName,
				'userPhone' => $cPhone,
				'userEmail' => $email,
				'userPass' => $password,
				'userType' => 4,
				'userStatus' => 2,
			);
			$this->generic->InsertData('users', $userData);
			//get max user id
			$maxUserId = $this->generic->GetMaxID('users', 'userID');
			//setup Authentaction
			$authCode = rand(1000, 9999);
			$authTocken = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
			// check if token is generated already exists
			$checkAuthTocken = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'authStatus' => 0));
			if ($checkAuthTocken) {
				// if exists then generate new token
				$authTocken = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
			}
			$authData = array(
				'userId' => $maxUserId[0]['result'],
				'authCode' => $authCode,
				'authTocken' => $authTocken,
				'authStatus' => 0,
			);
			$this->generic->InsertData('userauth', $authData);
			//send email
			$subject = 'Equip Manager - Account Verification';
			$message = 'Your account has been created successfully. Your verification code is: ' . $authCode;
			$this->send_email($email, $subject, $message);
			redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $maxUserId[0]['result']));
		}
	}



	public function VerifyAccount()
	{
		$authcode   = $this->input->get('auth', TRUE);
		$userIDParam = $this->input->get('userID', TRUE);
		//check if auth code exists
		$checkAuth = $this->generic->GetData('userauth', array('authTocken' => $authcode, 'userID' => $userIDParam, 'authStatus' => 0));
		if ($checkAuth || $this->input->get('forgot') !== NULL) {
			// die('a');
			$this->load->view('verifyAccount');
		} else {
			$this->session->set_flashdata('authExpire', 1);
			redirect(base_url());
		}
	}
	public function VerifyAccountData()
	{

		$authCode    = $this->input->post('password');
		$forgotcheck = $this->input->post('forgotcheck');
		$authTocken  = $this->input->get('auth', TRUE);
		$userIDParam = $this->input->get('userID', TRUE);
		//get user by auth token
		$userAuth = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'userID' => $userIDParam));
		if ($userAuth) {
			// die($authCode );
			if ($userAuth[0]['authCode'] == $authCode) {
				//update user auth status
				$this->generic->Update('userauth', array('userID' => $userAuth[0]['userID']), array('authStatus' => 1));
				$this->generic->Update('users', array('userID' => $userAuth[0]['userID']), array('userStatus' => 1));
				if ($forgotcheck == '1') {
					// if forgot password then update user password
					redirect(base_url('reset-password?auth=' . $authTocken . '&userID=' . $userIDParam));
				} else {
					$this->session->set_flashdata('successRegister', 1);
					redirect(base_url());
				}
			} else {
				$this->session->set_flashdata('error', 1);
				if ($forgotcheck == '1') {
					// die('forgot');
					redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $userIDParam . '&forgot=1'));
				} else {
					redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $userIDParam));
				}
			}
		} else {
			redirect(base_url('register'));
		}
	}
	public function resendVerificationEmail()
	{
		$authTocken  = $this->input->get('auth', TRUE);
		$userIDParam = $this->input->get('userID', TRUE);
		//get user by auth token
		$userAuth = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'userID' => $userIDParam));
		//get user data
		$userdata = $this->generic->GetData('users', array('userID' => $userAuth[0]['userID']));
		//generate new authcode
		$userAuth[0]['authCode'] = rand(1000, 9999);
		//update user auth code	
		$this->generic->Update('userauth', array('userID' => $userAuth[0]['userID']), array('authCode' => $userAuth[0]['authCode']));
		if ($userAuth) {
			//send email
			$email = $userdata[0]['userEmail'];
			$subject = 'Equip Manager - Account Verification';
			$message = 'Your account has been created successfully. Your verification code is: ' . $userAuth[0]['authCode'];
			$this->send_email($email, $subject, $message);
			$this->session->set_flashdata('newcodeSend', 1);
			if ($this->input->get('forgot') !== NULL) {
				redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $userIDParam . '&forgot=1'));
			} else {
				redirect(base_url('verify-account?auth=' . $authTocken . '&userID=' . $userIDParam));
			}
		} else {
			redirect(base_url('register'));
		}
	}


	public function forgotpassword()
	{
		$this->load->view('forgotPass');
	}
	public function forgotpasswordData()
	{
		$email = $this->input->post('femail');
		//check if email exists
		$user = $this->generic->GetData('users', array('userEmail' => $email, 'userStatus' => 1));
		$authdata = $this->generic->GetData('userauth', array('userID' => $user[0]['userID']));
		if ($user) {
			//generate new auth code
			$authCode = rand(1000, 9999);
			//update user auth code	
			$this->generic->Update('userauth', array('userID' => $user[0]['userID']), array('authCode' => $authCode));
			//send email
			$subject = 'Equip Manager - Forgot Password';
			$message = 'Your verification code is: ' . $authCode;
			$this->send_email($email, $subject, $message);
			redirect(base_url('verify-account?auth=' . $authdata[0]['authTocken'] . '&userID=' . $user[0]['userID'] . '&forgot=1'));
		} else {
			$this->session->set_flashdata('error', 1);
			redirect(base_url('forgot-password'));
		}
	}


	public function resetPassword()
	{
		$authTocken = $this->input->get('auth', TRUE);
		$userID     = $this->input->get('userID', TRUE);
		//get user by auth token
		$userAuth = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'userID' => $userID));
		if ($userAuth) {
			$this->load->view('resetPass');
		} else {
			redirect(base_url('register'));
		}
	}
	public function resetPasswordData()
	{
		$authTocken = $this->input->get('auth', TRUE);
		$userID     = $this->input->get('userID', TRUE);
		//get user by auth token
		$userAuth = $this->generic->GetData('userauth', array('authTocken' => $authTocken, 'userID' => $userID));
		if ($userAuth) {
			$newPassword = md5($this->input->post('password'));
			$confirmPassword = md5($this->input->post('cpassword'));
			if ($newPassword == $confirmPassword) {
				//update user password	
				$this->generic->Update('users', array('userID' => $userID), array('userPass' => $newPassword));
				$this->session->set_flashdata('passwordupdates', 1);
				redirect(base_url());
			} else {
				$this->session->set_flashdata('passwordnotmatch', 1);
				redirect(base_url('reset-password?auth=' . $authTocken . '&userID=' . $userID));
			}
		} else {
			redirect(base_url('register'));
		}
	}




	// <!-- ============================================================== -->
	// <!-- redirect to dashboard -->
	// <!-- ============================================================== -->

	public function userDashboard()
	{
		$login_data = $this->session->userdata('loginData');
		if (!$login_data || !isset($login_data['userType'])) {
			redirect('login');
			return;
		}
		switch ($login_data['userType']) {
			case 4: // normal user
				$this->load->view('dashboards/user_dashboard');
				break;
			case 2: // company admin
				$this->load->view('dashboards/companydashboard');
				break;
			case 3: // manager
				$this->load->view('dashboards/managerdashboard');
				break;
			default:
				redirect('login');
		}
	}

	public function userSettings()
	{
		//check if user is normal user (type 4)
		if ($this->session->userdata('loginData')['userType'] == 4) {
			$this->load->view('dashboards/settings');
		} else {
			redirect(base_url());
		}
	}

	public function companyDashboard()
	{
		//check if user is vendor
		if ($this->session->userdata('loginData')['userType'] == 2) {
			$this->load->view('dashboards/companydashboard');
		} else {
			redirect(base_url());
		}
	}
	public function managerDashboard()
	{
		//check if user is manager (type 3)
		if ($this->session->userdata('loginData')['userType'] == 3) {
			$this->load->view('dashboards/managerdashboard');
		} else {
			redirect(base_url());
		}
	}
	public function TestMail()
	{
		//send email
		$email = 'revotahir@gmail.com';
		$subject = 'Equip Manager - Account Verification';
		$message = 'Your account has been created successfully. Your verification code is: ';
		$this->send_email($email, $subject, $message);
		die('Email sent successfully');
	}

	// <!-- ============================================================== -->
	// <!-- logout function -->
	// <!-- ============================================================== -->
	public function LogOut()
	{
		// Get userType before unsetting loginData
		$login_data = $this->session->userdata('loginData');
		$this->session->unset_userdata('loginData');
		
		// If company admin, also unset company details
		if ($login_data && isset($login_data['userType']) && $login_data['userType'] == 2) {
			$this->session->unset_userdata('companyDetails');
		}
		
		redirect('login');
	}
}
