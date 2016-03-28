<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class t_transaction extends Model {
	protected $table='t_transactions';
	protected $fillable=['id_area','part_number','amount_box','amount_pcs','total_pcs'];

    public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        'id_area'        =>$key[0],
                        'part_number'    =>$key[2],
                     
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
