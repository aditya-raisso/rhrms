<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use DataTables;
use Redirect;

class HolidayController extends Controller
{
    public function index(Request $request){

        

        if ($request->ajax()) {
            $data = Holiday::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('date', function ($row) {
                      return date("d-m-Y",strtotime($row->date));
                             })
                    ->addColumn('action', function($row){

                    
                         
                        $url=route('admin.holiday.delete',['id'=>$row->id]);

                           $btn = '<a href="#" data-id="'.$row->id.'" class="holidayeditmodel btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></a> <a href="'.$url.'"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

         return view('backend.holiday.list');

    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'holiday_name'=> 'required',
            'date'=> 'required',
            'year'=> 'required|string',
        ]);

        $data=array(
            'holiday_name'=>$request->holiday_name,
            'date'=>$request->date,
            'year'=>$request->year,
        );

        $insert=Holiday::create($data);
        if($insert){
             return redirect('admin/holiday')->with('success', 'Holiday has been created ');
        }else{
             return redirect('admin/holiday')->with('error', 'failed to create holiday ');
        }

    }

    public function edit(Request $request){
          $data= Holiday::where('id',$request->id)->first();
         
        return response()->json($data);         
    } 

    public function update(Request $request){
        $this->validate($request, [
            'holiday_name'=> 'required',
            'date'=> 'required',
            'year'=> 'required',
        ]);

        $data=array(
            'holiday_name'=>$request->holiday_name,
            'date'=>$request->date,
            'year'=>$request->year,
        );
         $insert = Holiday::where('id',$request->id)->update($data);
           if($insert==1){
           return redirect('admin/holiday')->with('success', 'Holiday has been updated ');
        }else{
            return redirect('admin/holiday')->with('error', 'failed to update holiday ');
        }

    }

    public function delete(Request $request){
          $delete = Holiday::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Holiday has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to delete holiday ');
        }
    } 
}
