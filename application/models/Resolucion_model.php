<?php
class Resolucion_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_resolucion($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $query = $this->db->get('resolucion_factura');
                    return $query->result_array();
            }

            $query = $this->db->get_where('resolucion_factura', array('id' => $id));
            return $query->row_array();
    }

    public function set_resolucion()
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'texto_resolucion' => $this->input->post('texto')
        );

        return $this->db->insert('resolucion_factura', $data);
    }

    public function edit_resolucion($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'texto_resolucion' => $this->input->post('texto_resolucion')
        );

        $this->db->where('id', $id);
        return $this->db->update('resolucion_factura', $data);
    }
}
