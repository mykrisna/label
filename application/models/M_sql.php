<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sql extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view_barcode()
    {
        return $this->db->query("select rowid,no_ctn,ship_to,ship2,po,qty,style,sku,color,size,barcode,DATE_FORMAT(shipdate, '%d %b %Y') as shipdate,alamat1,alamat2,alamat3 from tb_barcode;")->result_array();
    }

    public function hapus()
    {
        $this->db->query("truncate table tb_barcode;");
    }
}
