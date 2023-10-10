<?php

namespace App\Services;

class GenerateMigrationClassService
{
    /**
     * Get the file boilerplate for the generator.
     * @param string $method
     * @return string
     */
    public function __invoke($method = 'create'): string
    {
        if ($method == 'create') return $this->creationBoilerplate();
        else return $this->updateBoilerplate();
    }

    private function creationBoilerplate():string
    {
        return '<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create("{{ table }}", function (Blueprint $table) {
                    $table->id();
                    {{ columns }}
                    $table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists("{{ table }}");
            }
        };
        ';
    }

    private function updateBoilerplate():string
    {
        return '';
    }

}
