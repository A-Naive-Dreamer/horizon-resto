<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Horizon_resto extends CI_Model {
        function __construct() {
            parent::__construct();

            $this -> load -> database();
        }

        function delete_cuisine($x) {
            $query = "DELETE FROM `cuisine` WHERE `id` = " . $this -> db -> escape($x) . ";";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function update_cuisine() {
            $name = $this -> input -> post('name');
            $price = $this -> input -> post('price');
            $status = $this -> input -> post('status');
            $id = $this -> input -> post('id');
            
            $query = "UPDATE `cuisine` SET `name` = '" . $this -> db -> escape_str($name) . "', `price` = " . $this -> db -> escape($price) . 
                ", `status` = '" . $this -> db -> escape_str($status) . "' WHERE `id` = " . $this -> db -> escape($id) . ";";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function get_cuisine() {
            $query = "SELECT * FROM `cuisine` ORDER BY `id` ASC;";
            $query = $this -> db -> query($query);

            $cuisine = $query -> result_array();

            $this -> db -> close();

            return $cuisine;
        }

        function get_max_id() {
            $query = "SELECT `id` FROM `cuisine` ORDER BY `id` DESC LIMIT 1;";
            $query = $this -> db -> query($query);

            $row = $query -> row_array();

            $this -> db -> close();

            return $row['id'];
        }

        function add_new_cuisine() {
            $name = $this -> input -> post('name');
            $price = $this -> input -> post('price');
            $status = $this -> input -> post('status');

            $query = "INSERT INTO `cuisine` VALUES(NULL, '" . $this -> db -> escape_str($name) . "', DEFAULT, " . $this -> db -> escape($price) . 
                ", '" . $this -> db -> escape_str($status) . "');";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function get_specific_cuisine($x) {
            $query = "SELECT * FROM `cuisine` WHERE `id` = " . $this -> db -> escape($x) . ";";
            $query = $this -> db -> query($query);

            $cuisine = $query -> result_array();

            $this -> db -> close();

            return $cuisine;
        }

        function get_orders() {
            $query = "SELECT `u`.`id`, `u`.`e_mail`, `u`.`name`, `o`.`table_number`, `o`.`message`, `o`.`status`, `o`.`fee`, " .
                "`o`.`reservation_date`, `o`.`reservation_time` FROM `user` `u` INNER JOIN `transaction` `t` ON `t`.`user_id` = `u`.`id` " .
                "INNER JOIN `order` `o` ON `t`.`order_id` = `o`.`id` ORDER BY `u`.`id`;";
            $query = $this -> db -> query($query);

            $orders = $query -> result_array();

            $this -> db -> close();

            return $orders;
        }

        function get_undone_orders() {
            $query = "SELECT `id`, `table_number`, `message`, `status`, `fee`, `reservation_date`, `reservation_time` FROM `order` WHERE " .
                "`status` = 'Plan' ORDER BY `id` ASC;";
            $query = $this -> db -> query($query);

            $orders = $query -> result_array();

            $this -> db -> close();

            return $orders;
        }

        function cancel($x) {
            $query = "UPDATE `order` SET `status` = 'Cancelled' WHERE `id` = " . $this -> db -> escape($x) . ";";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function check_done($x) {
            $query = "UPDATE `order` SET `status` = 'Done' WHERE `id` = " . $this -> db -> escape($x) . ";";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function get_specific_orders() {
            $user_id = 5;

            $query = "SELECT `o`.`id`, `o`.`table_number`, `o`.`message`, `o`.`status`, `o`.`fee`, `o`.`reservation_date`, " .
                "`o`.`reservation_time` FROM `order` `o` INNER JOIN `transaction` `t` ON `t`.`order_id` = `o`.`id` WHERE `t`.`user_id` = " .
                $this -> db -> escape($user_id) . " ORDER BY `id` ASC;";
            $query = $this -> db -> query($query);

            $orders = $query -> result_array();

            $this -> db -> close();

            return $orders;
        }

        function add_order() {
            $user_id = 5;
            $cuisines = json_decode($_POST['cuisines']);
            $table_number = $_POST['table_number'];
            $message = $_POST['message'];
            $reservation_date = $_POST['reservation_date'];
            $reservation_time = $_POST['reservation_time'];
            $fee = 0;

            for($x = 0; $x < count($cuisines); ++$x) {
                $fee += $cuisines[$x][0] * $cuisines[$x][2];
            }

            $query = "INSERT INTO `order` VALUES(NULL, " . $this -> db -> escape($table_number) . ", '" .
                $this -> db -> escape_str($message) . "', DEFAULT, " . $this -> db -> escape($fee) . ", '" .
                $this -> db -> escape_str($reservation_date) . "', '" . $this -> db -> escape_str($reservation_time) . "');";
            $query = $this -> db -> simple_query($query);

            $query = "SELECT `id` FROM `order` ORDER BY `id` DESC LIMIT 1;";
            $query = $this -> db -> query($query);

            $order = $query -> result_array();

            $query = "INSERT INTO `transaction` VALUES(NULL, " . $this -> db -> escape($user_id) . ", " .
                $order[0]['id']. ");";
            $query = $this -> db -> simple_query($query);

            for($x = 0; $x < count($cuisines); ++$x) {
                $query = "INSERT INTO `order_detail` VALUES(NULL, " . $order[0]['id'] . ", " .
                    $cuisines[$x][1] . ", " . $cuisines[$x][0] . ");";
                $query = $this -> db -> simple_query($query);
            }

            $this -> db -> close();
        }

        function delete_user() {
            $username = $this -> input -> post('username');
            $e_mail = $this -> input -> post('e_mail');
            $password = $this -> input -> post('password');
            $level_id = $this -> input -> post('level_id');

            $query = "DELETE FROM `user` WHERE `username` = '" . $this -> db -> escape_str($username) . "' AND " .
                "`e_mail` = '" . $this -> db -> escape_str($e_mail) . "' AND `password` = '" . $this -> db -> escape_str($password) .
                "' AND `level_id` = " . $this -> db -> escape($level_id) . ";";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function add_user() {
            $username = $this -> input -> post('username');
            $e_mail = $this -> input -> post('e_mail');
            $password = $this -> input -> post('password');
            $name = $this -> input -> post('name');
            $level_id = $this -> input -> post('level_id');

            $query = "INSERT INTO `user` VALUES(NULL, '" . $this -> db -> escape_str($username) . "', '" .
                $this -> db -> escape_str($e_mail) . "', '" . $this -> db -> escape_str($password) . "', '" .
                $this -> db -> escape_str($name) . "', " . $this -> db -> escape($level_id) . ");";
            $query = $this -> db -> simple_query($query);

            $this -> db -> close();
        }

        function log_in() {
            $level_id = 5;
            $username = $this -> input -> post('username');
            $e_mail = $this -> input -> post('e_mail');
            $password = $this -> input -> post('password');

            switch($this -> input -> post('privelege')) {
                case 'administrator':
                    $level_id = 1;
                    break;
                case 'owner':
                    $level_id = 2;
                    break;
                case 'cashier':
                    $level_id = 3;
                    break;
                case 'waiter':
                    $level_id = 4;
                    break;
                case 'guest':
                    $level_id = 5;
                    break;
            }

            $query = "SELECT `username` FROM `user` WHERE `username` = '" . $this -> db -> escape_str($username) . "' AND `level_id` =  '" . $this -> db -> escape($level_id) . "';";
            $query = $this -> db -> query($query);

            if($query -> num_rows() > 0) {
                $query -> free_result();

                $query = "SELECT `e_mail` FROM `user` WHERE `e_mail` = '" . $this -> db -> escape_str($e_mail) . "' AND `level_id` =  '" . $this -> db -> escape($level_id) . "';";
                $query = $this -> db -> query($query);

                if($query -> num_rows() > 0) {
                    $query -> free_result();

                    $query = "SELECT `password` FROM `user` WHERE `password` = '" . $this -> db -> escape_str($password) . "' AND `level_id` =  '" . $this -> db -> escape($level_id) . "';";
                    $query = $this -> db -> query($query);

                    if($query -> num_rows() > 0) {
                        $query -> free_result();

                        $this -> db -> close();

                        return array(
                            'level_id' => $level_id,
                            'username' => $username,
                            'e_mail' => $e_mail,
                            'password' => $password
                        );
                    }
                }
            }

            $this -> db -> close();

            return false;
        }
    }
