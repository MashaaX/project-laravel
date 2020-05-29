<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountLecturer;
use App\LecturerModel;
use App\SubjectLecturer;
use App\positionLecturer;
use App\ResearcherLecturer;

class LecturerController extends Controller
{
    //CRUD + Download + Upload File Contract 

    public function index($code){
        $data = [
            'code'      => $code,
            'info'      => LecturerModel::where('code',$code)->get(),
            'positions' => positionLecturer::where('code',$code)->get()
        ];
        return view('profile',$data);
    }

    public function subjectList($code){

        $subject = SubjectLecturer::where('code',$code)->get();

        $isSubjectDownloadable = SubjectLecturer::checkDownloadable($subject);

        $data = [
            'code' =>   $code,
            'subject' => $subject,
            'isDownloadable' => $isSubjectDownloadable
        ];
        
        return view('subjects',$data);
    }

    public function researchList($code){
        $data = [
            'code'      => $code,
            'research' => ResearcherLecturer::where('code',$code)->get(),
            
        ];
        return view('research',$data);
    }

// public function detail($id){
    //     $mahasiswa = Mahasiswa::find($id);
    //     return view('detail',['mahasiswa'=>$mahasiswa]);
    // }

    // public function edit($id){
    //     $mahasiswa = Mahasiswa::find($id);
    //     return view('edit',['mahasiswa'=>$mahasiswa]);
    // }

    // public function update($id, Request $request){
    //     $mahasiswa = Mahasiswa::find($id);
    //     $mahasiswa->nama = $request->namamhs;
    //     $mahasiswa->nim = $request->nimmhs;
    //     $mahasiswa->email = $request->emailmhs;
    //     $mahasiswa->jurusan = $request->jurusanmhs;
        
    //     $mahasiswa->save();

    //     return redirect('/mahasiswa');
    // }

    // public function hapus($id){
    //     $mahasiswa = Mahasiswa::find($id);
    //     $mahasiswa->delete();
    //     return redirect('/mahasiswa');
// }

    public function editPassword($code){
        $data = [
            'code'      => $code,
            'info' => AccountLecturer::where('code',$code)->get(),
        ];
        return view('changePassword',$data);
    }
    
    public function updatePassword(Request $request , $code){
        $info = AccountLecturer::find($id);
        $info->password = $request->password;
        $info->save();
        return redirect('/lecturer/{code}');
    }
}
