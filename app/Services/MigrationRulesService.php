<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;

class MigrationRulesService extends Blueprint
{
    public function __construct()
    {
        return get_class_methods($this);
    }
}
