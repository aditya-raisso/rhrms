<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Models\Permission;
use Auth;
use DataTables;
class RoleController extends Controller
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
            $data = Role::orderBy('role_name','ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $permission=route('admin.role.permission',['role'=>$row->id]);
                        $url=route('admin.role.edit',['id'=>$row->id]);

                           $btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                           <a href="'.$permission.'" class="edit btn btn-primary btn-sm">Permission</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      

        return view('backend.role.list');
    }
    
  
    public function add(Request $request){
        $data=Role::orderBy('role_name','ASC')->get();
        $permission='';
        return view('backend.role.add',['data'=>$data,'permission'=>$permission]);
    }

    public function edit(Request $request){
        $data=Role::where('id',$request->id)->first();
        $permission='';
        return view('backend.role.edit',['data'=>$data,'permission'=>$permission]);
    }

    public function store(Request $request){
        $this->validate($request, [
          'role_name'=> 'required|string|unique:roles,role_name',
        ]);
       $store=$request->all();
       unset($store['_token']);
       $insert=Role::create($store);
       if($insert){
             return redirect('admin/role')->with('success','Role has been created successfully.');
       }else{
              return Redirect::back()->with('success','Failed to create role.');
       }
    }

     public function update(Request $request){
       $store=$request->all();
       unset($store['_token']);
       unset($store['id']);
       
       $update=Role::where('id',$request->id)->update($store);
        if($update==1){
            return redirect('admin/role')->with('success','Role has been updated successfully.');
        }else{
            return Redirect::back()->with('success','Failed to update role.');
        }
    }

    public function permission(Request $request){
        if(! isset($request->role)){
          return Redirect::back()->with('error','Permission not found please try again.');
          exit;
        }
       $role=Role::where('id',$request->role)->first();
      
       

       $Module=Module::orderBy('module_name','ASC')->get();
        if(!empty($request->role) && count($Module)>0){
            return view('backend.role.permission',['role'=>$role,'Module'=>$Module]);
         
        }else{
         return Redirect::back()->with('error','Permission not found please try again.');
          exit;
        }

        
    }

     public function storePermission(Request $request){

       $store=[];
       for($i=0; $i<count($request->module_name); $i++){
       
         $store[]=array(
            'role_id'=>$request->role_id,
             'module_name'=>$request->module_name[$i],
              'add'=>$request->add[$i] ?? 0,
              'edit'=>$request->edit[$i] ?? 0,
              'delete'=>$request->delete[$i] ?? 0,
              'list'=>$request->list[$i] ?? 0,
              
            );
       }
     
       $delete=Permission::where('role_id',$request->role_id)->delete();

       $insert=Permission::insert($store);
     
      if($insert || $insert==1){
         return Redirect::back()->with('success','Permission has been updated successfully');
      }else{
          return Redirect::back()->with('success','Permission has been updated successfully');
      }

    }
    
}
