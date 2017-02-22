<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class t_bank_data extends Model {

	protected $table ='t_bank_datas' ;
	protected $fillable = ['code_vendor','vendor_name','code_bank','part_bank','account_no','account_name'];
    
    public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        'code_vendor'   =>$key[0],
                        'vendor_name'   =>$key[1],
                        'code_bank'     =>$key[2],
                        'account_no'    =>$key[5],
                        'account_name'  =>$key[6],
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


	//

}
