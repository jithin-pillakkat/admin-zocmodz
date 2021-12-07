<?php
class Banner_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table          = 'banners';
    }

    public function getBanners()
    {
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function store($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getBanner($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return true;
    }
    public function position_down($id)
    {
        $this->db->set('position', 'position-1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($this->table);
        return true;
    }

    public function position_up($id)
    {
        $this->db->set('position', 'position+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($this->table);
        return true;
    }
    
    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function get_maxposition(){
        $this->db->select_max('position');        
        $qry = $this->db->get($this->table); 
        $position = $qry->row('position');
        if($position==0){
            return 1;
        }
        return $position + 1;
    }
    
}
