<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeDocument;
use App\Models\Attendance;
use Illuminate\Support\Facades\Crypt;
use Redirect;
use DataTables;
use Illuminate\Support\Facades\Auth;
class EmployeeDocumentController extends Controller
{
	


    public function index(Request $request)
    {  
        $userID=User::where('emp_id',$request->id)->value('id');

        $document=EmployeeDocument::where('user_id',@$userID)->first();
        $emp_id=$request->id;
        return view('backend.employee.document',['data'=>$document,'emp_id'=>$emp_id]);
    }

public function store(Request $request){
 $this->validate($request, [
        'passport'=> 'required|mimes:pdf|max:2048',
        'relieving_letter'=> 'required|mimes:pdf|max:2048',
        'salary_slip'=> 'required|mimes:pdf|max:2048',
        'aadhar_card'=> 'required|mimes:pdf|max:2048',
        'pencard_card'=> 'required|mimes:pdf|max:2048',
        'form_16'=> 'required|mimes:pdf|max:2048',
        ]);
           $store=array('user_id'=>$request->user_id);
        $emp_id=User::where('id',$request->user_id)->value('emp_id');

    $passport_file = $request->file('passport');
    if ($passport_file) {
        $store['passport'] = 'p'.rand(100, 999) . date('ymd') . '.' . $passport_file->getClientOriginalExtension();
        $passport_file->storeAs('user/'.$emp_id,$store['passport']);
    }
    
    $relieving_file = $request->file('relieving_letter');
    if ($relieving_file) {
        $store['relieving_letter'] = 'r'.rand(1000, 9990) . date('ymd') . '.' . $relieving_file->getClientOriginalExtension();
        $relieving_file->storeAs('user/'.$emp_id,$store['relieving_letter']);
    }

    $salary_slip_file = $request->file('salary_slip');
    if ($salary_slip_file) {
        $store['salary_slip'] = 's'.rand(1000, 9990) . date('ymd') . '.' . $salary_slip_file->getClientOriginalExtension();
        $salary_slip_file->storeAs('user/'.$emp_id,$store['salary_slip']);
    }

    $aadhar_card_file = $request->file('aadhar_card');
    if ($aadhar_card_file) {
        $store['aadhar_card'] = 'a'.rand(1000, 9990) . date('ymd') . '.' . $aadhar_card_file->getClientOriginalExtension();
        $aadhar_card_file->storeAs('user/'.$emp_id,$store['aadhar_card']);
    }

     $pencard_card_file = $request->file('pencard_card');
    if ($pencard_card_file) {
        $store['pencard_card'] = 'p'.rand(1000, 9990) . date('ymd') . '.' . $pencard_card_file->getClientOriginalExtension();
        $pencard_card_file->storeAs('user/'.$emp_id,$store['pencard_card']);
    }
    

     $form_16_file = $request->file('form_16');
    if ($form_16_file) {
        $store['form_16'] = 'f'.rand(1000, 9990) . date('ymd') . '.' . $form_16_file->getClientOriginalExtension();
        $form_16_file->storeAs('user/'.$emp_id,$store['form_16']);
    }

    $insert=EmployeeDocument::updateOrCreate(['user_id'=>$request->user_id],$store);
    if($insert){
          return Redirect::back()->with('success','Document has been uploaded successfully.');
    }else{
         return Redirect::back()->with('success','Failed to upload document.');
    }
}

public function delete(Request $request){

    $delete=EmployeeDocument::where('id',$request->id)->update([$request->field=>'']);
    if($delete==1){
          return Redirect::back()->with('success','Document has been deleted successfully.');
    }else{
         return Redirect::back()->with('success','Failed to delete document.');
    }
}



}