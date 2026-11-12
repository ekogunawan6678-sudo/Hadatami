
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risk_analyses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                ->constrained('devices')
                ->cascadeOnDelete();

            $table->foreignId('sensor_reading_id')
                ->constrained('sensor_readings')
                ->cascadeOnDelete();

            $table->string('risk_level', 20);
            $table->text('analysis')->nullable();

            $table->timestamp('analyzed_at');

            $table->timestamps();

            $table->index(['device_id', 'analyzed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_analyses');
    }
};
