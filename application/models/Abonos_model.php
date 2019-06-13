<?php
class Abonos_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_abonos($id = FALSE)
    {
            if ($id === FALSE)
            {
                    $this->db->select('a.*, c.nombres, c.apellidos, c.cedula, v.costo_total, DATE_FORMAT(v.fecha,"%d/%m/%Y") AS fecha, t.descripcion');
                    $this->db->from('abonos a');
                    $this->db->join('ventas v', 'v.codigo_venta = a.codigo_venta');
                    $this->db->join('clientes c', 'c.id = v.cliente');    
                    $this->db->join('tipos_venta t', 't.id = v.tipo_venta');    
                    $this->db->where('v.tipo_venta <> 1');
                    $query = $this->db->get();
                    //return $query;
                    return $query->result_array();
            }

            $query = $this->db->get_where('abonos', array('id' => $id));
            return $query->row_array();
    }
    
    public function set_abonos()
    {
        $this->load->helper('url');
        if ($this->input->post('tipo_venta') != 1){
            $data = array(
                'codigo_venta' => $this->input->post('codigo_venta'),
                'abono' => $this->input->post('pago_total'),
                'saldo' => $this->input->post('costo_total')-$this->input->post('pago_total'),
            );
            //date_create_from_format("m/d/Y", $this->input->post('fecha'))->format('Y-m-d H:i:s'),
            return $this->db->insert('abonos', $data);
        } else 
            return false;       
    }
    
    
    public function set_detalles_abonos()
    {
        $this->load->helper('url');
        if ($this->input->post('tipo_venta') != 1 and $this->input->post('efectivo')>0){
            $data = array(
                'codigo_venta' => $this->input->post('codigo_venta'),
                'fecha' => $this->input->post('fecha'),
                'valor' => $this->input->post('pago_total'),
            );
            //date_create_from_format("m/d/Y", $this->input->post('fecha'))->format('Y-m-d H:i:s'),
            return $this->db->insert('detalles_abonos', $data);
        } else 
            return false;       
    }
    
    public function edit_abono($id = FALSE)
    {
        $this->load->helper('url');

        //$codigo = url_title($this->input->post('title'), 'dash', TRUE);
        if ($id === FALSE)
        {
            return 0;
        }

        $data = array(
            'abono' => ($this->input->post('abono')+$this->input->post('abonado')),
            'saldo' => $this->input->post('saldo')
        );

        $this->db->where('id', $id);
        return $this->db->update('abonos', $data);
    }
    
    public function insert_detalle_abono($codigo_fact)
    {
        $data = array(
            'codigo_venta' => $codigo_fact,
            'fecha' => $this->input->post('fecha'),
            'valor' => $this->input->post('abono'),
            'tipo_pago' => $this->input->post('tipo_pago')
        );
        return $this->db->insert('detalles_abonos', $data);
    }
    
    public function get_detalles_abonos($id)
    {
                    $this->db->select('d.id, d.codigo_venta, DATE_FORMAT(d.fecha,"%d/%m/%Y") AS fecha, d.valor, t.nombre AS tipo_pago');
                    $this->db->from('detalles_abonos d');
                    $this->db->join('tipo_pago t', 't.id = d.tipo_pago', 'left');
                    $this->db->where('codigo_venta',$id);
                    $query = $this->db->get();
                    return $query->result_array();
    }
    
    public function get_tipos_pago()
    {
                    $this->db->select('id, nombre');
                    $this->db->from('tipo_pago');
                    $query = $this->db->get();
                    return $query->result_array();
    }


    
}