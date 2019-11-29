<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    /* Konstruktor Function */
    public function __construct()
    {
        parent::__construct(); //memanggil method construct yg ada di CI_Controller
        is_logged_in();
         $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        /*rules validasi modal */
        $this->form_validation->set_rules('menu', 'Menu', 'required');


        /*validasi modal menu*/
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function deleteMenu($menu_id)
    {
        $data = $this->db->get_where('user_menu', ['menu_id' => $menu_id])->row_array();
        $data2 = $this->db->get_where('user_sub_menu', ['menu_id' => $menu_id])->row_array();

        if ($data['menu_id'] != $data2['menu_id']) {
            $this->db->delete('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted!</div>');
            redirect('menu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('menu');
        }  
    }

    public function editMenu()
    {
        $m_id = $this->input->post('menuId');
        $m = $this->input->post('menu');

        $this->db->set('menu', $m);
        $this->db->where('menu_id', $m_id);
        $this->db->update('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been updated!</div>');
        redirect('menu');
    }

    public function selectMenu($menu_id)
    {
        $data = $this->db->get_where('user_menu', ['menu_id' => $menu_id])->row_array();
        $data2 = $this->db->get_where('user_sub_menu', ['menu_id' => $menu_id])->row_array();

        if ($data['menu_id'] != $data2['menu_id']) {
            $data['title'] = 'Edit Menu';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
            $data['menu'] = $this->db->get_where('user_menu', ['menu_id' => $menu_id])->row_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer'); 
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot delete or update a parent row!</div>');
            redirect('menu');
        }    
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        /*rules validasi modal */
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    // public function deleteSubmenu($submenu_id)
    // {
    //     $data = $this->db->get_where('user_sub_menu', ['submenu_id' => $submenu_id])->row_array();
    //     $this->db->delete('user_sub_menu', $data);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted!</div>');
    //     redirect('menu/submenu');
    // }

    public function selectSubmenu($submenu_id)
    {
            $data['title'] = 'Edit Submenu';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
            $data['submenu'] = $this->menu->get_join_menu($submenu_id)->row_array();
            $data['menu'] = $this->db->get('user_menu')->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/footer');   
    }

    public function editSubmenu()
    {
        $id = $this->input->post('submenuId');
        $title = $this->input->post('title');
        $menu = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $active = $this->input->post('is_active');


        $this->db->set('title', $title);
        $this->db->set('menu_id', $menu);
        $this->db->set('url', $url);
        $this->db->set('icon', $icon);
        $this->db->set('is_active', $active);
        $this->db->where('submenu_id', $id);
        $this->db->update('user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu has been updated!</div>');
        redirect('menu/submenu');  
    }
}
