<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                    FROM user_sub_menu JOIN user_menu
                    ON user_sub_menu.menu_id = user_menu.menu_id
                ";
        return $this->db->query($query)->result_array();
    }

    function get_join_menu($id){
        $this->db->select('*');
        $this->db->from('user_menu');
        $this->db->join('user_sub_menu', 'user_menu.menu_id = user_sub_menu.menu_id');
        $this->db->where('user_sub_menu.submenu_id',$id);
        $query = $this->db->get();
        return $query;
    }

    public function getProduct()
    {
        $query = "SELECT * FROM product ORDER BY product ASC";
        return $this->db->query($query)->result_array();
    }

    public function getTransaction()
    {
        $query = "SELECT product.*, transaction.*
                    FROM product JOIN transaction
                    ON product.product_id = transaction.product_id
                    ORDER BY transaction.date_transaction ASC
                ";
        return $this->db->query($query)->result_array();
    }

    function get_join_transaction($id){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('transaction', 'transaction.product_id = product.product_id');
        $this->db->where('transaction.transaction_id',$id);
        $query = $this->db->get();
        return $query;
    }
    
    public function dateTransaction()
    {
        $query = "SELECT DATE_FORMAT(date_transaction,'%Y %m') as date
                    FROM transaction
                    GROUP BY DATE_FORMAT(date_transaction,'%Y %m')
                ";
        return $this->db->query($query)->result_array();
    }
    
    public function search($year_transaction)
    {
        $query = "ALTER VIEW total AS SELECT transaction.product_id, product.product, product.image, SUM(transaction.total) as total, DATE_FORMAT(transaction.date_transaction,'%Y %m') AS date, COUNT(transaction.product_id) as modus
                    FROM product JOIN transaction
                    ON product.product_id = transaction.product_id
                    WHERE DATE_FORMAT(transaction.date_transaction,'%Y %m') = '$year_transaction'
                    GROUP BY transaction.product_id
                ";
        return $this->db->query($query);
    }
    
    public function viewSearch()
    {
       
        $this->db->order_by('modus','DESC');
        return $this->db->get('total')->result_array();
    }

    public function deleteClass1()
    {
        $query = "DELETE FROM class1";
        return $this->db->query($query);
    }

    public function deleteClass2()
    {
        $query = "DELETE FROM class2";
        return $this->db->query($query);
    }
    
    public function accessClass1()
    {
        $query = "UPDATE class1 SET is_active = 1
                ";
        return $this->db->query($query);
    }

    public function unAccessClass1()
    {
        $query = "UPDATE class1 SET is_active = 0
                ";
        return $this->db->query($query);
    }

    public function accessClass2()
    {
        $query = "UPDATE class2 SET is_active = 1
                ";
        return $this->db->query($query);
    }

    public function unAccessClass2()
    {
        $query = "UPDATE class2 SET is_active = 0
                ";
        return $this->db->query($query);
    }

    public function bestClass1()
    {
        $query = "SELECT * FROM class1
                    WHERE is_active = 1
                    ORDER BY modus desc
                ";
        return $this->db->query($query)->result_array();
    }

    public function bestClass2()
    {
        $query = "SELECT * FROM class2
                    WHERE is_active = 1
                    ORDER BY modus desc
                ";
        return $this->db->query($query)->result_array();
    }

    public function promoClass1()
    {
        $query = "SELECT * FROM class1
                    WHERE is_active = 0
                    ORDER BY modus desc
                ";
        return $this->db->query($query)->result_array();
    }

    public function promoClass2()
    {
        $query = "SELECT * FROM class2
                    WHERE is_active = 0
                    ORDER BY modus desc
                ";
        return $this->db->query($query)->result_array();
    }

    function get_data_product($limit, $start){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('product','ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    function get_data_transaction($limit, $start){
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('product', 'product.product_id = transaction.product_id');
        $this->db->order_by('transaction.date_transaction','ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function getRoleAccess()
    {
        $query = "SELECT * FROM user_role
                    WHERE role_id IN
                    (SELECT role_id FROM user_access_menu)";
        return $this->db->query($query)->result_array();
    }

    public function deleteRoleAccess()
    {
        $query = "DELETE FROM user_role
                    WHERE role_id NOT IN
                    (SELECT role_id FROM user_access_menu)";
        return $this->db->query($query)->result_array;
    }


    public function deleteMenu()
    {
        $query = "DELETE FROM user_menu
                    WHERE menu_id NOT IN
                    (SELECT menu_id FROM user_sub_menu)";
        return $this->db->query($query)->result_array;
    }

}
