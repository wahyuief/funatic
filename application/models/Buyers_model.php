<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Buyers_model extends CI_Model
{
    public function get($where = false, $limit = false, $offset = false, $search = false, $group_by = false)
    {
        $this->db->select('buyers.*');
        if ($where) $this->db->where($where);
        if ($limit || $offset) $this->db->limit($limit, $offset);
        if ($search) {
            $this->db->like('phone', $search);
            $this->db->or_like('buyer_data', $search);
        }
        $this->db->order_by('id DESC');
        if ($group_by) $this->db->group_by($group_by);
        return $this->db->get('buyers');
    }

    public function add($data)
    {
        $this->db->set($data);
        $this->db->insert('buyers');
        return $this->db->insert_id();
    }

    public function set($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        return $this->db->update('buyers');
    }

    public function unset($where)
    {
        $this->db->where($where);
        return $this->db->delete('buyers');
    }
    public function count()
    {
        $this->db->group_by('phone');
        return $this->db->get('buyers')->num_rows();
    }
}