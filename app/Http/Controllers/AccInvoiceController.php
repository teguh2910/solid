<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice_acc_list() // invoice from cashier
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','3')
							->get();
		return view('invoice.acc.acc_list', compact('invoice'));
	}
    public function invoice_receive_acc($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="4";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah diterima');
		return redirect('invoice/acc/list');
	}
    public function invoice_reject_acc($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="11";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah direject');
		return redirect('invoice/acc/list');
	}
    public function list_invoice_receive_acc() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','4')
							->get();
		return view('invoice.acc.acc_receive', compact('invoice'));
    }
    public function invoice_send_acc($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="5";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah dikirim');
		return redirect('invoice/receive/acc');
	}
    public function invoice_send_acc_fin($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="7";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah dikirim');
		return redirect('invoice/receive/acc');
	}
    public function list_invoice_send_acc() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','5')
							->get();
		return view('invoice.acc.acc_send', compact('invoice'));
    }
    public function list_invoice_reject_acc() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','11')
							->get();
		return view('invoice.acc.acc_reject', compact('invoice'));
    }
    
}
