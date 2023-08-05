<?php namespace App\Http\Controllers;
use App\Invoice;
use App\CsvHelper;
use App\User;
use App\m_area;
use App\m_part;
use App\t_transaction;
use App\Stock;
use App\history_invoice; //dev-3.7.0, 20180202, by Fahrul Sudarusman
use DB;
use Illuminate\Support\Collection; 
use Illuminate\Http\Request;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Libern\QRCodeReader\QRCodeReader;
use Datatables;
use App\m_bank;
use App\t_bank_data;
use App\m_vendor;


use Excel;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user =\Auth::user();
		if ($user->role == "1") {
			$user 		= \Auth::user();
			$queries 	= DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        	$result 	= new Collection($queries);
        	$queries2 	= DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        	$result2 	= new Collection($queries2);
        	$queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        	$result3 = new Collection($queries3);
        	$queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        	$result4 = new Collection($queries4);
			$invoice 	= Invoice::where('status','1')
									->where('dept_code',$user->dept_code)
									->get();
			return view('invoice.new_list', compact('invoice','result','result2','result3','result4'));
		} else if ($user->role == "2") {
			$queries = DB::select('select count(id) as a from invoice where 
			(status="2" or status="7")');
	        $result = new Collection($queries);
	        $queries2 = DB::select('select count(id) as b from invoice where 
				status="6"');
	        $result2 = new Collection($queries2);
			$queries3 = DB::select('select count(id) as c from invoice where 
				status="3"');
	        $result3 = new Collection($queries3);
			$invoice = Invoice::where ( function ($q) {
	                $q->where('status','2')
	                    ->orWhere('status','7');
	                })
					->get();
			return view('invoice.act_list', compact('invoice','result','result2','result3','result4'));
		} elseif ($user->role == "8") {
			$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
        $queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','9')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.new_list', compact('invoice','result','result2','result3','result4'));
		
		}else if($user->role == "3"){
			$invoice = Invoice::where('status','3')->get();
			$queries = DB::select('select count(id) as a from invoice where status="3"');
        	$result = new Collection($queries);
        	$queries2 = DB::select('select count(id) as b from invoice where status="4"');
        	$result2 = new Collection($queries2);
		return view('invoice.fa_list', compact('invoice','result','result2'));
		} else if ($user->role == "4"){
			$invoice = Invoice::where('status','!=','8')->get();
			$queries = DB::select('select count(id) as a from invoice where status!="8"');
        	$result = new Collection($queries);
			return view('invoice.op_list', compact('invoice','result'));
		}else if ($user->role == "5"){
			
	        $user=\Auth::user();	
		 	$m_areas=m_area::all();
		 	$t_transaction=t_transaction::all();
		 	return view('stock.view_transaction',compact('t_transaction','m_areas'));

		}else if ($user->role == "6"){
	        $user=\Auth::user();	
		 	$m_areas=m_area::where('pic_name','=',$user->name)->get();
		 	$t_transaction=t_transaction::all();
		 	return view('stock.view_transaction',compact('t_transaction','m_areas'));
	 	}else if($user->role == "7"){
	        $user=\Auth::user();
	        if ($user->role == '7') {	
		 	$m_areas=m_area::where('pic_name','=',$user->name)->get();
		 	} else {
		 	$m_areas=m_area::all();
		 	}
		 	if ($user->role == '7') {
		 	$t_transaction 	= t_transaction::join('m_areas','m_areas.id_area','=','t_transactions.id_area')
		 									->where('m_areas.pic_name',''.$user->name.'')->get();
		 	} else {
		 	$t_transaction 	= t_transaction::all();
		 	}
		 	return view('stock.view_transaction',compact('t_transaction','m_areas'));
	 	}
			return redirect('auth/logout') ;
		}
	

	public function invoice_add()
	{
		return view('invoice.add');
	}

	public function invoice_new_list() // tab tambahan renni
	{
		$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
        $queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','9')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.new_list', compact('invoice','result','result2','result3','result4'));
	}

	public function invoice_new_list1() // tab user
	{
		$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
        $queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','1')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.new_list', compact('invoice','result','result2','result3','result4'));
	}

	public function invoice_user_list() 
	{
		$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
        $queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','1')
							->where('dept_code',$user->dept_code)
							->get();
		//dd($invoice);
		return view('invoice.user_list', compact('invoice','result','result2','result3','result4'));
	}

	public function invoice_checked_user($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->user=$user->id;
		$invoice->status="1";
		$invoice->tgl_input=$date;
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "1";

		if ($history->status = '1') {
			$history->name_status 	= "Waiting Approval by User";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('invoice/user/newlist');
	}

	public function invoice_checked_check($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->user=$user->id;
		$invoice->status="2";
		$invoice->tgl_terima_user=$date;
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "2";

		if ($history->status = '2') {
			$history->name_status 	= "Checked by User";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('invoice/user/list');
	}

	public function invoice_pending_user($id)
	{
		$user 		= \Auth::user();
		$invoice 	= Invoice::where('id',$id)
								->where('dept_code',$user->dept_code)
								->where('status','1')
								->get();
		return view('invoice.user_pending_view', compact('invoice'));
	}

	public function invoice_pending_user1($id)
	{
		$user 		= \Auth::user();
		$invoice 	= Invoice::where('id',$id)
								->where('dept_code',$user->dept_code)
								->where('status','9')
								->get();
		return view('invoice.user1_pending_view', compact('invoice'));
	}

	public function invoice_reject_user($id)
	{
		$user 		= \Auth::user();
		$invoice 	= Invoice::where('id',$id)
							->where('dept_code',$user->dept_code)
							->where('status','6')->get();
		return view('invoice.user_reject_view', compact('invoice'));
	}

	public function invoice_reject_fa($id)
	{
		$invoice = Invoice::findOrFail($id);
		$invoice->status="7";
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di reject');
		return redirect('invoice/fa/list');
	}

	public function invoice_detail($id)
	{
		$user =\Auth::user();
		$invoice = Invoice::where('id',$id)
						->get();
		return view('invoice.invoice_detail', compact('invoice'));
	}

	public function invoice_pending_act($id)
	{
		$invoice = Invoice::where('id',$id)
						->where ( function ($q) {
                			$q->where('status','2')
                    		->orWhere('status','7');
                			})->get();
		return view('invoice.act_pending_view', compact('invoice'));
	}

	public function invoice_pending_user_save()
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$input 		= \Input::all();
		$user 		= \Auth::user();
		$id 		= $input['id'];
		$invoice 					= Invoice::findOrFail($id);
		$invoice->status 			= "20";
		$invoice->user 				= $user->id;
		$invoice->tgl_pending_user 	= $date;
		$invoice->remark 			= $input['remark'];
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "20";

		if ($history->status = '20') {
			$history->name_status 	= "Reject by User";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice berhasil di reject');
		return redirect('/invoice/user/list');
	}

	public function invoice_pending_user1_save()
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$input 		= \Input::all();
		$user 		= \Auth::user();
		$id 		= $input['id'];
		$invoice 					= Invoice::findOrFail($id);
		$invoice->status 			= "5";
		$invoice->user 				= $user->id;
		$invoice->tgl_pending_user 	= $date;
		$invoice->remark 			= $input['remark'];
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "5";

		if ($history->status = '5') {
			$history->name_status 	= "Reject by Purch";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice berhasil di reject');
		return redirect('/invoice/user/list');
	}

	public function invoice_pending_act_save()
	{
		$input = \Input::all();
		$id=$input['id'];
		$invoice = Invoice::findOrFail($id);
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice->status="1";
		$invoice->act=$user->id;
		$invoice->tgl_pending_act=$date;
		$invoice->remark_act=$input['remark'];
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "1";

		if ($history->status = '1') {
			$history->name_status 	= "Reject by Accounting";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di reject');
		return redirect('home');
	}

	public function invoice_pending_list()
	{
		$invoice = Invoice::whereIn('status', ['5', '20'])->get();
		return view('invoice.pending_list', compact('invoice'));
	}

	public function invoice_act_list()
	{
		$queries = DB::select('select count(id) as a from invoice where 
			(status="2" or status="7")');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6"');
        $result2 = new Collection($queries2);
		$queries3 = DB::select('select count(id) as c from invoice where 
			status="3"');
        $result3 = new Collection($queries3);
		$invoice = Invoice::where ( function ($q) {
                $q->where('status','2')
                    ->orWhere('status','7');
                })
				->get();
		return view('invoice.act_list', compact('invoice','result','result2','result3'));
	}

	public function invoice_act_approve_list()
	{
		$queries = DB::select('select count(id) as a from invoice where 
			(status="2" or status="7")');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6"');
        $result2 = new Collection($queries2);
		$queries3 = DB::select('select count(id) as c from invoice where 
			status="3"');
        $result3 = new Collection($queries3);
		$invoice = Invoice::where('status','3')
							->get();
		return view('invoice.act_approve_list', compact('invoice','result','result2','result3'));
	}

	public function invoice_act_reject_list()
	{
		$queries = DB::select('select count(id) as a from invoice where 
			(status="2" or status="7")');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6"');
        $result2 = new Collection($queries2);
		$queries3 = DB::select('select count(id) as c from invoice where 
			status="3"');
        $result3 = new Collection($queries3);
		$invoice = Invoice::where('status','6')
							->get();
		return view('invoice.act_reject_list', compact('invoice','result','result2','result3'));
	}

	public function invoice_checked_act($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->act=$user->id;
		$invoice->status="3";
		$invoice->tgl_terima_act=$date;
		$invoice->save();

		//dev-3.7.0, 20180202, by Fahrul Sudarusman input ke tabel history invoice
		date_default_timezone_set('Asia/Jakarta');
		$date    				= date('Y-m-d H:i:s');
		$invoice 				= Invoice::findOrFail($id);

		$history                = new history_invoice;
		$history->no_penerimaan = $invoice->no_penerimaan;
		$history->dept_code     = $invoice->dept_code;
		$history->status 		= "3";

		if ($history->status = '3') {
			$history->name_status 	= "Approved by Accounting";
		}

		$history->tanggal 		= $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di approve');
		return redirect('invoice/act/list');
	}

	public function invoice_fa_list()
	{
		$invoice = Invoice::where('status','3')->get();
		$queries = DB::select('select count(id) as a from invoice where 
			status="3"');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="4"');
        $result2 = new Collection($queries2);
		return view('invoice.fa_list', compact('invoice','result','result2'));
	}

	public function invoice_fa_finish_list()
	{
		$invoice = Invoice::where('status','4')->get();
		$queries = DB::select('select count(id) as a from invoice where 
			status="3"');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="4"');
        $result2 = new Collection($queries2);
		return view('invoice.fa_finish_list', compact('invoice','result','result2'));
	}

	public function invoice_checked_fa($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->finance=$user->id;
		$invoice->status="4";
		$invoice->tgl_terima_finance=$date;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('/invoice/fa/list');
	}

	public function invoice_finish_fa($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->finance2=$user->id;
		$invoice->status="8";
		$invoice->tgl_ready_to_pay=$date;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di finish');
		return redirect('/invoice/fa/finish/list');
	}

	public function invoice_rtp_list()
	{
		$user = \Auth::user();
		// if ($user->role == '4' || $user->role == '3' || $user->role == '2') {
		// 	$invoice = Invoice::where('status','8')->orderby('id','DESC')->get();
		// 	return view('invoice.rtp_list', compact('invoice'));
		// } else {
		// 	return redirect('invoice/rtp/user');
		// }
		return view('invoice.rtp_list_2', compact('user'));
	}

	public function invoice_op_list()
	{
		$user =\Auth::user();
		if ($user->role == '4' || $user->role == '3' || $user->role == '2') {
			$invoice 	= Invoice::where('status','!=','8')->orderby('id','DESC')->get();
			$queries 	= DB::select('select count(id) as a from invoice where status != "8"');
	        $result 	= new Collection($queries);
			return view('invoice.op_list', compact('invoice','result'));
		} else {
			return redirect('invoice/op/user');
		}
	}

	public function invoice_rtp_user()
	{
		$user = \Auth::user();
		// $invoice = Invoice::where('status','8')
		// 					->where('dept_code',$user->dept_code)
		// 					->get();
		// return view('invoice.rtp_list', compact('invoice'));
		return view('invoice.rtp_list_2', compact('user'));

	}

	function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->kekata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
    }     
        return $temp;
}

	function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim($this->kekata($x));
    } else {
        $hasil = trim($this->kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

	//dev-3.0, 20161207, by yudo, invoice list print
	public function invoice_list_print(){

		$input 	= \Input::all();
		// $data   = array("no penerimaan", "department", "vendor", "tanggal terima", "doc_no","doc_date","due date", "curr", "amount", "no po");
		$data   = array();

		$data[] = array("no penerimaan", "department", "vendor", "tanggal terima", "doc_no","doc_date","due date", "curr", "amount", "no po");
		$tgl_terima = $input['ex_tgl_terima'];


		$invoice = DB::select('select * from invoice where tgl_terima = "'.$tgl_terima.'"');
		$result = new Collection($invoice);

            foreach($result as $result) {

            	 $dept = $result->dept_code;
            	 switch ($dept) {
				    case "1":
				        $deptName = "Purchasing & Exim";
				        break;
				    case "2":
				        $deptName = "General Affair";
				        break;
				    case "3":
				        $deptName = "BOD";
				        break;
				    case "5":
				        $deptName = "HR";
				        break;
				    case "6":
				        $deptName = "IT Development";
				        break;
				    case "11":
				        $deptName = "IRL";
				        break;
				  
				}
               
                 $data[] = array(
                    $result->no_penerimaan,
                    $deptName,
                    $result->vendor,
                    $result->tgl_terima,
                    $result->doc_no,
                    $result->doc_date,
                    $result->due_date,
                    $result->curr,
                    $result->amount,
                    $result->no_po
                );
            }

            // return $data;

           Excel::create('list_invoice', function($excel) use($data) {

   				 $excel->sheet('Data', function($sheet) use($data) {
        		 // $sheet->fromArray($data);
        		 $sheet->fromArray($data, null, 'A1', false, false);
    			 });
			})->export('xls');

	}
	//dev-3.0 , 20161207, by yudo, invoice print
	public function invoice_print($id)
	{

		$invoice = DB::select('select invoice.*, t_bank_datas.*, m_banks.*, m_vendors.* from invoice 
			inner join t_bank_datas on invoice.code_bank_data = t_bank_datas.id 
			inner join m_banks on t_bank_datas.code_bank = m_banks.code_bank 
			inner join m_vendors on t_bank_datas.code_vendor = m_vendors.code_vendor
			where invoice.id = "'.$id.'"');
		 $result = new Collection($invoice);

		
		\Excel::load('/storage/template/tandaterima.xlsm', function($file) use($result){

			foreach ($result as $result) {
			
				$no_penerimaan = $result->no_penerimaan;
				$code_vendor   = $result->code_vendor;
				$vendor_name   = $result->vendor_name;
				$invoice 	   = $result->doc_no;
				$tanggal 	   = $result->doc_date;
				$keterangan    = $result->description;
				$curr          = $result->curr;
				$amount        = $result->amount;
				$bank_code     = $result->code_bank;
				$bank_name     = $result->bank_name;
				$account_no    = $result->account_no;
				$account_name  = $result->account_name;
				$jatuh_tempo   = $result->due_date;
				$tgl           = date("Y-m-d");
				$tgl2          = date("Y");
			}

		
        	 switch ($curr) {
			    case "IDR":
			        $mata_uang1 = "RUPIAH";
			        $mata_uang2 = "rupiah";
			        $currency   = "Rp. ";
			        break;
			    case "JPY":
			        $mata_uang1 = "YEN";
			        $mata_uang2 = "yen";
			        $currency   = "'";
			        break;
			    case "THB":
			        $mata_uang1 = "BATH";
			        $mata_uang2 = "bath";
			        $currency   = "'";
			        break;
			    case "USD":
			        $mata_uang1 = "DOLLAR";
			        $mata_uang2 = "dollar";
			        $currency   = "'";
			        break;		  
			}

		$terbilang = $this->terbilang($amount, 1);
		$terbilang2 = $this->terbilang($amount, 2);
		//tanda Terima
		$file->setActiveSheetIndex(0)->setCellValue('K9', $no_penerimaan);
		$file->setActiveSheetIndex(0)->setCellValue('D11', $no_penerimaan);
		$file->setActiveSheetIndex(0)->setCellValue('I7', $no_penerimaan);
		$file->setActiveSheetIndex(0)->setCellValue('D12',$vendor_name);
		$file->setActiveSheetIndex(0)->setCellValue('C27', \Auth::user()->name);
		$file->setActiveSheetIndex(0)->setCellValue('H15',$keterangan);
		$file->setActiveSheetIndex(0)->setCellValue('B15',$invoice);
		$file->setActiveSheetIndex(0)->setCellValue('F15',$tanggal);
		$file->setActiveSheetIndex(0)->setCellValue('L15',$curr." ".number_format($amount,"2"));
		$file->setActiveSheetIndex(0)->setCellValue('L18',$curr." ".number_format($amount,"2"));
		
		$file->setActiveSheetIndex(0)->setCellValue('D19', $terbilang." ".$mata_uang1);
		$file->setActiveSheetIndex(0)->setCellValue('K22', $tgl);
		$file->setActiveSheetIndex(0)->setCellValue('K23', $bank_name);
		$file->setActiveSheetIndex(0)->setCellValue('K25', $account_no);
		$file->setActiveSheetIndex(0)->setCellValue('K26', $account_name);
		$file->setActiveSheetIndex(0)->setCellValue('K27', $jatuh_tempo);
		

		//invoice verification voucher
		$file->setActiveSheetIndex(0)->setCellValue('K35', $tgl);
		$file->setActiveSheetIndex(0)->setCellValue('E37', $tgl2."/".$no_penerimaan);
		$file->setActiveSheetIndex(0)->setCellValue('c38', $code_vendor."/".$vendor_name);
		$file->setActiveSheetIndex(0)->setCellValue('J38', $curr);
		// $file->setActiveSheetIndex(0)->setCellValue('L38', "'".number_format($amount, "0", ".", "."));
		$file->setActiveSheetIndex(0)->setCellValue('L38', $amount);
		$file->setActiveSheetIndex(0)->setCellValue('A41', $keterangan);
		$file->setActiveSheetIndex(0)->setCellValue('H41', $invoice);
		// $file->setActiveSheetIndex(0)->setCellValue('L41', "'".number_format($amount, "0", ".", "."));
		$file->setActiveSheetIndex(0)->setCellValue('L41', $amount);
		$file->setActiveSheetIndex(0)->setCellValue('C46', $terbilang2." ".$mata_uang2);
		$file->setActiveSheetIndex(0)->setCellValue('L46', $amount);

		$file->setActiveSheetIndex(0)->setCellValue('D50', $bank_code);
		$file->setActiveSheetIndex(0)->setCellValue('D51', $account_no);
		$file->setActiveSheetIndex(0)->setCellValue('D52', $account_name);

		$file->setActiveSheetIndex(0)->setCellValue('L51', $jatuh_tempo);

		})->export('xlsm');

		\Session::flash('flash_message','Sukses, invoice telah berhasil di finish');
		return Redirect::to('master/upload');

	    // return redirect('master/upload');

	}

	public function invoice_op_user()
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','!=','8')
							->where('dept_code',$user->dept_code)
							->get();
		$queries = DB::select('select count(id) as a from invoice where status!="8" and dept_code="'.$user->dept_code.'"');
        $result = new Collection($queries);
		return view('invoice.op_list', compact('invoice','result'));
	}

	public function invoice_pending_user_checked($id)
	{
		$invoice = Invoice::findOrFail($id);
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		if ($invoice->dept_code == '1') {
			$invoice->status	= "9";
		}else{
			$invoice->status	= "1";
		}
		$invoice->user=$user->name;
		$invoice->save();

		$input 		= \Input::all();
        date_default_timezone_set('Asia/Jakarta');
		$date 		= date('Y-m-d H:i:s');

		//dev-3.7.0, 20180201, by Farul Sudarusman, Input beberapa data ke table history invoice sebagai acuan history 
        $history 					= new history_invoice;
        $history->no_penerimaan		= $invoice->no_penerimaan;
        $history->dept_code 		= $invoice->dept_code;

        if ($history->dept_code == '1') {
			$history->status 		= "9";
			$history->name_status   = "Waiting Purch Received";
		}else{
			$history->status 	    = "1";
			$history->name_status 	= "Waiting Approval by User";
		}

		$history->tanggal		    = $date;
		$history->save();

		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('invoice/pending/list');
	}

	public function upload_master() {
		$date 		= date('y');
		$nomor 		= '';
		
		$bank_datas = DB::select('select * from m_vendors group by vendor_name');
		//hotfix-3.10.2 by AUDI, aotogenerate nomor penerimaan
		$invoice = Invoice::selectRaw('max(no_penerimaan) as nomor')->whereRaw('LEFT(no_penerimaan,2)='.$date)->first();
		$nomor = $invoice->nomor ? ($invoice->nomor + 1) : $date.'00000001';
		
		return view('invoice.upload', compact('nomor','bank_datas'));
	}

	//dev-3.0 by yudo, json part_bank dropdown list
	public function part_bank($id){
		$invoice = DB::select('select part_bank from t_bank_datas where code_vendor = "'.$id.'"');
		return $invoice;

	}

	//dev-3.0 by yudo, selected value di dropdown list
	public function part_bank_selected($id,$id2){
		$invoice = DB::select('select t_bank_datas.part_bank from t_bank_datas inner join invoice 
			on t_bank_datas.id = invoice.code_bank_data where code_vendor = "'.$id.'" and invoice.id = "'.$id2.'"');
		return $invoice;

	}

	//dev-3.0 by yudo, json data bank
	public function account($id,$id2){
		$invoice = DB::select('select t_bank_datas.*, t_bank_datas.account_no, t_bank_datas.account_name, m_banks.bank_name from t_bank_datas inner join m_banks on t_bank_datas.code_bank = m_banks.code_bank
					where code_vendor = "'.$id.'" and part_bank = "'.$id2.'"');
		return $invoice;

	}

	public function Upload(){
		$file = \Input::file('file');
		$table = \Input::get('table');
		$array_data=CsvHelper::csv_to_array($file);
		//return $array_data;
		$result=Invoice::array_to_db($array_data);
			
		// Insert To DB
		if($result==1){
			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Sukses, data berhasil diimport ke database');
		}else{
			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','Error, tidak ada data yang disimpan');
		}
		return redirect('master/upload');
	}

	function csvToArray($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if (!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }
	        fclose($handle);
	    }
	    return $data;
	}
	
	//dev-3.0 by yudo, import vendor
	public function import_vendor(){
		try{
			$file 		= \Input::file('file');
			$table 		= \Input::get('table');
		
            Excel::load(\Input::file('file'), function ($reader) {

                foreach ($reader->toArray() as $row) {
                	m_vendor::firstOrCreate($row);                   
                }
            });

			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Sukses, data berhasil diimport ke database');
			
			return redirect('master/upload');
		}
		catch (Exception $e){
			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','Error, tidak ada data yang disimpan');
			return redirect('master/upload');
		}
	}

	//dev-3.0 by yudo, import master bank 
	public function import_bank(){
		try{
			$file = \Input::file('file_bank');
			$table = \Input::get('table');
			// $array_data=CsvHelper::csv_to_array($file);
			// $result=m_bank::array_to_db($array_data);
			Excel::load(\Input::file('file_bank'), function ($reader) {

	                foreach ($reader->toArray() as $row) {
	                	m_bank::firstOrCreate($row);	                     
                }
            });
			
			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Sukses, data berhasil diimport ke database');
			return redirect('master/upload');
		}
		catch(Exception $e){

			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','Error, tidak ada data yang disimpan');
			return redirect('master/upload');
		}
		
	}

	//dev-3.0 by yudo, import vendor_bank
	public function vendor_bank(){
		try{
			$file = \Input::file('file_vendor_bank');
			$table = \Input::get('table');
			// $array_data=CsvHelper::csv_to_array($file);
			// $result=m_bank::array_to_db($array_data);
			Excel::load(\Input::file('file_vendor_bank'), function ($reader) {

	                foreach ($reader->toArray() as $row) {
	                	t_bank_data::firstOrCreate($row);	                     
	                }
	            });
				
			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Sukses, data berhasil diimport ke database');
			return redirect('master/upload');
			}
		catch(Exception $e){

			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','Error, tidak ada data yang disimpan');
			return redirect('master/upload');
		}
		
	}



	public function invoice_user_reject_list()
	{
		$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
		$queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','6')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_reject_list', compact('invoice','result','result2','result3','result4'));
	}

	public function invoice_user_check()
	{
		$user =\Auth::user();
		$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        $result = new Collection($queries);
        $queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        $result2 = new Collection($queries2);
		$queries3 = DB::select('select count(id) as c from invoice where 
			status="2" and dept_code='.$user->dept_code.'');
        $result3 = new Collection($queries3);
        $queries4 = DB::select('select count(id) as d from invoice where 
			status="9" and dept_code='.$user->dept_code.'');
        $result4 = new Collection($queries4);
		$invoice = Invoice::where('status','2')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_check', compact('invoice','result','result2','result3','result4'));
	}

	public function user_view()
	{
		$user = User::all();
		return view('user.view', compact('user'));
	}

	public function save_create()
	{
		$input 				= \Input::all();
		$user 				= new User;
		$user->password 	= bcrypt($input['password']);
    	$user->email 		= $input['email'];
    	$user->name 		= $input['name'];
    	$user->role 		= $input['role'];
    	$user->dept_code 	= $input['dept_code'];
    	$user->save();
    	\Session::flash('flash_type','alert-success');
    	\Session::flash('flash_message','Sukses, user baru berhasil ditambahkan ke database');
    	return redirect('user/view');
	}

	public function user_delete($id)
    {
        User::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data user berhasil dihapus dari database');
        return redirect('user/view');
    }

    public function invoice_delete($id)
    {
        Invoice::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data berhasil dihapus');
        return redirect('/invoice/op');
    }
    
    public function user_reset($id)
    {
        $password 		= bcrypt('aiia');
        $user 			= User::findOrFail($id);
        $user->password = $password;
        $user->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, password user berhasil diubah menjadi aiia');
        return redirect('user/view');
    }

    public function user_edit($id)
    {
        $user 		= User::where('id',$id)->get();
        $user_all 	= User::all();
		return view('user.edit', compact('user','user_all'));
    }

    public function save_edit()
	{
		$input 				= \Input::all();
		$id 				= $input['id'];
		$user 				= User::findOrFail($id);
		$user->email 		= $input['email'];
        $user->name 		= $input['name'];
        $user->role 		= $input['role'];
        $user->dept_code 	= $input['dept_code'];
        $user->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data user berhasil diubah');
        return redirect('user/view');
	}

	public function edit_password()
	{
		return view('user.edit_password');
	}

	public function save_edit_password()
	{
	
            $input 	= \Input::all();
            $pwd1 	= $input['password1'];
            $pwd2 	= $input['password2'];
            $pwd3 	= $input['password3'];
            $pwd4 	= bcrypt($pwd1);
            $pwd5 	= bcrypt($pwd2);
            $pwd6 	= bcrypt($pwd3);
            $user 	= \Auth::user();
          	if ($pwd1 == NULL or $pwd2 == NULL or $pwd3 == NULL){
          		\Session::flash('flash_type','alert-danger');
        		\Session::flash('flash_message','Error, terdapat kolom yang belum terisi, silakan ulangi proses');
          		return redirect('/');
          	} else {
            	if (\Hash::check($pwd1, $user->password)){
            		if ($pwd2 == $pwd3) {
        				$user->password = $pwd6;
        				$user->save();
        				\Session::flash('flash_type','alert-success');
 				        \Session::flash('flash_message','Sukses, password berhasil diubah');
        				return redirect('/') ;
		            } else {
        		    	\Session::flash('flash_type','alert-danger');
        				\Session::flash('flash_message','Error, password administrasi yang anda masukkan salah, silakan ulangi proses');
          		       	return redirect('/');
            		}
            	} else {
            		\Session::flash('flash_type','alert-danger');
        			\Session::flash('flash_message','Error, kombinasi password anda salah');
          		    return redirect('/');
            	}
        	}
	}

	public function invoice_update($id)
	{
		// $invoice = Invoice::where('id',$id)->get();
		//dev-3.0 by yudo, invoice update 
		$invoice = DB::select('select invoice.*, t_bank_datas.*, m_banks.*, m_vendors.* from invoice 
			inner join t_bank_datas on invoice.code_bank_data = t_bank_datas.id 
			inner join m_banks on t_bank_datas.code_bank = m_banks.code_bank 
			inner join m_vendors on t_bank_datas.code_vendor = m_vendors.code_vendor
			where invoice.id = "'.$id.'"');

		// $vendor  = m_vendor::lists('code_vendor','vendor_name');
		$vendor = DB::select('select * from m_vendors group by vendor_name');
		$vendor_selected = DB::select('select m_vendors.code_vendor, m_vendors.vendor_name from m_vendors inner join t_bank_datas
			on m_vendors.code_vendor = t_bank_datas.code_vendor 
			inner join invoice on invoice.code_bank_data = t_bank_datas.id where invoice.id = "'.$id.'"');
		// $vendor_selected = $vendor->vendor_name->lists('id');
		foreach ($vendor_selected as $vendor_selected) {
			$selected = $vendor_selected->code_vendor;
			$selected2 = $vendor_selected->vendor_name;
		}
		return view('invoice.invoice_update', compact('invoice','vendor','selected','selected2','id'));
	}

	//dev-3.0 by yudo , update invoice
	public function invoice_update_save()
	{

		$input 		= \Input::all();

		date_default_timezone_set('Asia/Jakarta');
		$date 		= date('Y-m-d H:i:s');
		$input 		= \Input::all();
		$account_no = $input['account_no2'];
		$code_vendor = $input['code_vendor']; //hotfix-3.0.5 by yudo, 20170502, menambahkan variable code vendor
		$part_bank   = $input['part_bank']; //hotfix-3.0.5 by yudo, 20170502, menambahkan variabel partbank
		$queries 	= DB::select('SELECT id FROM t_bank_datas WHERE account_no = "'.$account_no.'" AND code_vendor = "'.$code_vendor.'" AND part_bank = "'.$part_bank.'"');
		foreach ($queries as $queries) {
			$code_bank_data = $queries->id;
		}

		$id 						= $input['id'];
		$invoice 					= Invoice::findOrFail($id);
		$invoice->no_penerimaan 	= $input['no_penerimaan'];
		$invoice->dept_code 		= $input['dept_code'];
		$invoice->vendor 			= $input['vendor_name'];
		$invoice->tgl_terima 		= $input['tgl_terima'];
		$invoice->doc_no 			= $input['doc_no'];
		$invoice->description		= $input['description'];
		$invoice->doc_date 			= $input['doc_date'];
		$invoice->due_date 			= $input['due_date'];
		$invoice->curr 				= $input['curr'];
		$invoice->amount 			= $input['amount'];
		// $invoice->doc_no_2 			= $input['doc_no_2'];
		$invoice->tgl_input 		= $date;
		$invoice->status 			= "1";
		$invoice->no_po 			= $input['no_po'];
		$invoice->code_bank_data	= $code_bank_data;

        $invoice->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data berhasil diubah');
        return redirect('invoice/op');
	}

	public function invoice_saving()
	{

		$input 		= \Input::all();

		date_default_timezone_set('Asia/Jakarta');
		$date 		= date('Y-m-d H:i:s');
		$input 		= \Input::all();
		$account_no = $input['account_no2'];
		$code_vendor = $input['code_vendor'];
		$part_bank   = $input['part_bank'];
		$queries 	= DB::select('SELECT id FROM t_bank_datas WHERE account_no = "'.$account_no.'" AND code_vendor = "'.$code_vendor.'" AND part_bank = "'.$part_bank.'"');
		foreach ($queries as $queries) {
			$code_bank_data = $queries->id;
		}
		$string = str_replace(',', '', $input['amount']);

		$invoice 					= new Invoice;
		$invoice->no_penerimaan 	= $input['no_penerimaan'];
		$invoice->dept_code 		= $input['dept_code'];
		$invoice->vendor 			= $input['vendor_name'];
		$invoice->tgl_terima 		= $input['tgl_terima'];
		$invoice->doc_no 			= $input['doc_no'];
		$invoice->description		= $input['description'];
		$invoice->doc_date 			= $input['doc_date'];
		$invoice->due_date 			= $input['due_date'];
		$invoice->curr 				= $input['curr'];
		$invoice->amount 			= $string;
		// $invoice->doc_no_2 			= $input['doc_no_2'];
		$invoice->tgl_input 		= $date;
		$invoice->tgl_approve_user 	= $date;
		
		if ($input['dept_code'] == '1') {
			$invoice->status 			= "1";
		}else{
			$invoice->status 			= "1";
		}

		$invoice->no_po 			= $input['no_po'];
		$invoice->code_bank_data	= $code_bank_data;
        $invoice->save();

        $input 		= \Input::all();
        date_default_timezone_set('Asia/Jakarta');
		$date 		= date('Y-m-d H:i:s');

		//dev-3.7.0, 20180201, by Farul Sudarusman, Input beberapa data ke table history invoice sebagai acuan history 
        $history 					= new history_invoice;
        $history->no_penerimaan		= $input['no_penerimaan'];
        $history->dept_code 		= $input['dept_code'];

        if ($input['dept_code'] == '1') {
			$history->status 		= "9";
			$history->name_status   = "Waiting Purch Received";
		}else{
			$history->status 	    = "1";
			$history->name_status 	= "Waiting Approval by User";
		}

		$history->tanggal		    = $date;
		$history->save();

        $latestId 	= DB::select('select MAX(id) as id from invoice');
       
		foreach ($latestId as $latestId) {
			$lastId = $latestId->id;
		}
		
        $this->invoice_print($lastId);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data berhasil disimpan');
        return redirect('invoice/op');
	}

	public function invoice_approval_detail($id,$no_penerimaan)
	{
		$invoice         = Invoice::where('id',$id)->get();
		$history 		 = history_invoice::select('name_status','tanggal')->where('no_penerimaan',$no_penerimaan)->orderby('tanggal','ASC')->get();
		return view('invoice.invoice_approval_detail', compact('invoice','history'));
	}

	public function data() {
		$test = Invoice::select(['no_penerimaan','dept_code','vendor','tgl_terima','doc_no','doc_date','due_date','curr','amount',
			'doc_no_2','no_po','tgl_ready_to_pay'])->where('status','8');
		return Datatables::of($test)->make();
	}

	public function data_user() {
		$user = \Auth::user();
		$test = Invoice::select(['no_penerimaan','vendor','tgl_terima','doc_no','doc_date','due_date','curr','amount',
			'doc_no_2','no_po','tgl_ready_to_pay'])->where('status','8')->where('dept_code',$user->dept_code);
		return Datatables::of($test)->make();
	}

}
