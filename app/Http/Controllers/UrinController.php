<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use App\User;
use App\UrProfile;
use App\UrPeriode;
use App\UrInstrument;
use App\UrSampleInfo;
use App\UrQcH;
use App\UrQcD;
use App\UrResultH;
use App\UrResultD;
use DB;

class UrinController extends Controller
{
    function login(Request $request){

        $data = User::where('user_id',$request->user_id)->firstOrFail();
        
        if($data){
            if($data->password==$request->password){
                $periode = UrPeriode::where('isactive','Y')->first();
                $periode_id = 'N/A';
                if(!is_null($periode)){
                    $periode_id = $periode->periode_id;
                }
                session(['user_id'=>$data->user_id,'user_name'=>$data->user_name,'periode'=>$periode->periode_id, 'islogin'=>true]);
                return redirect()->route('urin.home');
            }
            return redirect()->route('urin.index');
        }
        
        return redirect()->route('urin.index');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('urin.index');
    }

    function index(){
        return view('urin.login');
    }

    function home(){
        return view('urin.home');
    }
    
    function myprofile(Request $request){
        $count = UrProfile::where('customer_id',$request->session()->get('user_id'))->count();
        if($count > 0){
            $profile =UrProfile::where('customer_id',$request->session()->get('user_id'))->first();
            $data = array(
                'address'=>$profile->address,
                'pj_lab'=>$profile->pj_lab,
                'email_pj_lab'=>$profile->email_pj_lab,
                'ka_lab'=>$profile->ka_lab,
                'email_ka_lab'=>$profile->email_ka_lab,
                'hp'=>$profile->hp,
                'telp'=>$profile->telp
            );
        }
        else{
            $data = array(
                'address'=>'',
                'pj_lab'=>'',
                'email_pj_lab'=>'',
                'ka_lab'=>'',
                'email_ka_lab'=>'',
                'hp'=>'',
                'telp'=>''
            );
        }
        return view('urin.profile',[
                'user_id'=>$request->session()->get('user_id'),
                'user_name'=>$request->session()->get('user_name'),
                'profile'=>$data
                ]);
    }

    function profile_store(Request $request){
        $profile = new UrProfile();
        $profile->customer_id = $request->session()->get('user_id');
        $profile->address = $request->address;
        $profile->pj_lab = $request->pjlab;
        $profile->email_pj_lab = $request->email_pjlab;
        $profile->ka_lab = $request->kalab;
        $profile->email_ka_lab = $request->email_kalab;
        $profile->hp = $request->hp;
        $profile->telp = $request->telp;
        $profile->save();
        return redirect('/')->with('message','Save Successfully');
    }

    function instrument(Request $request){
        $inst_arr = array();

        //get list of instrument
        $instruments = UrInstrument::where('customer_id',$request->session()->get('user_id'))
                                    ->where('isactive','Y')
                                    ->get();
        $periode = UrPeriode::get();

        foreach($instruments as $instrument){
            $count = UrResultH::where('inst_serial_no',$instrument->inst_serial_no)
                            ->where('inst_type',$instrument->inst_type)
                            ->where('periode',$request->session()->get('periode'))
                            ->where('customer_id',$request->session()->get('user_id'))->count();
            
            if($count > 0){
                $inst_arr = Arr::add($inst_arr,$instrument->inst_serial_no,'Y');
            }
            else{
                $inst_arr = Arr::add($inst_arr,$instrument->inst_serial_no,'N');
            }
        }
  
        return view('urin.instrument',['instruments'=>$instruments,'inst_arr'=>$inst_arr,'periodes'=>$periode]);
    }

    function sampleinfo(Request $request, $instrument_type, $instrument_id){
        return view('urin.sampleinfo',['instrument_type'=>$instrument_type,'instrument_id'=>$instrument_id]);
    }

    function sampleinfo_store(Request $request){
        $data = new UrSampleInfo();
        $data->customer_id = $request->session()->get('user_id');
        $data->periode = $request->session()->get('periode');
        $data->receive_date = $request->receive_date;
        $data->material_condition = $request->radio;
        $data->inst_serial_no = $request->instrument_id;
        $data->inst_type = $request->instrument_type;
        $data->save();
        return redirect()->route('urin.qc',['instrument_type'=>$request->instrument_type,'instrument_id'=>$request->instrument_id]);
    }
    

    function qc(Request $request, $instrument_type, $instrument_id){
        $test = array(
            'names'=>['RBC','WBC','EC','CAST','BACT','Cond'],
            'units'=>['sel/uL','sel/uL','sel/uL','sel/uL','sel/uL','mS/cm']
        );
        
        return view('urin.qc',['instrument_type'=>$instrument_type,'instrument_id'=>$instrument_id,'tests'=>$test]);
    }

    function qc_store(Request $request){
        //save qc header
        $qch = new UrQcH();
        $qch->customer_id = $request->session()->get('user_id');
        $qch->periode = $request->session()->get('periode');
        $qch->inst_serial_no = $request->instrument_id;
        $qch->inst_type = $request->instrument_type;
        $qch->lot_no = $request->lotno;
        $qch->save();

        //get header id for qc detail
        $qch_id = $qch->id;

        //save qc detail
        for($i=1;$i<=2;$i++){ //level part
            for($j=0;$j<6;$j++){ //test row part

                //if level part 1 then test row part begin at 0
                //if level part 2 then test row part begin at 6
                if($i==1){
                    $r = $j;
                }
                elseif($i==2){
                    $r = $j+6;
                }

                $qcd = new UrQcD();
                $qcd->qch_id = $qch_id;
                $qcd->test_name = $request->test[$r];
                $qcd->qc_value = $request->result[$r];
                $qcd->qc_level = $i;
                $qcd->save();
            }
        }
        return redirect()->route('urin.input',['instrument_type'=>$request->instrument_type,'instrument_id'=>$request->instrument_id,'page'=>'1']);
    }

    function input(Request $request, $instrument_type, $instrument_id, $page){
        $test = array(
            'names'=>['RBC','WBC','EC','CAST','BACT','Cond'],
            'units'=>['sel/uL','sel/uL','sel/uL','sel/uL','sel/uL','mS/cm']
        );
        return view('urin.input',['instrument_type'=>$instrument_type,'instrument_id'=>$instrument_id,'tests'=>$test,'page'=>$page]);
    }

    function input_store(Request $request){
        if($request->page==1){
            //save result header
            $resulth = new UrResultH();
            $resulth->customer_id = $request->session()->get('user_id');
            $resulth->periode = $request->session()->get('periode');
            $resulth->inst_serial_no = $request->instrument_id;
            $resulth->inst_type = $request->instrument_type;
            $resulth->save();

            //get result header id
            $resulth_id = $resulth->id;
        }
        elseif($request->page==2){
            $resulth = DB::table('ur_qch')->where('customer_id',$request->session()->get('user_id'))
                        ->where('periode',$request->session()->get('periode'))
                        ->where('inst_serial_no',$request->instrument_id)
                        ->where('inst_type',$request->instrument_type)->first();
            $resulth_id = $resulth->id;
        }

        //save result detail
        for($i=1;$i<=5;$i++){
            for($j=0;$j<6;$j++){
                $resultd = new UrResultD();
                $resultd->resulth_id = $resulth_id;
                if($i==1){$r = $j;}
                elseif($i==2){$r = $j+6;}
                elseif($i==3){$r = $j+12;}
                elseif($i==4){$r = $j+18;}
                elseif($i==5){$r = $j+24;}
                $resultd->test_name = $request->test[$r];
                $resultd->result_value = $request->result[$r];
                if($request->page=='1'){
                    $resultd->result_count = $i;
                }
                elseif($request->page=='2'){
                    $resultd->result_count = $i+5;
                }
                $resultd->save();
            }
        }
        
        if($request->page=='1'){
            return redirect()->route('urin.input',['instrument_type'=>$request->instrument_type,'instrument_id'=>$request->instrument_id,'page'=>'2']);
        }
        return redirect()->route('urin.success');
    }

    function success(){
        return view('urin.message');
    }
}
