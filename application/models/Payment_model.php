<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Payment Model - Segregated Payments Version
 * 
 * Handles database operations for segregated equipment and workforce payments
 * with global commission structure
 * 
 * @package    EquipManager
 * @subpackage Models
 * @category   Payment
 * @version    2.0
 */

class Payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Generic_model', 'generic');
    }

    // =============================================
    // EQUIPMENT PAYMENT METHODS
    // =============================================

    /**
     * Create equipment payment with commission calculation
     * 
     * @param array $data Payment data
     * @return int|false Payment ID or false on failure
     */
    public function createEquipmentPayment($data)
    {
        // Get global commission rate
        $commission_percent = $this->getGlobalCommissionRate();

        // Calculate commission
        $gross_amount = floatval($data['gross_amount']);
        $commission_amount = round($gross_amount * ($commission_percent / 100), 2);
        $net_amount = $gross_amount - $commission_amount;

        $payment_data = [
            'itemID' => $data['item_id'],
            'equipmentID' => $data['equipment_id'],
            'buyerUserID' => $data['buyer_user_id'],
            'sellerCompanyID' => $data['seller_company_id'],
            'stripeSessionID' => isset($data['stripe_session_id']) ? $data['stripe_session_id'] : null,
            'stripePaymentIntentID' => isset($data['stripe_payment_intent_id']) ? $data['stripe_payment_intent_id'] : null,
            'grossAmount' => $gross_amount,
            'commissionPercent' => $commission_percent,
            'commissionAmount' => $commission_amount,
            'netAmount' => $net_amount,
            'currency' => isset($data['currency']) ? $data['currency'] : 'USD',
            'quantity' => isset($data['quantity']) ? $data['quantity'] : 1,
            'saleType' => $data['sale_type'], // 'rental' or 'purchase'
            'rentalStartDate' => isset($data['rental_start_date']) ? $data['rental_start_date'] : null,
            'rentalEndDate' => isset($data['rental_end_date']) ? $data['rental_end_date'] : null,
            'rentalType' => isset($data['rental_type']) ? $data['rental_type'] : null,
            'paymentStatus' => 'pending',
            'paymentMetadata' => isset($data['metadata']) ? json_encode($data['metadata']) : null,
        ];

        $this->generic->InsertData('equipment_payments', $payment_data);
        return $this->db->insert_id();
    }

    /**
     * Update equipment payment status
     * 
     * @param int $payment_id Payment ID
     * @param string $status New status
     * @param array $additional_data Additional fields to update
     * @return bool Success status
     */
    public function updateEquipmentPaymentStatus($payment_id, $status, $additional_data = [])
    {
        $update_data = array_merge(['paymentStatus' => $status], $additional_data);
        $this->generic->Update('equipment_payments', ['equipmentPaymentID' => $payment_id], $update_data);
        return true;
    }

    /**
     * Get equipment payment by ID
     * 
     * @param int $payment_id Payment ID
     * @return array|false Payment data or false
     */
    public function getEquipmentPaymentById($payment_id)
    {
        $result = $this->generic->GetData('equipment_payments', ['equipmentPaymentID' => $payment_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get equipment payment by Stripe session ID
     * 
     * @param string $session_id Stripe session ID
     * @return array|false Payment data or false
     */
    public function getEquipmentPaymentBySessionId($session_id)
    {
        $result = $this->generic->GetData('equipment_payments', ['stripeSessionID' => $session_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get equipment payment by Stripe payment intent ID
     * 
     * @param string $payment_intent_id Stripe payment intent ID
     * @return array|false Payment data or false
     */
    public function getEquipmentPaymentByIntentId($payment_intent_id)
    {
        $result = $this->generic->GetData('equipment_payments', ['stripePaymentIntentID' => $payment_intent_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get equipment payments for a specific buyer
     * 
     * @param int $user_id Buyer user ID
     * @return array|false Payments array or false
     */
    public function getEquipmentPaymentsByBuyer($user_id)
    {
        return $this->generic->GetData('equipment_payments', ['buyerUserID' => $user_id], 'createdAt', 'DESC');
    }

    /**
     * Get equipment payments for a specific company (seller)
     * 
     * @param int $company_id Company ID
     * @return array|false Payments array or false
     */
    public function getEquipmentPaymentsBySeller($company_id)
    {
        return $this->generic->GetData('equipment_payments', ['sellerCompanyID' => $company_id], 'createdAt', 'DESC');
    }

    // =============================================
    // WORKFORCE PAYMENT METHODS
    // =============================================

    /**
     * Create workforce payment with commission calculation
     * 
     * @param array $data Payment data
     * @return int|false Payment ID or false on failure
     */
    public function createWorkforcePayment($data)
    {
        // Get global commission rate
        $commission_percent = $this->getGlobalCommissionRate();

        // Calculate commission
        $gross_amount = floatval($data['gross_amount']);
        $commission_amount = round($gross_amount * ($commission_percent / 100), 2);
        $net_amount = $gross_amount - $commission_amount;

        $payment_data = [
            'itemID' => $data['item_id'],
            'workforceID' => $data['workforce_id'],
            'buyerUserID' => $data['buyer_user_id'],
            'sellerCompanyID' => $data['seller_company_id'],
            'stripeSessionID' => isset($data['stripe_session_id']) ? $data['stripe_session_id'] : null,
            'stripePaymentIntentID' => isset($data['stripe_payment_intent_id']) ? $data['stripe_payment_intent_id'] : null,
            'grossAmount' => $gross_amount,
            'commissionPercent' => $commission_percent,
            'commissionAmount' => $commission_amount,
            'netAmount' => $net_amount,
            'currency' => isset($data['currency']) ? $data['currency'] : 'USD',
            'rentalStartDate' => $data['rental_start_date'],
            'rentalEndDate' => $data['rental_end_date'],
            'rentalType' => $data['rental_type'],
            'paymentStatus' => 'pending',
            'paymentMetadata' => isset($data['metadata']) ? json_encode($data['metadata']) : null,
        ];

        $this->generic->InsertData('workforce_payments', $payment_data);
        return $this->db->insert_id();
    }

    /**
     * Update workforce payment status
     * 
     * @param int $payment_id Payment ID
     * @param string $status New status
     * @param array $additional_data Additional fields to update
     * @return bool Success status
     */
    public function updateWorkforcePaymentStatus($payment_id, $status, $additional_data = [])
    {
        $update_data = array_merge(['paymentStatus' => $status], $additional_data);
        $this->generic->Update('workforce_payments', ['workforcePaymentID' => $payment_id], $update_data);
        return true;
    }

    /**
     * Get workforce payment by ID
     * 
     * @param int $payment_id Payment ID
     * @return array|false Payment data or false
     */
    public function getWorkforcePaymentById($payment_id)
    {
        $result = $this->generic->GetData('workforce_payments', ['workforcePaymentID' => $payment_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get workforce payment by Stripe session ID
     * 
     * @param string $session_id Stripe session ID
     * @return array|false Payment data or false
     */
    public function getWorkforcePaymentBySessionId($session_id)
    {
        $result = $this->generic->GetData('workforce_payments', ['stripeSessionID' => $session_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get workforce payment by Stripe payment intent ID
     * 
     * @param string $payment_intent_id Stripe payment intent ID
     * @return array|false Payment data or false
     */
    public function getWorkforcePaymentByIntentId($payment_intent_id)
    {
        $result = $this->generic->GetData('workforce_payments', ['stripePaymentIntentID' => $payment_intent_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get workforce payments for a specific buyer
     * 
     * @param int $user_id Buyer user ID
     * @return array|false Payments array or false
     */
    public function getWorkforcePaymentsByBuyer($user_id)
    {
        return $this->generic->GetData('workforce_payments', ['buyerUserID' => $user_id], 'createdAt', 'DESC');
    }

    /**
     * Get workforce payments for a specific company (seller)
     * 
     * @param int $company_id Company ID
     * @return array|false Payments array or false
     */
    public function getWorkforcePaymentsBySeller($company_id)
    {
        return $this->generic->GetData('workforce_payments', ['sellerCompanyID' => $company_id], 'createdAt', 'DESC');
    }

    // =============================================
    // COMBINED PAYMENT METHODS (for views that show both)
    // =============================================

    /**
     * Get all payments for a buyer (equipment + workforce)
     * 
     * @param int $user_id Buyer user ID
     * @return array Combined payments array with type indicator
     */
    public function getAllPaymentsByBuyer($user_id)
    {
        $equipment = $this->getEquipmentPaymentsByBuyer($user_id);
        $workforce = $this->getWorkforcePaymentsByBuyer($user_id);

        $combined = [];

        if ($equipment) {
            foreach ($equipment as $payment) {
                $payment['paymentType'] = 'equipment';
                $combined[] = $payment;
            }
        }

        if ($workforce) {
            foreach ($workforce as $payment) {
                $payment['paymentType'] = 'workforce';
                $combined[] = $payment;
            }
        }

        // Sort by createdAt DESC
        usort($combined, function ($a, $b) {
            return strtotime($b['createdAt']) - strtotime($a['createdAt']);
        });

        return $combined;
    }

    /**
     * Get all payments for a seller (equipment + workforce)
     * 
     * @param int $company_id Company ID
     * @return array Combined payments array with type indicator
     */
    public function getAllPaymentsBySeller($company_id)
    {
        $equipment = $this->getEquipmentPaymentsBySeller($company_id);
        $workforce = $this->getWorkforcePaymentsBySeller($company_id);

        $combined = [];

        if ($equipment) {
            foreach ($equipment as $payment) {
                $payment['paymentType'] = 'equipment';
                $combined[] = $payment;
            }
        }

        if ($workforce) {
            foreach ($workforce as $payment) {
                $payment['paymentType'] = 'workforce';
                $combined[] = $payment;
            }
        }

        // Sort by createdAt DESC
        usort($combined, function ($a, $b) {
            return strtotime($b['createdAt']) - strtotime($a['createdAt']);
        });

        return $combined;
    }

    // =============================================
    // PAYOUT METHODS
    // =============================================

    /**
     * Create equipment payout
     * 
     * @param int $payment_id Equipment payment ID
     * @param int $company_id Company ID
     * @param float $payout_amount Net amount to payout
     * @return int|false Payout ID or false
     */
    public function createEquipmentPayout($payment_id, $company_id, $payout_amount)
    {
        $payout_data = [
            'equipmentPaymentID' => $payment_id,
            'companyID' => $company_id,
            'payoutAmount' => $payout_amount,
            'payoutStatus' => 'pending',
        ];

        $this->generic->InsertData('equipment_payouts', $payout_data);
        return $this->db->insert_id();
    }

    /**
     * Create workforce payout
     * 
     * @param int $payment_id Workforce payment ID
     * @param int $company_id Company ID
     * @param float $payout_amount Net amount to payout
     * @return int|false Payout ID or false
     */
    public function createWorkforcePayout($payment_id, $company_id, $payout_amount)
    {
        $payout_data = [
            'workforcePaymentID' => $payment_id,
            'companyID' => $company_id,
            'payoutAmount' => $payout_amount,
            'payoutStatus' => 'pending',
        ];

        $this->generic->InsertData('workforce_payouts', $payout_data);
        return $this->db->insert_id();
    }

    /**
     * Update equipment payout status
     * 
     * @param int $payout_id Payout ID
     * @param string $status New status
     * @param int $approved_by SuperAdmin user ID
     * @param string $notes Optional notes
     * @return bool Success status
     */
    public function updateEquipmentPayoutStatus($payout_id, $status, $approved_by = null, $notes = null)
    {
        $update_data = ['payoutStatus' => $status];

        if ($status === 'approved' && $approved_by) {
            $update_data['approvedBy'] = $approved_by;
            $update_data['approvedAt'] = date('Y-m-d H:i:s');
        }

        if ($notes) {
            $update_data['payoutNotes'] = $notes;
        }

        $this->generic->Update('equipment_payouts', ['equipmentPayoutID' => $payout_id], $update_data);
        return true;
    }

    /**
     * Update workforce payout status
     * 
     * @param int $payout_id Payout ID
     * @param string $status New status
     * @param int $approved_by SuperAdmin user ID
     * @param string $notes Optional notes
     * @return bool Success status
     */
    public function updateWorkforcePayoutStatus($payout_id, $status, $approved_by = null, $notes = null)
    {
        $update_data = ['payoutStatus' => $status];

        if ($status === 'approved' && $approved_by) {
            $update_data['approvedBy'] = $approved_by;
            $update_data['approvedAt'] = date('Y-m-d H:i:s');
        }

        if ($notes) {
            $update_data['payoutNotes'] = $notes;
        }

        $this->generic->Update('workforce_payouts', ['workforcePayoutID' => $payout_id], $update_data);
        return true;
    }

    /**
     * Get equipment payout by payment ID
     * 
     * @param int $payment_id Equipment payment ID
     * @return array|false Payout data or false
     */
    public function getEquipmentPayoutByPaymentId($payment_id)
    {
        $result = $this->generic->GetData('equipment_payouts', ['equipmentPaymentID' => $payment_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get workforce payout by payment ID
     * 
     * @param int $payment_id Workforce payment ID
     * @return array|false Payout data or false
     */
    public function getWorkforcePayoutByPaymentId($payment_id)
    {
        $result = $this->generic->GetData('workforce_payouts', ['workforcePaymentID' => $payment_id]);
        return $result ? $result[0] : false;
    }

    /**
     * Get all pending payouts for SuperAdmin approval (both types)
     * 
     * @return array|false Payouts array or false
     */
    public function getPendingPayouts()
    {
        // Get equipment payouts
        $this->db->select('ep.*, epm.grossAmount, epm.itemID, epm.createdAt as paymentDate, 
                          cd.companyName, u.userName as buyerName, "equipment" as payoutType');
        $this->db->from('equipment_payouts ep');
        $this->db->join('equipment_payments epm', 'ep.equipmentPaymentID = epm.equipmentPaymentID');
        $this->db->join('companydetail cd', 'ep.companyID = cd.companyID');
        $this->db->join('users u', 'epm.buyerUserID = u.userID');
        $this->db->where('ep.payoutStatus', 'pending');
        $equipment_payouts = $this->db->get()->result_array();

        // Get workforce payouts
        $this->db->select('wp.*, wpm.grossAmount, wpm.itemID, wpm.createdAt as paymentDate, 
                          cd.companyName, u.userName as buyerName, "workforce" as payoutType');
        $this->db->from('workforce_payouts wp');
        $this->db->join('workforce_payments wpm', 'wp.workforcePaymentID = wpm.workforcePaymentID');
        $this->db->join('companydetail cd', 'wp.companyID = cd.companyID');
        $this->db->join('users u', 'wpm.buyerUserID = u.userID');
        $this->db->where('wp.payoutStatus', 'pending');
        $workforce_payouts = $this->db->get()->result_array();

        // Combine and sort
        $combined = array_merge($equipment_payouts, $workforce_payouts);

        if (empty($combined)) {
            return false;
        }

        usort($combined, function ($a, $b) {
            return strtotime($b['createdAt']) - strtotime($a['createdAt']);
        });

        return $combined;
    }

    /**
     * Get payouts for a specific company (both types)
     * 
     * @param int $company_id Company ID
     * @return array|false Payouts array or false
     */
    public function getPayoutsByCompany($company_id)
    {
        // Get equipment payouts
        $this->db->select('ep.*, epm.grossAmount, epm.itemID, epm.createdAt as paymentDate, "equipment" as payoutType');
        $this->db->from('equipment_payouts ep');
        $this->db->join('equipment_payments epm', 'ep.equipmentPaymentID = epm.equipmentPaymentID');
        $this->db->where('ep.companyID', $company_id);
        $equipment_payouts = $this->db->get()->result_array();

        // Get workforce payouts
        $this->db->select('wp.*, wpm.grossAmount, wpm.itemID, wpm.createdAt as paymentDate, "workforce" as payoutType');
        $this->db->from('workforce_payouts wp');
        $this->db->join('workforce_payments wpm', 'wp.workforcePaymentID = wpm.workforcePaymentID');
        $this->db->where('wp.companyID', $company_id);
        $workforce_payouts = $this->db->get()->result_array();

        // Combine and sort
        $combined = array_merge($equipment_payouts, $workforce_payouts);

        if (empty($combined)) {
            return false;
        }

        usort($combined, function ($a, $b) {
            return strtotime($b['createdAt']) - strtotime($a['createdAt']);
        });

        return $combined;
    }

    // =============================================
    // SYSTEM SETTINGS & COMMISSION
    // =============================================

    /**
     * Get global commission rate from system settings
     * 
     * @return float Commission percentage
     */
    public function getGlobalCommissionRate()
    {
        $setting = $this->generic->GetData('system_settings', ['settingKey' => 'marketplace_commission_percent']);

        if ($setting) {
            $rate = floatval($setting[0]['settingValue']);
            // Bounds validation: protect against a compromised DB row
            if ($rate >= 0 && $rate <= 50) {
                return $rate;
            }
            log_message('error', 'Commission rate from DB is out of bounds (' . $rate . '%), using safe default 5.00%');
        }

        // Default fallback
        return 5.00;
    }

    /**
     * Update global commission rate (SuperAdmin only)
     * 
     * @param float $commission_percent New commission percentage
     * @param int $updated_by SuperAdmin user ID
     * @return bool Success status
     */
    public function updateGlobalCommissionRate($commission_percent, $updated_by)
    {
        $this->generic->Update(
            'system_settings',
            ['settingKey' => 'marketplace_commission_percent'],
            [
                'settingValue' => $commission_percent,
                'updatedBy' => $updated_by
            ]
        );
        return true;
    }

    // =============================================
    // INVENTORY MANAGEMENT
    // =============================================

    /**
     * Lock equipment inventory after successful payment
     * 
     * @param int $equipment_id Equipment ID
     * @param int $quantity Quantity to lock
     * @return bool Success status
     */
    public function lockEquipmentInventory($equipment_id, $quantity)
    {
        // Get current quantity
        $equipment = $this->generic->GetData('equipment', ['equipmentID' => $equipment_id]);

        if (!$equipment) {
            return false;
        }

        $current_qty = $equipment[0]['equipTotalQuantity'];
        $in_use_qty = $equipment[0]['equipInUseQuantity'];

        // Check if enough inventory available
        if ($current_qty - $in_use_qty < $quantity) {
            log_message('error', "Insufficient inventory for equipment {$equipment_id}");
            return false;
        }

        // Increase in-use quantity
        $new_in_use = $in_use_qty + $quantity;
        $this->generic->Update('equipment', ['equipmentID' => $equipment_id], [
            'equipInUseQuantity' => $new_in_use,
        ]);

        return true;
    }

    /**
     * Release equipment inventory (e.g., after rental period ends or refund)
     * 
     * @param int $equipment_id Equipment ID
     * @param int $quantity Quantity to release
     * @return bool Success status
     */
    public function releaseEquipmentInventory($equipment_id, $quantity)
    {
        $equipment = $this->generic->GetData('equipment', ['equipmentID' => $equipment_id]);

        if (!$equipment) {
            return false;
        }

        $in_use_qty = $equipment[0]['equipInUseQuantity'];
        $new_in_use = max(0, $in_use_qty - $quantity);

        $this->generic->Update('equipment', ['equipmentID' => $equipment_id], [
            'equipInUseQuantity' => $new_in_use,
        ]);

        return true;
    }

    // =============================================
    // STATISTICS & REPORTING
    // =============================================

    /**
     * Get payment statistics for dashboard
     * 
     * @param array $filters Optional filters (company_id, date_from, date_to, type)
     * @return array Statistics
     */
    public function getPaymentStats($filters = [])
    {
        $equipment_stats = $this->getEquipmentPaymentStats($filters);
        $workforce_stats = $this->getWorkforcePaymentStats($filters);

        return [
            'total_payments' => $equipment_stats['total_payments'] + $workforce_stats['total_payments'],
            'total_revenue' => $equipment_stats['total_revenue'] + $workforce_stats['total_revenue'],
            'successful_payments' => $equipment_stats['successful_payments'] + $workforce_stats['successful_payments'],
            'failed_payments' => $equipment_stats['failed_payments'] + $workforce_stats['failed_payments'],
            'equipment' => $equipment_stats,
            'workforce' => $workforce_stats,
        ];
    }

    /**
     * Get equipment payment statistics
     */
    private function getEquipmentPaymentStats($filters = [])
    {
        $this->db->select('
            COUNT(equipmentPaymentID) as total_payments,
            SUM(CASE WHEN paymentStatus = "paid" THEN grossAmount ELSE 0 END) as total_revenue,
            SUM(CASE WHEN paymentStatus = "paid" THEN 1 ELSE 0 END) as successful_payments,
            SUM(CASE WHEN paymentStatus = "failed" THEN 1 ELSE 0 END) as failed_payments
        ');
        $this->db->from('equipment_payments');

        if (isset($filters['company_id'])) {
            $this->db->where('sellerCompanyID', $filters['company_id']);
        }

        if (isset($filters['date_from'])) {
            $this->db->where('createdAt >=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $this->db->where('createdAt <=', $filters['date_to']);
        }

        return $this->db->get()->row_array();
    }

    /**
     * Get workforce payment statistics
     */
    private function getWorkforcePaymentStats($filters = [])
    {
        $this->db->select('
            COUNT(workforcePaymentID) as total_payments,
            SUM(CASE WHEN paymentStatus = "paid" THEN grossAmount ELSE 0 END) as total_revenue,
            SUM(CASE WHEN paymentStatus = "paid" THEN 1 ELSE 0 END) as successful_payments,
            SUM(CASE WHEN paymentStatus = "failed" THEN 1 ELSE 0 END) as failed_payments
        ');
        $this->db->from('workforce_payments');

        if (isset($filters['company_id'])) {
            $this->db->where('sellerCompanyID', $filters['company_id']);
        }

        if (isset($filters['date_from'])) {
            $this->db->where('createdAt >=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $this->db->where('createdAt <=', $filters['date_to']);
        }

        return $this->db->get()->row_array();
    }

    // =============================================
    // INVENTORY & AVAILABILITY METHODS
    // =============================================

    /**
     * Get available quantity for equipment
     * 
     * Checks total stock minus currently active bookings for the requested period.
     * This prevents overbooking.
     */
    public function getAvailableQuantity($equipment_id, $start_date, $end_date)
    {
        // 1. Get total physical stock
        $equipment = $this->generic->GetData('equipment', ['equipmentID' => $equipment_id]);
        if (!$equipment) return 0;

        $total_qty = (int)$equipment[0]['equipTotalQuantity'];
        $in_use_qty = (int)$equipment[0]['equipInUseQuantity']; // Permanently unavailable/lost/maintenance

        // 2. Calculate overlapping rentals
        // We look for any "paid" or "pending" status bookings that overlap our dates
        $overlapping_qty = $this->getOverlappingRentals($equipment_id, $start_date, $end_date);

        // 3. Calculate true availability
        // Available = Total - (Permanently In Use) - (Booked for dates)
        $available = $total_qty - $in_use_qty - $overlapping_qty;

        return max(0, $available);
    }

    /**
     * Check if workforce member is available
     * 
     * Workforce are single units - they can only be in one place at a time.
     * Returns true if free, false if booked.
     */
    public function isWorkforceAvailable($workforce_id, $start_date, $end_date)
    {
        // Check "paid" or "pending" bookings that overlap
        $this->db->select('COUNT(*) as count');
        $this->db->from('workforce_payments');
        $this->db->where('workforceID', $workforce_id);
        $this->db->where_in('paymentStatus', ['paid', 'pending']); // Exclude failed/refunded

        // Date overlap logic:
        // (StartA <= EndB) and (EndA >= StartB)
        $this->db->group_start();
        $this->db->where('rentalStartDate <=', $end_date);
        $this->db->where('rentalEndDate >=', $start_date);
        $this->db->group_end();

        $result = $this->db->get()->row_array();

        // If count > 0, they are booked
        return ($result['count'] == 0);
    }

    /**
     * Get ID helpers
     */
    public function getEquipmentIDByItemID($item_id)
    {
        $item = $this->generic->GetData('shopequipments', ['itemID' => $item_id]);
        return $item ? $item[0]['equipmentID'] : false;
    }

    public function getWorkforceIDByItemID($item_id)
    {
        $item = $this->generic->GetData('shopworkforce', ['itemID' => $item_id]);
        return $item ? $item[0]['workforceID'] : false;
    }

    /**
     * Helper: Count overlapping equipment rentals
     */
    private function getOverlappingRentals($equipment_id, $start_date, $end_date)
    {
        $this->db->select('SUM(quantity) as booked_qty');
        $this->db->from('equipment_payments');
        $this->db->where('equipmentID', $equipment_id);
        $this->db->where_in('paymentStatus', ['paid', 'pending']);

        // Overlap check
        $this->db->group_start();
        $this->db->where('rentalStartDate <=', $end_date);
        $this->db->where('rentalEndDate >=', $start_date);
        $this->db->group_end();

        $result = $this->db->get()->row_array();
        return (int)$result['booked_qty'];
    }

    /**
     * Calculate Total Cost (Shared Logic)
     * 
     * Used by both API (for display) and Controller (for actual charging)
     * to ensure consistent pricing.
     * 
     * @return array ['total' => float, 'breakdown' => string, 'error' => string|null]
     */
    public function calculateTotalCost($item_type, $item_data, $quantity, $start_date, $end_date, $sale_type = 'rental')
    {
        $unit_price = 0;
        $rental_type = 0; // 1=daily, etc.

        if ($item_type == 1) { // Equipment
            $unit_price = $item_data['eqpPrice'];
            if ($sale_type == 'purchase') {
                return [
                    'total' => $unit_price * $quantity,
                    'breakdown' => "{$quantity} units × " . number_format($unit_price, 2),
                    'error' => null
                ];
            }
            $rental_type = $item_data['eqpRentalType'];
        } else { // Workforce
            $unit_price = $item_data['workforcePrice'];
            $rental_type = $item_data['workforceRentalType'];
            $sale_type = 'rental'; // Force rental
        }

        // Rental Calculation
        if (!$start_date || !$end_date) {
            return ['total' => 0, 'breakdown' => '', 'error' => 'Dates required'];
        }

        try {
            $start = new DateTime($start_date);
            $end = new DateTime($end_date);
            $days = $end->diff($start)->days + 1;
        } catch (Exception $e) {
            return ['total' => 0, 'breakdown' => '', 'error' => 'Invalid dates'];
        }

        if ($days < 1) {
            return ['total' => 0, 'breakdown' => '', 'error' => 'End date must be after start date'];
        }

        $period_count = 0;
        $period_name = '';

        switch ($rental_type) {
            case 1: // Daily
                $period_count = $days;
                $period_name = 'days';
                break;
            case 2: // Weekly
                $period_count = ceil($days / 7);
                $period_name = 'weeks';
                break;
            case 3: // Monthly
                $period_count = ceil($days / 30);
                $period_name = 'months';
                break;
            case 4: // Yearly
                $period_count = ceil($days / 365);
                $period_name = 'years';
                break;
            default:
                $period_count = $days;
                $period_name = 'days';
        }

        $total = $unit_price * $period_count * $quantity;
        $breakdown = "{$quantity} unit(s) × " . number_format($unit_price, 2) . " × {$period_count} {$period_name}";

        return [
            'total' => $total,
            'breakdown' => $breakdown,
            'error' => null
        ];
    }
}
