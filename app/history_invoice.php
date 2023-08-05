<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_invoice extends Model
{
    protected $table       = 'history_invoice';
	protected $fillable    =  ['no_penerimaan','dept_code','status','tanggal'];
}
