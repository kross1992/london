<?php
class Ventas_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_ventas($codigo_venta = FALSE)
    {
            if ($codigo_venta === FALSE)
            {
                $this->db->select('v.*, c.nombres, c.apellidos, c.cedula, tv.descripcion as tipo');
                $this->db->from('ventas v');
                $this->db->join('tipos_venta tv', 'v.tipo_venta = tv.id');
                $this->db->join('clientes c', 'c.id = v.cliente', 'left');
                $this->db->where('v.estado', '1');
//                $this->db->order_by('v.fecha', 'DESC');
                $query = $this->db->get();
//                echo "<pre>";var_dump($query->result_array());echo "</pre>";exit;
                return $query->result_array();
            }
            $this->db->select('v.*, c.nombres, c.apellidos, c.cedula, tv.descripcion as tipo');
            $this->db->from('ventas v');
            $this->db->join('tipos_venta tv', 'v.tipo_venta = tv.id');
            $this->db->join('clientes c', 'c.id = v.cliente', 'left');
            $this->db->where('v.codigo_venta', $codigo_venta);
            $this->db->where('v.estado', '1');
            $query = $this->db->get();
            //$query = $this->db->get_where('ventas', array('codigo_venta' => $codigo_venta));
            return $query->row_array();
    }

    public function get_detalles_venta($codigo_venta = FALSE)
    {
            if ($codigo_venta === FALSE)
            {   
                $this->db->select('dv.*, i.codigo, i.descripcion');
                $this->db->from('detalles_venta dv');
                $this->db->join('items i', 'dv.item_id = i.id', 'left');
                $this->db->order_by('dv.id', 'ASC');
                
                $query = $this->db->get();
                return $query->result_array();
            }

            $this->db->select('dv.*, i.codigo, i.descripcion');
            $this->db->from('detalles_venta dv');
            $this->db->join('items i', 'dv.item_id = i.id', 'left');
            $this->db->where('dv.codigo_venta', $codigo_venta);
            
            $query = $this->db->get();
//            echo "<pre>";var_dump($query);echo "</pre>";exit;
            //$query = $this->db->get_where('detalles_venta', array('codigo_venta' => $codigo_venta));
            
            return $query->result_array();
    }

    public function get_max_factura()
    {
            $this->db->select_max('codigo_venta');
            $query = $this->db->get('ventas');
            return $query->row_array();
    }
    


    public function set_ventas()
    {
        $this->load->helper('url');

        //$codigo_venta = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'codigo_venta' => $this->input->post('codigo_venta'),
            'tipo_venta' => $this->input->post('tipo_venta'),
            'cliente' => $this->input->post('cliente'),
            'fecha' => $this->input->post('fecha'),
            'costo_total' => $this->input->post('costo_total'),
            'plazo' => $this->input->post('plazo'),
            'periodicidad' => $this->input->post('periodicidad'),
            'iva'  => $this->input->post('iva'), 
            'cuota'    => $this->input->post('cuota') ,   
            'sistecredito' => $this->input->post('sistecredito')

        );
        //date_create_from_format("m/d/Y", $this->input->post('fecha'))->format('Y-m-d H:i:s'),
        return $this->db->insert('ventas', $data);
    }

    public function get_tipos_venta($id = FALSE)
    {
        if ($id === FALSE)
        {
                $query = $this->db->get('tipos_venta');
                return $query->result_array();
        }

        $query = $this->db->get_where('tipos_Venta', array('id' => $id));
        return $query->row_array();
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
        $this->db->select('e.codigo, e.cantidad, i.id, i.descripcion, i.precio');
        $this->db->from('existencias e');
        $this->db->join('items i', 'e.codigo = i.codigo');
        $this->db->where('i.id', "$item");
        //$query = $this->db->get_where('existencias', array('id' => $item));
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function set_detalles_venta()
    {
        $this->load->helper('url');

        //$codigo_venta = url_title($this->input->post('title'), 'dash', TRUE);
        $cantDetalles = $this->input->post('cantDetalles');
        $count = 0;
        //$algo = []; 
        for ($i=1; $i <= $cantDetalles ; $i++) { 

            //DESCUENTO LA CANTIDAD DE STOCK POR CADA ITEM.
                $item = $this->input->post('codigo'.$i);
                $existencia = $this->get_existencias($item);
                $this->db->set('cantidad', $existencia['cantidad'] - $this->input->post('cantidad'.$i));
                $this->db->where('id', $existencia['id']);
                $this->db->update('existencias');     
                //$algo[$i]= $this->db->get_compiled_update('existencias');
          
            //INSERTO EL DETALLE DE VENTA POR CADA ITEM
            $data = array(
               'codigo_venta' => $this->input->post('codigo_venta'),
               'item_id' => $this->input->post('codigo'.$i),
               'costo_unidad' => $this->input->post('precio'.$i),
               'cantidad' => $this->input->post('cantidad'.$i),
               'costo_total' => $this->input->post('total'.$i)
            ); 
            $count += $this->db->insert('detalles_venta', $data);
        }

        return $count;
        //return $algo;
    }
    
    public function set_detalles_pagos()
    {
        $this->load->helper('url');

        $cantPagos = $this->input->post('cantPagos');
        $count = 0;
        //$algo = []; 
        for ($i=1; $i <= $cantPagos ; $i++) { 

            //INSERTO CADA DETALLE DE PAGO
            $data = array(
               'codigo_venta' => $this->input->post('codigo_venta'),
               'tipo_pago' => $this->input->post('tipo_pago'.$i),
               'total' => $this->input->post('totalP'.$i),
               'estado' => 1,
            ); 
            $count += $this->db->insert('detalles_pago', $data);
        }

        return $count;
        //return $algo;
    }

    public function get_tipos_pago()
    {
                    $this->db->select('id, nombre');
                    $this->db->from('tipo_pago');
                    $query = $this->db->get();
                    return $query->result_array();
    }
    
    public function get_ventas_anuladas()
    {
           
                $this->db->select('v.*, c.nombres, c.apellidos, c.cedula, tv.descripcion as tipo');
                $this->db->from('ventas v');
                $this->db->join('tipos_venta tv', 'v.tipo_venta = tv.id');
                $this->db->join('clientes c', 'c.id = v.cliente', 'left');
                $this->db->where('v.estado', '0');
                $this->db->order_by('v.fecha', 'DESC');
                $query = $this->db->get();
//                echo "<pre>";var_dump($query->result_array());echo "</pre>";exit;
                return $query->result_array();
            
    }
    
    public function anular_venta($id = false) {
        if (empty($id)) {
            echo "0";
        } else {
            $detalles = $this->get_detalles_venta($id);
            foreach($detalles as $row){
                $this->agregar_stock($row['cantidad'], $row['codigo']);
                
            }
            
            //Cuando termino de devolver la cantidad de articulos, cambio el estado de la venta a anulada
            $data = array(
                'estado' => 0
            );
            $this->db->where('codigo_venta', $id);
            $this->db->update('ventas', $data);
            echo "1";
        }
    }
    
    public function agregar_stock($cant, $item = false) {
        if (empty($item)) {
            return false;
        } else {
            $this->db->query("UPDATE existencias SET cantidad = (cantidad + $cant) WHERE codigo = '".$item."'");
//            echo "<pre>";var_dump($this->db);echo "</pre>";exit;
        }
    }


    public function set_cliente()
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
        $this->db->insert('clientes', $data);
        
        //return $this->db->insert_id();
        // $id = $this->db->mysql_insert_id();
        // return $id;
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $LastIdInserted = $row['LAST_INSERT_ID()'];
    }
    
  public function get_ventas_cliente($cliente) {
    $this->db->select('v.*, tv.descripcion as tipo, DATE(v.fecha) AS fecha_fact');
    $this->db->from('ventas v');
    $this->db->join('tipos_venta tv', 'v.tipo_venta = tv.id');
    $this->db->where('v.estado', '1');
    $this->db->where('v.cliente', $cliente);
    $query = $this->db->get();
// echo "<pre>";var_dump($query->result_array());echo "</pre>";exit;
    return $query->result_array();
  }

}
