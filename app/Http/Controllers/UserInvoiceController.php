<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice_user_list() // invoice from cashier
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','1')
							->get();
		return view('invoice.user.user_list', compact('invoice'));
	}
    public function invoice_receive_user($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="2";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah diterima');
		return redirect('invoice/user/list');
	}
    public function invoice_reject_user($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="10";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah reject');
		return redirect('invoice/user/list');
	}
    public function list_invoice_receive_user() {
        $invoice = Invoice::where('status','2')
							->get();
							
		return view('invoice.user.user_receive', compact('invoice'));
    }
    public function invoice_send_user($id) //invoice user receive
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->status="3";
		$invoice->tgl_terima_user=$date;
		$invoice->save();		
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah dikirim');
		return redirect('invoice/receive/user');
	}
    public function list_invoice_send_user() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','3')
							->get();
		return view('invoice.user.user_send', compact('invoice'));
    }
    public function list_invoice_reject_user() {
        $user =\Auth::user();
		$invoice = Invoice::where('status','11')
							->get();
		return view('invoice.user.user_reject', compact('invoice'));
    }

	public function all_receive(Request $request)
		{

			// Get the selected invoice IDs from the request
			$selectedInvoiceIds = $request->input('invoice_ids');

			// Update the status to "Terima" for the selected invoices
			try {
				Invoice::whereIn('id', $selectedInvoiceIds)->update(['status' => '2']);

				// Redirect back with a success message
				return redirect()->back()->with('success', 'Status updated to "Terima" successfully');
			} catch (\Exception $e) {
				// Handle any errors, e.g., database errors
				return redirect()->back()->with('error', 'An error occurred while updating the status');
			}
		}
	public function all_send(Request $request)
		{

			// Get the selected invoice IDs from the request
			$selectedInvoiceIds = $request->input('invoice_ids');

			// Update the status to "Terima" for the selected invoices
			try {
				Invoice::whereIn('id', $selectedInvoiceIds)->update(['status' => '3']);

				// Redirect back with a success message
				return redirect()->back()->with('success', 'Status updated to "Kirim" successfully');
			} catch (\Exception $e) {
				// Handle any errors, e.g., database errors
				return redirect()->back()->with('error', 'An error occurred while updating the status');
			}
		}
    
}
