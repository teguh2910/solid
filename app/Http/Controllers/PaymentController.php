<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\t_bank_data;
use App\m_bank;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_c = m_bank::all();
        $m_payment = t_bank_data::all();
        return view('payment.view_payment', compact('m_payment','bank_c'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input                 = \Input::all();
        $v_payment              = new t_bank_data;
        $v_payment->code_vendor = $input['code_vendor'];
        $v_payment->code_bank   = $input['code_bank'];
        $v_payment->part_bank    = $input['part_bank'];
        $v_payment->account_no   = $input['account_no'];
        $v_payment->account_name = $input['account_name'];
        $v_payment->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, payment baru berhasil ditambahkan ke database');
        return redirect('payment');
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

    public function edit($id)
    {
        $m_payment       = t_bank_data::where('id',$id)->get();
        $bank_c = m_bank::all();
        return view('payment.edit_payment', compact('m_payment','bank_c'));
    }

    public function destroy($id)
    {
         t_bank_data::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data vendor berhasil dihapus dari database');
        return redirect('payment');
    }

    public function save_edit()
    {
        $input                  = \Input::all();
        $id                     = $input['id'];
        $v_payment              = t_bank_data::findOrFail($id);
        $v_payment->code_vendor = $input['code_vendor'];
        $v_payment->code_bank   = $input['code_bank'];
        $v_payment->part_bank    = $input['part_bank'];
        $v_payment->account_no   = $input['account_no'];
        $v_payment->account_name = $input['account_name'];
        $v_payment->update();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data user berhasil diubah');
        return redirect('payment');
    }

}
