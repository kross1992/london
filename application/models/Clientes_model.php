<?php
class Clientes_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_clientes($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $query = $this->db->get('clientes');
                    return $query->result_array();
            }

            $query = $this->db->get_where('clientes', array('id' => $id));
            return $query->row_array();
    }

    public function set_clientes()
    {
        $this->load->helper('url');

        //$cedula = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'cedula' => $this->input->post('cedula'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'fecha_nacimiento' => $this->input->post('fecha'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular'),
            'empresa' => $this->input->post('empresa'),
            'direccion1' => $this->input->post('direccion1'),
            'direccion2' => $this->input->post('direccion2')

        );

        return $this->db->insert('clientes', $data);
    }

    public function edit_cliente($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'cedula' => $this->input->post('cedula'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'fecha_nacimiento' => $this->input->post('fecha'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular'),
            'empresa' => $this->input->post('empresa'),
            'direccion1' => $this->input->post('direccion1'),
            'direccion2' => $this->input->post('direccion2')

        );

        $this->db->where('id', $id);
        return $this->db->update('clientes', $data);
    }
}