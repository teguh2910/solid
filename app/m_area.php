<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class m_area extends Model {

	protected $table ='m_areas' ;
    protected $fillable = ['id_area','type_plant','code_area','detail_area','name_area','pic_name','pic_contact'];
 
	public static function array_to_db($array_data){
        $total=sizeof($array_data);
        if($total>0){
            try {
                foreach ($array_data as $value) {
                    $key=explode(';',$value);
                    self::create([
                        'id_area'       =>$key[0],
                        'type_plant'    =>$key[1],
                        'code_area'     =>$key[2],
                        'detail_area'   =>$key[3],
                        'name_area'     =>$key[4],
                        'pic_name'      =>$key[5],
                        'pic_contact'   =>$key[6],
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
