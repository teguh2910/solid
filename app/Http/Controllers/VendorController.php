<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //feature-xxxx, by handika, 20170616, view vendor
    public function index()
    {
        $m_vendor = m_vendor::all();
        return view('vendor.view_vendor', compact('m_vendor'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input                 = \Input::all();
        $m_vendor              = new m_vendor;
        $m_vendor->vendor_name = $input['name_vendor'];
        $m_vendor->code_vendor = $input['code_vendor'];
        $m_vendor->country     = $input['country'];
        $m_vendor->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, vendor baru berhasil ditambahkan ke database');
        return redirect('vendor/view_vendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $m_vendor       = m_vendor::where('id',$id)->get();
        $vendor_all     = m_vendor::all();
        return view('vendor.edit_vendor', compact('m_vendor','vendor_all'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         m_vendor::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data vendor berhasil dihapus dari database');
        return redirect('vendor/view_vendor');
    }

    public function save_edit()
    {
        $input                  = \Input::all();
        $id                     = $input['id'];
        $m_vendor               = m_vendor::findOrFail($id);
        $m_vendor->vendor_name  = $input['vendor_name'];
        $m_vendor->code_vendor  = $input['code_vendor'];
        $m_vendor->country      = $input['country'];
        $m_vendor->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data user berhasil diubah');
        return redirect('vendor/view_vendor');
    }
}
