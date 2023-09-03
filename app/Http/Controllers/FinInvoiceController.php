<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice_fin_list() // invoice from cashier
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','7')
							->get();
		return view('invoice.fin.fin_list', compact('invoice'));
	}
    public function invoice_receive_fin($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="8";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah diterima');
		return redirect('invoice/fin/list');
	}
    public function invoice_reject_fin($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="13";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah reject');
		return redirect('invoice/fin/list');
	}
    public function list_invoice_receive_fin() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','8')
							->get();
		return view('invoice.fin.fin_receive', compact('invoice'));
    }
    public function invoice_send_fin($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="9";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah dikirim');
		return redirect('invoice/receive/fin');
	}
    public function list_invoice_send_fin() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','9')
							->get();
		return view('invoice.fin.fin_send', compact('invoice'));
    }
    public function list_invoice_reject_fin() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','13')
							->get();
		return view('invoice.fin.fin_reject', compact('invoice'));
    }
    
}
