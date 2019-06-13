<?php

class Notas_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function get_notas($nota_id = FALSE) {
    if ($nota_id === FALSE) {
      $this->db->select("n.*, c.cedula, c.nombres as nombre_cliente, c.apellidos as apellido_cliente, c.celular, tm.nombre as motivo, tm.exige_fact, v.codigo_venta, u.usuario");
      $this->db->from("notas n");
      $this->db->join("clientes c", "n.cliente_id = c.id");
      $this->db->join("tipo_motivo tm", "n.tipo_motivo_id = tm.id");
      $this->db->join("ventas v", "n.venta_id = v.id", "left");
      $this->db->join("usuarios u", "n.usuario_id = u.id");
      
      $this->db->where("n.estado", "1");
      $query = $this->db->get();
//                echo "<pre>";var_dump($query->result_array());echo "</pre>";exit;
      return $query->result_array();
    }
    $this->db->select("n.*, c.cedula, c.nombres as nombre_cliente, c.apellidos as apellido_cliente, c.celular, tm.nombre as motivo, tm.exige_fact, v.codigo_venta, u.usuario");
    $this->db->from("notas n");
    $this->db->join("clientes c", "n.cliente_id = c.id");
    $this->db->join("tipo_motivo tm", "n.tipo_motivo_id = tm.id");
    $this->db->join("ventas v", "n.venta_id = v.id", "left");
    $this->db->join("usuarios u", "n.usuario_id = u.id");

    $this->db->where("n.estado", "1");
    $this->db->where("n.id", $nota_id);
    $query = $this->db->get();
    //$query = $this->db->get_where('ventas', array('codigo_venta' => $codigo_venta));
    return $query->row_array();
  }

}
