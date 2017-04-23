<?php

namespace App\Models;

use DB;
use Hash;
use CreateVotesTable;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Vote extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'details' => 'array', // Casts array to JSON and vice versa.
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = CreateVotesTable::PK;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Register a creating model event with the dispatcher.
         */
        static::creating(function(Vote $vote) {
            // Create Universally Unique Identifier.
            do {
                $uuid = Uuid::uuid4()->toString(); // @see https://github.com/ramsey/uuid
            } while (DB::table(CreateVotesTable::TABLE)
                ->select(CreateVotesTable::PK)
                ->where(CreateVotesTable::PK, $uuid)
                ->exists());
            $vote->uuid = $uuid;

            // Create Checksum, assume password
            $data = $vote->getAttributes();
            ksort($data);
            $value = hash('sha512', (json_encode($data)).$vote->checksum);
            // \Log::debug([$data, $value]);
            $vote->checksum = bcrypt($value);
        });
    }
}
