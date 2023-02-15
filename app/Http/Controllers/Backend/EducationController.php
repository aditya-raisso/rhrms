<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Redirect;
use Illuminate\Support\Facades\Crypt;
class EducationController extends Controller
{
public function view(Request $request)
{
if ($request->ajax()) {
$data = Education::where('user_id',$request->user_id)->get();
return Datatables::of($data)
->addIndexColumn()
->editColumn('file', function ($row) {
$path=url('storage/app/user/'.$row->file);
return '<a href="'.$path.'" class="btn btn-primary" download><i class="fa fa-download"></i> document</a>';
})
->editColumn('start_date', function ($row) {
return date("d-m-Y",strtotime($row->start_date));
})
->editColumn('end_date', function ($row) {
return date("d-m-Y",strtotime($row->end_date));
})
->addColumn('action', function ($row) {
$url='';
$delete=route('admin.employee.education.delete',['id'=>$row->id]);
$btn    = '<a href="#" class="editEmpEducation btn btn-primary" data-id="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Edit!"><i class="fa fa-edit"></i></a> <a href="' . $delete . '" data-toggle="tooltip" data-placement="top" class="btn btn-danger" title="Delete !"><i class="fa fa-trash"></i></a>';
return $btn;
})
->rawColumns(['action','file'])->make(true);
}
return view('backend.employee.education');
}
public function store(Request $request){
$this->validate($request, [
'start_date'=> 'required',
'end_date'=> 'required',
'qualification'=> 'required|string|max:100',
'board_of_education'=> 'required|string|max:100',
]);
$store=array(
'user_id'=> $request->user_id,
'start_date'=>date("Y-m-d",strtotime($request->start_date)),
'end_date'=>date("Y-m-d",strtotime($request->end_date)),
'qualification'=>$request->qualification,
'board_of_education'=>$request->board_of_education,
);
$document_file = $request->file('upload_documents');
if ($document_file) {
//$avatar_old=Auth::user()->avatar;
//Delete old image
//  if(!empty($avatar_old)){
//$imageArr=explode("storage/user/",$avatar_old);
// Storage::disk('user')->delete($imageArr);
//  }
//update new image   
$store['file'] = rand(1000, 9990) . date('ymd') . '.' . $document_file->getClientOriginalExtension();
$document_file->storeAs('user',$store['file']);
}
$insert = Education::create($store);
if($insert){
return Redirect::back()->with('success', 'Education has been added successfully');
}else{
return Redirect::back()->with('error', 'Failed to education add');
}
}
public function edit(Request $request){
$data= Education::where('id',$request->id)->first();
return response()->json($data);         
} 
public function delete(Request $request){
$delete = Education::where('id',$request->id)->delete();
if($delete==1){
return Redirect::back()->with('success', 'Employee Education has been deleted ');
}else{
return Redirect::back()->with('error', 'Failed to delete education ');
}
} 
public function update(Request $request){
$this->validate($request, [
'start_date'=> 'required',
'end_date'=> 'required',
'qualification'=> 'required|string|max:100',
'board_of_education'=> 'required|string|max:100',
]);
$store=array(
'start_date'=>date("Y-m-d",strtotime($request->start_date)),
'end_date'=>date("Y-m-d",strtotime($request->end_date)),
'qualification'=>$request->qualification,
'board_of_education'=>$request->board_of_education,
);
$document_file = $request->file('upload_documents');
if ($document_file) {
$avatar_old=$request->old_document;
//Delete old image
if(!empty($avatar_old)){
$imageArr=explode("storage/user/",$avatar_old);
Storage::disk('user')->delete($imageArr);
}
//update new image   
$store['file'] = rand(1000, 9990) . date('ymd') . '.' . $document_file->getClientOriginalExtension();
$document_file->storeAs('user',$store['file']);
}
$insert = Education::where('id',$request->id)->update($store);
if($insert==1){
return Redirect::back()->with('success', 'Education has been updated ');
}else{
return Redirect::back()->with('error', 'Failed to update education ');
}
}
}