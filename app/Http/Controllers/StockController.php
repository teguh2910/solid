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

	 public function m_area_import()
	{
		$file  = \Input::file('file');
		$table = \Input::get('table');
		$array_data = CsvHelper::csv_to_array($file);
		$result     = m_area::array_to_db($array_data);
		if ($result == 1) {
			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Successfully Saved');
		} else {
			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','No data update');
		}
		return redirect('stock/view_area');
	}

	 public function save_area()
	 {
	 	$input = \Input::all();
	 	$code_area=$input['code_area'];
	 	$name_area=$input['name_area'];
	 	$type_plant=$input['type_plant'];
        $a=$input['code_area'];
       	$b=$input['name_area'];
       	$c=$input['type_plant'];
		$m_area     = new m_area;
	 	$number_unik="$c-$a-$b" ;
		$m_area->type_plant     =$input['type_plant'];
		$m_area->code_area      =$input['code_area'];
		$m_area->name_area      =$input['name_area'];
		$m_area->id_area=$number_unik;
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
		
		$type_plant=$input['type_plant'];
		$code_area=$input['code_area'];
		$name_area=$input['name_area'];
		$pic_name=$input['pic_name'];
		$pic_contact=$input['pic_contact'];
		$a=$input['code_area'];
       	$b=$input['name_area'];
       	$c=$input['type_plant'];
		$m_area = M_area::findOrFail($id);
		$number_unik="$c-$a-$b" ;
		$m_area->id_area    = $number_unik;
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
	 	$m_area=m_area::all();
	 	$m_part=m_part::select('*','m_parts.id as id_m_parts')
	 	->join('m_areas','m_areas.id_area','=','m_parts.id_area')->get();
	 	return view('stock.view_part',compact('m_part','m_area'));
	 }


	  public function m_part_import()
	{
		$file  = \Input::file('file');
		$table = \Input::get('table');
		$array_data = CsvHelper::csv_to_array($file);
		$result     = m_part::array_to_db($array_data);
		if ($result == 1) {
			\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Successfully Saved');
		} else {
			\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message','No data update');
		}
		return redirect('stock/view_part');
	}

	  public function save_part()
	 {
	 	$input = \Input::all();
		$m_part     = new m_part;
		$m_part->id_area        =$input['id_area'];
		$m_part->back_number    =$input['back_number'];
		$m_part->part_number    =$input['part_number'];
		$m_part->part_name      =$input['part_name'];
		$m_part->qty_box        =$input['qty_box'];
		$m_part->unit           =$input['unit'];
		$m_part->save();
		
		$t_transaction= new t_transaction;
		$t_transaction->id_area =$input['id_area'];
		$t_transaction->part_number=$input['part_number'];
        $t_transaction->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','New part was successfully created');
	 	return redirect('stock/view_part');
	 }

	 public function edit_part($id)
	 {    
	 	 $m_area=m_area::all();
	 	 $m_part=m_part::where('id',$id)->get();
         return view('stock.edit_part',compact('m_part','m_area'));

	 }

	 public function save_edit_part()
	{
		$input = \Input::all();
		$id=$input['id'];
		$m_part = m_part::findOrFail($id);
		$t_transaction1 = t_transaction::where('part_number',$m_part->part_number)->get();
        foreach ($t_transaction1 as $t_transaction1) {
               $id2=$t_transaction1->id;
        }
		$m_part->back_number   = $input['back_number'];
		$m_part->part_number   = $input['part_number'];
		$m_part->part_name     = $input['part_name'];
		$m_part->qty_box       = $input['qty_box'];
		$m_part->unit          = $input['unit'];
		$m_part->id_area       = $input['id_area'];
		$m_part->save();
        $t_transaction=t_transaction::findOrFail($id2);
        $t_transaction->id_area     = $input['id_area'];
        $t_transaction->part_number = $input['part_number'];
        $t_transaction->save();
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
	 	$m_area=m_area::all();
	 	$m_area2=m_area::all();
	 	$t_transaction=t_transaction::join('m_parts','m_parts.part_number','=','t_transactions.part_number')
	 	                            ->get();
	 	return view('stock.view_transaction',compact('t_transaction','m_part','m_area','m_area2'));
	 }


	  public function view_list()
	 {  
	 	$input = \Input::all();
	 	$id_area=$input['id_area'];
	 	$t_transaction=t_transaction::select('*','t_transactions.id as id_t_transactions')
	 	                            ->join('m_parts','m_parts.part_number','=','t_transactions.part_number')
	 	                            ->where('t_transactions.id_area',$id_area)                            
	 	                            ->get();
	 	return view('stock.view_list',compact('t_transaction'));
	 
	 }

	 public function input_transaction($id)
	 {    
          $m_part=m_part::all();
	 	  $t_transaction=t_transaction::where('id',$id)->get(); 	               
     	  return view('stock.input_transaction',compact('t_transaction','m_part'));
	
	 }

	 public function save_transaction()
	 {
        $input = \Input::all();
        $id=$input['id'];
        $part_number=$input['part_number'];
        $a=$input['amount_box'];
       	$b=$input['amount_pcs'];
       	// $box_temporary  =$input['amount_box'];
        // $pcs_temporary  =$input['amount_pcs'];
        // $total_temporary=['total_pcs'];
        $m_part=m_part::where('part_number',$part_number)->get();
        foreach ($m_part as $m_part) {
        	$qty_box = $m_part->qty_box;
        }
        // $t_transaction1=t_transaction::where('part_number',$part_number)->get();
        // foreach ($t_transaction1 as $t_transaction) {
        // 	$box_temporary   = $t_transaction1->box_temporary;
        // 	$pcs_temporary   = $t_transaction1->pcs_temporary;
        // 	$total_temporary = $t_transaction1->total_temporary ; 
        // }

        $t_transaction     = t_transaction::findOrFail($id) ;
       	$total1=$a*$qty_box;
       	$total_pcs=$total1+$b;

		$t_transaction->part_number   =$input['part_number'];
		$t_transaction->amount_box    =$input['amount_box'];
		$t_transaction->amount_pcs    =$input['amount_pcs'];
		$t_transaction->total_pcs    =$total_pcs;
		$t_transaction->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Amount was successfully added');
	 	return redirect('stock/view_transaction');  

	 }

	 public function print_report()
	 {    
        $input=\Input::all();
        $t_transaction=t_transaction::all();
	    return view('stock/print_report',compact('t_transaction'));
	 }

	  public function print_result()
	 {    
	 	$input=\Input::all();
	 	$id_area=$input['id_area'];
        $array=t_transaction::select('*','t_transactions.id as id_t_transactions')
	 	                            ->join('m_parts','m_parts.part_number','=','t_transactions.part_number')
	 	                            ->where('t_transactions.id_area',$id_area)                            
	 	                            ->get();
        $array2=t_transaction::select('*','t_transactions.id as id_t_transactions')
	 	                            ->join('m_parts','m_parts.part_number','=','t_transactions.part_number')
	 	                            ->where('t_transactions.id_area',$id_area)
	 	                            ->groupBy('t_transactions.id_area')                            
	 	                            ->get();
	 	$array3=m_area::where('id_area',$id_area)->get();
	 	foreach ($array3 as $m_area) {
	 		$code_area=$m_area->code_area;
	 	    $name_area=$m_area->name_area;
	 	}

      \Excel::load('/storage/template/report stock opname.xlsx', function($file) use($array,$array2,$array3){
            
		foreach ($array3 as $array3 ) {
				$name_area=$array3->name_area ;
				$code_area=$array3->code_area ;

			$file->setActiveSheetIndex(0)->setCellValue('B4', $name_area);
	        $file->setActiveSheetIndex(0)->setCellValue('J2', $code_area);
			}
 
            $a="6";
        foreach ($array as $array2) {
				$back_number=$array2->back_number;
				$part_number=$array2->part_number;
				$part_name  =$array2->part_name;
				$qty_box    =$array2->qty_box;
				$unit       =$array2->unit;
				$amount_box =$array2->amount_box;
				$amount_pcs =$array2->amount_pcs;
				$total_pcs  =$array2->total_pcs;
				$a++;

			$file->setActiveSheetIndex(0)->setCellValue('C'.$a.'', $back_number);
			$file->setActiveSheetIndex(0)->setCellValue('D'.$a.'', $part_number);
			$file->setActiveSheetIndex(0)->setCellValue('E'.$a.'', $part_name);
			$file->setActiveSheetIndex(0)->setCellValue('F'.$a.'', $qty_box);
			$file->setActiveSheetIndex(0)->setCellValue('G'.$a.'', $unit);
			$file->setActiveSheetIndex(0)->setCellValue('H'.$a.'', $amount_box);
			$file->setActiveSheetIndex(0)->setCellValue('I'.$a.'', $amount_pcs);
			$file->setActiveSheetIndex(0)->setCellValue('J'.$a.'', $total_pcs);
			}

	 })->export('xlsx');

  }




}