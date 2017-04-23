<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    const TABLE = 'votes';
    const PK = 'uuid';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::TABLE, function (Blueprint $table) {
            // Meta Data
            $table->uuid(static::PK)
                ->primary(static::PK);
            $table->string('checksum')
                ->nullable();

            // Foreign Keys
            $table->unsignedInteger('election_id');

            // Data
            $table->json('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(static::TABLE);
    }
}
