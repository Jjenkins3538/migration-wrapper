<?php

namespace App\Console\Commands;

use App\Services\GenerateMigrationClassService;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
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
        // NOTE: MOVED EVERYTHING FROM STUB TO SERVICE

        // TODO:
        // first check which DB driver is being used (mysql, pgsql, sqlite, sqlsrv) it effects which rules are allowed
        // fill rules service with known migration rules
        // prompt user for migration rules
        // add update class to GenerateMigrationClassService



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

        $columns = text(
            label: 'What are the columns?',
            placeholder: 'name, email, password',
            validate: fn (string $value) => match (true) {
                !Str::contains($value, ', ') => 'Column names must be comma separated',
                default => null
            }
        );

        $cleanedColumns = $this->cleanColumns($columns);

        $filePath = database_path('migrations/' . date('Y_m_d_His') . '_' . $tableName . '.php');
        $this->populateStubFile($tableName, $filePath, $cleanedColumns);

        $confirm = confirm(
            label: 'Would you like to run the migration now?',
            default: false
        );

        if ($confirm) {
            shell_exec('php artisan migrate');
        }

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

    private function populateStubFile(string $tableName, string $filePath, string $columns): void
    {
        $migrationClassString = new GenerateMigrationClassService();
        $migrationClassString = $migrationClassString->__invoke();

        // Create the migration file
        $tableVar = Str::between($tableName, 'create_', '_table');
        $migrationClassString = str_replace('{{ table }}', $tableVar, $migrationClassString);
        $migrationClassString = str_replace('{{ columns }}', $columns, $migrationClassString);
        $this->files->put($filePath, $migrationClassString);
    }

    private function cleanColumns(string $columnString): string
    {
        $columns = explode(', ', $columnString);
        $cleanedColumns = '';
        $baseString = "\$table->string('{column}');";

        foreach ($columns as $column) {
            $columnName = str_replace('{column}', Str::snake($column), $baseString);

            $cleanedColumns .= $columnName . PHP_EOL . '                    ';
        }

        return $cleanedColumns;
    }
}
