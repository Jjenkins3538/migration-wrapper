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


//TODO
// return [
//     'string' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'text' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'mediumText' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'longText' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'integer' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'bigInteger' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'unsignedBigInteger' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'float' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'double' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'decimal' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'boolean' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'date' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'dateTime' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'dateTimeTz' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'time' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'timeTz' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'year' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'json' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'jsonb' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'uuid' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'ipAddress' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'macAddress' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'geometry' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'point' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'lineString' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'polygon' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'geometryCollection' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'multiPoint' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'multiLineString' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'multiPolygon' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'set' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
//     'enum' => [
//         'type' => '',
//         'nullable' => false,
//         'default' => null,
//         'table_name' => '',
//         'modifiers' => [

//         ],
//     ] ,
// ];
