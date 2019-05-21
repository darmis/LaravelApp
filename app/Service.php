<?php

namespace Ciklas;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'kliento_id', 'registrator_id', 'meistro_id', 'klientas', 'tel', 'adresas', 'atstumas', 'darbo_laikas', 'dirbta_val', 'uzduotis', 'pastabos', 'busena', 'arRodo'
    ];

    public function user() {
        return $this->belongsTo('Ciklas\User');
    }

    public function client() {
        return $this->belongsTo('Ciklas\Client');
    }
}
