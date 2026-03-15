<?php

use Phpass\Loader;

defined('BASEPATH') or exit('No direct script access allowed');

class customer extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Generic_model', 'generic');
		$this->load->model('Payment_model', 'payment');
		$this->data['cartCount'] = $this->generic->GetCount('cart', 'cartID', array('customerID' => $this->session->userdata['loginData']['userID'], 'cartStatus' => 0));
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
	public function Dashboard()
	{
		$this->load->view('customer/dashboard-customer', $this->data);
	}

	public function OrderNow()
	{
		$this->data['cartProduct'] = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		$this->data['products'] = $this->generic->GetAssignedProducts($this->session->userdata['loginData']['userID']);
		$this->load->view('customer/order-now', $this->data);
	}
	public function addToCartData()
	{
		//ajax output
		$output = '';
		//check if products is already added
		$checkcart = $this->generic->GetData('cart', array(
			'productID' => $this->input->post('productID'),
			'customerID' => $this->session->userdata['loginData']['userID'],
			'cartStatus' => 0
		));
		if ($checkcart) {
			//add quantity
			$newQuantity = $this->input->post('quantity') + $checkcart[0]['quantity'];
			$this->generic->Update('cart', array(
				'productID' => $this->input->post('productID'),
				'customerID' => $this->session->userdata['loginData']['userID'],
				'cartStatus' => 0
			), array('quantity' => $newQuantity));
			$output = $output . 'QtyUpdated//';
		} else {
			//get vendor ID 
			$productDetail = $this->generic->GetData('products', array('productID' => $this->input->post('productID')));
			//arrayFor cart
			$data = array(
				'customerID' => $this->session->userdata['loginData']['userID'],
				'vendorID' => $productDetail[0]['userID'],
				'productID' => $this->input->post('productID'),
				'quantity' => $this->input->post('quantity'),
				'price' => $this->input->post('price')
			);
			$this->generic->InsertData('cart', $data);
			$output = $output . 'AddedNew//';
		}
		//get all product for sumary
		$cartProduct = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		if ($cartProduct) {
			$totalAmount = 0;
			$li = '';
			foreach ($cartProduct as $row) {
				// M9: Escape all user-supplied values to prevent stored XSS
				$li = $li . '  <li class="list-group-item" id="cartItems_' . (int)$row['cartID'] . '" style="justify-content: start !important;display:flex;
  gap: 20px;">
				<div>
                                                    <a href="javascript:void(0);" onclick="deleteCart(' . (int)$row['cartID'] . ')"><i class="far fa-window-close" style="color: red;"></i></a>
                                                </div>
                                                    <div>
                                                        <h6 class="my-0">' . h($row['productName']) . '</h6>
                                                        <small class="text-muted" >' . h($row['productDesp']) . '</small>
                                                    </div>
                                                    <span class="text-muted" style="margin-left: auto;">$' . h($row['price']) . ' X ' . h($row['quantity']) . '</span>
                                                </li>';
				$totalAmount = $totalAmount + ($row['price'] * $row['quantity']);
			}
		}
		$li = $li . ' <li class="list-group-item d-flex justify-content-between">
                                                    <span>Total (USD)</span>
                                                    <strong id="totalAmount">$' . $totalAmount . '</strong>
                                                </li>';
		$TotalProduct = $this->generic->GetCount('cart', 'cartID', array('customerID' => $this->session->userdata['loginData']['userID'], 'cartStatus' => 0));

		$output = $output . $li . '//' . $TotalProduct[0]['result'];
		echo $output;
	}
	public function DeletCartItem()
	{
		//delet from cart
		$this->generic->Delete('cart', array('cartID' => $this->input->post('cartid')));
		$cartProduct = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		if ($cartProduct) {
			$totalproducts = 0;
			$totalAmount = 0;
			foreach ($cartProduct as $row) {
				$totalAmount = $totalAmount + ($row['price'] * $row['quantity']);
				$totalproducts++;
			}
		} else {
			$totalAmount = 'empty';
			$totalproducts = 'empty';
		}
		echo 'done//' . $totalAmount . '//' . $totalproducts;
	}
	public function cart()
	{
		$this->data['cartProducts'] = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		$this->load->view('customer/cart', $this->data);
	}
	public function UpdateQuanityFromCart()
	{
		$this->generic->Update('cart', array('cartID' => $this->input->post('cartid')), array('quantity' => $this->input->post('quantity')));
		$cartProduct = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID']));
		if ($cartProduct) {
			$totalAmount = 0;
			foreach ($cartProduct as $row) {
				$totalAmount = $totalAmount + ($row['price'] * $row['quantity']);
			}
		} else {
			$totalAmount = 'empty';
		}
		echo 'done//' . $totalAmount;
	}
	public function CheckOut()
	{
		$this->data['cartProduct'] = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		$this->load->view('customer/checkout', $this->data);
	}
	public function CheckOutData()
	{
		//calculate toal bill
		$cartProducts = $this->generic->GetProductsByCart(array('c.customerID' => $this->session->userdata['loginData']['userID'], 'c.cartStatus' => 0));
		if ($cartProducts) {
			$totalAmount = 0;
			$productList = '';
			foreach ($cartProducts as $row) {
				$totalAmount += $row['price'] * $row['quantity'];
				$productList = $productList . '<strong>' . $row['productName'] . '</strong>' . '<br>' . $row['quantity'] . ' X $' . $row['price'] . '<br>';
			}
		}
		$data = array(
			'customerID' => $this->session->userdata['loginData']['userID'],
			'address' => $this->input->post('address'),
			'address2' => $this->input->post('address2'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'addType' => $this->input->post('addType'),
			'totalBill' => $totalAmount,
			'addQuestions' => $this->input->post('addQuestion'),

		);
		$this->generic->InsertData('checkout', $data);
		//get max id
		$checkoutid = $this->generic->GetMaxID('checkout', 'checkoutID');
		//updatecat
		$this->generic->Update('cart', array('customerID' => $this->session->userdata['loginData']['userID'], 'cartStatus' => 0), array('checKoutID' => $checkoutid[0]['result'], 'cartStatus' => 1));

		//email to custmer
		$email = $this->session->userdata['loginData']['userEmail'];
		$subject = 'Order Confirmation';
		$message = ' Hi ' . $this->session->userdata['loginData']['userName'] . ',<br>
		<p>Thank you for placing your order with Metro Foods. We’ve received your order and it’s currently being processed.</P>
		<strong>Order Summary:</strong><br><br>
		<strong>Order Number: ' . $checkoutid[0]['result'] . '</strong><br>
		<strong>Items:</strong><br>' . $productList . '<br>
		<strong>Total:</strong> $' . $totalAmount . '<br>
		<strong>Estimated Delivery or Pickup Time:</strong>  A team member from metro foods will reach out regarding your delivery<br>
		<p>You will receive an update once your order is out for delivery or ready for pickup.
		If you have any questions or need assistance, feel free to reply to this email or contact us at</p>
		orders@mymetrofoods.com<br>
		Thank you for choosing Metro Foods.<br>
		Best regards,<br>
		<strong>The Metro Foods Team<strong>
		';
		$result = $this->send_email($email, $subject, $message);



		//email to vendors
		//--get all vendors id thorugh cart
		$vendorsID = $this->generic->GetDistVendorInCart($checkoutid[0]['result']);
		if ($vendorsID) {
			// die('aaa');
			$vendorsName='';
			$vendorNameCheck=1;
			$overallTotalVendoramount=0; //overall vendor amount for metro food email
			foreach ($vendorsID as $row) {
				//get products for curent vendor id
				$cartProductsByVendor = $this->generic->GetProductsByCart(array('c.checkoutID' => $checkoutid[0]['result'], 'c.vendorID' => $row['vendorID']));
				if ($cartProductsByVendor) {
					$vendortotalAmount = 0;
					$vendorproductList = '';
					foreach ($cartProductsByVendor as $row1) {
						$vendortotalAmount += $row1['productPrice'] * $row1['quantity'];
						
						$vendorproductList = $vendorproductList . '<strong>' . $row1['productName'] . '</strong>' . '<br>' . $row1['quantity'] . ' X $' . $row1['productPrice'] . '<br>';
					}
					$overallTotalVendoramount=$overallTotalVendoramount+$vendortotalAmount;
				}
				//get vendor Detail 
				$vendorDetail = $this->generic->GetData('users', array('userID' => $row['vendorID']));
				//set vendor name for metro foods email
				if($vendorNameCheck==1){
					$vendorsName=$vendorsName.$vendorDetail[0]['userName'];
					$vendorNameCheck++;
				}else{
					$vendorsName=$vendorsName.', '.$vendorDetail[0]['userName'];
				}
				


				//generate email for vendor
				
				$email = $vendorDetail[0]['userEmail'];
				$subject = 'New Metro Foods Order Received – '.$checkoutid[0]['result'];
				$message = ' Hello ' . $vendorDetail[0]['userName'] . ',<br>
				<p>You have received a new order through the Metro Foods portal. Please begin preparing the order as soon as possible.</P>
				<strong>Order Summary:</strong><br><br>
				<strong>Order Number: ' . $checkoutid[0]['result'] . '</strong><br>
				<strong>Items:</strong><br>' . $vendorproductList . '<br>
				<strong>Total:</strong> $' . $vendortotalAmount . '<br>
				<p>For any issues or delays, contact Metro Support at orders@mymetrofoods.com
				Thank you for your partnership.<br>
				Sincerely,<br>
				Metro Foods Operations</p>
								
				';
				$result = $this->send_email($email, $subject, $message);
			}
		}


				//email to metro foods
				$email = 'orders@mymetrofoods.com';
				$subject = 'New Order Placed – '.$checkoutid[0]['result'] ;
				$message = '  Team,<br>
				<p>A new order has been submitted through the customer portal. Please see the details below:</P>
				<strong>Order Summary:</strong><br><br>
				<strong>Order Number: ' . $checkoutid[0]['result'] . '</strong><br>
				<strong>Customer Name: ' . $this->session->userdata['loginData']['userName'] . '</strong><br>
				<strong>Vendor: ' . $vendorsName . '</strong><br>
				<strong>Delivery or Pickup: : ' . $this->input->post('addType') . '</strong><br>
				<strong>Order Breakdown:</strong><br>' . $productList . '<br>
				<strong>Total Customer Amount:</strong> $' . $totalAmount . '<br>
				<strong>Total Vendor Amount:</strong> $' . $overallTotalVendoramount . '<br>
				<p>The customer and vendor have been notified. Please monitor for processing and fulfillment. If there are any issues, please escalate to Waleed Akram at wakram@mymetrofoods.com<br>
Thank you!
</p>
				
				';
				$result = $this->send_email($email, $subject, $message);
		


		$this->session->set_flashdata('checkoutDone', 1);
		redirect(base_url('order-now'));
	}
	public function OrderHistory()
	{
		$this->data['orderList'] = $this->generic->GetData('checkout', array('customerID' => $this->session->userdata['loginData']['userID']));
		$this->load->view('customer/orderHistory', $this->data);
	}
	public function OrderInvoice()
	{
		$this->data['order'] = $this->generic->GetData('checkout', array('checkoutID' => $this->uri->segment(2)));
		$this->data['userData'] = $this->generic->GetData('users', array('userID' => $this->data['order'][0]['customerID']));
		$this->data['cartProduct'] = $this->generic->GetProductsByCart(array('c.cartStatus' => 1, 'checkoutID' => $this->uri->segment(2)));
		$this->load->view('customer/invoice', $this->data);
	}

	/**
	 * Earnings Dashboard for Company Admin
	 */
	public function earnings()
	{
		// Check if user is Company Admin
		if ($this->session->userdata('loginData')['userType'] != 2) {
			redirect(base_url());
			return;
		}

		$company_id = $this->session->userdata('companyDetails')['companyID'];

		// Get payments for this company
		$this->data['payments'] = $this->payment->getPaymentsBySeller($company_id);

		// Get payouts for this company
		$this->data['payouts'] = $this->payment->getPayoutsByCompany($company_id);

		// Get statistics
		$this->data['stats'] = $this->payment->getPaymentStats(['company_id' => $company_id]);

		$this->load->view('customer/earnings', $this->data);
	}
}
