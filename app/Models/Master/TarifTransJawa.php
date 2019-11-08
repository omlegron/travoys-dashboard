<?php

namespace App\Models\Master;

// use App\Models\Model;
use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasContributors;
use App\Models\Traits\Utilities;


class TarifTransJawa extends Model
{
    // call traits
    use HasContributors;
    use Utilities;
    
    protected $table 		= 'tarif_transjawa';
    protected $fillable 	= [
        'asal_tujuan',
        'Pandaan-Malang',
        'Gempol',
        'Pasuruan',
        'Grati-Probolinggo Timur',
        'Sidoarjo',
        'Surabaya',
        'Mojokerto-GT Mojokerto Barat',
        'Kertosono-GT Nganjuk',
        'Madiun',
        'Ngawi',
        'Sragen',
        'Solo-Yogya Via GT Colomadu',
        'Boyolali',
        'Ungaran',
        'Semarang',
        'Batang',
        'Pemalang',
        'Brebes Timur',
        'Pejagan',
        'Cirebon-GT Ciperna',
        'Palimanan',
        'Cikampek',
        'Merak Via JORR',
        ];


}
