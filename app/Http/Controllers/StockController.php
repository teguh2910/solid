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
use Excel;

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
	 	$m_area = m_area::all();
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
	 	 $m_area = m_area::where('id',$id)->get();
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
        \Session::flash('flash_message','Sukses, data area berhasil diubah');
		return redirect('stock/view_area');
	}
	public function delete_area($id)
    {
        M_area::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data area berhasil dihapus');
        return redirect('stock/view_area');
    }

    public function view_part()
	 {
	 	$m_area = m_area::all();
	 	$m_part = m_part::all();
	 	return view('stock.view_part',compact('m_part','m_area'));
	 }

	public function normalize_transaction()
	 {
	 	$t_transactions = t_transaction::all();
	 	foreach ($t_transactions as $t_transactions) {
	 		$id 			= $t_transactions->id;
	 		$qty_box 		= $t_transactions->qty_box;
	 		$amount_box 	= $t_transactions->amount_box;
	 		$amount_pcs 	= $t_transactions->amount_pcs;
	 		$total_pcs      = $qty_box*$amount_box;
	 		$total_pcs2     = $total_pcs+$amount_pcs;
	 		
	 		$m_area = t_transaction::findOrFail($id);
	 		$m_area->total_pcs = $total_pcs2;
	 		$m_area->save(); 
	 	}
	 	\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Transaction was normalize');
        return redirect('stock/view_part');
	 }


	  public function m_part_import()
	{
		 \DB::beginTransaction();
		try
		{
			$file  = \Input::file('file');
			$table = \Input::get('table');
			$array_data = CsvHelper::csv_to_array($file);
			$result     = m_part::array_to_db($array_data);
			$result2    =t_transaction::array_to_db($array_data);
			if ($result == 1 && $result2 == 1) {
				\Session::flash('flash_type','alert-success');
				\Session::flash('flash_message','Successfully Saved');
			} else {
				\Session::flash('flash_type','alert-danger');
				\Session::flash('flash_message','No data update');
			}
		\DB::commit();
		return redirect('stock/view_part');
		}

		catch (\Exception $e)
		{
			\DB::rollback();
			return $e;
		}
		

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
		$t_transaction->type_plant=$input['type_plant'];
		$t_transaction->part_number=$input['part_number'];
		$t_transaction->back_number    =$input['back_number'];
		$t_transaction->part_name    =$input['part_name'];
		$t_transaction->unit         =$input['unit'];
		$t_transaction->qty_box=$input['qty_box'];
        $t_transaction->save();
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','New part was successfully created');
	 	return redirect('stock/view_part');
	 }

	 public function edit_part($id)
	 {    
	 	 $m_area = m_area::all();
	 	 $m_part = m_part::where('id',$id)->get();
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
        \Session::flash('flash_message','Sukses, data part berhasil diubah');
	 	return redirect('stock/view_part');
	}

	public function delete_part($id)
    {
        M_part::destroy($id);
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data part berhasil dihapus');
        return redirect('stock/view_part');
    }

    public function view_transaction()
	 {
	 	$user 			= \Auth::user();	
	 	if ($user->role == '7') {
	 		$m_area 		= m_area::where('pic_name','=',$user->name)->get();
	 	} else {
	 		$m_area 		= m_area::all();	
	 	}
	 	if ($user->role == '7') {
	 		$t_transaction 	= t_transaction::join('m_areas','m_areas.id_area','=','t_transactions.id_area')
	 										->where('m_areas.pic_name',''.$user->name.'')->get();
	 	} else {
	 		$t_transaction 	= t_transaction::all();
	 	}
	 	return view('stock.view_transaction',compact('t_transaction','m_area'));
	 }

	 public function view_transaction_inventory()
	 {
	 	$t_transaction 	= t_transaction::select('*','t_transactions.id as id_transaksi', ('t_transactions.amount_pcs * t_transactions.harga as total_amount'))
	 									->join('m_areas','m_areas.id_area','=','t_transactions.id_area')
	 									->get();
	 							
	 	return view('stock.view_transaction_inventory',compact('t_transaction'));
	 }

	 public function view_sto_report() //v1.6.1, by ario 20170919
	 {
	 	$t_transaction 	= t_transaction::select(DB::raw('sum(t_transactions.total_pcs) as sto_qty'),DB::raw('sum(t_transactions.total_amount) as sto_amount'),'t_transactions.*','t_transactions.id as id_transaksi', ('t_transactions.amount_pcs * t_transactions.harga as total_amount'), 't_transactions.v_class as vclass','t_transactions.part_number as part_number','t_transactions.part_name as part_name','t_transactions.kind as kind')
	 									->join('m_areas','m_areas.id_area','=','t_transactions.id_area')
	 									->groupBy('t_transactions.part_number')
	 									->get();
	 					// return $t_transaction;		
	 	return view('stock.view_sto_report',compact('t_transaction'));
	 }

	public function view_list()
	{  
	 	$input 			= \Input::all();
	 	$id_area 		= $input['id_area'];
	 	$check 			= m_area::where('id_area',$id_area)->get();
	 	$t_transaction 	= t_transaction::where('id_area',$id_area)->get();
	 	return view('stock.view_list', compact('t_transaction','check')); 
	}

	public function view_list3($id)
	{  
	 	$check 			= m_area::where('id_area','=',$id)->get();
	 	$t_transaction 	= t_transaction::where('id_area',$id)->get();
	 	return view('stock.view_list',compact('t_transaction','check')); 
	}

	public function view_list2($id)
	{  
	 	$check 			= m_area::where('id_area','=',$id)->get();
	 	$t_transaction 	= t_transaction::where('t_transactions.id_area',$id)->get();
	 	return view('stock.view_list',compact('t_transaction','check')); 
	}

	public function input_transaction($id) {    
        $m_part 		= m_part::all();
	 	$t_transaction 	= t_transaction::where('id',$id)->get(); 	      
	 		 	// return \Auth::user()->dept_code;            
     	return view('stock.input_transaction',compact('t_transaction','m_part'));
	}

	public function input_transaction_inventory($id) {    
        $m_part 		= m_part::all();
	 	$t_transaction 	= t_transaction::where('id',$id)->get(); 	            
     	return view('stock.input_transaction_inventory',compact('t_transaction','m_part'));
	}

	 public function save_transaction()
	 {
        $input 		 = \Input::all();
        $id 		 = $input['id'];
        $id_area 	 = $input['id_area'];
        $qty_box 	 = $input['qty_box'];
        $part_number = $input['part_number'];
        if ($input['amount_box'] == 'null') {
        	$b 			 = $input['amount_pcs'];
	       	$t_transaction  			= t_transaction::findOrFail($id);
			$t_transaction->amount_pcs	= $b;
			$t_transaction->total_pcs   = $b;
			$t_transaction->save();
        } else {
        	$a 			 = $input['amount_box'];
       		$b 			 = $input['amount_pcs'];
	       	$total1 	 = $a*$qty_box;
	       	$total_pcs 	 = $total1+$b;
	       	$t_transaction  			= t_transaction::findOrFail($id);
	       	$total_amt = $total_pcs * $t_transaction->harga;
	       	$t_transaction->total_amount = $total_amt;
			$t_transaction->amount_box  = $a;
			$t_transaction->amount_pcs	= $b;
			$t_transaction->total_pcs   = $total_pcs;
			$t_transaction->save();
        }
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data stock berhasil disimpan ke dalam sistem');
	 	return redirect('stock/view_list/2/'.$id_area.'');  
	 }

	 public function save_transaction_inventory()
	 {
        $input 		 = \Input::all();
        $id 		 = $input['id'];
        $id_area 	 = $input['id_area'];
        $qty_box 	 = $input['qty_box'];
        $part_number = $input['part_number'];
        if ($input['amount_box'] == 'null') {
        	$b 			 = $input['amount_pcs'];
	       	$t_transaction  			= t_transaction::findOrFail($id);
			$t_transaction->amount_pcs	= $b;
			$t_transaction->total_pcs   = $b;
			$t_transaction->save();
        } else {
        	$a 			 = $input['amount_box'];
       		$b 			 = $input['amount_pcs'];
	       	$total1 	 = $a*$qty_box;
	       	$total_pcs 	 = $total1+$b;
	       	$t_transaction  			= t_transaction::findOrFail($id);
	       	$total_amt = $total_pcs * $t_transaction->harga;
	       	$t_transaction->total_amount = $total_amt;
			$t_transaction->amount_box  = $a;
			$t_transaction->amount_pcs	= $b;
			$t_transaction->total_pcs   = $total_pcs;
			$t_transaction->save();
        }
		\Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','Sukses, data stock berhasil disimpan ke dalam sistem');
	 	return redirect('stock/view_transaction/inventory');  
	 }

	 public function print_report()
	 {    
        $input=\Input::all();
        $t_transaction = t_transaction::all();
        $id_area = m_area::all();
	    return view('stock.print_report',compact('t_transaction','id_area'));
	 }

	  public function print_result()
	 {    
	 	$input=\Input::all();
	 	$id_area=$input['id_area'];
            $array2=t_transaction::select('*','t_transactions.id as id_t_transactions')
	 	                            ->where('t_transactions.id_area',$id_area)                            
	 	                            ->get();
	 	$array3=m_area::where('id_area',$id_area)->get();
	 	foreach ($array3 as $m_area) {
	 		$code_area=$m_area->code_area;
	 	    $name_area=$m_area->name_area;
	 	}

      \Excel::load('/storage/template/report stock opname.xlsx', function($file) use($array2,$array3){
            
		foreach ($array3 as $array3 ) {
				$name_area=$array3->name_area ;
				$code_area=$array3->code_area ;

			$file->setActiveSheetIndex(0)->setCellValue('B4', $name_area);
	        $file->setActiveSheetIndex(0)->setCellValue('J2', $code_area);
			}
 
            $a="6";
        foreach ($array2 as $array2) {
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

   public function print_report_plant()
	 {    
        $input=\Input::all();
        $t_transaction=t_transaction::all();
        $m_area=m_area::all();
	    return view('stock.print_report_plant',compact('t_transaction','m_area'));
	 }

	public function print_plant_result()
	 {    
	 	$input=\Input::all();
	 	$type_plant=$input['type_plant'];
	 	$array = DB::select('select *, sum(t_transactions.amount_box) as a, 
	 		sum(t_transactions.amount_pcs) as b, 
	 		sum(t_transactions.total_pcs) as c 
	 		from t_transactions
	 		where 
	 		type_plant = "'.$type_plant.'"
	 		group By t_transactions.part_number');
        $array2 = new Collection($array);
        	// $tes = DB::select('select SUM(t_transactions.amount_box) as a, 
        	// 	SUM(t_transactions.amount_pcs) as b, SUM(t_transactions.total_pcs) as c 
        	// 	FROM t_transactions group by t_transactions.part_number');
        	// $tes2 = new Collection($tes);
        // $array2=t_transaction::select('*','t_transactions.id as id_t_transactions')
	 	     //                        ->leftjoin('m_areas','m_areas.id_area','=','t_transactions.id_area')
	 	     //                        ->leftjoin('m_parts','m_parts.part_number','=','t_transactions.part_number')
	 	     //                        ->where('m_areas.type_plant',$type_plant)
	 	     //                        ->groupBy('m_parts.part_number')                            
	 	     //                        ->get();
	 	$array3=m_area::where('type_plant',$type_plant)->get();
      	\Excel::load('/storage/template/report stock opname.xlsx', function($file) use($array2,$array3){    
		foreach ($array3 as $array3 ) {
			$type_plant=$array3->type_plant ;
			$file->setActiveSheetIndex(0)->setCellValue('B4', $type_plant);
		}
        $a="6";
        foreach ($array2 as $array2) {
			$back_number=$array2->back_number;
			$part_number=$array2->part_number;
			$part_name  =$array2->part_name;
			$qty_box    =$array2->qty_box;
			$unit       =$array2->unit;
			$amount_box =$array2->a;
			$amount_pcs =$array2->b;
			$total_pcs  =$array2->c;
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

  	public function print_master_part()
	 {    
	 	
	 	
        $array2=m_part::all();
	 	

      \Excel::load('/storage/template/report stock opname.xlsx', function($file) use($array2){
 
            $a="6";
        foreach ($array2 as $array2) {
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

public function upload_sto() { //by ario, 20170925

  		$i = 1;	
    	try {	
			
	    	DB::beginTransaction();

    		$file = \Input::file('file');
    
       		$data = array();
	    	$file->move('../file/', $file->getClientoriginalName());
	    	$extension = \Input::file('file')->getClientoriginalExtension();
	    	$fileName  = $file->getClientoriginalName();
	    
      		$row = Excel::load('file/'.$fileName)->get();
      
	    	foreach ($row as $rows) {

	    		$pn = $rows['part_number'];
	    		$trx=t_transaction::where('part_number',$pn)->first();
	    		if($pn != '' && $pn != '000000' && $pn != null ){

	    			$trx = t_transaction::where('part_number', $pn)
	    									->first();
	    			if (! $trx) {
	    				throw new \Exception('part number : ('.$pn.') tidak ditemukan', 1);
	    			}
	    			else {
			    		// return $pn;
			    		$trx->ending_pcs=$rows['qty'];
			    		$trx->ending_amount=$rows['amount'];
			    		$trx->save();
			    		
	    			}
	    		}

	    		$i++;
	    		
	    	}
	    	
	    	DB::commit();

	    	\Session::flash('flash_type','alert-success');
			\Session::flash('flash_message','Sukses, Ending Qty dan Amount berhasil di upload!');
    		return redirect ('stock/sto/report');
    	}
    	catch(\Exception $e){
    		DB::rollback();
    		\Session::flash('flash_type','alert-danger');
			\Session::flash('flash_message', 'Baris-'.$i.' problem ===> '.$e->getMessage());
			return redirect ('stock/sto/report');	// hotfix-3.1.3, Ferry, kembali ke menu import
    	}   	
    	
	}


}