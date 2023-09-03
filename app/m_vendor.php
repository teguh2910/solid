<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_vendor extends Model
{
    protected $table ='m_vendors' ;
	protected $fillable = ['code_vendor','country','vendor_name'];
}
