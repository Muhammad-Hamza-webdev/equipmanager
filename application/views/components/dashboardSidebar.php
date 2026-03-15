<!-- Dashboard Sidebar Component -->
<style>
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
    }

    .dashboard-sidebar {
        width: 260px;
        background-color: var(--card-bg);
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        padding: 0;
        box-shadow: var(--shadow);
        border-radius: 12px;
    }

    .sidebar-profile {
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: var(--primary-brand);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        overflow: hidden;
        color: var(--text-light);
        font-size: 32px;
        font-weight: bold;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        width: 100%;
    }

    .profile-name {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
        font-family: "Manrope", sans-serif;
    }

    .profile-email {
        font-size: 13px;
        color: var(--text-secondary);
        margin-bottom: 16px;
        word-break: break-word;
        font-family: "Manrope", sans-serif;
    }

    .logout-btn {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        font-family: "Manrope", sans-serif;
    }

    .logout-btn:hover {
        background-color: #f0f0f0;
        border-color: var(--text-secondary);
        color: var(--text-primary);
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 24px 0;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        font-weight: 500;
        font-family: "Manrope", sans-serif;
    }

    .nav-item:hover {
        background-color: #f9f9f9;
    }

    .nav-item.active {
        background-color: var(--primary-brand);
        color: var(--text-light);
    }

    @media (max-width: 1024px) {
        .dashboard-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            border-radius: 0;
        }

        .sidebar-profile {
            border-bottom: none;
            padding: 0;
            text-align: left;
            flex-direction: row;
            align-items: center;
            gap: 16px;
            width: auto;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            margin-bottom: 0;
        }

        .profile-name {
            margin-bottom: 2px;
        }

        .profile-email {
            margin-bottom: 0;
            font-size: 12px;
        }

        .logout-btn {
            width: auto;
            padding: 8px 16px;
        }

        .sidebar-nav {
            display: none;
        }
    }
</style>

<aside class="dashboard-sidebar">
    <!-- Profile Section -->
    <div class="sidebar-profile">
        <div class="profile-avatar">
            <?php 
                $login_data = $this->session->userdata('loginData');
                $user_name = isset($login_data['userName']) ? $login_data['userName'] : 'User';
                $user_email = isset($login_data['userEmail']) ? $login_data['userEmail'] : 'user@equipmanager.com';
                echo strtoupper(substr($user_name, 0, 2));
            ?>
        </div>
        <div class="profile-info">
            <div class="profile-name"><?= htmlspecialchars($user_name) ?></div>
            <div class="profile-email"><?= htmlspecialchars($user_email) ?></div>
        </div>
        <button class="logout-btn" onclick="logoutUser()">Logout</button>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <li class="nav-item <?= ($active_page ?? '') === 'dashboard' ? 'active' : '' ?>" onclick="navigateTo('user-dashboard')">
            <i class="bi bi-house-door"></i>
            Dashboard
        </li>
        <li class="nav-item <?= ($active_page ?? '') === 'orders' ? 'active' : '' ?>" onclick="navigateTo('orders')">
            <i class="bi bi-bag"></i>
            Orders
        </li>
        <li class="nav-item <?= ($active_page ?? '') === 'chats' ? 'active' : '' ?>" onclick="navigateTo('chats')">
            <i class="bi bi-chat-dots"></i>
            Chats
        </li>
        <li class="nav-item <?= ($active_page ?? '') === 'settings' ? 'active' : '' ?>" onclick="navigateTo('settings')">
            <i class="bi bi-gear"></i>
            Settings
        </li>
    </nav>
</aside>

<script>
    function logoutUser() {
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = '<?= base_url('logout') ?>';
        }
    }

    function navigateTo(page) {
        window.location.href = '<?= base_url() ?>' + page;
    }
</script>
