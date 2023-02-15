<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeCategory;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use Auth;
use DataTables;
class CategoryController extends Controller
{
  

      public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = EmployeeCategory::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         
                        $url=route('admin.category.edit',['id'=>$row->id]);

                           $btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      

        return view('backend.category.list');
    }
    
    public function add(){
        $data=EmployeeCategory::where('is_parient',0)->orderBy('category_name','ASC')->get();
      return view('backend.category.add',['data'=>$data]);
    }
    

    public function edit(Request $request){
        $data=EmployeeCategory::where('is_parient',0)->orderBy('category_name','ASC')->get();
        $category_details=EmployeeCategory::where('id',$request->id)->first();
        return view('backend.category.edit',['category_data'=>$data,'category_details'=>$category_details]);
    }

    public function store(Request $request){
        $this->validate($request, [
          'category_name'=> 'required|string|unique:employee_categories,category_name',
        ]);


       $store=$request->all();
       unset($store['_token']);
       $insert=EmployeeCategory::create($store);
       if($insert){
             return Redirect::back()->with('success','Category has been created successfully.');
       }else{
              return Redirect::back()->with('success','Failed to create category.');
       }
    }

     public function update(Request $request){
       $store=$request->all();
       unset($store['_token']);
       unset($store['id']);
       if(empty($request->is_parient)){
        $store['is_parient']=0;
       }
       $update=EmployeeCategory::where('id',$request->id)->update($store);
        if($update==1){
            return Redirect::back()->with('success','Category has been updated successfully.');
        }else{
            return Redirect::back()->with('success','Failed to update category.');
        }
    }
    
}
