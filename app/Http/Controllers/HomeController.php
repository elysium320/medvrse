<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\PatientInfo;
use App\Models\ResultInfo;
use DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $path = public_path('/uploads');
        $files = File::allFiles($path);
        foreach($files as $file){
            $fileInfo = pathinfo($file);
            $contents = "";
            if($fileInfo['extension'] == 'txt'){
                $contents = File::get($file);
                $contents = explode("\r\n",$contents);
                foreach($contents as $content){
                    $data_arrays = explode(',',$content);
                    if($data_arrays[0] == "1"){
                        $check_patient = PatientInfo::select()->where('mrn','=', intval($data_arrays[1]))->first();
                        if($check_patient){
                            $check_patient->mrn = $data_arrays[1];
                            $check_patient->firstname = $data_arrays[2];
                            $check_patient->fathername = $data_arrays[3];
                            $check_patient->familyname = $data_arrays[4];
                            $check_patient->birthday = date('Y-m-d', strtotime($data_arrays[5]));
                            $check_patient->gender = $data_arrays[6];
                            $check_patient->save();
                        }
                        else{
                            $patient_info = new PatientInfo();
                            $patient_info->mrn = $data_arrays[1];
                            $patient_info->firstname = $data_arrays[2];
                            $patient_info->fathername = $data_arrays[3];
                            $patient_info->familyname = $data_arrays[4];
                            $patient_info->birthday = date('Y-m-d', strtotime($data_arrays[5]));
                            $patient_info->gender = $data_arrays[6];
                            $patient_info->save();
                        }
                    }
                    if($data_arrays[0] == "2"){
                        $check_patient = ResultInfo::select()
                            ->where('mrn','=', intval($data_arrays[1]))
                            ->where('record_date','=',$data_arrays[2])
                            ->where('record_nature','=',$data_arrays[3])
                            ->where('processing_site','=',$data_arrays[4])
                            ->where('pdf_name','=',$data_arrays[5])->first();
                        if($check_patient){
                        }
                        else{
                            $result_info = new ResultInfo();
                            $result_info->mrn = $data_arrays[1];
                            $result_info->record_date = $data_arrays[2];
                            $result_info->record_nature = $data_arrays[3];
                            $result_info->processing_site = $data_arrays[4];
                            $result_info->pdf_name = $data_arrays[5];
                            $result_info->save();
                        }
                    }
                }
            }
        }
        $patient_infos = PatientInfo::all();
        $result_infos = ResultInfo::all();
        return view('home',compact(['patient_infos','result_infos']));
    }
    public function patient_info(Request $request){
        dd($request);
    }
}
