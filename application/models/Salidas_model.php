<?php
class Salidas_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_salidas($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $query = $this->db->get('salidas');
                    return $query->result_array();
            }

            $query = $this->db->get_where('salidas', array('id' => $id));
            return $query->row_array();
    }

    public function set_salidas()
    {
        $this->load->helper('url');

        //$item = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'factura' => $this->input->post('factura'),
            'item' => $this->input->post('item'),
            'proveedor' => $this->input->post('proveedor'),
            'costo_unidad' => $this->input->post('costo_unidad'),
            'cantidad' => $this->input->post('cantidad'),
            'costo_total' => $this->input->post('costo_total'),
            'reembolso' => $this->input->post('reembolso'),
            'observaciones' => $this->input->post('observaciones'),
        );

        return $this->db->insert('salidas', $data);
    }
}
