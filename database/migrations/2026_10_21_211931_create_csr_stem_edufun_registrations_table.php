
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('csr_stem_edufun_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('company_name');
            $table->string('position');
            $table->string('mobile_no', 30);
            $table->string('email_address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('csr_stem_edufun_registrations');
    }
};
