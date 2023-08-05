<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_bank;

class bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m_bank = m_bank::all();
        return view('bank.view_bank', compact('m_bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $input                 = \Input::all();
        $m_bank              = new m_bank;
        $m_bank->bank_name = $input['name_bank'];
        $m_bank->code_bank = $input['code_bank'];
        $m_bank->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, bank baru berhasil ditambahkan ke database');
        return redirect('bank/view_bank');
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
    public function save_edit()
    {
        $input                  = \Input::all();
        $id                     = $input['id'];
        $m_bank                 = m_bank::findOrFail($id);
        $m_bank->bank_name      = $input['bank_name'];
        $m_bank->code_bank      = $input['code_bank'];
        $m_bank->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data bank berhasil diubah');
        return redirect('bank/view_bank');
    }

     public function edit($id)
    {
        $m_bank       = m_bank::where('id',$id)->get();
        $bank_all     = m_bank::all();
        return view('bank.edit_bank', compact('m_bank','bank_all'));
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
         m_bank::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data bank berhasil dihapus dari database');
        return redirect('bank/view_bank');
    }
}
