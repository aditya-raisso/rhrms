<?php
namespace App\Imports;
use App\Models\WorkingHour;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class WorkingHourImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        $data='';
        $user_id=User::where("emp_id",$row['employee_id'])->value('id');
        
       if(! empty($user_id)){
           $data= new WorkingHour([
                'user_id' => $user_id,
                'working_hours' => $row['working_hours'],
                'start_date' => date("Y-m-d",strtotime($row['start_date'])),
                'end_date' => date("Y-m-d",strtotime($row['end_date'])),
            ]);

           
       }
        return  $data;
    }
}