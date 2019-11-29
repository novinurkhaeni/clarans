<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clarans extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Hasil Klaster';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Get_data', 'data');
        $data = $this->data->getData();
        $jumlah_transaksi = $this->data->transaksi();
        $support = 30;
        $confidence = 40;

        $result = array();
        foreach ($data as $d) {
            $tmp = ($d['modus'] / count($jumlah_transaksi)) * 100;
            array_push($result, $tmp);
        }

        $positif = array();
        $negatif = array();
        $display = array();
        $undisplay = array();
        for ($i = 0; $i < count($result); $i++) {
            if ($result[$i] > $support) {
                array_push($positif, $result[$i]);
                $display[$i] = $result[$i];
            } else {
                array_push($negatif, $result[$i]);
                $undisplay[$i] = $result[$i];
            }
        }

        foreach ($result as $key => $r) {

            echo $result[$key];
            echo '<br/>';
        }

        echo '<br/>';
        echo '<br/>';

        foreach ($negatif as $key => $p) {
            // echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
            echo $negatif[$key];
            echo '<br/>';
        }

        echo '<br/>';
        echo '<br/>';

        foreach ($undisplay as $key => $ud) {
            echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
            echo '<br/>';
        }

        // $numlocal = 5;
        // $number_cluster = 2;
        // $max_neighbor = 0.5 * $number_cluster * (count($data) - $number_cluster);
        // $min_cost = 9999;
        // $cluster1 = array();
        // $cluster2 = array();

        // for ($i = 1; $i <= $numlocal; $i++) {
        //     $current1 = rand(0, count($data) - 1);
        //     $current2 = rand(0, count($data) - 1);

        //     $j = 1;
        //     while ($j <= $max_neighbor) {
        //         $s1 = rand(0, count($data) - 1);
        //         $s2 = rand(0, count($data) - 1);

        //         $cost_current1 = array();
        //         $cost_current2 = array();
        //         foreach ($data as $d) {
        //             $tmp1 = abs($d['total'] - $data[$current1]['total']) + abs($d['modus'] - $data[$current1]['modus']);
        //             array_push($cost_current1, $tmp1);
        //             $tmp2 = abs($d['total'] - $data[$current2]['total']) + abs($d['modus'] - $data[$current2]['modus']);
        //             array_push($cost_current2, $tmp2);
        //         }
        //         $min_result = array();
        //         $result_best_node1 = array();
        //         $result_best_node2 = array();
        //         for ($ko = 0; $ko < count($cost_current1); $ko++) {
        //             if ($cost_current1[$ko] < $cost_current2[$ko]) {
        //                 array_push($min_result, $cost_current1[$ko]);
        //                 // array_push($result_best_node1,$cost_current1[$ko]);
        //                 $result_best_node1[$ko] = $cost_current1[$ko];
        //             } else {
        //                 array_push($min_result, $cost_current2[$ko]);
        //                 // array_push($result_best_node2,$cost_current2[$ko]);
        //                 $result_best_node2[$ko] = $cost_current2[$ko];
        //             }
        //         }
        //         $cost_current = array_sum($min_result);

        //         $cost_s1 = array();
        //         $cost_s2 = array();
        //         foreach ($data as $d) {
        //             $data1 = abs($d['total'] - $data[$current1]['total']) + abs($d['modus'] - $data[$current1]['modus']);
        //             array_push($cost_s1, $data1);
        //             $data2 = abs($d['total'] - $data[$current2]['total']) + abs($d['modus'] - $data[$current2]['modus']);
        //             array_push($cost_s2, $data2);
        //         }
        //         $min_result_s = array();
        //         $result_node_s1 = array();
        //         $result_node_s2 = array();
        //         for ($kj = 0; $kj < count($cost_s1); $kj++) {

        //             if ($cost_s1[$kj] < $cost_s2[$kj]) {
        //                 array_push($min_result_s, $cost_s1[$kj]);
        //                 // array_push($result_node_s1,$cost_s1[$kj]);
        //                 $result_node_s1[$kj] = $cost_s1[$kj];
        //             } else {
        //                 array_push($min_result_s, $cost_s2[$kj]);
        //                 // array_push($result_node_s2,$cost_s2[$kj]);
        //                 $result_node_s2[$kj] = $cost_s2[$kj];
        //             }
        //         }
        //         $cost_s = array_sum($min_result_s);

        //         if ($cost_s < $cost_current) {
        //             $result_best_node1 = $result_node_s1;
        //             $result_best_node2 = $result_node_s2;
        //             $cost_current = $cost_s;
        //         } else {
        //             $j++;
        //         }
        //     }

        //     if ($cost_current < $min_cost) {
        //         $minCost = $cost_current;
        //         $cluster1 = $result_best_node1;
        //         $cluster2 = $result_best_node2;
        //     } else {
        //         continue;
        //     }
        // }

        // foreach ($cluster1 as $key => $c1) {
        //     echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
        //     echo '<br/>';
        // }

        // echo '<br/>';
        // echo '<br/>';

        // foreach ($cluster2 as $key => $c2) {
        //     echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
        //     echo '<br/>';
        // }

        // echo '<br/>';
        // echo '<br/>';

        // foreach($current_node1 as $key =>$n1){
        //     echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
        //     echo '<br/>';
        // }

        // echo '<br/>';
        // echo '<br/>';

        // foreach($current_node2 as $key =>$n1){
        //     echo $data[$key]['product'] . "\n" . $data[$key]['total'] . "\n" . $data[$key]['modus'];
        //     echo '<br/>';
        // }
    }
}
