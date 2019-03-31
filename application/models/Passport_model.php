<?php
class Passport_model extends MY_Model{
    public function __construct(){
        parent:: __construct();
    }

   
    // this function for get all staff my pagination
     public function get_all_passport( $per_page=null, $page=null){
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "DESC");
            $this->db->limit($per_page, $page);
        }
       $result = $this->db->get('passport');
        return $result->result();
    }
   
    // this function for get all staff my pagination
     public function get_passport_search( $query_vars =null){
        $result=0;
        if($query_vars!=null){
            $this->db->order_by("id", "DESC");
            $this->db->where($query_vars);
        }
       $result = $this->db->get('passport');
        return $result->result();
    }
    
    
    /*This function for get all passport count */
    public function get_passport_count(){
        $result=0;
        $result = $this->db->get('passport');
        return $result->num_rows();
        
    }

    /*This fnction for get one single user*/
    public function get_passport($id=null){
         $result = $this->db->get_where('passport', array('id'=>$id));
        return $result->row(0);
    }
    
    // get month name from month number
    public function get_fullmonth($month){
        $dateObj   = DateTime::createFromFormat('!m', $month);
        return $monthName = $dateObj->format('F');
    }
    
    // this month staff salary advancecd or not
    public function advanced($staff_id, $month, $year){
        $advanced='';
        $this->db->where('staff_id', $staff_id);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get('salary');
        if($result = $query->row(0)){
            return $result->advance;
        }else{
            return $advanced;
        }
        
    }
    
    //this function for get salary status
    public function salary_status($staff_id, $month, $year){
        $this->db->where('staff_id', $staff_id);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
         $query = $this->db->get('salary');
        if($result = $query->row(0)){
            return $result->status;
        }else{
            $unpaid='Unpaid';
            return $unpaid;
        }
    }
    
    //this function for get salary status
    public function get_staff_salary($staff_id, $year, $month){
        $this->db->where('staff_id', $staff_id);
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get('salary');
        return $query->row(0);
    }
    
    
    //get stuff report by table wise
    public function get_staff_report($year){
        $this_year = date('Y', time());
        $this_month = date('m', time());
        $year = $year;
        $all_staff = $this->get_all_staff();
        $table='<table class="table table-bordered" border="1" cellpadding="3">
                    <tbody>';
        $table_rows='';
        for($i=1; $i<=12; $i++){
            $table_rows.='
                <tr style="background-color:#000;color:#FFF">
                    <th colspan="3">MONTH: '.$this->get_fullmonth($i).'</th>
                    <th colspan="3">Year: '.$year.'</th>
                </tr>
            ';
            
            if($i==1){
            $table_rows.='
            <tr style="font-weight: 700;background-color: #5f5f5f;color: #FFF;">
                <td>Name of employe</td>
                <td>Designation</td>
                <td>Basic Salary</td>
                <td>Advance</td>
                <td>Remark</td>
                <td>Changes</td>
            </tr>
            ';  
            }
            if($all_staff){
                foreach($all_staff as $staff){
                    $table_rows.='
                    <tr>
                        <td>'.$staff->first_name.' '.$staff->last_name.'</td>
                        <td>'.$staff->designation.'</td>
                        <td>'.$staff->salary.'.00 TK.</td>
                        <td>'.$this->advanced($staff->id, $i, $year).'.00 TK.</td>
                        <td>'.$this->salary_status($staff->id, $i, $year).'</td>
                        <td><a href="'.site_url('admin/staff/change_report/'.$staff->id.'/'.$year.'/'.$i).'"><i class="fa fa-edit"></i> Change</a></td>
                    </tr>
                    ';
                }
            }
            
            
            //if this month anad this year same this loop will stome
            if($this_year==$year and $this_month==$i){
                break;
            }
        }
        $table.=$table_rows;
        $table.='</tbody>
                  </table>';
        return $table;
    }    
    
    //get stuff report by table wise for pdf table
    public function get_staff_report_for_pdf($year){
        $this_year = date('Y', time());
        $this_month = date('m', time());
        $year = $year;
        $all_staff = $this->get_all_staff();
        $table='<table class="table table-bordered" border="1" cellpadding="3">
                    <tbody>';
        $table_rows='';
        for($i=1; $i<=12; $i++){
            $table_rows.='
                <tr style="background-color:#000;color:#FFF">
                    <th colspan="3">MONTH: '.$this->get_fullmonth($i).'</th>
                    <th colspan="2">Year: '.$year.'</th>
                </tr>
            ';
            
            if($i==1){
            $table_rows.='
            <tr style="font-weight: 700;background-color: #5f5f5f;color: #FFF;">
                <td>Name of employe</td>
                <td>Designation</td>
                <td>Basic Salary</td>
                <td>Advance</td>
                <td>Remark</td>
            </tr>
            ';  
            }
            if($all_staff){
                foreach($all_staff as $staff){
                    $table_rows.='
                    <tr>
                        <td>'.$staff->first_name.' '.$staff->last_name.'</td>
                        <td>'.$staff->designation.'</td>
                        <td>'.$staff->salary.'.00 TK.</td>
                        <td>'.$this->advanced($staff->id, $i, $year).'.00 TK.</td>
                        <td>'.$this->salary_status($staff->id, $i, $year).'</td>
                    </tr>
                    ';
                }
            }
            
            
            //if this month anad this year same this loop will stome
            if($this_year==$year and $this_month==$i){
                break;
            }
        }
        $table.=$table_rows;
        $table.='</tbody>
                  </table>';
        return $table;
    }
    
    
    
}
?>