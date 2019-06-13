<?php
class Existencias_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_existencias($item = FALSE)
    {
            if ($item === FALSE)
            {
                    $this->db->select('e.codigo, e.cantidad, i.id, i.descripcion, i.precio');
                    $this->db->from('existencias e');
                    $this->db->join('items i', 'e.codigo = i.codigo');
                    $this->db->order_by('i.descripcion', 'ASC');
                    $query = $this->db->get();
                    //return $query;
                    return $query->result_array();
            }

            $query = $this->db->get_where('existencias', array('codigo' => "$item"));
            return $query->row_array();
    }
    
    public function set_existencias()
    {
        $this->load->helper('url');

        $item = $this->input->post('item');
        $existencia = $this->get_existencias($item);

        if (empty($existencia)){
            $data = array(
                'codigo' => $this->input->post('item'),
                'cantidad' => $this->input->post('cantidad')
            );
            
            return $this->db->insert('existencias', $data);
        } else {
            $this->db->set('cantidad', $existencia['cantidad'] + $this->input->post('cantidad'));
            $this->db->where('id', $existencia['id']);
            return $this->db->update('existencias'); 
        }
    }

    public function set_existencias_archivo($item, $cantidad)
    {
        $this->load->helper('url');

        $existencia = $this->get_existencias($item);

        if (empty($existencia)){
            $data = array(
                'codigo' => "$item",
                'cantidad' => $cantidad
            );
            return $this->db->insert('existencias', $data);
        } else {
            $this->db->set('cantidad', $existencia['cantidad'] + $cantidad);
            $this->db->where('id', $existencia['id']);
            return $this->db->update('existencias'); 
        }
    }
    
    public function rest_existencias()
    {
        $this->load->helper('url');

        $item = $this->input->post('item');
        $existencia = $this->get_existencias($item);

        $this->db->set('cantidad', $existencia['cantidad'] - $this->input->post('cantidad'));
        $this->db->where('id', $existencia['id']);
        return $this->db->update('existencias'); 
        
    }

    
}