<?php

namespace App\Services;

use Illuminate\Database\Schema\Grammars\MySqlGrammar;

class MigrationRulesService
{

    private $dbDriver;

    /**
     * MigrationRulesService constructor.
     */

    public function __construct()
    {
        $this->dbDriver = config('database.default');
    }

    /**
     * Get migration rules for prompts
     * @return array
     */
    public function getMigrationRules(): array
    {
        if ($this->dbDriver === 'mysql') {
            return [
                'string' => 'string',
                'text' => 'text',
                'mediumText' => 'mediumText',
                'longText' => 'longText',
                'integer' => 'integer',
                'bigInteger' => 'bigInteger',
                'unsignedBigInteger' => 'unsignedBigInteger',
                'float' => 'float',
                'double' => 'double',
                'decimal' => 'decimal',
                'boolean' => 'boolean',
                'date' => 'date',
                'dateTime' => 'dateTime',
                'dateTimeTz' => 'dateTimeTz',
                'time' => 'time',
                'timeTz' => 'timeTz',
                'year' => 'year',
                'json' => 'json',
                'jsonb' => 'jsonb',
                'uuid' => 'uuid',
                'ipAddress' => 'ipAddress',
                'macAddress' => 'macAddress',
                'geometry' => 'geometry',
                'point' => 'point',
                'lineString' => 'lineString',
                'polygon' => 'polygon',
                'geometryCollection' => 'geometryCollection',
                'multiPoint' => 'multiPoint',
                'multiLineString' => 'multiLineString',
                'multiPolygon' => 'multiPolygon',
                'set' => 'set',
                'enum' => 'enum',
            ];
        }
    }
}
