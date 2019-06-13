<?php
class Proveedores_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_proveedores($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $query = $this->db->get('proveedores');
                    return $query->result_array();
            }

            $query = $this->db->get_where('proveedores', array('id' => $id));
            return $query->row_array();
    }

    public function set_proveedores()
    {
        $this->load->helper('url');

        //$identificacion = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'identificacion' => $this->input->post('identificacion'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular')

        );

        return $this->db->insert('proveedores', $data);
    }

    public function edit_proveedor($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'identificacion' => $this->input->post('identificacion'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('celular')

        );

        $this->db->where('id', $id);
        return $this->db->update('proveedores', $data);
    }
}