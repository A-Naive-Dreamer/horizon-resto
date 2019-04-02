<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Pages extends CI_Controller {
        private $data = array();

        function __construct() {
            parent::__construct();
            $this -> load -> model('horizon_resto');
        }

        function _remap(string $method = 'section', array $params = array('home')) {
            if($method === 'section') {
                switch($params[0]) {
                    case 'home':
                        return call_user_func_array(array($this, 'home'), $params);
                        break;
                    case 'update-cuisine':
                        return call_user_func_array(array($this, 'update_cuisine'), $params);
                        break;
                    case 'cashier-table':
                        return call_user_func_array(array($this, 'cashier_table'), $params);
                        break;
                    case 'cuisine-menu':
                        return call_user_func_array(array($this, 'cuisine_menu'), $params);
                        break;
                    case 'report':
                        return call_user_func_array(array($this, 'report'), $params);
                        break;
                    case 'site-settings':
                        return call_user_func_array(array($this, 'site_settings'), $params);
                        break;
                    case 'log-in':
                        return call_user_func_array(array($this, 'log_in'), $params);
                        break;
                    case 'log-out':
                        return call_user_func_array(array($this, 'log_out'), $params);
                        break;
                    case 'register':
                        return call_user_func_array(array($this, 'register'), $params);
                        break;
                    case 'account-settings':
                        return call_user_func_array(array($this, 'account_settings'), $params);
                        break;
                    case 'my-orders':
                        return call_user_func_array(array($this, 'my_orders'), $params);
                        break;
                    case 'check':
                        return call_user_func_array(array($this, 'check'), $params);
                        break;
                    case 'booking':
                        return call_user_func_array(array($this, 'booking'), $params);
                        break;
                    case 'order':
                        return call_user_func_array(array($this, 'order'), $params);
                        break;
                    case 'report':
                        return call_user_func_array(array($this, 'report'), $params);
                        break;
                    case 'cashier-table':
                        return call_user_func_array(array($this, 'cashier_table'), $params);
                        break;
                    case 'cancel':
                        return call_user_func_array(array($this, 'cancel'), $params);
                        break;
                    case 'check-done':
                        return call_user_func_array(array($this, 'check_done'), $params);
                        break;
                    case 'delete-cuisine':
                        return call_user_func_array(array($this, 'delete_cuisine'), $params);
                        break;
                    case 'edit-cuisine':
                        return call_user_func_array(array($this, 'edit_cuisine'), $params);
                        break;
                    case 'add-cuisine':
                        return call_user_func_array(array($this, 'add_cuisine'), $params);
                        break;
                    case 'add-new-cuisine':
                        return call_user_func_array(array($this, 'add_new_cuisine'), $params);
                        break;
                }
            }

            show_404();
        }

        function update_cuisine($title = "Update Cuisine") {
            $data['title'] = 'Update Cuisine';

            $this -> horizon_resto -> update_cuisine();

            redirect('http://localhost/horizon-resto/site/index.php/pages/section/booking');
        }

        function add_new_cuisine($title = "Add New Cuisine") {
            $data['title'] = 'Add New Cuisine';

            $this -> horizon_resto -> add_new_cuisine();

            redirect('http://localhost/horizon-resto/site/index.php/pages/section/booking');
        }

        function cancel($title = 'Cancel', $id) {
            $data['title'] = 'Cancel Order';

            $this -> horizon_resto -> cancel($id);
        }

        function check_done($title = 'Check Done', $id) {
            $data['title'] = 'Check Done';

            $this -> horizon_resto -> check_done($id);
        }

        function cashier_table($title = 'Cashier Table') {
            $data['title'] = 'Cashier Table';
            $data['orders'] = $this -> horizon_resto -> get_undone_orders();

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/cashier_table.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function add_cuisine($title = 'Add Cuisine') {
            $data['title'] = 'Add Cuisine';

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/add_cuisine.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function home($title = 'Home') {
            $data['title'] = 'Home';

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/home.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function my_orders($title = 'My Orders') {
            $data['title'] = 'My Orders';
            $data['orders'] = $this -> horizon_resto -> get_specific_orders();

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/my_orders.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function report($title = 'Report') {
            $data['title'] = 'Report';
            $data['orders'] = $this -> horizon_resto -> get_orders();

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/report.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function booking($title = 'Booking') {
            $data['title'] = 'Booking';
            $data['cuisine'] = $this -> horizon_resto -> get_cuisine();

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/booking.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function order($title = 'Order') {
            $data['title'] = 'Order';

            $this -> horizon_resto -> add_order();

            redirect('http://localhost/horizon-resto/site/index.php/pages/section/my-orders');
        }

        function check() {
            $log_in_info = $this -> horizon_resto -> log_in();

            if(!empty($log_in_info['level_id'])) {
                $data['user'] = $log_in_info;
                $data['title'] = 'Check';

                $this -> load -> view('pages/store_hash.php', $data);
            } else {
                redirect('http://localhost/horizon-resto/site/index.php/pages/section/log-in');
            }
        }

        function log_in($title = 'Log In') {
            $data['title'] = 'Log In';

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/log_in.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function log_out($title = 'Log Out') {
            $data['title'] = 'Log Out';

            $this -> load -> view('pages/destroy_hash.php', $data);
        }

        function edit_cuisine($title = 'Edit Cuisine', $x) {
            $data['title'] = 'Edit Cuisine';
            $data['cuisine'] = $this -> horizon_resto -> get_specific_cuisine($x);

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/edit_cuisine.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
            
        }

        function delete_cuisine($title = 'Delete Cuisine', $x) {
            $data['title'] = 'Delete Cuisine';
            
            $this -> horizon_resto -> delete_cuisine($x);
            
            redirect('http://localhost/horizon-resto/site/index.php/pages/section/cuisine-menu');
        }

        function cuisine_menu($title = 'Cuisine Menu') {
            $data['title'] = 'Cuisine Menu';
            $data['cuisines'] = $this -> horizon_resto -> get_cuisine();

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/cuisine_menu.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }

        function register($title = 'Register') {
            $data['title'] = 'Register';

            $this -> load -> view('templates/meta.php', $data);
            $this -> load -> view('templates/navbar.xml');
            $this -> load -> view('templates/header.php');
            $this -> load -> view('pages/register.php', $data);
            $this -> load -> view('templates/sidebar.php');
            $this -> load -> view('templates/footer.xml');
            $this -> load -> view('templates/dependencies.php');
        }
    }
