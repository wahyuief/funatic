<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Variations_model extends CI_Model
{
    public function get($where = false, $limit = false, $offset = false, $search = false, $group_by = false)
    {
        $this->db->select('product_variations.*');
        if ($where) $this->db->where($where);
        if ($limit || $offset) $this->db->limit($limit, $offset);
        if ($search) {
            $this->db->like('title', $search);
            $this->db->or_like('content', $search);
            $this->db->or_like('category', $search);
        }
        $this->db->order_by('variation_price ASC');
        if ($group_by) $this->db->group_by($group_by);
        return $this->db->get('product_variations');
    }

    public function add($data)
    {
        $this->db->set($data);
        $this->db->insert('product_variations');
        return $this->db->insert_id();
    }

    public function set($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('product_variations');
    }

    public function unset($where)
    {
        $this->db->where($where);
        return $this->db->delete('product_variations');
    }
}