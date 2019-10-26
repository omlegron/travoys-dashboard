<?php

namespace App\Models\Master;

// use App\Models\Model;
use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasContributors;
use App\Models\Traits\Utilities;

// use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments\Attachment;
// use App\Models\Attachments;
use Illuminate\Support\Facades\URL;

class  EventUsers extends Model
{
    // call traits
    use HasContributors;
    use Utilities;
    
    protected $table 		= 'ref_event';
    protected $fillable 	= [
        'target_id',
        'target_type',
        'trans_id',
        'user_id',
        'type',
        'timestamp',
        'barcode',
        'status',
    ];

    // public function filesMorphClass()
    // {
    //     return 'event-file';
    // }

    // public function attachment()
    // {
    //     return $this->morphMany(Attachment::class, 'target');
    // }
}
