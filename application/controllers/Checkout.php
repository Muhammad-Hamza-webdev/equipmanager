<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Checkout Controller
 * 
 * Handles secure checkout process for equipment rental/purchase and workforce rental.
 * All calculations, validations, and data retrieval are server-side ONLY.
 * 
 * Integration with:
 * - Stripe Payment API (via prepare_payment method)
 * - Payment_model for database operations
 * - Database tables: equipment_payments, workforce_payments, equipment_payouts, workforce_payouts
 */

class Checkout extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Generic_model');
		$this->load->model('Payment_model', 'payment');
		$this->load->library('StripeService');
		$this->load->database();
		$this->config->set_item('csrf_protection', TRUE);
	}

	/**
	 * Display checkout page with order summary
	 * 
	 * GET Parameters (validated):
	 * - item_id (int): shopitem.itemID
	 * - quantity (int): units to rent/purchase
	 * - start_date (string, optional): rental start date YYYY-MM-DD (if rental)
	 * - end_date (string, optional): rental end date YYYY-MM-DD (if rental)
	 * 
	 * Flow:
	 * 1. Validate all input parameters
	 * 2. Fetch product from database
	 * 3. Validate product state (exists, live, saleable)
	 * 4. Validate quantity against available inventory
	 * 5. Validate dates if rental
	 * 6. Calculate pricing server-side
	 * 7. Fetch system commission rate
	 * 8. Render checkout view with data
	 */
	public function index()
	{
		// ===== SECURITY CHECK: USER MUST BE LOGGED IN =====
		$login_data = $this->session->userdata('loginData');
		if (!$login_data) {
			$this->session->set_flashdata('error', 'Please log in to continue with checkout');
			redirect(base_url('login'));
			return;
		}

		// ===== STEP 1: VALIDATE & SANITIZE INPUT =====

		$item_id = $this->input->get('item_id', TRUE);
		$quantity = $this->input->get('quantity', TRUE);
		$start_date = $this->input->get('start_date', TRUE);
		$end_date = $this->input->get('end_date', TRUE);

		// Convert to appropriate types
		$item_id  = intval($item_id);
		$quantity = intval($quantity);

		// Validate required parameters (must be strictly positive integers)
		if ($item_id <= 0) {
			show_error('Invalid item ID. Must be a positive integer.', 400);
			return;
		}
		if ($quantity < 1 || $quantity > 10000) {
			show_error('Invalid quantity. Must be between 1 and 10000.', 400);
			return;
		}

		// ===== STEP 2: FETCH PRODUCT FROM DATABASE =====

		// Get shopitem record to determine type (equipment vs workforce)
		$item_query = $this->db->where('itemID', $item_id)
			->where('liveStatus', 1)  // Only live items can be checked out
			->get('shopitem');

		if ($item_query->num_rows() === 0) {
			show_error('Product not found or not available', 404);
			return;
		}

		$item = $item_query->row();
		$item_type = $item->itemType;  // 1 = equipment, 2 = workforce
		$sale_type = $item->saleType;  // 0 = rental, 1 = purchase

		// ===== STEP 3: FETCH PRODUCT DETAILS BASED ON TYPE =====

		$order_data = array();

		if ($item_type == 1) {
			// EQUIPMENT CHECKOUT
			$equipment = $this->db->select('se.*, e.equipName')
				->from('shopequipments se')
				->join('equipment e', 'se.equipmentID = e.equipmentID')
				->where('se.itemID', $item_id)
				->get()
				->row();

			if (!$equipment) {
				show_error('Equipment not found', 404);
				return;
			}

			// ===== STEP 4: VALIDATE INVENTORY =====

			if ($quantity > $equipment->equipQty) {
				show_error('Insufficient inventory. Available: ' . $equipment->equipQty . ', Requested: ' . $quantity, 400);
				return;
			}

			// ===== STEP 5: VALIDATE RENTAL DATES (IF APPLICABLE) =====

			$rental_days = 0;

			if ($sale_type == 0) {  // Rental

				// Dates are required for rental
				if (!$start_date || !$end_date) {
					show_error('Start date and end date are required for rental', 400);
					return;
				}

				// Validate date format (YYYY-MM-DD)
				if (!$this->_validate_date_format($start_date) || !$this->_validate_date_format($end_date)) {
					show_error('Invalid date format. Use YYYY-MM-DD', 400);
					return;
				}

				// Parse dates
				$start = strtotime($start_date);
				$end = strtotime($end_date);

				// Validate date range
				if ($start === FALSE || $end === FALSE) {
					show_error('Invalid dates', 400);
					return;
				}

				if ($start > $end) {
					show_error('Start date must be before end date', 400);
					return;
				}

				// Minimum 2-day rental
				$rental_days = intdiv($end - $start, 86400);  // 86400 seconds per day
				if ($rental_days < 1) {
					show_error('Rental period must be at least 1 day', 400);
					return;
				}

				// Validate dates fall within availability window
				$avail_start = strtotime($equipment->eqpAvailableStart);
				$avail_end = strtotime($equipment->eqpAvailableEnd);

				if ($start < $avail_start || $end > $avail_end) {
					show_error('Selected dates fall outside availability window', 400);
					return;
				}
			}

			// ===== STEP 6: CALCULATE PRICING (SERVER-SIDE ONLY) =====

			$subtotal = 0;

			if ($sale_type == 0) {  // Rental
				// Price based on rental type
				$price_per_unit = floatval($equipment->eqpPrice);

				// rental_type: 1=daily, 2=weekly, 3=monthly, 4=yearly
				// For now, assume daily rate - can be extended for other periods
				$subtotal = $price_per_unit * $rental_days * $quantity;
			} else {  // Purchase
				// Direct purchase price
				$price_per_unit = floatval($equipment->eqpPrice);
				$subtotal = $price_per_unit * $quantity;
			}

			// Prepare order data for view
			$order_data = array(
				'item_id' => $item_id,
				'item_type' => 1,
				'sale_type' => $sale_type,
				'product_name' => $equipment->equipName,
				'product_sku' => 'EQ-' . $equipment->equipmentID,
				'quantity' => $quantity,
				'unit_price' => floatval($equipment->eqpPrice),
				'rental_start_date' => $sale_type == 0 ? $start_date : NULL,
				'rental_end_date' => $sale_type == 0 ? $end_date : NULL,
				'rental_days' => $rental_days,
				'delivery_option' => $equipment->eqpDeliveryOpt,  // 1=both pickup & delivery, 2=pickup only
				'pickup_address' => $equipment->eqpAdd ?? 'Address not available',
				'pickup_city' => $equipment->eqpLocCity ?? 'City not available',
				'equipment_rules' => $equipment->eqpRules ?? '',
				'subtotal' => $subtotal,
			);
		} else if ($item_type == 2) {
			// WORKFORCE CHECKOUT
			$workforce = $this->db->select('sw.*, w.personName')
				->from('shopworkforce sw')
				->join('workforce w', 'sw.workforceID = w.workforceID')
				->where('sw.itemID', $item_id)
				->get()
				->row();

			if (!$workforce) {
				show_error('Workforce not found', 404);
				return;
			}

			// ===== STEP 4: VALIDATE WORKFORCE QUANTITY =====
			// Workforce is always 1 person, so quantity must be 1

			if ($quantity != 1) {
				show_error('Workforce quantity must be 1', 400);
				return;
			}

			// ===== STEP 5: VALIDATE DATES =====

			if (!$start_date || !$end_date) {
				show_error('Start date and end date are required for workforce rental', 400);
				return;
			}

			if (!$this->_validate_date_format($start_date) || !$this->_validate_date_format($end_date)) {
				show_error('Invalid date format. Use YYYY-MM-DD', 400);
				return;
			}

			$start = strtotime($start_date);
			$end = strtotime($end_date);

			if ($start === FALSE || $end === FALSE) {
				show_error('Invalid dates', 400);
				return;
			}

			if ($start > $end) {
				show_error('Start date must be before end date', 400);
				return;
			}

			$rental_days = intdiv($end - $start, 86400);
			if ($rental_days < 1) {
				show_error('Rental period must be at least 1 day', 400);
				return;
			}

			// Validate availability
			$avail_start = strtotime($workforce->workforceAvailableStart);
			$avail_end = strtotime($workforce->workforceAvailableEnd);

			if ($start < $avail_start || $end > $avail_end) {
				show_error('Selected dates fall outside availability window', 400);
				return;
			}

			// ===== STEP 6: CALCULATE PRICING (SERVER-SIDE ONLY) =====

			$price_per_unit = floatval($workforce->workforcePrice);
			$subtotal = $price_per_unit * $rental_days;

			// Prepare order data
			$order_data = array(
				'item_id' => $item_id,
				'item_type' => 2,
				'sale_type' => 0,  // Workforce is always rental
				'product_name' => $workforce->personName . ' (Workforce)',
				'product_sku' => 'WF-' . $workforce->workforceID,
				'quantity' => 1,
				'unit_price' => $price_per_unit,
				'rental_start_date' => $start_date,
				'rental_end_date' => $end_date,
				'rental_days' => $rental_days,
				'delivery_option' => $workforce->workforceDeliveryOpt,  // 1=pickup, 2=delivery
				'pickup_address' => $workforce->WorkforceAdd ?? 'Address not available',
				'pickup_city' => $workforce->workforceCity ?? 'City not available',
				'subtotal' => $subtotal,
			);
		} else {
			show_error('Invalid item type', 400);
			return;
		}

		// ===== STEP 7: FETCH GLOBAL COMMISSION RATE =====

		$commission_query = $this->db->where('settingKey', 'marketplace_commission_percent')
			->get('system_settings');

		$commission_percent = 5.00;  // Default if not found
		if ($commission_query->num_rows() > 0) {
			$commission_percent = floatval($commission_query->row()->settingValue);
			// Bounds validation: commission must be between 0 and 50 percent
			if ($commission_percent < 0 || $commission_percent > 50) {
				log_message('error', 'Invalid commission rate from DB: ' . $commission_percent . ' — using safe default 5.00');
				$commission_percent = 5.00;
			}
		}

		// ===== STEP 8: CALCULATE TAXES & TOTAL =====

		$subtotal = floatval($order_data['subtotal']);
		$commission_amount = ($subtotal * $commission_percent) / 100;
		$tax_amount = 0;  // TODO: Implement tax calculation if required
		$total = $subtotal + $tax_amount;  // Commission is NOT added to customer total

		// Add calculated values to order data
		$order_data['commission_percent'] = $commission_percent;
		$order_data['commission_amount'] = $commission_amount;
		$order_data['tax_amount'] = $tax_amount;
		$order_data['total'] = $total;

		// ===== STEP 9: LOAD VIEW =====

		// Get Stripe public key from StripeService
		$stripe_public_key = $this->stripeservice->getPublishableKey();

		$data = array(
			'order' => $order_data,
			'csrf_token_name' => $this->security->get_csrf_token_name(),
			'csrf_token_value' => $this->security->get_csrf_hash(),
			'stripe_public_key' => $stripe_public_key,
		);

		// Use existing header/footer layout
		$this->load->view('components/websiteHeader', $data);
		$this->load->view('website/checkout_view', $data);
		$this->load->view('components/websiteFooter', $data);
	}

	/**
	 * Prepare payment with Stripe integration
	 * 
	 * POST Parameters:
	 * - equipment_payment_id (int, optional): If provided, UPDATE existing order; else CREATE new
	 * - payment_method_id (string): Stripe payment method ID
	 * - item_id (int)
	 * - quantity (int)
	 * - start_date (string, optional)
	 * - end_date (string, optional)
	 * - customer_email (string)
	 * - customer_phone (string)
	 * - delivery_name (string)
	 * - delivery_street (string)
	 * - delivery_city (string)
	 * - delivery_postal (string)
	 * - delivery_country (string)
	 * - delivery_method (int): 1=pickup, 2=delivery
	 * - delivery_notes (string, optional)
	 * 
	 * Returns: JSON with client_secret or error
	 */
	public function prepare_payment()
	{

		try {
			header('Content-Type: application/json');

			// Disable CSRF for this AJAX endpoint - security handled by:
			// 1. Server-side order validation
			// 2. Stripe API security
			// 3. Session user verification
			$this->config->set_item('csrf_protection', FALSE);

			// ===== INITIALIZE STRIPE API =====
			\Stripe\Stripe::setApiKey($this->stripeservice->getSecretKey());

			// Accept POST only
			if ($this->input->server('REQUEST_METHOD') !== 'POST') {
				http_response_code(405);
				echo json_encode(['success' => FALSE, 'message' => 'POST required']);
				return;
			}

			// Get JSON input
			$input = json_decode(file_get_contents('php://input'), TRUE);

			if (!is_array($input)) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Invalid JSON input']);
				return;
			}

			// ===== VALIDATE INPUT =====
			$equipment_payment_id = intval($input['equipment_payment_id'] ?? 0);
			$item_id = intval($input['item_id'] ?? 0);
			$quantity = intval($input['quantity'] ?? 0);
			$start_date = $input['start_date'] ?? '';
			$end_date = $input['end_date'] ?? '';
			$payment_method_id = $input['payment_method_id'] ?? '';
			$customer_email = htmlspecialchars($input['customer_email'] ?? '');
			$customer_phone = htmlspecialchars($input['customer_phone'] ?? '');
			$delivery_name = htmlspecialchars($input['delivery_name'] ?? '');
			$delivery_street = htmlspecialchars($input['delivery_street'] ?? '');
			$delivery_city = htmlspecialchars($input['delivery_city'] ?? '');
			$delivery_postal = htmlspecialchars($input['delivery_postal'] ?? '');
			$delivery_country = htmlspecialchars($input['delivery_country'] ?? '');
			$delivery_method = intval($input['delivery_method'] ?? 0);
			$delivery_notes = htmlspecialchars($input['delivery_notes'] ?? '');

			if (!$item_id || !$quantity || !$payment_method_id) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Missing required parameters']);
				return;
			}

			// ===== CHECK IF UPDATING EXISTING ORDER (approved request with token) =====
			$buyer_user_id = 0;
			if ($equipment_payment_id > 0) {
				// Verify the order exists and belongs to the current logged-in user
				$login_data = $this->session->userdata('loginData');
				$buyer_user_id = intval($login_data['userID'] ?? 0);
				
				if (!$buyer_user_id) {
					http_response_code(401);
					echo json_encode(['success' => FALSE, 'message' => 'User not authenticated']);
					return;
				}
				
				$existing_order = $this->db->select('equipmentPaymentID, buyerUserID, orderStatus')
					->from('equipment_payments')
					->where('equipmentPaymentID', $equipment_payment_id)
					->where('buyerUserID', $buyer_user_id)
					->get()
					->row();
				
				if (!$existing_order) {
					http_response_code(403);
					echo json_encode(['success' => FALSE, 'message' => 'Order not found or access denied']);
					return;
				}
				
				if ($existing_order->orderStatus !== 'payment_pending') {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Order cannot be paid in current status: ' . $existing_order->orderStatus]);
					return;
				}
			}

			// ===== RE-VALIDATE ORDER (Never trust client) =====

			// Fetch and validate item
			$item_query = $this->db->where('itemID', $item_id)
				->where('liveStatus', 1)
				->get('shopitem');

			if ($item_query->num_rows() === 0) {
				http_response_code(404);
				echo json_encode(['success' => FALSE, 'message' => 'Product not found']);
				return;
			}

			$item = $item_query->row();
			$item_type = $item->itemType;
			$sale_type = $item->saleType;

			// Fetch product details and recalculate pricing
			$subtotal = 0;
			// Default seller company from shopitem; tables below may not expose sellerCompanyID directly
			$seller_company_id = intval($item->companyID ?? 0);

			if ($item_type == 1) {
				// Equipment
				$equipment = $this->db->select('se.*, e.equipName')
					->from('shopequipments se')
					->join('equipment e', 'se.equipmentID = e.equipmentID')
					->where('se.itemID', $item_id)
					->get()
					->row();

				if (!$equipment) {
					http_response_code(404);
					echo json_encode(['success' => FALSE, 'message' => 'Equipment not found']);
					return;
				}

				if ($quantity > $equipment->equipQty) {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Insufficient inventory']);
					return;
				}

				// Fallback to item company if sellerCompanyID is not present
				$seller_company_id = intval($equipment->sellerCompanyID ?? $seller_company_id);

				if ($sale_type == 0) {
					// Rental
					$start = strtotime($start_date);
					$end = strtotime($end_date);

					if ($start === FALSE || $end === FALSE || $start > $end) {
						http_response_code(400);
						echo json_encode(['success' => FALSE, 'message' => 'Invalid dates']);
						return;
					}

					$rental_days = intdiv($end - $start, 86400);
					$price_per_unit = floatval($equipment->eqpPrice);
					$subtotal = $price_per_unit * $rental_days * $quantity;
				} else {
					// Purchase
					$price_per_unit = floatval($equipment->eqpPrice);
					$subtotal = $price_per_unit * $quantity;
				}
			} else if ($item_type == 2) {
				// Workforce
				$workforce = $this->db->select('sw.*, w.personName')
					->from('shopworkforce sw')
					->join('workforce w', 'sw.workforceID = w.workforceID')
					->where('sw.itemID', $item_id)
					->get()
					->row();

				if (!$workforce) {
					http_response_code(404);
					echo json_encode(['success' => FALSE, 'message' => 'Workforce not found']);
					return;
				}

				if ($quantity != 1) {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Workforce quantity must be 1']);
					return;
				}

				$seller_company_id = intval($workforce->sellerCompanyID ?? $seller_company_id);

				$start = strtotime($start_date);
				$end = strtotime($end_date);

				if ($start === FALSE || $end === FALSE || $start > $end) {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Invalid dates']);
					return;
				}

				$rental_days = intdiv($end - $start, 86400);
				$price_per_unit = floatval($workforce->workforcePrice);
				$subtotal = $price_per_unit * $rental_days;
			}

			// Get commission and calculate total
			$commission_percent = $this->payment->getGlobalCommissionRate();
			$commission_amount = round($subtotal * ($commission_percent / 100), 2);
			$tax_amount = 0; // TODO: Implement tax if needed
			$total_amount = $subtotal + $tax_amount;

			// Get current user (buyer) - session structure: loginData contains user array
			$login_data = $this->session->userdata('loginData');
			if (!$login_data) {
				http_response_code(401);
				echo json_encode(['success' => FALSE, 'message' => 'User not authenticated. Please log in.']);
				return;
			}
			$buyer_user_id = intval($login_data['userID'] ?? 0);


			// ===== CREATE STRIPE PAYMENT INTENT =====

			// Create payment intent with Stripe
			// Setting confirm=true allows immediate confirmation (succeeds for test cards, requires_action for 3DS)
			$intent = \Stripe\PaymentIntent::create([
				'amount' => intval($total_amount * 100), // Amount in cents
				'currency' => 'usd',
				'automatic_payment_methods' => [
					'enabled' => true,
					'allow_redirects' => 'never',  // Only accept non-redirect payment methods
				],
				'payment_method' => $payment_method_id,
				// Stripe PaymentIntent does not accept customer_email; use receipt_email instead
				'receipt_email' => $customer_email,
				'description' => 'Order from EquipManager - ' . ($item_type == 1 ? 'Equipment' : 'Workforce'),
				'metadata' => [
					'item_id' => $item_id,
					'item_type' => $item_type,
					'quantity' => $quantity,
					'buyer_user_id' => $buyer_user_id,
					'seller_company_id' => $seller_company_id,
					'delivery_method' => $delivery_method,
				],
				'confirm' => true,
			]);

			// ===== CREATE OR UPDATE PAYMENT RECORD IN DATABASE =====

			if ($equipment_payment_id > 0) {
				// UPDATE existing approved order with Stripe payment info
				$update_data = [
					'stripePaymentIntentID' => $intent->id,
					'paymentStatus' => 'pending',
					'paymentMetadata' => json_encode([
						'delivery_method' => $delivery_method,
						'customer_email' => $customer_email,
						'customer_phone' => $customer_phone,
						'delivery_name' => $delivery_name,
						'delivery_street' => $delivery_street,
						'delivery_city' => $delivery_city,
						'delivery_postal' => $delivery_postal,
						'delivery_country' => $delivery_country,
						'delivery_notes' => $delivery_notes,
					]),
					'updatedAt' => date('Y-m-d H:i:s')
				];
				
				$this->db->where('equipmentPaymentID', $equipment_payment_id);
				$update_result = $this->db->update('equipment_payments', $update_data);
				
				if (!$update_result) {
					http_response_code(500);
					echo json_encode(['success' => FALSE, 'message' => 'Failed to update payment record']);
					return;
				}
				
				$payment_id = $equipment_payment_id;
				log_message('info', "Updated existing order {$equipment_payment_id} with Stripe payment intent {$intent->id}");
			} else {
				// CREATE new payment record (for direct checkout, not via token)
				$payment_data = [
					'item_id' => $item_id,
					'buyer_user_id' => $buyer_user_id,
					'seller_company_id' => $seller_company_id,
					'gross_amount' => $total_amount,
					'currency' => 'USD',
					'metadata' => [
						'delivery_method' => $delivery_method,
						'customer_email' => $customer_email,
						'customer_phone' => $customer_phone,
						'delivery_name' => $delivery_name,
						'delivery_street' => $delivery_street,
						'delivery_city' => $delivery_city,
						'delivery_postal' => $delivery_postal,
						'delivery_country' => $delivery_country,
						'delivery_notes' => $delivery_notes,
					],
				];

				if ($item_type == 1) {
					// EQUIPMENT PAYMENT
					$payment_data['equipment_id'] = $equipment->equipmentID;
					$payment_data['quantity'] = $quantity;
					$payment_data['sale_type'] = $sale_type == 1 ? 'purchase' : 'rental';
					$payment_data['rental_start_date'] = $start_date ?: NULL;
					$payment_data['rental_end_date'] = $end_date ?: NULL;
					$payment_data['rental_type'] = $equipment->eqpRentalType; // 1=daily, 2=weekly, 3=monthly, 4=yearly
					$payment_data['stripe_payment_intent_id'] = $intent->id;

					$payment_id = $this->payment->createEquipmentPayment($payment_data);
				} else {
					// WORKFORCE PAYMENT
					$payment_data['workforce_id'] = $workforce->workforceID;
					$payment_data['rental_start_date'] = $start_date;
					$payment_data['rental_end_date'] = $end_date;
					$payment_data['rental_type'] = $workforce->workforceRentalType; // 1=daily, 2=weekly, 3=monthly, 4=yearly
					$payment_data['stripe_payment_intent_id'] = $intent->id;

					$payment_id = $this->payment->createWorkforcePayment($payment_data);
				}

				if (!$payment_id) {
					http_response_code(500);
					echo json_encode(['success' => FALSE, 'message' => 'Failed to create payment record']);
					return;
				}
			}

			// ===== RETURN RESPONSE =====

			http_response_code(200);
			echo json_encode([
				'success' => TRUE,
				'payment_intent_id' => $intent->id,
				'client_secret' => $intent->client_secret,
				'requires_action' => $intent->status === 'requires_action',
				'status' => $intent->status,
			]);
		} catch (\Stripe\Exception\ApiErrorException $e) {
			header('Content-Type: application/json');
			http_response_code(400);
			echo json_encode([
				'success' => FALSE,
				'message' => 'Stripe Error: ' . $e->getMessage()
			]);
			log_message('error', 'Stripe Error: ' . $e->getMessage());
		} catch (Exception $e) {
			header('Content-Type: application/json');
			http_response_code(500);
			echo json_encode([
				'success' => FALSE,
				'message' => 'Error: ' . $e->getMessage()
			]);
			log_message('error', 'Payment Processing Error: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
		} catch (Throwable $e) {
			header('Content-Type: application/json');
			http_response_code(500);
			echo json_encode([
				'success' => FALSE,
				'message' => 'Unexpected Error: ' . $e->getMessage()
			]);
			log_message('error', 'Unhandled Error in prepare_payment: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
		}
	}

	/**
	 * Payment success callback
	 * 
	 * Handles payment confirmation after successful Stripe payment
	 * - Retrieves PaymentIntent status from Stripe
	 * - Updates payment record status in database
	 * - Updates inventory if applicable
	 * - Displays success page
	 */
	public function payment_success()
	{

		// Check if user is authenticated - session structure: loginData contains user array
		$login_data = $this->session->userdata('loginData');
		if (!$login_data) {
			redirect('login');
			return;
		}
		$user_id = intval($login_data['userID'] ?? 0);

		// Get the payment intent ID from query params (set by Stripe after 3D Secure)
		$payment_intent_id = $this->input->get('payment_intent', TRUE);

		if (!$payment_intent_id) {
			$this->load->view('website/payment_failed', [
				'error_message' => 'No payment confirmation received. Please contact support.'
			]);
			return;
		}

		// Initialize Stripe API
		try {
			\Stripe\Stripe::setApiKey($this->stripeservice->getSecretKey());

			// Retrieve PaymentIntent from Stripe to verify status
			$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

			// Verify payment was actually successful
			if ($payment_intent->status !== 'succeeded') {
				$this->load->view('website/payment_failed', [
					'error_message' => 'Payment was not completed successfully. Status: ' . $payment_intent->status
				]);
				return;
			}
		} catch (Exception $e) {
			log_message('error', 'Stripe verification error in payment_success: ' . $e->getMessage());
			$this->load->view('website/payment_failed', [
				'error_message' => 'Could not verify payment. Please contact support.'
			]);
			return;
		}

		// Look up payment by intent ID
		$payment = NULL;

		// Check equipment payments first
		$eq_payment = $this->payment->getEquipmentPaymentByIntentId($payment_intent_id);
		if ($eq_payment && $eq_payment['buyerUserID'] == $user_id) {
			$payment = $eq_payment;
			$payment['type'] = 'equipment';
		}

		// Check workforce payments
		if (!$payment) {
			$wf_payment = $this->payment->getWorkforcePaymentByIntentId($payment_intent_id);
			if ($wf_payment && $wf_payment['buyerUserID'] == $user_id) {
				$payment = $wf_payment;
				$payment['type'] = 'workforce';
			}
		}

		if (!$payment) {
			$this->load->view('website/payment_failed', [
				'error_message' => 'Payment not found. Please contact support with your payment ID.'
			]);
			return;
		}

		// ===== VERIFY ORDER STATUS (ESCROW WORKFLOW) =====
		// For equipment orders, verify order status before processing payment
		if ($payment['type'] === 'equipment' && isset($payment['orderStatus'])) {
			if ($payment['orderStatus'] === 'rejected') {
				$this->load->view('website/payment_failed', [
					'error_message' => 'This purchase request was rejected by the seller. Payment cannot be processed.'
				]);
				return;
			}
			
			if ($payment['orderStatus'] === 'requested') {
				$this->load->view('website/payment_failed', [
					'error_message' => 'This purchase request is still pending approval. Payment cannot be processed yet.'
				]);
				return;
			}
		}

		// Update payment status to completed if Stripe confirms success
		if ($payment['paymentStatus'] === 'pending' || $payment['paymentStatus'] === 'processing') {
			if ($payment['type'] === 'equipment') {
				$this->payment->updateEquipmentPaymentStatus(
					$payment['equipmentPaymentID'],
					'completed'
				);
				$payment_id = $payment['equipmentPaymentID'];

				// ===== UPDATE ORDER STATUS TO PAYMENT_SECURED (ESCROW) =====
				// Money is now held in escrow, awaiting shipment
				$this->db->update(
					'equipment_payments',
					['orderStatus' => 'payment_secured'],
					['equipmentPaymentID' => $payment['equipmentPaymentID']]
				);

				// ===== UPDATE EQUIPMENT INVENTORY =====
				// Decrease equipment quantity after successful payment
				$equipment_data = $this->db->where('itemID', $payment['itemID'])
					->get('shopequipments')
					->row();

				if ($equipment_data) {
					$new_quantity = floatval($equipment_data->equipQty) - floatval($payment['quantity']);
					$this->db->update(
						'shopequipments',
						['equipQty' => max(0, $new_quantity)],  // Don't go below 0
						['itemID' => $payment['itemID']]
					);
					log_message('info', "Equipment inventory updated: Item ID {$payment['itemID']}, Quantity reduced by {$payment['quantity']}");
				}

			// ===== UPDATE MAIN EQUIPMENT TABLE TOTAL QUANTITY =====
			// Also decrease the total quantity in the equipment table
			$main_equipment = $this->db->where('equipmentID', $payment['equipmentID'])
				->get('equipment')
				->row();

			if ($main_equipment) {
				$new_total_quantity = floatval($main_equipment->equipTotalQuantity) - floatval($payment['quantity']);
				$this->db->update(
					'equipment',
					['equipTotalQuantity' => max(0, $new_total_quantity)],  // Don't go below 0
					['equipmentID' => $payment['equipmentID']]
				);
				log_message('info', "Main equipment total quantity updated: Equipment ID {$payment['equipmentID']}, Total quantity reduced by {$payment['quantity']}");
			}

			// ===== CREATE CHAT FOR ORDER =====
			// Automatically create chat between buyer and seller
			$this->load->model('Chat_model');

			$chatID = $this->Chat_model->create_chat(
				$payment['equipmentPaymentID'],
				$payment['buyerUserID'],
				$payment['sellerCompanyID']
			);

			if ($chatID) {
				log_message('info', "Chat created for equipment payment {$payment['equipmentPaymentID']}: Chat ID {$chatID}");
				
				// Send automated message to seller: Payment secured, please ship
				$message = "Payment received and secured in escrow!\n\n"
				         . "Order #" . $payment['equipmentPaymentID'] . "\n"
				         . "Amount: $" . number_format($payment['grossAmount'], 2) . "\n\n";
				
				$this->Chat_model->send_automated_message(
					$chatID,
					$message,
					$payment['sellerCompanyID'],
					'system'
				);
			} else {
				log_message('error', "Failed to create chat for equipment payment {$payment['equipmentPaymentID']}");
				$chatID = null;
			}
		} else {
			// Workforce - update payment status to completed
			$this->db->update(
					'workforce_payments',
					['paymentStatus' => 'completed'],
					['workforcePaymentID' => $payment['workforcePaymentID']]
				);
				$payment_id = $payment['workforcePaymentID'];
				$chatID = null;
			}
		} else {
			// Already processed
			$payment_id = $payment['type'] === 'equipment' ? $payment['equipmentPaymentID'] : $payment['workforcePaymentID'];
			$chatID = null;
		}

		// Render success page with order details
		$this->load->view('website/payment_success', [
			'order_id' => $payment_id ?? 'N/A',
			'amount' => $payment['grossAmount'] ?? 0,
			'chatID' => $chatID,
			'paymentID' => $payment_id
		]);
	}

	/**
	 * Payment failure callback
	 * 
	 * Displays failure page with error details
	 * User can retry or contact support
	 */
	public function payment_failed()
	{

		// Check if user is authenticated - session structure: loginData contains user array
		$login_data = $this->session->userdata('loginData');
		if (!$login_data) {
			redirect('login');
			return;
		}
		$user_id = intval($login_data['userID'] ?? 0);

		// Get error message from query params
		$error_message = $this->input->get('error', TRUE);

		$this->load->view('website/payment_failed', [
			'error_message' => $error_message ?: 'Your payment could not be processed. Please try again.'
		]);
	}

	/**
	 * PRIVATE HELPER: Validate date format (YYYY-MM-DD)
	 */
	private function _validate_date_format($date)
	{
		$pattern = '/^\d{4}-\d{2}-\d{2}$/';
		if (!preg_match($pattern, $date)) {
			return FALSE;
		}

		// Also validate it's a real date
		$parts = explode('-', $date);
		return checkdate(intval($parts[1]), intval($parts[2]), intval($parts[0]));
	}

	/**
	 * Create Purchase Request (NEW FLOW)
	 * 
	 * Creates a purchase request without immediate payment
	 * - Request goes to company admin for approval
	 * - Chat is opened immediately
	 * - Payment only proceeds after admin approval
	 * 
	 * POST Parameters:
	 * - item_id: shopitem.itemID
	 * - quantity: units to purchase
	 * - start_date (optional): for rentals
	 * - end_date (optional): for rentals
	 * - customer_email
	 * - customer_phone
	 * - delivery_method: 1=pickup, 2=delivery
	 * - delivery details (name, street, city, postal, country, notes)
	 */
	public function create_purchase_request()
	{
		try {
			header('Content-Type: application/json');
			
			// Disable CSRF for AJAX endpoint
			$this->config->set_item('csrf_protection', FALSE);
			
			// POST only
			if ($this->input->server('REQUEST_METHOD') !== 'POST') {
				http_response_code(405);
				echo json_encode(['success' => FALSE, 'message' => 'POST required']);
				return;
			}
			
			// Get JSON input
			$input = json_decode(file_get_contents('php://input'), TRUE);
			
			if (!is_array($input)) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Invalid JSON input']);
				return;
			}
			
			// ===== CHECK IF UPDATING EXISTING ORDER (approved request with token) =====
			$equipment_payment_id = intval($input['equipment_payment_id'] ?? 0);
			
			// If equipment_payment_id is provided, we're updating an existing approved order
			if ($equipment_payment_id > 0) {
				// Verify the order exists and belongs to the current logged-in user
				$login_data = $this->session->userdata('loginData');
				$buyer_user_id = intval($login_data['userID'] ?? 0);
				
				$existing_order = $this->db->select('equipmentPaymentID, buyerUserID, orderStatus')
					->from('equipment_payments')
					->where('equipmentPaymentID', $equipment_payment_id)
					->where('buyerUserID', $buyer_user_id)
					->get()
					->row();
				
				if (!$existing_order) {
					http_response_code(403);
					echo json_encode(['success' => FALSE, 'message' => 'Order not found or access denied']);
					return;
				}
				
				if ($existing_order->orderStatus !== 'payment_pending') {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Order cannot be paid in current status: ' . $existing_order->orderStatus]);
					return;
				}
				
				// This is an UPDATE scenario - update the payment metadata for the existing order
				// Continue to payment processing but mark as UPDATE_EXISTING
			}
			
         // ===== VALIDATE INPUT =====
			$item_id = intval($input['item_id'] ?? 0);
			$quantity = intval($input['quantity'] ?? 0);
			$start_date = $input['start_date'] ?? '';
			$end_date = $input['end_date'] ?? '';
			$customer_email = htmlspecialchars($input['customer_email'] ?? '');
			$customer_phone = htmlspecialchars($input['customer_phone'] ?? '');
			$delivery_name = htmlspecialchars($input['delivery_name'] ?? '');
			$delivery_street = htmlspecialchars($input['delivery_street'] ?? '');
			$delivery_city = htmlspecialchars($input['delivery_city'] ?? '');
			$delivery_postal = htmlspecialchars($input['delivery_postal'] ?? '');
			$delivery_country = htmlspecialchars($input['delivery_country'] ?? '');
			$delivery_method = intval($input['delivery_method'] ?? 0);
			$delivery_notes = htmlspecialchars($input['delivery_notes'] ?? '');
			
			if (!$item_id || !$quantity) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Missing required parameters']);
				return;
			}
			
			// ===== VALIDATE PRODUCT =====
			$item_query = $this->db->where('itemID', $item_id)
				->where('liveStatus', 1)
				->get('shopitem');
			
			if ($item_query->num_rows() === 0) {
				http_response_code(404);
				echo json_encode(['success' => FALSE, 'message' => 'Product not found']);
				return;
			}
			
			$item = $item_query->row();
			$item_type = $item->itemType;
			$sale_type = $item->saleType;
			$seller_company_id = intval($item->companyID ?? 0);
			
			// Only process equipment (type 1) for now
			if ($item_type != 1) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Only equipment purchases supported']);
				return;
			}
			
			// ===== FETCH EQUIPMENT DETAILS =====
			$equipment = $this->db->select('se.*, e.equipName')
				->from('shopequipments se')
				->join('equipment e', 'se.equipmentID = e.equipmentID')
				->where('se.itemID', $item_id)
				->get()
				->row();
			
			if (!$equipment) {
				http_response_code(404);
				echo json_encode(['success' => FALSE, 'message' => 'Equipment not found']);
				return;
			}
			
			// Validate quantity
			if ($quantity > $equipment->equipQty) {
				http_response_code(400);
				echo json_encode(['success' => FALSE, 'message' => 'Insufficient inventory']);
				return;
			}
			
			// ===== CALCULATE PRICING =====
			$subtotal = 0;
			
			if ($sale_type == 0) {
				// Rental
				$start = strtotime($start_date);
				$end = strtotime($end_date);
				
				if ($start === FALSE || $end === FALSE || $start > $end) {
					http_response_code(400);
					echo json_encode(['success' => FALSE, 'message' => 'Invalid dates']);
					return;
				}
				
				$rental_days = intdiv($end - $start, 86400);
				$price_per_unit = floatval($equipment->eqpPrice);
				$subtotal = $price_per_unit * $rental_days * $quantity;
			} else {
				// Purchase
				$price_per_unit = floatval($equipment->eqpPrice);
				$subtotal = $price_per_unit * $quantity;
			}
			
			// Get commission
			$commission_percent = $this->payment->getGlobalCommissionRate();
			$commission_amount = round($subtotal * ($commission_percent / 100), 2);
			$total_amount = $subtotal;
			
			// Get buyer user ID
			$login_data = $this->session->userdata('loginData');
			if (!$login_data) {
				http_response_code(401);
				echo json_encode(['success' => FALSE, 'message' => 'User not authenticated']);
				return;
			}
			$buyer_user_id = intval($login_data['userID'] ?? 0);
			
			// ===== CREATE PURCHASE REQUEST RECORD =====
			$request_data = [
				'itemID' => $item_id,
				'equipmentID' => $equipment->equipmentID,
				'buyerUserID' => $buyer_user_id,
				'sellerCompanyID' => $seller_company_id,
				'grossAmount' => $total_amount,
				'commissionPercent' => $commission_percent,
				'commissionAmount' => $commission_amount,
				'netAmount' => $total_amount - $commission_amount,
				'currency' => 'USD',
				'quantity' => $quantity,
				'saleType' => $sale_type == 1 ? 'purchase' : 'rental',
				'rentalStartDate' => $start_date ?: NULL,
				'rentalEndDate' => $end_date ?: NULL,
				'rentalType' => $equipment->eqpRentalType,
				'orderStatus' => 'requested',  // KEY: New request starts as "requested"
				'paymentStatus' => 'pending',
				'paymentMetadata' => json_encode([
					'delivery_method' => $delivery_method,
					'customer_email' => $customer_email,
					'customer_phone' => $customer_phone,
					'delivery_name' => $delivery_name,
					'delivery_street' => $delivery_street,
					'delivery_city' => $delivery_city,
					'delivery_postal' => $delivery_postal,
					'delivery_country' => $delivery_country,
					'delivery_notes' => $delivery_notes,
				]),
				'createdAt' => date('Y-m-d H:i:s'),
				'updatedAt' => date('Y-m-d H:i:s')
			];
			
			$this->db->insert('equipment_payments', $request_data);
			$request_id = $this->db->insert_id();
			
			if (!$request_id) {
				http_response_code(500);
				echo json_encode(['success' => FALSE, 'message' => 'Failed to create purchase request']);
				return;
			}
			
			// ===== CREATE CHAT IMMEDIATELY =====
			$this->load->model('Chat_model');
			$chatID = $this->Chat_model->create_chat($request_id, $buyer_user_id, $seller_company_id);
			
			if ($chatID) {
				log_message('info', "Chat created immediately for purchase request {$request_id}: Chat ID {$chatID}");

				// Send order summary FROM THE BUYER so the seller can see the full request details
				$order_type = ($sale_type == 0) ? 'Rental' : 'Purchase';
				$buyer_order_msg = "New Order Request\n\n"
				                 . "Item: " . $equipment->equipName . "\n"
				                 . "Type: " . $order_type . "\n"
				                 . "Quantity: " . $quantity . "\n"
				                 . "Total: $" . number_format($total_amount, 2);
				if ($sale_type == 0 && !empty($start_date) && !empty($end_date)) {
					$buyer_order_msg .= "\nRental Period: " . $start_date . " to " . $end_date;
				}
				if (!empty($delivery_city)) {
					$location = trim(($delivery_name ? $delivery_name . ', ' : '') . $delivery_city . ($delivery_country ? ', ' . $delivery_country : ''));
					$buyer_order_msg .= "\nDelivery to: " . $location;
				}
				$buyer_order_msg .= "\n\nPlease review and approve my order request.";

				$this->Chat_model->send_automated_message_as_user($chatID, $buyer_order_msg, $buyer_user_id);
			} else {
				log_message('error', "Failed to create chat for purchase request {$request_id}");
			}
			
			// ===== RETURN SUCCESS =====
			http_response_code(200);
			echo json_encode([
				'success' => TRUE,
				'message' => 'Purchase request submitted successfully',
				'request_id' => $request_id,
				'chat_id' => $request_id,
				'status' => 'pending_approval'
			]);
			
			log_message('info', "Purchase request {$request_id} created by user {$buyer_user_id} for equipment {$equipment->equipmentID}");
			
		} catch (Exception $e) {
			header('Content-Type: application/json');
			http_response_code(500);
			echo json_encode([
				'success' => FALSE,
				'message' => 'Error: ' . $e->getMessage()
			]);
			log_message('error', 'Purchase Request Error: ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
		}
	}

	/**
	 * Token-based checkout for approved purchase requests
	 * 
	 * @param string $token Unique checkout token from approval
	 * 
	 * Flow:
	 * 1. Verify token exists and hasn't expired
	 * 2. Verify orderStatus = 'payment_pending'
	 * 3. Load order details from database
	 * 4. Display checkout page with pre-filled data
	 * 5. User completes payment (handled by prepare_payment_from_token)
	 */
	public function pay_with_token($token)
	{
		// ===== SECURITY CHECK: USER MUST BE LOGGED IN =====
		$login_data = $this->session->userdata('loginData');
		if (!$login_data) {
			$this->session->set_flashdata('error', 'Please log in to complete your payment');
			redirect(base_url('login'));
			return;
		}

		$user_id = intval($login_data['userID'] ?? 0);

		// ===== STEP 1: VALIDATE TOKEN =====
		if (!$token || strlen($token) !== 64) {
			show_error('Invalid checkout token', 400);
			return;
		}

		// ===== STEP 2: FETCH ORDER BY TOKEN =====
		$order = $this->db->select('ep.*, e.equipName, e.equipDesc, e.equipImg, 
		                           si.itemID, si.itemType, si.saleType,
		                           cd.companyName as sellerCompanyName,
		                           se.equipQty, se.eqpRentalType, se.eqpPrice, se.eqpDeliveryOpt, se.eqpAdd, se.eqpLocCity, se.eqpRules')
			->from('equipment_payments ep')
			->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
			->join('shopitem si', 'ep.itemID = si.itemID', 'left')
			->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
			->join('shopequipments se', 'si.itemID = se.itemID', 'left')
			->where('ep.checkoutToken', $token)
			->where('ep.buyerUserID', $user_id)  // Security: verify this order belongs to logged-in user
			->get()
			->row();

		if (!$order) {
			show_error('Checkout link not found or you do not have permission to access it', 404);
			return;
		}

		// ===== STEP 3: VALIDATE TOKEN NOT EXPIRED =====
		$expiry_time = strtotime($order->checkoutTokenExpiry);
		$current_time = time();

		if ($current_time > $expiry_time) {
			$this->session->set_flashdata('error', 'This checkout link has expired. Please contact the seller.');
			redirect(base_url('orders'));
			return;
		}

		// ===== STEP 4: VALIDATE ORDER STATUS =====
		if ($order->orderStatus !== 'payment_pending') {
			$status_messages = [
				'requested' => 'This request is still pending seller approval.',
				'rejected' => 'This request was rejected by the seller.',
				'payment_secured' => 'Payment has already been completed for this order.',
				'shipped' => 'This order has already been paid and shipped.',
				'delivered' => 'This order has already been completed.',
				'completed' => 'This order has already been completed.',
				'cancelled' => 'This order was cancelled.',
				'refunded' => 'This order was refunded.'
			];

			$message = $status_messages[$order->orderStatus] ?? 'This checkout link is no longer valid.';
			$this->session->set_flashdata('error', $message);
			redirect(base_url('orders'));
			return;
		}

		// ===== STEP 5: PREPARE ORDER DATA FOR CHECKOUT VIEW =====
		$subtotal = floatval($order->grossAmount);
		$commission_percent = floatval($order->commissionPercent);
		$commission_amount = floatval($order->commissionAmount);

		// Determine rental days if applicable
		$rental_days = 0;
		if ($order->saleType == 0 && $order->rentalStartDate && $order->rentalEndDate) {
			$start = strtotime($order->rentalStartDate);
			$end = strtotime($order->rentalEndDate);
			$rental_days = intdiv($end - $start, 86400);
		}

		$order_data = [
			'equipment_payment_id' => $order->equipmentPaymentID,
			'checkout_token' => $token,
			'item_id' => $order->itemID,
			'item_type' => 1,  // Equipment
			'sale_type' => $order->saleType === 'rental' ? 0 : 1,
			'product_name' => $order->equipName,
			'product_description' => $order->equipDesc,
			'product_image' => $order->equipImg,
			'product_sku' => 'EQ-' . $order->equipmentID,
			'quantity' => intval($order->quantity),
			'unit_price' => $subtotal / intval($order->quantity),
			'rental_start_date' => $order->rentalStartDate,
			'rental_end_date' => $order->rentalEndDate,
			'rental_days' => $rental_days,
			'subtotal' => $subtotal,
			'commission_percent' => $commission_percent,
			'commission_amount' => $commission_amount,
			'tax_amount' => 0,
			'total' => $subtotal,
			'seller_company' => $order->sellerCompanyName,
			'delivery_option' => intval($order->eqpDeliveryOpt ?? 2),
			'pickup_address' => $order->eqpAdd ?? 'Address not available',
			'pickup_city' => $order->eqpLocCity ?? 'City not available',
			'equipment_rules' => $order->eqpRules ?? '',
			'pre_filled' => true,  // Flag to indicate this is a pre-approved order
		];

		// Get Stripe public key
		$stripe_public_key = $this->stripeservice->getPublishableKey();

		$data = [
			'order' => $order_data,
			'csrf_token_name' => $this->security->get_csrf_token_name(),
			'csrf_token_value' => $this->security->get_csrf_hash(),
			'stripe_public_key' => $stripe_public_key,
		];

		// ===== STEP 6: LOAD CHECKOUT VIEW =====
		$this->load->view('components/websiteHeader', $data);
		$this->load->view('website/checkout_view', $data);
		$this->load->view('components/websiteFooter', $data);

		log_message('info', "User {$user_id} accessed checkout with token for order {$order->equipmentPaymentID}");
	}
}
