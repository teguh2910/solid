<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaxInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice_tax_list() // invoice from cashier
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','5')
							->get();
		return view('invoice.tax.tax_list', compact('invoice'));
	}
    public function invoice_receive_tax($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="6";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah diterima');
		return redirect('invoice/tax/list');
	}
    public function invoice_reject_tax($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="12";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah reject');
		return redirect('invoice/tax/list');
	}
    public function list_invoice_receive_tax() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','6')
							->get();
		return view('invoice.tax.tax_receive', compact('invoice'));
    }
    public function invoice_send_tax($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="7";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah dikirim');
		return redirect('invoice/receive/tax');
	}
    public function list_invoice_send_tax() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','7')
							->get();
		return view('invoice.tax.tax_send', compact('invoice'));
    }
    public function list_invoice_reject_tax() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','12')
							->get();
		return view('invoice.tax.tax_reject', compact('invoice'));
    }
    
}
