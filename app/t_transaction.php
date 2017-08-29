<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class t_transaction extends Model {
	protected $table='t_transactions';
	protected $fillable=[
    'id_area','type_plant', 
    'part_number','back_number','part_name','qty_box','unit',
    'amount_box','amount_pcs','total_pcs', 'harga','total_amount'
    ];

    public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        
                        'id_area'        =>$key[0],
                        'back_number'    =>$key[1],
                        'part_number'    =>$key[2],
                        'part_name'      =>$key[3],
                        'type_plant'     =>$key[4],
                        'qty_box'        =>$key[5],
                        'unit'           =>$key[6],
                        'harga'          =>$key[7],
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
