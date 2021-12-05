<?php
class Newsletter_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table          = 'newsletters';
    }

    public function getNewsletters($search, $order, $order_column, $order_dir, $start, $length, $draw)
    {

        $column = ["email",  "created_at"];

        $query = "SELECT * FROM $this->table";
        $query .= " WHERE ";


        if (isset($search)) {
            $query .= '(email LIKE "%' . $search . '%")';
        }

        if (!empty($order)) {
            $query .= ' ORDER BY ' . "$column[$order_column]" . ' ' . $order_dir . '';
        } else {
            $query .= ' ORDER BY id DESC ';
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
            $status = ($row->newsletter_status == 1)? 'checked' : '';
            $nestedData[] = $i++;
            $nestedData[] = $row->email;            
            $nestedData[] = "<div class='checkbox checkbox-success'><input class='changeStatus'  type='checkbox' $status   name='status' data-id='".$row->id."' data-status='".$row->newsletter_status."' ><label></label></div>";
            $nestedData[] = date('Y-m-d h:i a', strtotime($row->created_at));
            $nestedData[] = "<button type='button' class='btn btn-info btn-outline btn-circle m-r-5 deleteButton' title='Delete' data-id='".$row->id."'><i class='icon-trash'></i></button>";

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

}
