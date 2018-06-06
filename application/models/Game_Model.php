<?php 

class Game_Model extends CI_Model {

    var $table = 'game';

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all(){
        $this->db->from('game');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id){
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}