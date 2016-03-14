<?php namespace App\Http\Controllers;
use App\Invoice;
use App\CsvHelper;
use App\User;
use App\m_area;
use App\m_part;
use App\t_transaction;
use DB;
use Illuminate\Support\Collection; 
use Illuminate\Http\Request;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StockController extends Controller {

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

	public function view_area()
	 {
	 	$m_area=m_area::all();
	 	return view('stock.view_area',compact('m_area'));
	 }

	 public function save_area()
	 {
	 	$input = \Input::all();
		$m_area     = new m_area;
		$m_area->id_area        =$input['id_area'];
		$m_area->type_plant     =$input['type_plant'];
		$m_area->code_area      =$input['code_area'];
		$m_area->name_area      =$input['name_area'];
		$m_area->pic_name       =$input['pic_name'];
		$m_area->pic_contact    =$input['pic_contact'];
		$m_area->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Area was successfully created');
	 	return redirect('stock/view_area');
	 }

	 public function edit_area($id)
	 {
	 	 $m_area=m_area::where('id',$id)->get();
         return view('stock.edit_area',compact('m_area'));

	 }

	 public function save_edit_area()
	{
		
		$input = \Input::all();
		$id=$input['id'];
		$id_area=$input['id_area'];
		$type_plant=$input['type_plant'];
		$code_area=$input['code_area'];
		$name_area=$input['name_area'];
		$pic_name=$input['pic_name'];
		$pic_contact=$input['pic_contact'];
		$m_area = M_area::findOrFail($id);
		$m_area->id_area    = $id_area;
		$m_area->type_plant = $type_plant;
		$m_area->code_area  = $code_area;
		$m_area->name_area  = $name_area;
		$m_area->pic_name   = $pic_name;
		$m_area->pic_contact= $pic_contact;
		$m_area->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','area was successfully updated');
		return redirect('stock/view_area');
	}
	public function delete_area($id)
    {
        M_area::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Area was successfully deleted');
        return redirect('stock/view_area');
    }

    public function view_part()
	 {
	 	$m_part=m_part::all();
	 	return view('stock.view_part',compact('m_part'));
	 }

	  public function save_part()
	 {
	 	$input = \Input::all();
		$m_part     = new m_part;
		$m_part->back_number    =$input['back_number'];
		$m_part->part_number    =$input['part_number'];
		$m_part->part_name      =$input['part_name'];
		$m_part->qty_box        =$input['qty_box'];
		$m_part->unit           =$input['unit'];
		$m_part->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Area was successfully created');
	 	return redirect('stock/view_part');
	 }

	 public function edit_part($id)
	 {
	 	 $m_part=m_part::where('id',$id)->get();
         return view('stock.edit_part',compact('m_part'));

	 }

	 public function save_edit_part()
	{
		
		$input = \Input::all();
		$id=$input['id'];
		$back_number=$input['back_number'];
		$part_number=$input['part_number'];
		$part_name=$input['part_name'];
		$qty_box=$input['qty_box'];
		$unit=$input['unit'];
		
		$m_part = M_part::findOrFail($id);
		$m_part->back_number    = $back_number;
		$m_part->part_number = $part_number;
		$m_part->part_name  = $part_name;
		$m_part->qty_box  = $qty_box;
		$m_part->unit   = $unit;

		$m_part->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','part was successfully updated');
		return redirect('stock/view_part');
	}

	public function delete_part($id)
    {
        M_part::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Area was successfully deleted');
        return redirect('stock/view_part');
    }

    public function view_transaction()
	 {

        $m_part=m_part::all();
	 	$t_transaction=t_transaction::all();
	 	$m_area=m_area::all();
	 	$m_area2=m_area::all();
	 	return view('stock.view_transaction',compact('t_transaction','m_part','m_area','m_area2'));
	 }

	 public function input_transaction()
	 { 
	 	 $m_part=m_part::all();
         $t_transaction=t_transaction::all();
	 	 return view('stock.input_transaction',compact('m_part','t_transaction'));
	
	 }


}