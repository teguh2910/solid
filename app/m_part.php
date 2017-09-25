<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class m_part extends Model {

	protected $table ='m_parts' ;
	protected $fillable = ['back_number','part_number','part_name','v_class','kind','qty_box','unit','harga'];
    
    public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        
                        'back_number'   =>$key[1],
                        'part_number'   =>$key[2],
                        'part_name'     =>$key[3],
                        'v_class'       =>$key[4],
                        'kind'          =>$key[5],
                        'qty_box'       =>$key[7],
                        'unit'          =>$key[8],
                        'harga'         =>$key[9],
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
