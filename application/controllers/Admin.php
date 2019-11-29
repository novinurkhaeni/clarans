<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    /* Konstruktor Function */
    public function __construct()
    {
        parent::__construct(); //memanggil method construct yg ada di CI_Controller
        is_logged_in();

        $this->load->library('pagination');
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function clarans()
    {
        $data['title'] = 'Clustering';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['year'] = $this->menu->dateTransaction();
        $data['year_transaction'] = $this->input->post('year_transaction');
        $this->menu->search($data['year_transaction']);
        $data['list'] = $this->menu->viewSearch();
        $data['total_cluster1'] = 0;
        $data['total_cluster2'] = 0;
        $data['sx'] = 0;
        $data['ax'] = 0;
        $data['bx'] = 0;
        $data['cluster1'] = array();
        $data['cluster2'] = array();

        $this->form_validation->set_rules('year_transaction', 'Year Transaction', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/cluster', $data);
            $this->load->view('templates/footer');
        } else {
            $numlocal = 2;
            $number_cluster = 2;
            $max_neighbor = (count($data['list']) - $number_cluster) / $number_cluster;
            $min_cost = 9999;

            for ($i = 1; $i <= $numlocal; $i++) {
                $current1 = rand(0, count($data['list']) - 1);
                $current2 = rand(0, count($data['list']) - 1);

                $j = 1;
                while ($j <= $max_neighbor) {
                    $s1 = rand(0, count($data['list']) - 1);
                    $s2 = rand(0, count($data['list']) - 1);

                    $cost_current1 = array();
                    $cost_current2 = array();
                    foreach ($data['list'] as $d) {
                        $tmp1 = abs($d['total'] - $data['list'][$current1]['total']) + abs($d['modus'] - $data['list'][$current1]['modus']);
                        array_push($cost_current1, $tmp1);
                        $tmp2 = abs($d['total'] - $data['list'][$current2]['total']) + abs($d['modus'] - $data['list'][$current2]['modus']);
                        array_push($cost_current2, $tmp2);
                    }
                    $min_result = array();
                    $result_best_node1 = array();
                    $result_best_node2 = array();
                    $result_class1 = array();
                    $result_class2 = array();
                    for ($ko = 0; $ko < count($cost_current1); $ko++) {
                        if ($cost_current1[$ko] < $cost_current2[$ko]) {
                            array_push($min_result, $cost_current1[$ko]);
                            array_push($result_class1, $cost_current1[$ko]);
                            $result_best_node1[$ko] = $cost_current1[$ko];
                        } else {
                            array_push($min_result, $cost_current2[$ko]);
                            array_push($result_class2, $cost_current2[$ko]);
                            $result_best_node2[$ko] = $cost_current2[$ko];
                        }
                    }
                    $cost_current = array_sum($min_result);
                    $cost_all_current1 = array_sum($cost_current1);
                    $cost_all_current2 = array_sum($cost_current2);
                    $cost_class1 = array_sum($result_class1);
                    $cost_class2 = array_sum($result_class2);
                    $n1 = count($result_class1);
                    $n2 = count($result_class2);

                    $cost_s1 = array();
                    $cost_s2 = array();
                    foreach ($data['list'] as $d) {
                        $data1 = abs($d['total'] - $data['list'][$current1]['total']) + abs($d['modus'] - $data['list'][$current1]['modus']);
                        array_push($cost_s1, $data1);
                        $data2 = abs($d['total'] - $data['list'][$current2]['total']) + abs($d['modus'] - $data['list'][$current2]['modus']);
                        array_push($cost_s2, $data2);
                    }
                    $min_result_s = array();
                    $result_node_s1 = array();
                    $result_node_s2 = array();
                    $result_new_class1 = array();
                    $result_new_class2 = array();
                    for ($kj = 0; $kj < count($cost_s1); $kj++) {

                        if ($cost_s1[$kj] < $cost_s2[$kj]) {
                            array_push($min_result_s, $cost_s1[$kj]);
                            array_push($result_new_class1, $cost_s1[$kj]);
                            $result_node_s1[$kj] = $cost_s1[$kj];
                        } else {
                            array_push($min_result_s, $cost_s2[$kj]);
                            array_push($result_new_class2, $cost_s2[$kj]);
                            $result_node_s2[$kj] = $cost_s2[$kj];
                        }
                    }
                    $cost_s = array_sum($min_result_s);
                    $cost_all_s1 = array_sum($cost_s1);
                    $cost_all_s2 = array_sum($cost_s2);
                    $cost_new_class1 = array_sum($result_new_class1);
                    $cost_new_class2 = array_sum($result_new_class2);
                    $ns1 = count($result_new_class1);
                    $ns2 = count($result_new_class2);

                    if ($cost_s < $cost_current) {
                        $result_best_node1 = $result_node_s1;
                        $result_best_node2 = $result_node_s2;
                        $cost_all_current1 = $cost_all_s1;
                        $cost_all_current2 = $cost_all_s2;
                        $n1 = $ns1;
                        $n2 = $ns2;
                        $cost_class1 = $cost_new_class1;
                        $cost_class2 = $cost_new_class2;
                        $cost_current = $cost_s;
                    } else {
                        $j++;
                    }
                }

                // $ai = ($cost_class1 / ($n1 - 1));
                // $bi = (($cost_all_current2 - $cost_class2) / $n2);
                if ($cost_current < $min_cost) {
                    $minCost = $cost_current;
                    if ($cost_class1 < 1) {
                        $sx = 0;
                    } else {
                        // $sx = ($bi - $ai) / max($ai, $bi);
                        $sx = ((($cost_all_current2 - $cost_class2) / $n2) - ($cost_class1 / ($n1 - 1))) / max(($cost_class1 / ($n1 - 1)), (($cost_all_current2 - $cost_class2) / $n2));
                    }
                    $data['cluster1'] = $result_best_node1;
                    $data['cluster2'] = $result_best_node2;
                    $data['total_cluster1'] = $cost_class1;
                    $data['total_cluster2'] = $cost_class2;
                    $data['sx'] = $sx;
                    $data['ax'] = $cost_class1 / ($n1 - 1);
                    $data['bx'] = ($cost_all_current2 - $cost_class2) / $n2;
                } else {
                    continue;
                }
            }

            $this->menu->deleteClass1();
            $this->menu->deleteClass2();

            foreach ($data['cluster1'] as $key => $cl1) {
                $data['list'][$key] = [
                    'product' => $data['list'][$key]['product'],
                    'image' => $data['list'][$key]['image'],
                    'total' => $data['list'][$key]['total'],
                    'modus' => $data['list'][$key]['modus']
                ];
                $this->db->insert('class1', $data['list'][$key]);
            }

            foreach ($data['cluster2'] as $key => $cl2) {
                $data['list'][$key] = [
                    'product' => $data['list'][$key]['product'],
                    'image' => $data['list'][$key]['image'],
                    'total' => $data['list'][$key]['total'],
                    'modus' => $data['list'][$key]['modus']
                ];
                $this->db->insert('class2', $data['list'][$key]);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/cluster', $data);
            $this->load->view('templates/footer');
        }
    }

    public function displayAccess()
    {
        $data['title'] = 'Display Cluster';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['class1'] = $this->menu->bestClass1();
        $data['class2'] = $this->menu->bestClass2();
        $data['promo1'] = $this->menu->promoClass1();
        $data['promo2'] = $this->menu->promoClass2();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/cluster_access', $data);
        $this->load->view('templates/footer');
    }

    public function clusterAccess()
    {
        $data['title'] = 'Display Cluster';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post('cluster') == 1) {
            $this->menu->accessClass1();
            $this->menu->unAccessClass2();
        } else {
            $this->menu->accessClass2();
            $this->menu->unAccessClass1();
        }
        $data['class1'] = $this->menu->bestClass1();
        $data['class2'] = $this->menu->bestClass2();
        $data['promo1'] = $this->menu->promoClass1();
        $data['promo2'] = $this->menu->promoClass2();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/cluster_access', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        /*rules validasi modal */
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function deleteRole($role_id)
    {
        $data = $this->db->get_where('user_role', ['role_id' => $role_id])->row_array();
        $data2 = $this->db->get_where('user_access_menu', ['role_id' => $role_id])->row_array();

        if ($data['role_id'] != $data2['role_id']) {
            $this->db->delete('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been deleted!</div>');
            redirect('admin/role');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('admin/role');
        }
    }

    public function editRole()
    {
        $r_id = $this->input->post('roleId');
        $r = $this->input->post('role');

        $this->db->set('role', $r);
        $this->db->where('role_id', $r_id);
        $this->db->update('user_role');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been updated!</div>');
        redirect('admin/role');
    }

    public function selectRole($role_id)
    {
        $data = $this->db->get_where('user_role', ['role_id' => $role_id])->row_array();
        $data2 = $this->db->get_where('user_access_menu', ['role_id' => $role_id])->row_array();

        if ($data['role_id'] != $data2['role_id']) {
            $data['title'] = 'Edit Role';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['role'] = $this->db->get_where('user_role', ['role_id' => $role_id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_role_access', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['role_id' => $role_id])->row_array();

        $this->db->where('menu_id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function inputData()
    {
        $data['title'] = 'Input Data Product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $config['base_url'] = site_url('admin/inputdata');
        $config['total_rows'] = $this->db->count_all('product');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $this->menu->get_data_product($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $data['product'] = $this->menu->getProduct();

        /*rules validasi modal */
        $this->form_validation->set_rules('product', 'Product', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/input_data_product', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gambar yg akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/product/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->insert('product', ['product' => $this->input->post('product')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New product added!</div>');
            redirect('admin/inputdata');
        }
    }

    public function deleteProduct($product_id)
    {
        $data = $this->db->get_where('product', ['product_id' => $product_id])->row_array();
        $data2 = $this->db->get_where('transaction', ['product_id' => $product_id])->row_array();

        if ($data['product_id'] != $data2['product_id']) {
            $this->db->delete('product', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product has been deleted!</div>');
            redirect('admin/inputdata');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('admin/inputdata');
        }
    }

    public function selectProduct($product_id)
    {
        $data = $this->db->get_where('product', ['product_id' => $product_id])->row_array();
        $data2 = $this->db->get_where('transaction', ['product_id' => $product_id])->row_array();

        if ($data['product_id'] != $data2['product_id']) {
            $data['title'] = 'Edit Data Transactions';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['product'] = $this->db->get_where('product', ['product_id' => $product_id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_data_product', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('admin/inputdata');
        }
    }

    public function editProduct()
    {
        $product = $this->input->post('product');
        $productId = $this->input->post('productId');
        //cek jika ada gambar yg akan diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/product/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('product', $product);
        $this->db->where('product_id', $productId);
        $this->db->update('product');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Product has been updated!</div>');
        redirect('admin/inputdata');
    }

    public function inputTransaction()
    {
        $data['title'] = 'Input Data Transactions';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $config['base_url'] = site_url('admin/inputtransaction');
        $config['total_rows'] = $this->db->count_all('transaction');
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $this->menu->get_data_transaction($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $data['transaction'] = $this->menu->getTransaction();
        $data['product'] = $this->menu->getProduct();

        /*rules validasi modal */
        $this->form_validation->set_rules('product_id', 'Product', 'required|trim');
        $this->form_validation->set_rules('total', 'Total', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/input_data_transaction', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'product_id' => $this->input->post('product_id'),
                'total' => $this->input->post('total'),
                'date_transaction' => $this->input->post('date')
            ];
            $this->db->insert('transaction', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New transaction added!</div>');
            redirect('admin/inputtransaction');
        }
    }

    public function deleteTransaction($transaction_id)
    {
        $data = $this->db->get_where('transaction', ['transaction_id' => $transaction_id])->row_array();
        $this->db->delete('transaction', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaction has been deleted!</div>');
        redirect('admin/inputdata');
    }

    public function selectTransaction($transaction_id)
    {
        $data['title'] = 'Edit Transaction';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['transaction'] = $this->menu->get_join_transaction($transaction_id)->row_array();
        $data['product'] = $this->db->get('product')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_data_transaction', $data);
        $this->load->view('templates/footer');
    }

    public function editTransaction()
    {
        $id = $this->input->post('transactionId');
        $product = $this->input->post('product_id');
        $total = $this->input->post('total');
        $date = $this->input->post('date');

        $this->db->set('product_id', $product);
        $this->db->set('total', $total);
        $this->db->set('date_transaction', $date);
        $this->db->where('transaction_id', $id);
        $this->db->update('transaction');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaction has been updated!</div>');
        redirect('admin/inputtransaction');
    }
}
