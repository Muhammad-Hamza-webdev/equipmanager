<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// login & register module module 
$route['register'] = 'welcome/RegisterView';
$route['company-registeration-data'] = 'welcome/comapnyRegisterationData';
$route['verify-account'] = 'welcome/VerifyAccount';
$route['verif-account-data'] = 'welcome/VerifyAccountData';
$route['resend-verification-email'] = 'welcome/resendVerificationEmail';
$route['user-registeration-data'] = 'welcome/userRegistersationData';
$route['forgot-password'] = 'welcome/forgotpassword';
$route['forgot-password-data'] = 'welcome/forgotpasswordData';
$route['reset-password'] = 'welcome/resetPassword';
$route['reset-password-data'] = 'welcome/resetPasswordData';
$route['login'] = 'welcome/login';
$route['login-data'] = 'welcome/loginData';

//website market place 
$route['work-force-marketplace']='welcome/workforceMarketPlace';
$route['equipment-marketplace']='welcome/equipmentMarketPlace';
$route['equipment-detail']='welcome/equipmentDetailMarketPlace';
$route['workforce-detail']='welcome/WorkforceDetailMarketPlace';
//--website utality pages
$route['contact-form-data']='welcome/ContactFormData';

//dashboards
$route['user-dashboard'] = 'welcome/userDashboard';
$route['settings'] = 'welcome/userSettings';
$route['company-dashboard'] = 'welcome/companyDashboard';
$route['manager-dashboard'] = 'welcome/managerDashboard';


//manage workforce company
//--maage skill
$route['manage-workforce-skill'] = 'workforce/ManageWorkforceSkill';
$route['add-skill-data'] = 'workforce/addSkillData';
$route['delet-skill/:any'] = 'workforce/DeleteSkill';
$route['update-skill-data/:any'] = 'workforce/UpdateSkillData';
//--add workforce
$route['add-workforce'] = 'workforce/addWorkforce';
$route['add-skill-data-ajax'] = 'workforce/addSkillDataAjax';
$route['add-work-force-data'] = 'workforce/addWorkForceData';
$route['all-workforce'] = 'workforce/allWorkforce';
$route['delete-person/:any'] = 'workforce/DeletePerson';
$route['edit-work-force/:any'] = 'workforce/editWorkForce';


//manage equipment company
//--manage category
$route['manage-category'] = 'equipment/ManageCategory';
$route['equipment-category-data'] = 'equipment/CategoryData';
$route['delete-category/:any'] = 'equipment/deletCategory';
$route['update-category-data/:any'] = 'equipment/CategoryUpdateData';
//--add equipment
$route['add-equipment'] = 'equipment/AddEquipment';
$route['add-equipment-data'] = 'equipment/AddEquipmentData';
$route['add-equipment-category-jax'] = 'equipment/AddEquipmentAjaxData';
//--all equipment
$route['all-equipment'] = 'equipment/AllEquipment';
$route['delet-equipment/:any'] = 'equipment/DeleteEquipment';
$route['edit-equipment/:any'] = 'equipment/EditEquipment';
$route['edit-equipment-data/:any'] = 'equipment/UpdateEquipmentData';


//manage project company
//--manage category
$route['project-category'] = 'project/ProjectCategory';
$route['project-cat-data'] = 'project/ProjectCategoryData';
$route['delet-project-cat/:any'] = 'project/ProjectCategoryDeletData';
$route['update-project-category-data/:any'] = 'project/ProjectCategoryEditData';
//--add project
$route['add-project'] = 'project/AddProject';
$route['add-project-general-data'] = 'project/AddProjectGeneralData'; // ajax first step(General data)
$route['add-project-workforce'] = 'project/AddProjecWorkforce'; // ajax second step(workforce data)
$route['remove-project-workforce'] = 'project/removeWorkforceFromProject'; // ajax second step(workforce removal)
$route['add-project-equipment'] = 'project/addProjectEquipment'; // ajax add project equipment
$route['remove-project-equipment'] = 'project/RemoveProjectEquipment'; // ajax add project equipment
$route['move-to-step3'] = 'project/MovetoStepThree'; // ajax Move to step 3
$route['assign-equipment-employee'] = 'project/assignEquipmenttoEmployee'; // ajax assign equipment to employee
$route['remove-assigned-equipment'] = 'project/removeAssignEquipmenttoEmployee'; // ajax remove assigned equipment to employee
$route['mark-project-as-inprogress'] = 'project/MarkInProgressProject';
//--all projects
$route['all-projects'] = 'project/AllProjects';
$route['delete-project/:any'] = 'project/DeletProject';
//support ticket 
$route['add-new-ticket']='support/addNewTicket';
$route['add-ticket-data']='support/addNewTicketData';
$route['ticket-chat']='support/ticketChat';
$route['add-new-chat-ajax']='support/newChatAjax'; //add new chat ajax
$route['all-tickets']='support/allTickets';
//--admin side support
$route['ticket-category']='support/ticketCategory';
$route['add-ticket-cat-data']='support/ticketCategoryData';
$route['change-ticket-cat-status/:any/:any']='support/ticketCategoryStatus';
$route['delet-ticket-cat/:any']='support/ticketCategoryDlt';
$route['update-ticket-cat-data/:any']='support/ticketCategoryUpdate';
$route['marked-ticket-complete/:any']='support/ticketMarketCompleted';
$route['contact-form']='support/contactForm'; //--website contact form
$route['contact-form-responded']='support/contactFormStatusUpdate'; 


//manage company admin listing
//--add listing
$route['add-listing']='listing/addListing';
$route['add-equipment-listing-data']='listing/addEquipmentListingData';
$route['fetch-equipment-availablity-from-project']='listing/fetchEquipmentAvailablity'; //--ajax
$route['fetch-workforce-availablity']='listing/fetchWorkforceAvailablity'; //--ajax
$route['add-workforce-listing-data']='listing/addWorkforceListingData'; 
$route['add-step-3-data']='listing/step3Data';
//==all listing module
$route['all-listing']='listing/allListing';
//--delet listing
$route['delete-listing']='listing/dltListing';




//super admin
$route['admin-dashboard'] = 'superadmin/superadmindashboard';
// manage super category
$route['manage-super-category'] = 'superadmin/ManageSuperCategory';
$route['add-super-category'] = 'superadmin/addSuperCategory';
$route['show-super-category'] = 'superadmin/showSuperCategory';
$route['delet-cat/:any'] = 'superadmin/deletCategory';
$route['update-cate/:any'] = 'superadmin/updateSuperCategory';
$route['process-update-cat'] = 'superadmin/processUpdateCategory';
// change status
$route['change-status/:any/:any'] = 'superadmin/changeStatus';
//super testimonial
$route['manage-super-testimonial'] = 'superadmin/ManageSuperTestimonial';
$route['add-testimoni'] = 'superadmin/AddTestimonial';
$route['delet-testmoni/:any'] = 'superadmin/deleteTestimonial';
$route['update-testmoni/:any'] = 'superadmin/updateTestimonial';
$route['process-update-testi/:any'] = 'superadmin/processUpdateTestimonial';
// change status
$route['change-testi-status/:any/:any'] = 'superadmin/changeTestimonialStatus';
// super blog
$route['manage-super-blog'] = 'superadmin/ManageSuperBlog';
$route['change-blog-cat-status/:any/:any'] = 'superadmin/changeBlogCatStatus';
$route['delet-blog-cat/:any'] = 'superadmin/DltBlogCat';
$route['update-blog-cat/:any'] = 'superadmin/updateBlogCat';
$route['update-blog-category-data/:any/:any'] = 'superadmin/updateBlogCatData';
$route['add-blog'] = 'superadmin/addSuperBlog';
$route['change-blog-status/:any/:any'] = 'superadmin/changeBlogStatus';
$route['show-super-blog'] = 'superadmin/showSuperBlog';
$route['dlet-blog/:any'] = 'superadmin/deletSuperBlog';
$route['update-blog/:any'] = 'superadmin/updateSuperBlog';
$route['process-update-blog/:any/:any'] = 'superadmin/processUpdateBlog';
$route['manage-blog-category'] = 'superadmin/manageBlogCat';
$route['add-blog-category-data'] = 'superadmin/blogCatData';
// success metrics
$route['manage-success'] = 'superadmin/manageSuccess';
$route['add-success'] = 'superadmin/addSuccess';
$route['delet-metrics/:any'] = 'superadmin/deleteSuccess';
$route['update-success/:any'] = 'superadmin/updateSuccess';
$route['process-update-success/:any'] = 'superadmin/processUpdateSuccess';
// change status 
$route['change-success-cat-status/:any/:any'] = 'superadmin/changeSuccessCatStatus';
// company partner
$route['manage-company'] = 'superadmin/manageCompany';
$route['add-partner'] = 'superadmin/addPartner';
$route['delet-partner/:any'] = 'superadmin/deletePartner';
$route['update-partner/:any'] = 'superadmin/updatePartner';
$route['process-update-partner/:any'] = 'superadmin/processUpdatePartner';
// change status 
$route['change-partner-status/:any/:any'] = 'superadmin/changePartnerStatus';

//market place listing
$route['admin-marketplace-listing']='superadmin/MarketplaceListing';
$route['mark-listing-approved']='superadmin/MarketplaceListingMarkedApproved';
$route['mark-listing-rejected']='superadmin/MarketplaceListingMarkedRejected';
$route['change-website-listing-status/:any/:any']='superadmin/ChangeMarketplacelistingWebsiteStatus';

// Super admin orders route
$route['super-admin-orders'] = 'superadmin/all_orders';
$route['super-admin-orders/view/(:num)'] = 'superadmin/view_order/$1';

$route['login-data'] = 'welcome/LoginData';


//website mode change
$route['change-website-mode']='superadmin/changeWebsiteMode';
//system settings
$route['manage-system-settings']='superadmin/manageSystemSettings';
$route['update-system-settings']='superadmin/updateSystemSettings';
//test email
$route['test-mail'] = 'welcome/TestMail';

// Checkout route (secure checkout page)
$route['checkout'] = 'checkout/index';
$route['checkout/pay/(:any)'] = 'checkout/pay_with_token/$1';
$route['checkout/(:any)'] = 'checkout/$1';

// Chat routes (order-based messaging system)
$route['chats'] = 'chats/index';
$route['chats/(:any)'] = 'chats/$1';
$route['chat/debug/(:num)'] = 'chat/debug/$1';
$route['chat/(:num)'] = 'chat/view/$1';
$route['chat/api/(:any)'] = 'chat/api_$1';

// Company admin chat routes (admin layout)
$route['company-chats/view/(:num)'] = 'chat/company_view/$1';
$route['company-chats'] = 'chats/index';
$route['company-chats/(:any)'] = 'chats/$1';

// Orders routes (user order history and details)
$route['orders'] = 'orders/index';
$route['orders/confirm_delivery'] = 'orders/confirm_delivery';
$route['orders/(:num)'] = 'orders/view/$1';  // Route numeric IDs to view method: /orders/21 → orders/view/21
$route['orders/(:alpha)'] = 'orders/$1';     // Route method names like test_session
$route['dashboard/orders'] = 'orders/index';
$route['dashboard/orders/(:num)'] = 'orders/view/$1';  // Numeric IDs to view
$route['dashboard/orders/(:alpha)'] = 'orders/$1';     // Method names

// Company Orders routes (admin approval dashboard for purchase requests)
$route['company-orders'] = 'company_orders/index';
$route['company-orders/view/(:num)'] = 'company_orders/view/$1';
$route['company-orders/accept'] = 'company_orders/accept';
$route['company-orders/reject'] = 'company_orders/reject';
$route['company-orders/mark_shipped'] = 'company_orders/mark_shipped';
$route['company-orders/allow_pickup'] = 'company_orders/allow_pickup';

$route['orders/confirm_pickup'] = 'orders/confirm_pickup';

$route['logout'] = 'welcome/LogOut';
$route['default_controller'] = 'welcome';
$route['(:any)'] = 'welcome';

// Route any unmatched URI to the default controller
$route['404_override'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;
