<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use Sortable;

    public $sortable = ['id', 'name'];
    
}
