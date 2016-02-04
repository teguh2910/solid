<?php namespace App\Http\Controllers;
use App\Invoice;
use App\CsvHelper;
use App\User;
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
			$user =\Auth::user();
			$queries = DB::select('select count(id) as a from invoice where 
			status="1" and dept_code='.$user->dept_code.'');
        	$result = new Collection($queries);
        	$queries2 = DB::select('select count(id) as b from invoice where 
			status="6" and dept_code='.$user->dept_code.'');
        	$result2 = new Collection($queries2);
			$invoice = Invoice::where('status','1')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_list', compact('invoice','result','result2'));
		} else if ($user->role == "2") {
			$invoice = Invoice::where ( function ($q) {
                $q->where('status','2')
                    ->orWhere('status','7');
                })->get();
			return view('invoice.act_list', compact('invoice'));
		} else if ($user->role == "3"){
			$invoice = Invoice::where('status','3')->get();
			$queries = DB::select('select count(id) as a from invoice where status="3"');
        	$result = new Collection($queries);
        	$queries2 = DB::select('select count(id) as b from invoice where status="4"');
        	$result2 = new Collection($queries2);
		return view('invoice.fa_list', compact('invoice','result','result2'));
		} else if ($user->role == "4"){
			$invoice = Invoice::where('status','!=','8')->get();
			return view('invoice.op_list', compact('invoice'));
		} else {
			return redirect('auth/logout') ;
		}
	}

	public function invoice_add()
	{
		return view('invoice.add');
	}

	public function invoice_saving()
	{		
		$input = \Input::all();
		$invoice = new Invoice;
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice->no_penerimaan=$input['no_penerimaan'];
		$invoice->dept_code=$input['dept_code'];
		$invoice->vendor=$input['vendor'];
		$invoice->tgl_terima=$input['tgl_terima'];
		$invoice->doc_no=$input['doc_no'];
		$invoice->doc_date=$input['doc_date'];
		$invoice->due_date=$input['due_date'];
		$invoice->curr=$input['curr'];
		$invoice->amount=$input['amount'];
		$invoice->doc_no_2=$input['doc_no_2'];
		$invoice->tgl_input=$date;
		$invoice->status="1";
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Invoice was successfully created');
		return redirect('/invoice/op');

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
		$invoice = Invoice::where('status','1')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_list', compact('invoice','result','result2'));
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
        \Session::flash('flash_message','Invoice was successfully checked');
		return redirect('invoice/user/list');
	}

	public function invoice_pending_user($id)
	{
		$user =\Auth::user();
		$invoice = Invoice::where('id',$id)
						->where('dept_code',$user->dept_code)
						->where('status','1')->get();
		return view('invoice.user_pending_view', compact('invoice'));
	}

	public function invoice_reject_user($id)
	{
		$user =\Auth::user();
		$invoice = Invoice::where('id',$id)
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
        \Session::flash('flash_message','Invoice was successfully reject');
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
		$input = \Input::all();
		$id=$input['id'];
		$invoice = Invoice::findOrFail($id);
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice->status="5";
		$invoice->user=$user->id;
		$invoice->tgl_pending_user=$date;
		$invoice->remark=$input['remark'];
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Invoice was successfully reject');
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
        \Session::flash('flash_message','Invoice was successfully reject');
		return redirect('home');
	}

	public function invoice_pending_list()
	{
		$invoice = Invoice::where('status','5')->get();
		return view('invoice.pending_list', compact('invoice'));
	}

	public function invoice_act_list()
	{
		$invoice = Invoice::where ( function ($q) {
                $q->where('status','2')
                    ->orWhere('status','7');
                })
				->get();
		return view('invoice.act_list', compact('invoice'));
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
        \Session::flash('flash_message','Invoice was successfully approve');
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
        \Session::flash('flash_message','Invoice was successfully checked');
		return redirect('/invoice/fa/list');
	}

	public function invoice_finish_fa($id)
	{
		$user =\Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$invoice = Invoice::findOrFail($id);
		$invoice->finance=$user->id;
		$invoice->status="8";
		$invoice->tgl_terima_finance=$date;
		$invoice->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Invoice was successfully finish');
		return redirect('/invoice/fa/finish/list');
	}

	public function invoice_rtp_list()
	{
		$invoice = Invoice::where('status','8')->get();
		return view('invoice.rtp_list', compact('invoice'));
	}

	public function invoice_op_list()
	{
		$invoice = Invoice::where('status','!=','8')->get();
		return view('invoice.op_list', compact('invoice'));
	}

	public function invoice_rtp_user()
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','8')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.rtp_list', compact('invoice'));
	}

	public function invoice_op_user()
	{
		$user =\Auth::user();
		$invoice = Invoice::where('status','!=','8')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.op_list', compact('invoice'));
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
        \Session::flash('flash_message','Invoice was successfully checked');
		return redirect('invoice/pending/list');
	}

	public function upload_master(){
		return view('invoice.upload');
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
				\Session::flash('flash_message','Successfully Saved');
			}else{
				\Session::flash('flash_type','alert-danger');
				\Session::flash('flash_message','No data update');
			}
		return redirect('/master/upload');
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
		
		$invoice = Invoice::where('status','6')
							->where('dept_code',$user->dept_code)
							->get();
		return view('invoice.user_reject_list', compact('invoice','result','result2'));
	}

	public function user_view()
	{
		$user = User::all();
		return view('user.view', compact('user'));
	}

	public function save_create()
	{
		$input = \Input::all();
		$user = new User;
		$pwd1 = $input['password'];
		$pwd2 = $input['password1'];
		if ($pwd1 == $pwd2) {
        	$name = $input['name'];
        	$user->password = bcrypt($input['password']);
        	$user->email = $input['email'];
        	$user->name = $input['name'];
        	$user->role = $input['role'];
        	$user->dept_code = $input['dept_code'];
        	$user->save();
        	\Session::flash('flash_type','alert-success');
        	\Session::flash('flash_message','User was successfully created');
        	return redirect('user/view');
		} else {
			\Session::flash('flash_type','alert-danger');
	        \Session::flash('flash_message','Combination password is wrong, please repeat the process');
			return redirect('user/crate');
		}
		
	}

	public function user_delete($id)
    {
        User::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','User was successfully deleted');
        return redirect('user/view');
    }

    public function invoice_delete($id)
    {
        Invoice::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Invoice was successfully deleted');
        return redirect('/invoice/op');
    }
    
    public function user_reset($id)
    {
        $password = bcrypt('aiia');
        $user = User::findOrFail($id);
        $user->password = $password;
        $user->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','User password was successfully reset to "aiia"');
        return redirect('user/view');
    }

    public function user_edit($id)
    {
        $user = User::where('id',$id)
        			->get();
        $user_all = User::all();
		return view('user.edit', compact('user','user_all'));
    }

    public function save_edit()
	{
		$input = \Input::all();
		$id = $input['id'];
		$user = User::findOrFail($id);
		$user->email = $input['email'];
        $user->name = $input['name'];
        $user->role = $input['role'];
        $user->dept_code = $input['dept_code'];
        $user->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','User was successfully updated');
        return redirect('user/view');
	}

	public function edit_password()
	{
		return view('user.edit_password');
	}

	public function save_edit_password()
	{
	
            $input = \Input::all();
            $pwd1=$input['password1'];
            $pwd2=$input['password2'];
            $pwd3=$input['password3'];
            $pwd4=bcrypt($pwd1);
            $pwd5=bcrypt($pwd2);
            $pwd6=bcrypt($pwd3);
            $user =\Auth::user();
          	if ($pwd1 == NULL or $pwd2 == NULL or $pwd3 == NULL){
          		\Session::flash('flash_type','alert-danger');
        		\Session::flash('flash_message','Error, there columns that you have not fill');
          		return redirect('edit_password');
          	} else {
            	if (\Hash::check($pwd1, $user->password)){
            		if ($pwd2 == $pwd3) {
        				$user->password=$pwd6;
        				$user->save();
        				\Session::flash('flash_type','alert-success');
 				       \Session::flash('flash_message','Password was successfully updated');
        				return redirect('/') ;
		            } else {
        		    	\Session::flash('flash_type','alert-danger');
        				\Session::flash('flash_message','Error, your administrator password incorrect');
          		       	return redirect('edit_password');
            		}
            	} else {
            		\Session::flash('flash_type','alert-danger');
        			\Session::flash('flash_message','Error, your new password combination do not match');
          		    return redirect('edit_password');
            	}
        	}
	}

}
