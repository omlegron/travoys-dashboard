<?php

namespace App\Models\Auth;

use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
	public function isSuperAdmin()
	{
		return $this->name === 'Super Admin';
	}
}
