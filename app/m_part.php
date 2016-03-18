<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class m_part extends Model {

	protected $table ='m_parts' ;
	protected $fillable = ['id_area','back_number','part_number','part_name','qty_per_box','unit'];

	//

}
