<?php

namespace App\Models;

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

class Users extends Model
{
    // call traits
    use HasContributors;
    use Utilities;
    
    protected $table 		= 'users';
    protected $fillable 	= [
        'name',
        'email',
        'avatar',
        'email_verified_at',
        'phone',
    ];
}
