<?php
class Usuarios_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_usuarios($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $query = $this->db->get('usuarios');
                    return $query->result_array();
            }

            $query = $this->db->get_where('usuarios', array('id' => $id));
            return $query->row_array();
    }

    public function set_usuarios()
    {
        $this->load->helper('url');

        //$usuario = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'usuario' => $this->input->post('usuario'),
            'nombre' => $this->input->post('nombres'),
            'password' => $this->input->post('password'),
            'rol' => $this->input->post('rol'),
            'estado' => 1

        );

        return $this->db->insert('usuarios', $data);
    }

    public function edit_usuario($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'usuario' => $this->input->post('usuario'),
            'nombre' => $this->input->post('nombres'),
            'password' => $this->input->post('password'),
            'rol' => $this->input->post('rol'),
            'estado' => $this->input->post('estado')

        );

        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }

    public function login()
    {   
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        
        $query = $this->db->get_where('usuarios', array('usuario' => $usuario, 'password' => $password));
        return $query->row_array();
    }
}