<?php

use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_person', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Family::class)->constrained()->onUpdate('cascade')->onDelete('cascade');;
            $table->foreignIdFor(Person::class)->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_person');
    }
}
