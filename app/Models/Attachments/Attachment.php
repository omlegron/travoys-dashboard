<?php

namespace App\Models\Attachments;

// use App\Models\Model;
use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasContributors;
use App\Models\Traits\Utilities;

// use App\Models\Roles;
use App\Models\User;
// use App\Models\Attachments;
use Illuminate\Support\Facades\URL;

class  Attachment extends Model
{
    // call traits
    use HasContributors;
    use Utilities;
    
    protected $table 		= 'ref_attachments';
    protected $fillable 	= [
        'target_id',
        'target_type',
        'filename',
        'url',
        'type',
        'description',
        'status',
    ];

    public function target()
    {
        return $this->morphTo();
    }
  
}
