<?php

namespace Ciklas;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
	protected $fillable = [
		'klientas', 'meistro_id', 'tel', 'busena', 'tipas', 'daliu_kaina', 'remonto_kaina', 'spec_komp', 'gedimai', 'pastabos', 'barkodas', 'mob_tel'
	];

    public function user() {
        return $this->belongsTo('Ciklas\User');
    }

    public function client() {
        return $this->belongsTo('Ciklas\Client');
    }
}
