<?php
class Entradas_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_entradas($id = FALSE)
    {
            if ($id === FALSE)
            {       
                    $this->db->select('e.*, p.nombres as nom_proveedor, i.descripcion as nom_item ');
                    $this->db->from('entradas e');
                    $this->db->join('proveedores p', 'p.id = e.proveedor');
                    $this->db->join('items i', 'i.id = e.item');
                    $this->db->order_by('e.factura, i.descripcion', 'ASC');
                    $query = $this->db->get();

                    // $query = $this->db->get('entradas');
                    return $query->result_array();
            }

            $query = $this->db->get_where('entradas', array('id' => $id));
            return $query->row_array();
    }

    public function set_entradas()
    {
        $this->load->helper('url');

        //$item = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'factura' => $this->input->post('factura'),
            'item' => $this->input->post('item'),
            'proveedor' => $this->input->post('proveedor'),
            'costo_unidad' => $this->input->post('costo_unidad'),
            'cantidad' => $this->input->post('cantidad'),
            'costo_total' => $this->input->post('costo_total')

        );

        return $this->db->insert('entradas', $data);
    }

    public function edit_entrada($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'factura' => $this->input->post('factura'),
            'item' => $this->input->post('item'),
            'proveedor' => $this->input->post('proveedor'),
            'costo_unidad' => $this->input->post('costo_unidad'),
            'cantidad' => $this->input->post('cantidad'),
            'costo_total' => $this->input->post('costo_total')

        );

        $this->db->where('id', $id);
        return $this->db->update('entradas', $data);
    }
}