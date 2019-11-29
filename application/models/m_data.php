<?php 

class M_data extends CI_Model{
    
    function get_data_product($limit, $start){
        $query = $this->db->get('product', $limit, $start);
        return $query;
    }

    function get_data_transaction($limit, $start){
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('product', 'product.product_id = transaction.product_id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }
}