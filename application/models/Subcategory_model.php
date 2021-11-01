<?php
class Subcategory_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table          = 'subcategories';
    }

    public function getCategories(){
        $this->db->select('id, title');
        $this->db->order_by('title', 'ASC');
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function getSubcategories($search, $order, $order_column, $order_dir, $start, $length, $category_id, $draw)
    {

        $column = ["id", "title", "category_status"];

        $query = "SELECT c.title as category, s.* FROM $this->table s JOIN categories c ON c.id = s.category_id";
        $query .= " WHERE ";

        if($category_id>0){
            if(!empty($category_id)){
                $query .= "s.category_id = $category_id AND ";
            }            
        }

        if (isset($search)) {
            $query .= '(s.title LIKE "%' . $search . '%")';
        }

        if (!empty($order)) {
            $query .= ' ORDER BY ' . "$column[$order_column]" . ' ' . $order_dir . '';
        } else {
            $query .= ' ORDER BY s.id DESC ';
        }

        $query1 = '';
        if ($length != -1) {
            $query1 .= ' LIMIT ' . $start . ',' . $length;
        }

        $number_filter_rows = $this->db->query($query)->num_rows();
        $result = $this->db->query($query . $query1)->result();

        $i = 1;
        $data = array();
        foreach ($result as $row) {  // preparing an array
            $nestedData = array();
            $status = ($row->subcategory_status == 1)? 'checked' : '';
            $nestedData[] = $i++;
            $nestedData[] = $row->category;
            $nestedData[] = $row->title;
            $nestedData[] = "<img src='" . base_url('uploads/subcategory/' . $row->image) . "' alt='Subcategory Image' width='100' height='50'>";
            $nestedData[] = "<div class='checkbox checkbox-success'><input class='changeStatus'  type='checkbox' $status   name='status' data-id='".$row->id."' data-status='".$row->subcategory_status."' ><label></label></div>";
            $nestedData[] = date('Y-m-d h:i a', strtotime($row->created_at));
            $nestedData[] = "<a href='" . base_url('subcategory/edit/' . $row->id . '') . "' class='btn btn-info btn-outline btn-circle btn-lg m-r-5' title='Edit'><i class='ti-pencil-alt'></i></a>
                            <button type='button' class='btn btn-info btn-outline btn-circle btn-lg m-r-5 deleteButton' title='Delete' data-id='".$row->id."'><i class='icon-trash'></i></button>";

            $data[] = $nestedData;
        }

        $query2 = "SELECT * FROM $this->table";
        $total_rows = $this->db->query($query2)->num_rows();

        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => $total_rows,
            "recordsFiltered" => $number_filter_rows,
            "data" => $data
        );

        return $output;
    }

    public function store($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getSubcategory($id)
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

    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function checkExist($categoryId, $title) 
    {
        $this->db->where('title', $title);        
        $this->db->where('category_id', $categoryId);        
        $query = $this->db->get($this->table); 
        return $query->num_rows();
    }

    public function checkExistEdit($id, $categoryId, $title) 
    {
        $this->db->where('title', $title);
        $this->db->where_not_in('id', $id); 
        $this->db->where_not_in('category_id', $categoryId);        
        $query = $this->db->get($this->table); 
        return $query->num_rows();
    }
    
}
