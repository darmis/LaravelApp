<?php

namespace Ciklas;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
		'name', 'kontakto_vardas','tel', 'mob', 'address', 'pvm_kodas', 'im_kodas'
	];

    public function repairs() {
        return $this->hasMany('Ciklas\Repair');
    }
}
