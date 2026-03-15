<?php
defined('BASEPATH') or exit('No direct script access allowed');

class superadmin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('Generic_model', 'generic');
        $this->load->model('Payment_model', 'payment');
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


    // super admin login
    public function superadmindashboard()
    {
        //check if user is vendor
        if ($this->session->userdata('loginData')['userType'] == 1) {
            $this->load->view('superadmin/superadmindashboard');
        } else {
            redirect(base_url());
        }
    }
    public function changeWebsiteMode() {
        $curentStatus=$this->generic->GetData('web_setting');
        if($curentStatus[0]['websiteStatus']==1){
            $this->generic->Update('web_setting',array('settingID'=>1),array('websiteStatus'=>0));
        }else{
            $this->generic->Update('web_setting',array('settingID'=>1),array('websiteStatus'=>1));

        }
        redirect(base_url().$_GET['curentUrl']);
    }

    // manage system settings
    public function manageSystemSettings()
    {
        //check if user is admin
        if ($this->session->userdata('loginData')['userType'] == 1) {
            //get all system settings
            $this->data['settings'] = $this->generic->GetData('system_settings');
            $this->load->view('superadmin/system_settings/manage_settings', $this->data);
        } else {
            redirect(base_url());
        }
    }

    // update system settings
    public function updateSystemSettings()
    {
        //check if user is admin
        if ($this->session->userdata('loginData')['userType'] == 1) {
            $settingKey = $this->input->post('settingKey');
            $settingValue = $this->input->post('settingValue');
            $description = $this->input->post('description');

            //get existing setting
            $existingSetting = $this->generic->GetData('system_settings', array('settingKey' => $settingKey));

            if ($existingSetting) {
                //update existing setting
                $updateData = array(
                    'settingValue' => $settingValue,
                    'description' => $description,
                    'updatedBy' => $this->session->userdata('loginData')['userID']
                );
                $this->generic->Update('system_settings', array('settingKey' => $settingKey), $updateData);
                $this->session->set_flashdata('successUpdated', 'System setting updated successfully!');
            } else {
                //insert new setting if it doesn't exist
                $insertData = array(
                    'settingKey' => $settingKey,
                    'settingValue' => $settingValue,
                    'settingType' => 'number',
                    'description' => $description,
                    'updatedBy' => $this->session->userdata('loginData')['userID']
                );
                $this->generic->InsertData('system_settings', $insertData);
                $this->session->set_flashdata('successAdded', 'System setting added successfully!');
            }

            redirect(base_url('manage-system-settings'));
        } else {
            redirect(base_url());
        }
    }


    // manage super category page load
    public function ManageSuperCategory()
    {
        $this->load->view('superadmin/category/managecategory');
    }

    // add category
    public function addSuperCategory()
    {
        $superCatName = $this->input->post('catName');
        $superCatDesp = $this->input->post('catDesc');

        //check if we have image posted
        if (empty($_FILES['catIcon']['name'])) {
            $personImage = 'category.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/category';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 5024;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('catIcon')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-super-category'));
            } else {
                $uploadData = $this->upload->data();
                $personImage = $uploadData['file_name'];
            }
        }

        //get all seo part inputs
        $metaTitle = $this->input->post('metaTittle');
        // normalize title: trim, replace any whitespace sequence with a hyphen, then lowercase
        $Slug = strtolower(preg_replace('/\s+/', '-', trim($superCatName)));
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        //page entry
        $pagedata = array(
            'slug' => $Slug,
            'pageType' => 2,
            'pageStatus' => 1
        );
        $this->generic->InsertData('web_pages', $pagedata);
        //get page max page id
        $pageID = $this->generic->GetMaxID('web_pages', 'pageID');
        //seo data entry
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $superCatName . " | equipmanager.dk";
        }
        $seodata = array(
            'pageID' => $pageID[0]['result'],
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->InsertData('web_page_meta', $seodata);
        //add category data
        $data = array(
            'web_catName' => $superCatName,
            'pageID' => $pageID[0]['result'],
            'web_catDesp' => $superCatDesp,
            'web_catIcon' => $personImage,
            'web_cat_type'=>$this->input->post('catType')
        );
        $this->generic->InsertData('web_cat', $data);
        $this->session->set_flashdata('success', 'Person deleted successfully!');
        redirect(base_url('manage-super-category'));
    }

    // show super category
    public function showSuperCategory()
    {
        // Get data from database
        $this->data['supercategory'] = $this->generic->GetWebCategoryData();
        $this->load->view('superadmin/category/showcategory', $this->data);
    }

    // delete category
    public function deletCategory()
    {
        // Delete category from database
        $catdata = $this->generic->GetData('web_cat', array('web_catID' => $this->uri->segment(2)));
        $this->generic->Delete('web_pages', array('pageID' => $catdata[0]['pageID']));
        $this->generic->Delete('web_page_meta', array('pageID' => $catdata[0]['pageID']));
        $this->generic->Delete('web_cat', array('web_catID' => $this->uri->segment(2)));
        $this->session->set_flashdata('successDeleted', 'Category deleted successfully!');
        redirect(base_url('show-super-category'));
    }

    // update category
    public function updateSuperCategory()
    {
        // Get category data
        $this->data['updateCategory'] = $this->generic->GetWebCategoryData(array('wc.web_catID' => $this->uri->segment(2)));
        // Load view
        $this->load->view('superadmin/category/updatecategory', $this->data);
    }

    // change status from active to deactive
    public function changeStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Category deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Category activated successfully!');
        }
        $this->generic->Update('web_pages', array('pageID' => $this->uri->segment(2)), array('pageStatus' => $newStatus));
        redirect(base_url('show-super-category'));
    }


    // process update category
    public function processUpdateCategory()
    {
        $catID = $this->input->post('catID');
        $superCatName = $this->input->post('catName');
        $superCatDesp = $this->input->post('catDesc');

        //check if we have image posted
        if (empty($_FILES['catIcon']['name'])) {
            $personImage = 'category.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/category';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 300;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('catIcon')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('show-super-category'));
            } else {
                $uploadData = $this->upload->data();
                $personImage = $uploadData['file_name'];
            }
        }
        $data = array(
            'web_catName' => $superCatName,
            'web_catDesp' => $superCatDesp,
            'web_catIcon' => $personImage,
        );
        $this->generic->Update('web_cat', array('web_catID' => $catID), $data);
        //get cat data
        $cat = $this->generic->GetData('web_cat', array('web_catID' => $catID));
        //update seo meta
        //get all seo part inputs
        $metaTitle = $this->input->post('metaTittle');
        // normalize title: trim, replace any whitespace sequence with a hyphen, then lowercase
        $Slug = strtolower(preg_replace('/\s+/', '-', trim($superCatName)));
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $superCatName . " | equipmanager.dk";
        }
        $seodata = array(
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->Update('web_page_meta', array('pageID' => $cat[0]['pageID']), $seodata);
        //update slug
        $this->generic->Update('web_pages', array('pageID' => $cat[0]['pageID']), array('slug' => $Slug));
        $this->session->set_flashdata('success-edited', 'Person deleted successfully!');
        redirect(base_url('show-super-category'));
    }


    // manage super testimonial page load
    public function ManageSuperTestimonial()
    {
        $this->data['showtestimonialdata'] = $this->generic->GetData('web_testimonial', array(), 'web_testimonialID', 'DESC');
        $this->load->view('superadmin/testimonial/supertestimonial', $this->data);
    }

    // add testimonial
    public function AddTestimonial()
    {
        $testiRating = $this->input->post('testiRating');
        $testiReview = $this->input->post('testiReview');
        $testiName = $this->input->post('testiName');
        $testiLocation = $this->input->post('testiLocation');

        //check if we have image posted
        if (empty($_FILES['testiImage']['name'])) {
            $personImage = 'testimonial.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/testimonial';
            $config['allowed_types']        = 'svg|png|jpg|jpeg';
            $config['max_size']             = 500;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('testiImage')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-super-testimonial'));
            } else {
                $uploadData = $this->upload->data();
                $personImage = $uploadData['file_name'];
            }
        }
        $data = array(
            'web_testimonialRating' => $testiRating,
            'web_testimonialDesp' => $testiReview,
            'web_testimonialName' => $testiName,
            'web_testimonialLocation' => $testiLocation,
            'web_testimonialImg' => $personImage,
            'web_testimonialStatus' => 1,
        );
        $this->generic->InsertData('web_testimonial', $data);
        $this->session->set_flashdata('success', 'Person deleted successfully!');
        redirect(base_url('manage-super-testimonial'));
    }

    // delete testimonial
    public function deleteTestimonial()
    {
        // Delete testimonial from database
        $this->generic->Delete('web_testimonial', array('web_testimonialID' => $this->uri->segment(2)));
        $this->session->set_flashdata('successDeleted', 'Testimonial deleted successfully!');
        redirect(base_url('manage-super-testimonial'));
    }

    // change status 
    public function changeTestimonialStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Category deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Category activated successfully!');
        }
        $this->generic->Update('web_testimonial', array('web_testimonialID' => $this->uri->segment(2)), array('web_testimonialStatus' => $newStatus));
        redirect(base_url('manage-super-testimonial'));
    }

    // update testimonial
    public function updateTestimonial()
    {
        // Get testimonial data
        $this->data['testimonialData'] = $this->generic->GetData('web_testimonial', array('web_testimonialID' => $this->uri->segment(2)));
        // Load view
        $this->load->view('superadmin/testimonial/updatetestimonial', $this->data);
    }

    // process update testimonial
    public function processUpdateTestimonial()
    {
        $testiID = $this->uri->segment(2);
        $testiRating = $this->input->post('testiRating');
        $testiReview = $this->input->post('testiReview');
        $testiName = $this->input->post('testiName');
        $testiLocation = $this->input->post('testiLocation');
        //get testiminial data
        $testiminial = $this->generic->GetData('web_testimonial', array('web_testimonialID' => $testiID));
        //check if we have image posted
        if (empty($_FILES['testiImage']['name'])) {
            $personImage = $testiminial[0]['web_testimonialImg'];
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/testimonial';
            $config['allowed_types']        = 'svg|png|jpg|jpeg';
            $config['max_size']             = 500;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('testiImage')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-super-testimonial'));
            } else {
                $uploadData = $this->upload->data();
                $personImage = $uploadData['file_name'];
            }
        }
        $data = array(
            'web_testimonialRating' => $testiRating,
            'web_testimonialDesp' => $testiReview,
            'web_testimonialName' => $testiName,
            'web_testimonialLocation' => $testiLocation,
            'web_testimonialImg' => $personImage,
        );
        $this->generic->Update('web_testimonial', array('web_testimonialID' => $testiID), $data);
        $this->session->set_flashdata('success-edited', 'Person deleted successfully!');
        redirect(base_url('manage-super-testimonial'));
    }

    // manage super blog page load

    //--manage blog category
    public function manageBlogCat()
    {
        $this->data['blogCat'] = $this->generic->GetBlogCatData();
        $this->load->view('superadmin/blog/blogCat', $this->data);
    }
    public function blogCatData()
    {
        $catName = $this->input->post('catName');
        //add page
        //get all seo part inputs
        $metaTitle = $this->input->post('metaTittle');
        // normalize title: trim, replace any whitespace sequence with a hyphen, then lowercase
        $Slug = strtolower(preg_replace('/\s+/', '-', trim($catName)));
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        //page entry
        $pagedata = array(
            'slug' => $Slug,
            'pageType' => 4,
            'pageStatus' => 1
        );
        $this->generic->InsertData('web_pages', $pagedata);
        //get page max page id
        $pageID = $this->generic->GetMaxID('web_pages', 'pageID');
        //seo data entry
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $catName . " | equipmanager.dk";
        }
        $seodata = array(
            'pageID' => $pageID[0]['result'],
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->InsertData('web_page_meta', $seodata);
        //add blog cat data
        $blogcatData = array(
            'pageID' => $pageID[0]['result'],
            'blogCat' => $this->input->post('catName'),
            'blogCatDesc' => $this->input->post('catDesc'),
        );
        $this->generic->InsertData('web_blog_cat', $blogcatData);
        $this->session->set_flashdata('successadded', 'addedd');
        redirect(base_url('manage-blog-category'));
    }

    public function DltBlogCat()
    {
        // Delete blog from database
        $blogcat = $this->generic->GetData('web_blog_cat', array('blogCatID' => $this->uri->segment(2)));
        $this->generic->Delete('web_pages', array('pageID' => $blogcat[0]['pageID']));
        $this->generic->Delete('web_page_meta', array('pageID' => $blogcat[0]['pageID']));
        $this->generic->Delete('web_blog_cat', array('blogCatID' => $this->uri->segment(2)));
        $this->session->set_flashdata('successDeleted', 'Blog Category deleted successfully!');
        redirect(base_url('manage-blog-category'));
    }

    // change status blog cat
    public function changeBlogCatStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Category deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Category activated successfully!');
        }
        $this->generic->Update('web_pages', array('pageID' => $this->uri->segment(2)), array('pageStatus' => $newStatus));
        redirect(base_url('manage-blog-category'));
    }

    public function updateBlogCat()
    {
        $this->data['blogCatData'] = $this->generic->GetBlogCatData(array('bc.blogCatID' => $this->uri->segment(2)));
        $this->load->view('superadmin/blog/EditBlogCat', $this->data);
    }
    public function updateBlogCatData()
    {
        $catName = $this->input->post('catName');
        //add page
        //get all seo part inputs
        $metaTitle = $this->input->post('metaTittle');
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $catName . " | equipmanager.dk";
        }
        $seodata = array(
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->Update('web_page_meta', array('pageID' => $this->uri->segment(3)), $seodata);
        //add blog cat data
        $blogcatData = array(
            'blogCat' => $this->input->post('catName'),
            'blogCatDesc' => $this->input->post('catDesc'),
        );
        $this->generic->Update('web_blog_cat', array('pageID' => $this->uri->segment(3)), $blogcatData);
        $this->session->set_flashdata('updatedCat', 'Blog Category deleted successfully!');
        redirect(base_url('manage-blog-category'));
    }
    public function ManageSuperBlog()
    {
        $this->data['blogCatData'] = $this->generic->GetBlogCatData(array('p.pageStatus' => 1));
        $this->load->view('superadmin/blog/addblog', $this->data);
    }

    // show super blog page load
    public function showSuperBlog()
    {
        $this->data['showblogdata'] = $this->generic->GetBlogData();
        $this->load->view('superadmin/blog/showblog', $this->data);
    }
    public function changeBlogStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Category deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Category activated successfully!');
        }
        $this->generic->Update('web_pages', array('pageID' => $this->uri->segment(2)), array('pageStatus' => $newStatus));
        redirect(base_url('show-super-blog'));
    }

    // add blog
    public function addSuperBlog()
    {
        $blogCate = $this->input->post('blogCate');
        $blogDate = $this->input->post('blogDate');
        $blogTitle = $this->input->post('blogTitle');
        $blogDesp = $this->input->post('blogDesp');
        $metaTitle = $this->input->post('metaTittle');
        // normalize title: trim, replace any whitespace sequence with a hyphen, then lowercase
        $Slug = strtolower(preg_replace('/\s+/', '-', trim($blogTitle)));
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        //page entry
        $pagedata = array(
            'slug' => $Slug,
            'pageType' => 5,
            'pageStatus' => 1
        );
        $this->generic->InsertData('web_pages', $pagedata);
        //get page max page id
        $pageID = $this->generic->GetMaxID('web_pages', 'pageID');
        //seo data entry
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $blogTitle . " | equipmanager.dk";
        }
        $seodata = array(
            'pageID' => $pageID[0]['result'],
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->InsertData('web_page_meta', $seodata);

        //check if we have image posted
        if (empty($_FILES['blogImage']['name'])) {
            $blogImage = 'testimonial.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/blog';
            $config['allowed_types']        = 'png|jpg|jpeg';
            $config['max_size']             = 1024;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('blogImage')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('add-blog'));
            } else {
                $uploadData = $this->upload->data();
                $blogImage = $uploadData['file_name'];
            }
        }
        $data = array(
            'pageID' => $pageID[0]['result'],
            'blogCatID' => $blogCate,
            'web_blogDate' => $blogDate,
            'web_blogTitle' => $blogTitle,
            'web_blogDesp' => $blogDesp,
            'web_blogImg' => $blogImage,
        );
        $this->generic->InsertData('web_blogs', $data);
        $this->session->set_flashdata('successadde', 'Person deleted successfully!');
        redirect(base_url('manage-super-blog'));
    }

    // delete blog
    public function deletSuperBlog()
    {
        // Delete blog from database
        $blogcat = $this->generic->GetData('web_blogs', array('web_blogID' => $this->uri->segment(2)));
        $this->generic->Delete('web_pages', array('pageID' => $blogcat[0]['pageID']));
        $this->generic->Delete('web_page_meta', array('pageID' => $blogcat[0]['pageID']));
        $this->generic->Delete('web_blogs', array('web_blogID' => $this->uri->segment(2)));
        $this->session->set_flashdata('successDeleted', 'Blog deleted successfully!');
        redirect(base_url('show-super-blog'));
    }

    // update blog
    public function updateSuperBlog()
    {
        //load category
        $this->data['blogCatData'] = $this->generic->GetBlogCatData(array('p.pageStatus' => 1));
        // Get blog data
        $this->data['blogData'] = $this->generic->GetBlogData(array('wb.web_blogID' => $this->uri->segment(2)));
        // Load view
        $this->load->view('superadmin/blog/updateblog', $this->data);
    }

    // process blog update
    public function processUpdateBlog()
    {
        $blogID = $this->uri->segment(2);
        $blogCate = $this->input->post('blogCate');
        $blogDate = $this->input->post('blogDate');
        $blogTitle = $this->input->post('blogTitle');
        $blogDesp = $this->input->post('blogDesp');

        //get all seo part inputs
        $metaTitle = $this->input->post('metaTittle');
        $metaKeywords = $this->input->post('metaKeyword');
        $metaDesc = $this->input->post('metaDesc');
        $heading1 = $this->input->post('heading1');
        $heading2 = $this->input->post('heading2');
        $headingDesc1 = $this->input->post('headingDesc1');
        $headingDesc2 = $this->input->post('headingDesc2');
        if ($metaTitle) {
            $pageTittle = $metaTitle;
        } else {
            $pageTittle = $blogTitle . " | equipmanager.dk";
        }
        $seodata = array(
            'metaTittle' => $pageTittle,
            'metaKeywords' => $metaKeywords,
            'metaDesc' => $metaDesc,
            'h1' => $heading1,
            'h2' => $heading2,
            'p1' => $headingDesc1,
            'p2' => $headingDesc2
        );
        $this->generic->Update('web_page_meta', array('pageID' => $this->uri->segment(3)), $seodata);
        $blogdata = $this->generic->GetData('web_blogs', array('web_blogID' => $this->uri->segment(2)));
        //check if we have image posted
        if (empty($_FILES['blogImage']['name'])) {
            $blogImage = $blogdata[0]['web_blogImg'];
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/blog';
            $config['allowed_types']        = 'png|jpg|jpeg';
            $config['max_size']             = 1024;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('blogImage')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('add-blog'));
            } else {
                $uploadData = $this->upload->data();
                $blogImage = $uploadData['file_name'];
            }
        }
        $data = array(
            'blogCatID' => $blogCate,
            'web_blogDate' => $blogDate,
            'web_blogTitle' => $blogTitle,
            'web_blogDesp' => $blogDesp,
            'web_blogImg' => $blogImage,
        );
        $this->generic->Update('web_blogs', array('web_blogID' => $blogID), $data);
        $this->session->set_flashdata('successupdated', 'Person deleted successfully!');
        redirect(base_url('show-super-blog'));
    }

    // manage super success metrics page load
    public function manageSuccess()
    {
        // get data from database
        $this->data['successData'] = $this->generic->GetData('web_success', array(), 'web_successID', 'DESC');
        $this->load->view('superadmin/success/managesuccess', $this->data);
    }

    // add success
    public function addSuccess()
    {
        $sucesTitle = $this->input->post('sucesTitle');
        $sucesDesp = $this->input->post('sucesDesp');

        //check if we have image posted
        if (empty($_FILES['sucesIcon']['name'])) {
            $successIcon = 'metrics.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/success-metrics';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 300;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('sucesIcon')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-success'));
            } else {
                $uploadData = $this->upload->data();
                $successIcon = $uploadData['file_name'];
            }
        }

        $data = array(
            'web_successIcon' => $successIcon,
            'web_successName' => $sucesTitle,
            'web_successDes' => $sucesDesp,
            'web_successStatus' => 1,
        );
        $this->generic->InsertData('web_success', $data);
        $this->session->set_flashdata('success', 'Metrics added successfully!');
        redirect(base_url('manage-success'));
    }

    // change success status
    public function changeSuccessCatStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Metrics deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Metrics activated successfully!');
        }
        $this->generic->Update('web_success', array('web_successID' => $this->uri->segment(2)), array('web_successStatus' => $newStatus));
        redirect(base_url('manage-success'));
    }

    // delete success
    public function deleteSuccess()
    {
        $this->generic->Delete('web_success', array('web_successID' => $this->uri->segment(2)));
        $this->session->set_flashdata('success-delete', 'Metrics Deleted!');
        redirect(base_url('manage-success'));
    }

    // update success page laod
    public function updateSuccess()
    {
        $this->data['successData'] = $this->generic->GetData('web_success', array('web_successID' => $this->uri->segment(2)));
        $this->load->view('superadmin/success/updatemanagesuccess', $this->data);
    }

    // process update success
    public function processUpdateSuccess()
    {
        $sucesID = $this->uri->segment(2);
        $sucesTitle = $this->input->post('sucesTitle');
        $sucesDesp = $this->input->post('sucesDesp');

        //check if we have image posted
        if (empty($_FILES['sucesIcon']['name'])) {
            $successIcon = 'metrics.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/success-metrics';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 300;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('sucesIcon')) {
                $error = array('error' => $this->upload->display_errors());
                // die(print_r($error));
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-success'));
            } else {
                $uploadData = $this->upload->data();
                $successIcon = $uploadData['file_name'];
            }
        }

        $data = array(
            'web_successIcon' => $successIcon,
            'web_successName' => $sucesTitle,
            'web_successDes' => $sucesDesp,
            'web_successStatus' => 1,
        );
        $this->generic->Update('web_success', array('web_successID' => $sucesID), $data);
        $this->session->set_flashdata('success-update', 'Metrics added successfully!');
        redirect(base_url('manage-success'));
    }

    // company page load
    public function manageCompany()
    {
        $this->data['companyData'] = $this->generic->GetData('web_company', array(), 'web_companyID', 'DESC');
        $this->load->view('superadmin/partners/managepartners', $this->data);
    }

    // add partner
    public function addPartner()
    {
        //check if we have image posted
        if (empty($_FILES['sucesIcon']['name'])) {
            $partnerIcon = 'partner.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/partner';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 300;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('sucesIcon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-company'));
            } else {
                $uploadData = $this->upload->data();
                $partnerIcon = $uploadData['file_name'];
            }
        }

        $data = array(
            'web_companyIcon' => $partnerIcon,
            'web_companyStatus' => 1,
        );
        $this->generic->InsertData('web_company', $data);
        $this->session->set_flashdata('success', 'Partner added successfully!');
        redirect(base_url('manage-company'));
    }

    // change status
    public function changePartnerStatus()
    {
        if ($this->uri->segment(3) == 1) {
            $newStatus = 0;
            $this->session->set_flashdata('statusDeactivated', 'Metrics deactivated successfully!');
        } else {
            $newStatus = 1;
            $this->session->set_flashdata('statusActivated', 'Metrics activated successfully!');
        }
        $this->generic->Update('web_company', array('web_companyID' => $this->uri->segment(2)), array('web_companyStatus' => $newStatus));
        redirect(base_url('manage-company'));
    }

    // delete partner
    public function deletePartner()
    {
        $this->generic->Delete('web_company', array('web_companyID' => $this->uri->segment(2)));
        $this->session->set_flashdata('success-delete', 'Partner Deleted!');
        redirect(base_url('manage-company'));
    }

    // update parnter
    public function updatePartner()
    {
        $this->data['partnerdata'] = $this->generic->GetData('web_company', array('web_companyID' => $this->uri->segment(2)));
        $this->load->view('superadmin/partners/updatemanagepartners', $this->data);
    }

    // process update partner
    public function processUpdatePartner()
    {
        $prntID = $this->uri->segment(2);
        //check if we have image posted
        if (empty($_FILES['sucesIcon']['name'])) {
            $partnerIcon = 'partner.svg';
        } else {
            //upload person image
            $config['upload_path']          = './assets/uploads/superadmin/partner';
            $config['allowed_types']        = 'svg';
            $config['max_size']             = 300;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('sucesIcon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect(base_url('manage-company'));
            } else {
                $uploadData = $this->upload->data();
                $partnerIcon = $uploadData['file_name'];
            }
        }

        $data = array(
            'web_companyIcon' => $partnerIcon,
            'web_companyStatus' => 1,
        );
        $this->generic->Update('web_company', array('web_companyID' => $prntID), $data);
        $this->session->set_flashdata('success-update', 'Partner added successfully!');
        redirect(base_url('manage-company'));
    }

    //market place listing management
    public function MarketplaceListing(){
        $where=array();
		if (isset($_GET['ItemType']) && $_GET['ItemType'] != '') {
			$where['si.itemType'] = $_GET['ItemType'];
		}
		if (isset($_GET['listingType']) && $_GET['listingType'] != '') {
			$where['si.saleType'] = $_GET['ItemType'];
		}
		if (isset($_GET['listingStatus']) && $_GET['listingStatus'] != '') {
			$where['si.itemStatus'] = $_GET['listingStatus'];
		}
        $where['si.itemStatus!=']=4;
		$this->data['listing'] = $this->generic->GetMarketPlaceListingData($where);
		$this->load->view('superadmin/marketplaceListing/all-listing', $this->data);
    }
    public function MarketplaceListingMarkedApproved(){
        $this->generic->Update('shopitem',array('itemID'=>$_GET['listingID']),array('itemStatus'=>1,'liveStatus'=>1));
         $this->session->set_flashdata('approved', 'Partner added successfully!');
        redirect(base_url('admin-marketplace-listing'));
    }
    public function MarketplaceListingMarkedRejected(){
        $this->generic->Update('shopitem',array('itemID'=>$_GET['listingID']),array('itemStatus'=>3));
         $this->session->set_flashdata('rejected', 'Partner added successfully!');
        redirect(base_url('admin-marketplace-listing'));
    }
    public function ChangeMarketplacelistingWebsiteStatus(){
        $curentStatus=$this->uri->segment(3);
        if($curentStatus==1){
            $this->generic->Update('shopitem',array('itemID'=>$this->uri->segment(2)),array('liveStatus'=>0));
             $this->session->set_flashdata('notLive', 'Partner added successfully!');
             
        }else{
            $this->generic->Update('shopitem',array('itemID'=>$this->uri->segment(2)),array('liveStatus'=>1));
            $this->session->set_flashdata('live', 'Partner added successfully!');
        }
        if($this->session->userdata('loginData')['userType']==1){
         redirect(base_url('admin-marketplace-listing'));
        }else{
            redirect(base_url('all-listing'));
        }
    }

    /**
     * Payments Dashboard - View all payments and pending payouts
     */
    public function payments()
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            redirect(base_url());
            return;
        }

        // Get pending payouts
        $this->data['pending_payouts'] = $this->payment->getPendingPayouts();

        // Get payment statistics
        $this->data['stats'] = $this->payment->getPaymentStats();

        $this->load->view('superadmin/payments/dashboard', $this->data);
    }

    /**
     * Approve payout
     */
    public function approvePayout()
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            return;
        }

        $payout_id = $this->input->post('payout_id');
        $notes = $this->input->post('notes');

        if (!$payout_id) {
            echo json_encode(['success' => false, 'error' => 'Payout ID required']);
            return;
        }

        $admin_id = $this->session->userdata('loginData')['userID'];
        $this->payment->updatePayoutStatus($payout_id, 'approved', $admin_id, $notes);

        $this->session->set_flashdata('success', 'Payout approved successfully!');
        echo json_encode(['success' => true]);
    }

    /**
     * Reject payout
     */
    public function rejectPayout()
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            return;
        }

        $payout_id = $this->input->post('payout_id');
        $notes = $this->input->post('notes');

        if (!$payout_id) {
            echo json_encode(['success' => false, 'error' => 'Payout ID required']);
            return;
        }

        $admin_id = $this->session->userdata('loginData')['userID'];
        $this->payment->updatePayoutStatus($payout_id, 'rejected', $admin_id, $notes);

        $this->session->set_flashdata('error', 'Payout rejected');
        echo json_encode(['success' => true]);
    }

    /**
     * Set commission percentage for an item
     */
    public function setItemCommission()
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            return;
        }

        $item_id = $this->input->post('item_id');
        $commission_percent = floatval($this->input->post('commission_percent'));

        if (!$item_id || $commission_percent < 0 || $commission_percent > 100) {
            echo json_encode(['success' => false, 'error' => 'Invalid input']);
            return;
        }

        $admin_id = $this->session->userdata('loginData')['userID'];
        $this->payment->setItemCommission($item_id, $commission_percent, $admin_id);

        $this->session->set_flashdata('success', 'Commission set successfully!');
        echo json_encode(['success' => true]);
    }

    /**
     * Display all orders from all companies (Super Admin view)
     */
    public function all_orders()
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            redirect(base_url());
            return;
        }

        $this->load->database();

        // Get filter parameter from URL
        $filter = $this->input->get('status');

        // Build query to get all orders
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.buyerUserID',
            'ep.sellerCompanyID',
            'ep.grossAmount',
            'ep.commissionAmount as commission',
            'ep.orderStatus as status',
            'ep.createdAt',
            'u.userName as buyerFirstName',
            'u.userEmail as buyerEmail',
            'cd.companyName'
        ])
        ->from('equipment_payments ep')
        ->join('users u', 'ep.buyerUserID = u.userID', 'left')
        ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left');

        // Apply filter if provided
        if ($filter && !empty($filter)) {
            $valid_filters = ['requested', 'payment_pending', 'payment_secured', 'shipped', 'completed', 'rejected'];
            if (in_array($filter, $valid_filters)) {
                $this->db->where('ep.orderStatus', $filter);
            }
        }

        // Order by newest first
        $this->db->order_by('ep.createdAt', 'DESC');

        $query = $this->db->get();
        $orders = $query->result();

        // Prepare data for view
        $data = [
            'orders' => $orders,
            'filter' => $filter
        ];

        // Load the view with layout
        $this->load->view('superadmin/all_orders', $data);
    }

    /**
     * Display detailed order information (Super Admin view)
     */
    public function view_order($order_id)
    {
        // Check if user is SuperAdmin
        if ($this->session->userdata('loginData')['userType'] != 1) {
            redirect(base_url());
            return;
        }

        // Validate order ID is numeric
        if (!is_numeric($order_id)) {
            show_404();
            return;
        }

        $this->load->database();

        // Get complete order details
        $order = $this->db->select([
            'ep.*',
            'e.equipName as equipmentName',
            'e.equipDesc',
            'e.equipImg as equipImage',
            'e.equipTotalQuantity',
            'u.userName as buyerName',
            'u.userEmail as buyerEmail',
            'u.userPhone as buyerPhone',
            'cd.companyName as sellerCompanyName',
            'seller.userName as sellerUserName',
            'oc.chatID',
            'approver.userName as approvedByName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('users u', 'ep.buyerUserID = u.userID', 'left')
        ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
        ->join('users seller', 'cd.userID = seller.userID', 'left')
        ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
        ->join('users approver', 'ep.approvedBy = approver.userID', 'left')
        ->where('ep.equipmentPaymentID', $order_id)
        ->get()
        ->row();

        if (!$order) {
            show_404();
            return;
        }

        // Build images array — try shopequipments first, fallback to equipment main image
        $images = [];
        if (!empty($order->itemID)) {
            $shop_eq = $this->db->select([
                'eqpimg1','eqpimg2','eqpimg3','eqpimg4','eqpimg5',
                'eqpimg6','eqpimg7','eqpimg8','eqpimg9','eqpimg10'
            ])->from('shopequipments')->where('itemID', $order->itemID)->limit(1)->get()->row();
            if ($shop_eq) {
                for ($i = 1; $i <= 10; $i++) {
                    $f = 'eqpimg' . $i;
                    if (!empty($shop_eq->$f)) $images[] = 'assets/website/images/' . $shop_eq->$f;
                }
            }
        }
        if (empty($images) && !empty($order->equipmentID)) {
            $shop_eq = $this->db->select([
                'eqpimg1','eqpimg2','eqpimg3','eqpimg4','eqpimg5',
                'eqpimg6','eqpimg7','eqpimg8','eqpimg9','eqpimg10'
            ])->from('shopequipments')->where('equipmentID', $order->equipmentID)->limit(1)->get()->row();
            if ($shop_eq) {
                for ($i = 1; $i <= 10; $i++) {
                    $f = 'eqpimg' . $i;
                    if (!empty($shop_eq->$f)) $images[] = 'assets/website/images/' . $shop_eq->$f;
                }
            }
        }
        if (empty($images) && !empty($order->equipImage)) {
            $images[] = 'assets/website/images/' . $order->equipImage;
        }

        // Prepare data for view
        $data = [
            'order'  => $order,
            'images' => $images
        ];

        // Load the view with layout
        $this->load->view('superadmin/order_detail', $data);
    }
}

