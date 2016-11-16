<?php namespace App\Http\Controllers;
use App\Invoice;
use App\CsvHelper;
use App\User;
use App\m_area;
use App\m_part;
use App\t_transaction;
use App\Stock;
use DB;
use Illuminate\Support\Collection; 
use Illuminate\Http\Request;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
			$invoice 	= Invoice::where('status','1')
									->where('dept_code',$user->dept_code)
									->get();
			return view('invoice.user_list', compact('invoice','result','result2','result3'));
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
			return view('invoice.act_list', compact('invoice','result','result2','result3'));
		} else if ($user->role == "3"){
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
		 	$m_area=m_area::all();
		 	$t_transaction=t_transaction::all();
		 	return view('stock.view_transaction',compact('t_transaction','m_area'));

		}else if ($user->role == "6"){
	        $user=\Auth::user();	
		 	$m_area=m_area::where('pic_name','=',$user->name)->get();
		 	$t_transaction=t_transaction::all();
		 	return view('stock.view_transaction',compact('t_transaction','m_area'));
	 	}else if($user->role == "7"){
	        $user=\Auth::user();
	        if ($user->role == '7') {	
		 	$m_area=m_area::where('pic_name','=',$user->name)->get();
		 	} else {
		 	$m_area=m_area::all();
		 	}
		 	if ($user->role == '7') {
		 	$t_transaction 	= t_transaction::join('m_areas','m_areas.id_area','=','t_transactions.id_area')
		 									->where('m_areas.pic_name',''.$user->name.'')->get();
		 	} else {
		 	$t_transaction 	= t_transaction::all();
		 	}
		 	return view('stock.view_transaction',compact('t_transaction','m_area'));
	 	}
			return redirect('auth/logout') ;
		}
	

	public function invoice_add()
	{
		return view('invoice.add');
	}

	public function invoice_saving()
	{		
		date_default_timezone_set('Asia/Jakarta');
		$date 		= date('Y-m-d H:i:s');
		$input 		= \Input::all();
		$account_no = $input['account_no2'];
		$queries 	= DB::select('select id from t_bank_datas where account_no = "'.$account_no.'" ');
		foreach ($queries as $queries) {
			$code_bank_data = $queries->id;
		}
		// return $account_no;
		$invoice 					= new Invoice;
		$invoice->no_penerimaan 	= $input['no_penerimaan'];
		$invoice->dept_code 		= $input['dept_code'];
		$invoice->vendor 			= $input['code_vendor'];
		$invoice->tgl_terima 		= $input['tgl_terima'];
		$invoice->doc_no 			= $input['doc_no'];
		$invoice->doc_date 			= $input['doc_date'];
		$invoice->due_date 			= $input['due_date'];
		$invoice->curr 				= $input['curr'];
		$invoice->amount 			= $input['amount'];
		$invoice->doc_no_2 			= $input['doc_no_2'];
		$invoice->tgl_input 		= $date;
		$invoice->status 			= "1";
		$invoice->no_po 			= $input['no_po'];
		$invoice->code_bank_data	= $code_bank_data;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data invoice berhasil ditambahkan ke database');
		return redirect('master/upload');

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
		$invoice = Invoice::where('status','1')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_list', compact('invoice','result','result2','result3'));
	}

	public function invoice_checked_user($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->user=$user->id;
		$invoice->status="2";
		$invoice->tgl_terima_user=$date;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('invoice/user/list');
	}

	public function invoice_pending_user($id)
	{
		$user 		= \Auth::user();
		$invoice 	= Invoice::where('id',$id)
								->where('dept_code',$user->dept_code)
								->where('status','1')->get();
		return view('invoice.user_pending_view', compact('invoice'));
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
		$invoice->status 			= "5";
		$invoice->user 				= $user->id;
		$invoice->tgl_pending_user 	= $date;
		$invoice->remark 			= $input['remark'];
		$invoice->save();
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
		$invoice->status="6";
		$invoice->act=$user->id;
		$invoice->tgl_pending_act=$date;
		$invoice->remark_act=$input['remark'];
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di reject');
		return redirect('home');
	}

	public function invoice_pending_list()
	{
		$invoice = Invoice::where('status','5')->get();
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
		$user =\Auth::user();
		if ($user->role == '4' || $user->role == '3' || $user->role == '2') {
			$invoice = Invoice::where('status','8')->orderby('id','DESC')->get();
			return view('invoice.rtp_list', compact('invoice'));
		} else {
			return redirect('invoice/rtp/user');
		}
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
		$user =\Auth::user();
		$invoice = Invoice::where('status','8')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.rtp_list', compact('invoice'));
	}

	public function invoice_print($id)
	{
		$invoice = DB::select('select invoice.*, t_bank_datas.*, m_banks.* from invoice inner join t_bank_datas on invoice.code_bank_data = t_bank_datas.id 
			inner join m_banks on t_bank_datas.code_bank = m_banks.code_bank where invoice.id = "'.$id.'"');
		
		\Excel::load('/storage/template/tandaterima.xlsx', function($file) use($invoice){

		foreach ($invoice as $invoice) {
			
			$no_penerimaan = $invoice->no_penerimaan;
			$vendor_name   = $invoice->vendor_name;
			$invoice 	   = $invoice->no_po;
			// $tanggal 	   = $invoice->doc_date;
			// $keterangan    = $invoice->
			// $amount        = $invoice->curr;
			// $ampunt        = $invoice->amount;
			// $bank_name     = $invoice->bank_name;
			// $account_no    = $invoice->account_no;
			// $account_name  = $invoice->account_name;
			// $jatuh_tempo   = $invoice->due_date;
			// $tgl           = date("dd-MM-yyyy");
			

		}
		$file->setActiveSheetIndex(0)->setCellValue('J7', $no_penerimaan);

		// return $no_penerimaan;
		})->download('pdf');
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
		$invoice->status="1";
		$invoice->user=$user->name;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, invoice telah berhasil di check');
		return redirect('invoice/pending/list');
	}

	public function upload_master(){
		$date = date('y');
		$nomor = '';
		$invoice = DB::select('select max(no_penerimaan) as nomor from invoice');
		$bank_datas = DB::select('select * from t_bank_datas group by vendor_name');
		$part_bank = DB::select('select part_bank from t_bank_datas group by part_bank');
		foreach ($invoice as $invoice) {
			$nomor = $invoice->nomor;
		}
		$getNomor = substr($nomor, 0,2);
		if ($nomor == '' || $nomor == null){
			$nomor = $date+'00000001';
		}
		else {
			if($getNomor == $date){
				$nomor = $nomor+1;
			}
			else
			{
				$nomor = $date+'00000001';
			}

		}
		// return $nomor;
		return view('invoice.upload', compact('nomor','bank_datas','part_bank'));
	}

	public function part_bank($id){
		$invoice = DB::select('select part_bank from t_bank_datas where code_vendor = "'.$id.'"');
		return $invoice;

	}

	public function account($id,$id2){
		$invoice = DB::select('select t_bank_datas.code_bank, t_bank_datas.account_no, t_bank_datas.account_name, m_banks.bank_name from t_bank_datas inner join m_banks on t_bank_datas.code_bank = m_banks.code_bank
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
		$invoice = Invoice::where('status','6')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_reject_list', compact('invoice','result','result2','result3'));
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
		$invoice = Invoice::where('status','2')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_check', compact('invoice','result','result2','result3'));
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
		$invoice = Invoice::where('id',$id)->get();
		return view('invoice.invoice_update', compact('invoice'));
	}

	public function invoice_update_save()
	{
		$input 		= \Input::all();
		$id 		= $input['id'];
		$invoice 					= Invoice::findOrFail($id);
		$invoice->no_penerimaan 	= $input['no_penerimaan'];
		$invoice->dept_code 		= $input['dept_code'];
		$invoice->vendor 			= $input['vendor'];
		$invoice->tgl_terima 		= $input['tgl_terima'];
		$invoice->doc_no 			= $input['doc_no'];
		$invoice->doc_date 			= $input['doc_date'];
		$invoice->due_date 			= $input['due_date'];
		$invoice->curr 				= $input['curr'];
		$invoice->amount 			= $input['amount'];
		$invoice->doc_no_2 			= $input['doc_no_2'];
		$invoice->no_po 			= $input['no_po'];
        $invoice->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data berhasil diubah');
        return redirect('invoice/op');
	}
	public function invoice_approval_detail($id)
	{
		$invoice = Invoice::where('id',$id)->get();
		return view('invoice.invoice_approval_detail', compact('invoice'));
	}

}
