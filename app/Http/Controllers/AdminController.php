<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use App\User;
//koagulasi
use App\KgProfile;
use App\KgPeriode;
use App\KgInstrument;
use App\KgSampleInfo;
use App\KgDdimerQcH;
use App\KgDdimerQcD;
use App\KgDdimerResultH;
use App\KgDdimerResultD;
use App\KgPtapttQcH;
use App\KgPtapttQcD;
use App\KgPtapttResultH;
use App\KgPtapttResultD;
use App\KgGroupResult;
//urin
use App\UrPeriode;
use App\UrInstrument;
use App\UrSampleInfo;
use App\UrQcH;
use App\UrQcD;
use App\UrResultH;
use App\UrResultD;


use DB;

class AdminController extends Controller
{
    function login(Request $request){
        $data = User::where('user_id',$request->user_id)->firstOrFail();
        if($data){
            if($data->password==$request->password){
                session(['user_id'=>$data->user_id,'user_name'=>$data->user_name, 'islogin'=>true]);
                return redirect()->route('admin.home');
            }
            return redirect()->route('admin.index');
        }
        return redirect()->route('admin.index');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('admin.index');
    }

    function index(){
        return view('admin.login');
    }

    function home(){
        return view('admin.home');
    }

    function dashboard(Request $request){
        if($request->is('equas/admin/urin')){
            $periode = UrPeriode::where('isactive','Y')->first();
            if (is_null($periode)){
                return view('admin.dashboard',['pending'=>'N/A','completed'=>'N/A','total'=>'N/A']);
            }
            $total = UrInstrument::where('isactive','Y')->count();
            $completed = UrResultH::where('periode',$periode->periode_id)->count();
            $pending = $total - $completed;
        }
        elseif($request->is('equas/admin/koagulasi')){
            $periode = KgPeriode::where('isactive','Y')->first();
            if (is_null($periode)){
                return view('admin.dashboard',['pending'=>'N/A','completed'=>'N/A','total'=>'N/A']);
            }
            $total = KgInstrument::where('isactive','Y')->count();
            $c_ptaptt = KgPtapttResultH::where('periode',$periode->periode_id)->count();
            $c_ddimer = KgDdimerResultH::where('periode',$periode->periode_id)->count();
            $completed = $c_ptaptt + $c_ddimer;
            $pending = $total - $completed;
        }
        return view('admin.dashboard',['pending'=>$pending,'completed'=>$completed,'total'=>$total]);
    }
    
    function pending(Request $request){
        if($request->is('equas/admin/urin/*')){
            $pending = UrInstrument::where('isactive','Y')
                    ->join('User','customer_id','=','user_id')
                    ->whereNotIn('inst_serial_no',function($query){
                        $periode = UrPeriode::where('isactive','Y')->first();
                        $query->select('inst_serial_no')->from('ur_resulth')->where('periode',$periode->periode_id);
                    })->get();
        }
        elseif($request->is('equas/admin/koagulasi/*')){
            $p_ptaptt = KgInstrument::where('isactive','Y')
                    ->join('User','customer_id','=','user_id')
                    ->whereNotIn('inst_serial_no',function($query){
                        $periode = KgPeriode::where('isactive','Y')->first();
                        $query->select('inst_serial_no')->from('kg_ptaptt_resulth')->where('periode',$periode->periode_id);
                    })->get();

            
            $p_ddimer = KgInstrument::where('isactive','Y')
                    ->join('User','customer_id','=','user_id')
                    ->whereNotIn('inst_serial_no',function($query){
                        $periode = KgPeriode::where('isactive','Y')->first();
                        $query->select('inst_serial_no')->from('kg_ddimer_resulth')->where('periode',$periode->periode_id);
                    })->get();
                    
            $pending = $p_ptaptt->union($p_ddimer);
        }
        return view('admin.pending',['records'=>$pending]);
    }

    function manage(Request $request){
        return view('admin.manage');
    }

    function manage_periode(Request $request, $step=0){
        $periode = KgPeriode::where('isactive','Y')->first();
        ////////////////////////////////
        //MAIN MENU OF PERIODE SECTION//
        ///////////////////////////////
        if(\Request::is('*/manage/periode')){
            return view('admin.periode');
        }

        
        /////////////////////////
        //CREATE PERIODE SECTION//
        /////////////////////////
        elseif(\Request::is('*/manage/periode/create')){
            return view('admin.periode',['records'=>$pending]);
        }

        /////////////////////////
        //CLOSE PERIODE SECTION//
        /////////////////////////
        elseif(\Request::is('*/manage/periode/close*')){
            if($step==1){
                //CALCULATE GROUP RESULT
                DB::select("call p_equas_kg_groupresult(?)",array($periode->periode_id));
            }
    
            if($step==2){
                //CALCULATE MEASUREMENT
                DB::select("call p_equas_kg_measurement(?)",array($periode->periode_id));
            } 

            if($step==3){
                KgPeriode::where('isactive','Y')->update(['isactive'=>'N']);
            }

            return view('admin.periode',['step'=>$step]);
        } 
    }

    function manage_groupresult(Request $request){
        $periode = KgPeriode::where('isactive','Y')->first();
        $groupresult = KgGroupResult::where('periode',$periode->periode_id)->get();
        return view('admin.groupresult',['periode'=>$periode,'data'=>$groupresult]);
    }

    function update_groupresult(Request $request){
        for($i=0;$i<16;$i++){
            $grp_result = KgGroupResult::find($request->grp_id[$i]);
            $grp_result->median = $request->median[$i];
            $grp_result->save();
        }
        return redirect()->route('admin.periode_close',['step'=>'1']);
    }


}
