<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_dashboard;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view_dashboard()
    {
        $data=m_dashboard::all();
        return view('dashboard.dashboard', compact('data'));
        // return $dashboard;
    }

    public function view_save_dashboard($id){
        $data=m_dashboard::find($id);
        return view('dashboard.save_dashboard',compact('data'));
    }
    
    public function save_dashboard(){
        $data= \Input::all();
        $new = m_dashboard::find($data['id']);
        $new->kode_area=$data['kode_area'];
        $new->nama_area=$data['nama_area'];
        $new->leader=$data['leader'];
        $new->supervisor=$data['spv'];
        $new->manager=$data['manager'];
        $new->auditor=$data['auditor'];
        $new->hitung_8=$data['hitung_8'];
        $new->hitung_9=$data['hitung_9'];
        $new->hitung_10=$data['hitung_10'];
        $new->entry_9=$data['entry_9'];
        $new->entry_10=$data['entry_10'];
        $new->entry_11=$data['entry_11'];
        $new->save();

         \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses Simpan Data');
        return \Redirect::Back();
    }
}
