<?php
  
namespace App\Exports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class WorkingHoursExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         $workHourdata = WorkingHour::groupBy('user_id')->select('user_id', DB::raw('sum(working_hours) as working_hours'))->get();
         foreach($workHourdata as $data){
            $name=$data->user->first_name.''.$data->user->first_name;
            $commission=$this->calculater_comission($row->user_id, $row->working_hours);

                $data=array(
                    'user_name'=> $name,
                    'working_hours'=>$row->user->net_margin ?? 0,
                    'commission'=>$commission,
                );
         }
        return User::all();
    }
}