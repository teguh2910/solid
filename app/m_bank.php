<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class m_bank extends Model {

	protected $table ='m_banks' ;
	protected $fillable = ['code_bank','bank_name'];
    
    public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        'code_bank'     =>$key[2],
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
