<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class t_transaction extends Model {
	protected $table='t_transactions';
	protected $fillable=['id_area','part_number','amount_box','amount_pcs','total_pcs'];

	//

}
