<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
	protected $table       = 'invoice';
	protected $fillable    =  ['no_penerimaan','dept_code','vendor','tgl_terima','doc_no','doc_date',
                                'due_date','curr','amount','doc_no_2','user_acc','user','tgl_terima_user','remark','status','act_acc','act','tgl_terima_act','finance_acc','finance','tgl_terima_finance','remark_act','tgl_pending_user','tgl_pending_act','tgl_input','no_po','tgl_approve_user','coy'];
	public function status() {
		return $this->hasMany('App\status', 'status', 'status');
	}
	public function dept() {
		return $this->hasMany('App\dept', 'dept_code', 'dept_code');
	}

}