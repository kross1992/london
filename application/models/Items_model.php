<?php
class Items_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_items($id = FALSE, $cod= FALSE)
    {
            if ($id === FALSE and $cod === FALSE)
            {       
                    $this->db->select('i.id, i.codigo, i.descripcion, i.linea, i.categoria, c.descripcion as nom_categoria, i.linea, i.precio');
                    $this->db->from('items i');
                    $this->db->join('categorias c', 'i.categoria = c.codigo');
                    $this->db->order_by('i.descripcion', 'ASC');
                    $query = $this->db->get();
                
                    return $query->result_array();
            }else if(!empty($cod)){
                    $this->db->select('codigo');
                    $this->db->from('items');
                    $this->db->where('codigo', $cod);
                    $query = $this->db->get();
                    return $query->num_rows();
            }else{

            $query = $this->db->get_where('items', array('id' => $id));
            return $query->row_array();
            }
    }

    public function get_item($cod) {
        $this->db->select('codigo');
        $this->db->from('items');
        $this->db->where('codigo', "$cod");
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function set_items()
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'codigo' => $this->input->post('codigo'),
            'descripcion' => $this->input->post('descripcion'),
            'categoria' => $this->input->post('categoria'),
            'linea' => $this->input->post('linea')

        );

        return $this->db->insert('items', $data);
    }

    public function set_items_archivo($item, $descripcion, $categoria, $linea, $precio)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'codigo' => "$item",
            'descripcion' => "$descripcion",
            'categoria' => $categoria,
            'linea' => $linea,
            'precio' => $precio

        );

        return $this->db->insert('items', $data);
    }

    public function edit_item($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'codigo' => $this->input->post('codigo'),
            'descripcion' => $this->input->post('descripcion'),
            'categoria' => $this->input->post('categoria'),
            'linea' => $this->input->post('linea')

        );

        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }
}