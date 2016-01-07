<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

	protected $table = 'invoice';

	protected $fillable =  ['no_penerimaan','dept_code','vendor','tgl_terima','doc_no','doc_date','due_date','curr'
							,'amount','doc_no_2','user_acc','user','tgl_terima_user','remark','status','act_acc'
							,'act','tgl_terima_act','finance_acc','finance','tgl_terima_finance','remark_act',
                            'tgl_pending_user','tgl_pending_act'];

	public static function array_to_db($array_data){
    	$total=sizeof($array_data);
    	if($total>0){
    		try {
    			foreach ($array_data as $value) {
    				$key=explode(';',$value);
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d H:i:s');
                    if ($key[1]=="PUR" or $key[1]=="EXM"){
                        $dept="1";
                    } elseif ($key[1]=="GAF"){
                        $dept="2";
                    } elseif ($key[1]=="MTE" or $key[1]=="PPC" or $key[1]=="FIN"){
                        $dept="3";
                    } elseif ($key[1]=="MIS"){
                        $dept="5";
                    } elseif ($key[1]=="HRD"){
                        $dept="6";
                    }
    				self::create([
    					'no_penerimaan'=>$key[0],
    					'dept_code'=>$dept,
    					'vendor'=>$key[2],
    					'tgl_terima'=>$key[3],
    					'doc_no'=>$key[4],
    					'doc_date'=>$key[5],
                        'due_date'=>$key[6],
    					'curr'=>$key[7],
    					'amount'=>$key[8],
    					'doc_no_2'=>$key[9],
    					'status'=>'1',
                        'tgl_input'=>$date,
    				]);
    			}
    			return 1;
    		} catch (Exception $e) {

    			return 0;
    		}
    	}else{
    		return 0;
    	}
    }
}
