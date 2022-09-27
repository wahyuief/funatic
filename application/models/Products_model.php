<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model
{
    public function get($where = false, $limit = false, $offset = false, $search = false, $group_by = false)
    {
        $this->db->select('products.*');
        if ($where) $this->db->where($where);
        if ($limit || $offset) $this->db->limit($limit, $offset);
        if ($search) {
            $this->db->like('title', $search);
            $this->db->or_like('content', $search);
            $this->db->or_like('category', $search);
        }
        $this->db->order_by('id DESC');
        if ($group_by) $this->db->group_by($group_by);
        return $this->db->get('products');
    }

    public function add($data)
    {
        $this->db->set($data);
        $this->db->insert('products');
        return $this->db->insert_id();
    }

    public function set($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('products');
    }

    public function unset($where)
    {
        $this->db->where($where);
        return $this->db->delete('products');
    }
}