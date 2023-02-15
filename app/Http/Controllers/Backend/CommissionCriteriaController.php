<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommissionCriteria;
use App\Models\LeadComissionCriteria;
use App\Models\AccountManagerComissionCriteria;
use App\Models\BdmCommissionCriteria;
use App\Models\Role;
use DataTables;
use Redirect;
class CommissionCriteriaController extends Controller
{
    public function index(Request $request){

     if ($request->ajax()) {
            $data = CommissionCriteria::latest()->where('criteria_type',$request->type)->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('type', function ($row) {
                        if($row->type==1){
                            return '<span class="badge badge-success">Indirect commission</span>';
                        }else{
                            return '<span class="badge badge-danger">Direct commission</span>';
                        }                          
                      }) 

                      ->addColumn('action', function($row){
                        
                           $edit=route('admin.commission-criteria.edit',['id'=>$row->id]);
                           $delete=route('admin.commission-criteria.delete',['id'=>$row->id]);
                           $btn = '<a href="'.$edit.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                           <a href="'.$delete.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                            return $btn;

                    })->rawColumns(['action'])->make(true);
        }
      

       return view('backend.commission-criteria.list');
    }

      public function add(Request $request){
         $roles=Role::get();
         return view('backend.commission-criteria.add',['roles'=>$roles]);
      }


    public function create(Request $request){
      $this->validate($request, [
      'from_net_margin'=> 'required|string',
      'to_net_margin'=> 'required|string',
      'commission_amount'=> 'required|integer',
      ]);

     $data=array(
        'from_net_margin'=>$request->from_net_margin,
        'to_net_margin'=>$request->to_net_margin,
        'commission'=>$request->commission_amount,
        'criteria_type'=>$request->criteria_type
      );
     $insert=CommissionCriteria::create($data);
     if($insert){
             return Redirect::back()->with('success','Commission has been created');
         }else{
             return Redirect::back()->with('error','Failed to create Commission');
            
         }

    }

      public function edit(Request $request){
         $data=CommissionCriteria::where('id',$request->id)->first();
         $roles=Role::get();
         return view('backend.commission-criteria.edit',['data'=>$data,'roles'=>$roles]);
      }

     public function update(Request $request){

        $data=array(
        'from_net_margin'=>$request->from_net_margin,
        'to_net_margin'=>$request->to_net_margin,
        'commission'=>$request->commission_amount,
        
      );
        $insert=CommissionCriteria::where('id',$request->id)->update($data);
         if($insert){
             return Redirect::back()->with('success','Commission has been updated');
         }else{
             return Redirect::back()->with('error','Failed to update commission');
            
         }

    }

    public function delete(Request $request){
         $delete=CommissionCriteria::where('id',$request->id)->delete();
         
          if($delete==1){
             return redirect('admin/commission-criteria/list')->with('success','Commission has been deleted');
         }else{
             return Redirect::back()->with('error','Failed to delete commission');
            
         }
      }


      public function leadComissionList(Request $request){
      if ($request->ajax()) {
                $data = LeadComissionCriteria::get();
                return Datatables::of($data)
                ->addIndexColumn()
                  ->addColumn('action', function($row){
                       
                       $delete=route('admin.lead-commission-criteria.delete',['id'=>$row->id]);
                       $btn = '<a href="#"  class="editLeadCommission btn btn-primary btn-sm" data-id="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Edit!"><i class="fa fa-edit"></i></a>
                       <a href="'.$delete.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
 
                        return $btn;
                        })->rawColumns(['action'])->make(true);
            }
       return view('backend.commission-criteria.lead-comission');
      }

        public function leadComissionEdit(Request $request){
          $data= LeadComissionCriteria::where('id',$request->id)->first();
         
        return response()->json($data);         
    } 

      public function leadComissionStore(Request $request){
        $data=$request->all();
        unset($data['_token']);

        $insert=LeadComissionCriteria::create($data);
         if($insert){
             return Redirect::back()->with('success','Lead commission has been created.');
         }else{
             return Redirect::back()->with('error','Failed to create commission.');
         }
      }

      public function leadComissionUpdate(Request $request){
        $data=$request->all();
        unset($data['_token']);
        unset($data['id']);
        $insert=LeadComissionCriteria::where('id',$request->id)->update($data);
         if($insert==1){
             return Redirect::back()->with('success','Lead commission has been updated.');
         }else{
             return Redirect::back()->with('error','Failed to update commission');
         }
      }

      public function leadComissionDelete(Request $request){
         $delete=LeadComissionCriteria::where('id',$request->id)->delete();
         if($delete==1){
             return Redirect::back()->with('success','Lead commission has been deleted.');
         }else{
             return Redirect::back()->with('error','Failed to delet commission');
         }
      }

      /* ACOUNT MANAGER COMMISSION CRITRIA */ 
      public function acountManagerCommissionList(Request $request){
         if ($request->ajax()) {
                $data = AccountManagerComissionCriteria::get();
                return Datatables::of($data)
                ->addIndexColumn()
                  ->addColumn('action', function($row){
                       
                       $delete=route('admin.account-commission-criteria.delete',['id'=>$row->id]);
                       $btn = '<a href="#"  class="editAcountCommission btn btn-primary btn-sm" data-id="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Edit!"><i class="fa fa-edit"></i></a>
                       <a href="'.$delete.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
 
                        return $btn;
                        })->rawColumns(['action'])->make(true);
            }
       return view('backend.commission-criteria.account-manager-comission');
      }

      public function acountManagerCommissionCreate(Request $request){
          $data=$request->all();
        $insert=AccountManagerComissionCriteria::create($data);
         if($insert){
             return Redirect::back()->with('success','Commission criteria has been created.');
         }else{
             return Redirect::back()->with('error','Failed to create commission criteria.');
         }
      }


      public function acountManagerCommissionEdit(Request $request){
        $data= AccountManagerComissionCriteria::where('id',$request->id)->first();
         
        return response()->json($data);        
      }


      public function acountManagerCommissionUpdate(Request $request){
         $data=$request->all();
        unset($data['_token']);
        unset($data['id']);
        $insert=AccountManagerComissionCriteria::where('id',$request->id)->update($data);
         if($insert==1){
             return Redirect::back()->with('success','Commission criteria has been updated .');
         }else{
             return Redirect::back()->with('error','Failed to update commission criteria.');
         }
      }


      public function acountManagerCommissionDelete(Request $request){
         $delete=AccountManagerComissionCriteria::where('id',$request->id)->delete();
         if($delete==1){
             return Redirect::back()->with('success','Commission criteria has been deleted.');
         }else{
             return Redirect::back()->with('error','Failed to delete commission criteria');
         }
      }


      /*BDM COMMISSION*/

      public function bdmCommissionList(Request $request){

        if ($request->ajax()) {
                $data = BdmCommissionCriteria::get();
                return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('type', function ($row) {
                        if($row->type==1){
                            return 'Indirect commission';
                        }else{
                            return 'Direct commission';
                        }                          
                      }) 

                  ->addColumn('action', function($row){
                    $delete=route('admin.bdm-commission-criteria.delete',['id'=>$row->id]);

                       $btn = '<a href="#"  class="editBdmCommission btn btn-primary btn-sm" data-id="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Edit!"><i class="fa fa-edit"></i></a>

                       <a href="'.$delete.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        return $btn;
                        })->rawColumns(['action'])->make(true);
            }
        return view('backend.commission-criteria.bdm-commission-criteria');
      }

       public function bdmCommissionCreate(Request $request){
         $this->validate($request, [
         'from_net_margin_per'=> 'required|string',
         'to_net_margin_per'=> 'required|string',
         'monthly_from_net_margin'=> 'required|string',
         'monthly_to_net_margin'=> 'required|string',
         'monthly_commission'=> 'required|string',
         'type'=> 'required|string',

      ]);

         $data=array(
        'from_net_margin_per'=>$request->from_net_margin_per,
        'to_net_margin_per'=>$request->to_net_margin_per,
        'monthly_from_net_margin'=>$request->monthly_from_net_margin,
        'monthly_to_net_margin'=>$request->monthly_to_net_margin,
        'monthly_commission'=>$request->monthly_commission,
        'type'=>$request->type);

         //dd($data);

        $insert= BdmCommissionCriteria::create($data);
        if($insert){
             return Redirect::back()->with('success','BDM Commission has been created');
         }else{
             return Redirect::back()->with('error','Failed to create BDM Commission');    
         }
       }

        public function bdmCommissionEdit(Request $request){
            $data= BdmCommissionCriteria::where('id',$request->id)->first();        
           return response()->json($data);
        }


        public function bdmCommissionUpdate(Request $request){
            $data=$request->all();
            unset($data['_token']);
            unset($data['id']);
             $update=BdmCommissionCriteria::where('id',$request->id)->update($data);
             if($update==1){
             return Redirect::back()->with('success','BDM commission criteria has been updated .');
         }else{
             return Redirect::back()->with('error','Failed to update BDM commission criteria.');
         }
        }

        public function bdmCommissionDelete(Request $request){

             $delete=BdmCommissionCriteria::where('id',$request->id)->delete();
         if($delete==1){
             return Redirect::back()->with('success','BDM Commission criteria has been deleted.');
         }else{
             return Redirect::back()->with('error','Failed to delete BDM commission criteria');
         }


        }


}
