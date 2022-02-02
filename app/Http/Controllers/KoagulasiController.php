<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use App\User;
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
use DB;

class KoagulasiController extends Controller
{
    
    function login(Request $request){
        $data = User::where('user_id',$request->user_id)->firstOrFail();
        if($data){
            if($data->password==$request->password){
                $periode = KgPeriode::where('isactive','Y')->first();
                $periode_id = 'N/A';
                if(!is_null($periode)){
                    $periode_id = $periode->periode_id;
                }
                session(['user_id'=>$data->user_id,'user_name'=>$data->user_name,'periode'=>$periode_id, 'islogin'=>true]);
                return redirect()->route('koagulasi.home');
            }
            return redirect()->route('koagulasi.index');
        }
        return redirect()->route('koagulasi.index');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('koagulasi.index');
    }

    function index(){
        return view('koagulasi.login');
    }

    function home(){
        return view('koagulasi.home');
    }

    function myprofile(Request $request){
        $count = KgProfile::where('customer_id',$request->session()->get('user_id'))->count();
        if($count > 0){
            $profile = KgProfile::where('customer_id',$request->session()->get('user_id'))->first();
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
        return view('koagulasi.profile',[
                'user_id'=>$request->session()->get('user_id'),
                'user_name'=>$request->session()->get('user_name'),
                'profile'=>$data
                ]);
    }

    function profile_store(Request $request){
        
        $count = KgProfile::where('customer_id',$request->session()->get('user_id'))->count();
        if($count > 0 ){
            $profile = KgProfile::where('customer_id',$request->session()->get('user_id'))->first();
        }
        else{
           $profile = new KgProfile();
           $profile->customer_id = $request->session()->get('user_id');
        }
        $profile->address = $request->address;
        $profile->pj_lab = $request->pjlab;
        $profile->email_pj_lab = $request->email_pjlab;
        $profile->ka_lab = $request->kalab;
        $profile->email_ka_lab = $request->email_kalab;
        $profile->hp = $request->hp;
        $profile->telp = $request->telp;
        $profile->save();
        return redirect()->route('koagulasi.profile');
    }

    function sampleinfo(Request $request, $instrument_type, $instrument_id){
        return view('koagulasi.sampleinfo',['instrument_type'=>$instrument_type,'instrument_id'=>$instrument_id]);
    }

    function sampleinfo_store(Request $request){
        //store sample info
        $data = new KgSampleInfo();
        $data->customer_id = $request->session()->get('user_id');
        $data->inst_serial_no = $request->instrument_id;
        $data->inst_type = $request->instrument_type;
        $data->periode = $request->session()->get('periode');;
        $data->receive_date = $request->receive_date;
        $data->material_condition = $request->radio;
        if($request->has('doddimer')){
            $data->doddimer = 'Y';
        }else{
            $data->doddimer = 'N';
        }
        if($request->has('doptaptt')){
            $data->doptaptt = 'Y';
        }else{
            $data->doptaptt = 'N';
        }
        $data->save();
        
        if($request->has('doddimer')){
            return redirect()->route('koagulasi.qc',['ddimer',$request->instrument_type,$request->instrument_id]);
        }
        return redirect()->route('koagulasi.qc',['ptaptt',$request->instrument_type,$request->instrument_id]);
    }

    function instrument(Request $request){
        //get list of instrument
        $instruments = KgInstrument::where('customer_id',$request->session()->get('user_id'))->get();
        
        $periode = KgPeriode::get();
        
        $inst_arr = array();
        
        foreach($instruments as $instrument){
            //check if current instrument already input result
            $count_ptaptt = KgPtapttResultH::where('inst_serial_no',$instrument->inst_serial_no)
                        ->where('inst_type',$instrument->inst_type)
                        ->where('customer_id',$request->session()->get('user_id'))
                        ->where('periode',$request->session()->get('periode'))->count();
            $count_ddimer = KgDdimerResultH::where('inst_serial_no',$instrument->inst_serial_no)
                        ->where('inst_type',$instrument->inst_type)
                        ->where('customer_id',$request->session()->get('user_id'))
                        ->where('periode',$request->session()->get('periode'))->count();
            $count = $count_ptaptt + $count_ddimer;

            if($count > 0){ //already input result
                $inst_arr = Arr::add($inst_arr,$instrument->inst_serial_no,'Y');
            }
            else{ //not input result yet
                $inst_arr = Arr::add($inst_arr,$instrument->inst_serial_no,'N');
            }
        }
        
        return view('koagulasi.instrument',['instruments'=>$instruments,'inst_arr'=>$inst_arr,'periodes'=>$periode]);
    }

    function qc(Request $request, $test, $instrument_type, $instrument_id){
        return view('koagulasi.qc',['test'=>$test,'instrument_id'=>$instrument_id,'instrument_type'=>$instrument_type]);
    }

    function qc_store(Request $request){
        //Retrieve value from DDimer form 
        if($request->test=='ddimer'){
            //Save QC Header
            $qch = new KgDdimerQch();
            //$qch->reagen_lot = $request->reagenlot;
            //$qch->innovance_lot = $request->innolot;
            //$qch->calibrate_date = $request->kalibrasi;
            $qch->customer_id = $request->session()->get('user_id');
            $qch->inst_serial_no = $request->instrument_id;
            $qch->inst_type = $request->instrument_type;
            $qch->periode = $request->session()->get('periode');
            $qch->save();
            $qch_id = $qch->id;
            
            //Save QC Detail
            $results = $request->result;
            foreach($results as $index => $result){
                $qcd = new KgDdimerQcd();
                $qcd->qch_id = $qch_id;
                $qcd->qc_count = $index+1;
                $qcd->qc_value = $result;
                $qcd->qc_lotno = $request->lotno[$index];
                //$qcd->qc_upper = $request->upper[$index];
                //$qcd->qc_lower = $request->lower[$index];
                //$qcd->qc_dilution = $request->dilution[$index];
                $qcd->save();
            }
            
            return redirect()->route('koagulasi.input',['ddimer',$request->instrument_type,$request->instrument_id]);
        }

        //Retrieve value from PT-APTT form 
        if($request->test=='ptaptt'){
            //Save QC Header
            $qch = new KgPtapttQch();
            $qch->pt_reagen_name = $request->ptreagenname;
            //$qch->pt_reagen_lot = $request->ptlotno;
            $qch->aptt_reagen_name = $request->apttreagenname;
            //$qch->aptt_reagen_lot = $request->apttlotno;
            //$qch->cpn_dilution_date = $request->dilution[0];
            //$qch->cpp_dilution_date = $request->dilution[1];
            $qch->customer_id = $request->session()->get('user_id');
            $qch->inst_serial_no = $request->instrument_id;
            $qch->inst_type = $request->instrument_type;
            $qch->periode = $request->session()->get('periode');
            $qch->save();
            $qch_id = $qch->id;

            //Save QC Detail
            for($i=0;$i<2;$i++){
                for($j=0;$j<2;$j++){
                    if($request->control[$i]=='CPN' or ($request->control[$i]=='CPP' and $request->hasil[$j+2]<>'')){
                        $qcd = new KgPtapttQcd();
                        $qcd->qch_id = $qch_id;
                        $qcd->test_name = $request->param[$i+$j];
                        $qcd->control_type = $request->control[$i];
                        if($i==0){ //CPN control
                            $qcd->qc_lotno = $request->lotno[0];
                            $qcd->qc_value = $request->hasil[$i+$j];
                            //$qcd->qc_upper = $request->upper[$i+$j];
                            //$qcd->qc_lower = $request->lower[$i+$j];
                        }
                        elseif($i==1){ //CPP control
                            $qcd->qc_lotno = $request->lotno[$j+1];
                            $qcd->qc_value = $request->hasil[$j+2];
                            //$qcd->qc_upper = $request->upper[$j+2];
                            //$qcd->qc_lower = $request->lower[$j+2];
                        }
                        $qcd->save();
                    }
                }
            }

            return redirect()->route('koagulasi.input',['ptaptt',$request->instrument_type,$request->instrument_id]);
        }
        
    }

    function input(Request $request, $test, $instrument_type, $instrument_id){
        return view('koagulasi.input',['test'=>$test,'instrument_id'=>$instrument_id,'instrument_type'=>$instrument_type]);
    }

    function input_store(Request $request){
    
        //Retrieve value from DDimer form 
        if($request->test=='ddimer'){
            //Save Result Header
            $resulth = new KgDdimerResultH();
            $resulth->activity_date = $request->radio;
            $resulth->executor = $request->pelaksana;
            $resulth->customer_id = $request->session()->get('user_id');
            $resulth->inst_serial_no = $request->instrument_id;
            $resulth->inst_type = $request->instrument_type;
            $resulth->periode = $request->session()->get('periode');
            $resulth->save();
            $resulth_id = $resulth->id;

            //Save Result Detail
            for($i=0;$i<4;$i++){
                $resultd = new KgDdimerResultD();
                $resultd->resulth_id = $resulth_id;
                $resultd->material_type = $request->material[$i/2];
                $resultd->result_count = ($i%2)+1;
                $resultd->result_value = $request->result[$i];
                $resultd->dod = $request->dod[$i];
                $resultd->save();

            }

            //Get Do Ddimer or Pt-Aptt flag
            $flag = KgSampleInfo::where('customer_id',$request->session()->get('user_id'))
                            ->where('periode',$request->session()->get('periode'))
                            ->where('inst_serial_no',$request->instrument_id)
                            ->where('inst_type',$request->instrument_type)->firstOrFail();

            if($flag->doptaptt == 'Y'){
                return redirect()->route('koagulasi.qc',['test'=>'ptaptt','instrument_id'=>$request->instrument_id,'instrument_type'=>$request->instrument_type]);
            }
            return redirect()->route('koagulasi.success');
        }

        //Retrieve value from PT-APTT form 
        if($request->test=='ptaptt'){
            //Save Result Header
            
            $resulth = new KgPtapttResultH();
            $resulth->activity_date = $request->radio;
            $resulth->executor = $request->pelaksana;
            $resulth->customer_id = $request->session()->get('user_id');
            $resulth->inst_serial_no = $request->instrument_id;
            $resulth->inst_type = $request->instrument_type;
            $resulth->periode = $request->session()->get('periode');
            $resulth->pt_refrange = $request->ptrr;
            $resulth->aptt_refrange = $request->apttrr;
            $resulth->save();
            $resulth_id = $resulth->id;

            //Save Result Detail
            $cnt = 1;
            for($i=0;$i<8;$i++){
                $resultd = new KgPtapttResultD();
                $resultd->resulth_id = $resulth_id;
                $resultd->material_type = $request->material[$i/4];
                $resultd->test_name = $request->param[$i];
                $resultd->result_count = $cnt;
                $resultd->result_value = $request->hasil[$i];
                $resultd->save();

                if(($i+1)%2==0){
                    $cnt = $cnt + 1;
                }
            }
            return redirect()->route('koagulasi.success');
        }
        return "Redirect Fail";
    }

    function view(Request $request, $instrument_type, $instrument_id){
        $sampleinfo = KgSampleInfo::where('periode',$request->session()->get('periode'))
                     ->where('customer_id',$request->session()->get('user_id'))
                     ->where('inst_serial_no',$instrument_id)
                     ->where('inst_type',$instrument_type)
                     ->first();
        
        $qc_ddimer = DB::table('kg_ddimer_qch')
                    ->join('kg_ddimer_qcd','kg_ddimer_qch.id','=','kg_ddimer_qcd.qch_id')
                    ->where('periode','=',$request->session()->get('periode'))
                    ->where('inst_serial_no','=',$instrument_id)
                    ->where('inst_type','=',$instrument_type)
                    ->orderBy('qc_count','asc')
                    ->get();

        $result_ddimer = DB::table('kg_ddimer_resulth')
                    ->join('kg_ddimer_resultd','kg_ddimer_resulth.id','=','kg_ddimer_resultd.resulth_id')
                    ->where('periode','=',$request->session()->get('periode'))
                    ->where('inst_serial_no','=',$instrument_id)
                    ->where('inst_type','=',$instrument_type)
                    ->orderBy('material_type','asc')
                    ->orderBy('result_count','asc')
                    ->get();
        
        
        //bug fix 28-10-2021
        //this IF condition to handle view error when DDimer not performance
        if($sampleinfo->doddimer == 'Y'){
            $first = $result_ddimer->first();
            $activity_ddimer = $first->activity_date;
        }
        else{
            $activity_ddimer = '-';
        }
        

        $qc_ptaptt = DB::table('kg_ptaptt_qch')
                    ->join('kg_ptaptt_qcd','kg_ptaptt_qch.id','=','kg_ptaptt_qcd.qch_id')
                    ->where('periode','=',$request->session()->get('periode'))
                    ->where('inst_serial_no','=',$instrument_id)
                    ->where('inst_type','=',$instrument_type)
                    ->orderBy('control_type','asc')
                    ->orderBy('test_name','asc')
                    ->get();

        $first = $qc_ptaptt->first();
        $reagen_pt = $first->pt_reagen_name;
        $reagen_aptt = $first->aptt_reagen_name;
        
        $result_ptaptt = DB::table('kg_ptaptt_resulth')
                    ->join('kg_ptaptt_resultd','kg_ptaptt_resulth.id','=','kg_ptaptt_resultd.resulth_id')
                    ->where('periode','=',$request->session()->get('periode'))
                    ->where('inst_serial_no','=',$instrument_id)
                    ->where('inst_type','=',$instrument_type)
                    ->orderBy('result_count','asc')
                    ->orderBy('test_name','desc')
                    ->get();
                    
        //bug fix 28-10-2021
        //this IF condition to handle view error when PT-APTT not performance
        if($sampleinfo->doptaptt == 'Y'){
            $first = $result_ptaptt->first();
            $activity_ptaptt = $first->activity_date;
        }
        else{
            $activity_ptaptt = '-';
        }
        

        return view('koagulasi.view',['instrument_type'=>$instrument_type,'instrument_id'=>$instrument_id,
                                    'activity_ddimer'=>$activity_ddimer,
                                    'activity_ptaptt'=>$activity_ptaptt,
                                    'reagen_pt'=>$reagen_pt,
                                    'reagen_aptt'=>$reagen_aptt,
                                    'qc_ddimer'=>$qc_ddimer,
                                    'result_ddimer'=>$result_ddimer,
                                    'qc_ptaptt'=>$qc_ptaptt,
                                    'result_ptaptt'=>$result_ptaptt,
                                    'sampleinfo'=>$sampleinfo]);
    }

    function success(){
        return view('koagulasi.message');
    }
}
