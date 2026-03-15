<!-- Chats Card Component -->
<div class="chats-card">
    <!-- Header with Title and Search -->
    <div class="chats-header-section">
        <h2 class="chats-title">Chats</h2>
        <div class="search-bar">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Search Here"
                onkeyup="filterTable()"
            >
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <?php if (empty($chats)): ?>
            <div class="no-data">
                <svg class="no-data-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <h3>No chats yet</h3>
                <p>Your order conversations will appear here once you interact with an order.</p>
            </div>
        <?php else: ?>
            <table class="chats-table" id="chatsTable">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>States</th>
                        <th>Chat</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($chats as $chat): ?>
                        <?php
                        // Format date
                        $last_activity = $chat->lastMessageAt ?: $chat->createdAt;
                        $date_display = date('m/d/Y', strtotime($last_activity));
                        
                        // Determine status class and text
                        $status = strtolower($chat->paymentStatus);
                        $status_class = 'status-' . $status;
                        $status_text = ucfirst($status);
                        
                        // Use partner/order name as "Name" - can be equipment name if available
                        $partner_name = '';
                        if ($user_type == 2 || $user_type == 3) {
                            // Admin/Seller - show buyer
                            $partner_name = ($chat->buyerFirstName ?? '') . ' ' . ($chat->buyerLastName ?? '');
                            $partner_name = trim($partner_name) ?: ($chat->buyerEmail ?? 'Buyer');
                        } else {
                            // Regular user/Buyer - show seller's actual username
                            $partner_name = $chat->sellerUserName ?? $chat->sellerCompanyName ?? 'Seller';
                        }
                        ?>
                        <tr class="chat-row" data-order-id="<?= $chat->equipmentPaymentID ?>" data-search-text="<?= htmlspecialchars(strtolower($partner_name . ' ' . $status_text . ' ' . $date_display)) ?>">
                            <td><span class="order-id">#<?= htmlspecialchars($chat->equipmentPaymentID) ?></span></td>
                            <td><?= htmlspecialchars($partner_name) ?></td>
                            <td><?= htmlspecialchars($chat->category ?? 'Equipment') ?></td>
                            <td><span class="price">$<?= number_format($chat->grossAmount, 2) ?></span></td>
                            <td><?= $date_display ?></td>
                            <td>
                                <span class="status-chip <?= $status_class ?>">
                                    <?= $status_text ?>
                                </span>
                            </td>
                            <td>
                                <?php 
                                // Regular users (type 4) use /chat/{id}, company admins (type 2,3) use /company-chats/view/{id}
                                $chat_url = ($user_type == 2 || $user_type == 3) 
                                    ? base_url('company-chats/view/' . $chat->equipmentPaymentID)
                                    : base_url('chat/' . $chat->equipmentPaymentID);
                                ?>
                                <a href="<?= $chat_url ?>" class="chat-btn">
                                    Chat Now
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container" id="paginationContainer">
                <!-- Pagination will be inserted here by JavaScript -->
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap');

    :root {
        --primary-brand: #13372E;
        --accent-green: #2A7A66;
        --text-primary: #1A1A1A;
        --text-secondary: #6B7280;
        --text-light: #FFFFFF;
        --body-bg: #F5F6F8;
        --card-bg: #FFFFFF;
        --border-color: #E5E7EB;
        --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        --table-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
    }

    * {
        font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .chats-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--table-shadow);
        padding: 32px;
        width: 100%;
    }

    /* Header Section */
    .chats-header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        gap: 24px;
    }

    .chats-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    /* Search Bar */
    .search-bar {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 10px 16px;
        width: 300px;
        background: var(--card-bg);
        transition: all 0.2s ease;
    }

    .search-bar:focus-within {
        border-color: var(--accent-green);
        box-shadow: 0 0 0 3px rgba(42, 122, 102, 0.1);
    }

    .search-icon {
        width: 18px;
        height: 18px;
        color: var(--text-secondary);
        margin-right: 12px;
        flex-shrink: 0;
    }

    .search-input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: var(--text-primary);
        width: 100%;
        font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .search-input::placeholder {
        color: var(--text-secondary);
    }

    /* Table Wrapper */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* Table */
    .chats-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .chats-table thead {
        background-color: #F9FAFB;
    }

    .chats-table th {
        text-align: left;
        padding: 16px 24px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid var(--border-color);
    }

    .chats-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: background-color 0.2s ease;
    }

    .chats-table tbody tr:hover {
        background-color: #F9FAFB;
    }

    .chats-table td {
        padding: 20px 24px;
        vertical-align: middle;
        font-size: 14px;
        color: var(--text-primary);
    }

    /* Order ID */
    .order-id {
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Price */
    .price {
        font-weight: 600;
        color: var(--accent-green);
    }

    /* Status Chips */
    .status-chip {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-chip.status-completed {
        background-color: #DEF7EC;
        color: #03543F;
    }

    .status-chip.status-processing {
        background-color: #FDF6B2;
        color: #723B13;
    }

    .status-chip.status-refunded {
        background-color: #E5E7EB;
        color: #1F2937;
    }

    .status-chip.status-pending {
        background-color: #FDF6B2;
        color: #723B13;
    }

    /* Chat Button */
    .chat-btn {
        display: inline-block;
        background: var(--card-bg);
        border: 1px solid #D1D5DB;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .chat-btn:hover {
        border-color: #9CA3AF;
        background: #F3F4F6;
        color: var(--text-primary);
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 8px;
        margin-top: 32px;
    }

    .pagination-btn {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .pagination-btn:hover {
        background: #F3F4F6;
    }

    .pagination-btn.active {
        background: var(--primary-brand);
        color: var(--text-light);
        border-color: var(--primary-brand);
    }

    .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-info {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 0 8px;
    }

    /* No Data State */
    .no-data {
        text-align: center;
        padding: 64px 32px;
    }

    .no-data-icon {
        width: 64px;
        height: 64px;
        color: var(--border-color);
        margin-bottom: 24px;
    }

    .no-data h3 {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .no-data p {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chats-card {
            padding: 24px;
        }

        .chats-header-section {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .search-bar {
            width: 100%;
        }

        .chats-title {
            font-size: 20px;
        }

        .chats-table th,
        .chats-table td {
            padding: 12px 16px;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }
    }

    @media (max-width: 480px) {
        .chats-card {
            padding: 16px;
        }

        .chats-table th,
        .chats-table td {
            padding: 12px 8px;
            font-size: 12px;
        }

        .chat-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .order-id {
            font-size: 12px;
        }
    }
</style>

<script>
    // Pagination variables
    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRows = [];

    function initializePagination() {
        filteredRows = Array.from(document.querySelectorAll('.chat-row'));
        renderTable();
        createPagination();
    }

    function filterTable() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.chat-row');
        
        filteredRows = Array.from(rows).filter(row => {
            const searchText = row.getAttribute('data-search-text');
            return searchText.includes(searchInput);
        });

        currentPage = 1;
        renderTable();
        createPagination();
    }

    function renderTable() {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedRows = filteredRows.slice(startIndex, endIndex);

        paginatedRows.forEach(row => {
            tableBody.appendChild(row.cloneNode(true));
        });

        if (paginatedRows.length === 0 && filteredRows.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 40px;">No chats found</td></tr>';
        }
    }

    function createPagination() {
        const paginationContainer = document.getElementById('paginationContainer');
        paginationContainer.innerHTML = '';

        if (filteredRows.length === 0) return;

        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.className = `pagination-btn ${currentPage === 1 ? 'disabled' : ''}`;
        prevBtn.textContent = 'Previous';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                createPagination();
            }
        };
        paginationContainer.appendChild(prevBtn);

        // Page info
        const info = document.createElement('span');
        info.className = 'pagination-info';
        info.textContent = `${currentPage} / ${totalPages}`;
        paginationContainer.appendChild(info);

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.className = `pagination-btn ${currentPage === totalPages ? 'disabled' : ''}`;
        nextBtn.textContent = 'Next';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                createPagination();
            }
        };
        paginationContainer.appendChild(nextBtn);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('tableBody');
        if (tableBody) {
            initializePagination();
        }
    });
</script>