
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                ->constrained('devices')
                ->cascadeOnDelete();

            $table->foreignId('risk_analysis_id')
                ->constrained('risk_analyses')
                ->cascadeOnDelete();

            $table->string('title', 150);
            $table->text('message');
            $table->string('severity', 20);

            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index(['device_id', 'sent_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
