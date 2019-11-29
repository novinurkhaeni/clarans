<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get_data extends CI_Model
{
    public function getData()
    {
        $query = "SELECT transaction.product_id, product.product, product.image, SUM(transaction.total) as total, DATE_FORMAT(transaction.date_transaction,'%Y %m') AS date, COUNT(transaction.product_id) as modus
    FROM product JOIN transaction
    ON product.product_id = transaction.product_id
    WHERE DATE_FORMAT(transaction.date_transaction,'%Y %m') = '2018 11'
    GROUP BY transaction.product_id";
        return $this->db->query($query)->result_array();
    }

    public function transaksi()
    {
        $query = "select * from transaction WHERE DATE_FORMAT(transaction.date_transaction,'%Y %m') = '2018 11'";
        return $this->db->query($query)->result_array();
    }
}
