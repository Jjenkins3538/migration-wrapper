<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use Illuminate\Filesystem\Filesystem;
use App\Services\MigrationRulesService;


class MigrationCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jd-make:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate migration files with columns from a prompt';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO:
        // first check which DB driver is being used (mysql, pgsql, sqlite, sqlsrv) it effects which rules are allowed
        // fill rules service with known migration rules
        // prompt user for migration rules
        // logic for which stub to load, probably just str::contains tbh


        $this->files = new Filesystem();
        $migrationRulesService = new MigrationRulesService();
        $migrationRules = $migrationRulesService->getMigrationRules();

        $tableName = text(
            label: 'What is the table name?',
            placeholder: 'Users',
            validate: fn (string $value) => match (true) {
                Str::contains($value, ' ') => 'Table names cannot contain spaces',
                !Str::contains($value, '_table') => 'Table names must end with _table',
                !Str::startsWith($value, ['create_', 'update_']) => 'Table names must start with create_ or update_',
                $this->ensureMigrationDoesntAlreadyExist($value, database_path('migrations')) => 'A migration for ' . $value . ' already exists',
                default => null
            }
        );

        $tableColumns = [];

        $columns = text(
            label: 'What are the columns?',
            placeholder: 'name:string, email:string:unique, password:string:nullable',
            validate: fn (string $value) => match (true) {
                Str::contains($value, ' ') => 'Column names cannot contain spaces',
                !Str::contains($value, ':') => 'Column names must be followed by a colon and a rule',
                !Str::contains($value, ',') => 'Column names must be separated by a comma',
                default => null
            }
        );


        $this->ensureMigrationDoesntAlreadyExist($tableName, database_path('migrations'));

        $filePath = database_path('migrations/' . date('Y_m_d_His') . '_' . $tableName . '.php');
        $this->populateStubFile($tableName, $filePath);
    }

    /**
     * Ensure that a migration with the given name doesn't already exist.
     *
     * @param  string  $name
     * @param  string  $migrationPath (database_path('migrations'))
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function ensureMigrationDoesntAlreadyExist($name, $migrationPath)
    {
        if (!empty($migrationPath)) {
            $migrationFiles = $this->files->glob($migrationPath . '/*.php');

            if (preg_match("/$name/i", implode(', ', $migrationFiles))) {
                throw new InvalidArgumentException("A migration for {$name} already exists.");
            }
        }
    }

    private function getStub()
    {
        return $this->files->get(storage_path('app/public/stubs/migration.create.stub'));
    }

    private function populateStubFile(string $tableName, string $filePath): void
    {
        $stub = $this->getStub();

        $tableVar = Str::between($tableName, 'create_', '_table');
        $stub = str_replace('{{ table }}', $tableVar, $stub);

        $this->files->put($filePath, $stub);
    }
}
