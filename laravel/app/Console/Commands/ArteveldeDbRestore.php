<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class ArteveldeDbRestore
 *
 * Use:
 * $ php artisan artevelde:db:restore
 *
 * @package App\Console\Commands
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright © 2017, Artevelde University College Ghent
 */
class ArteveldeDbRestore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artevelde:db:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restores database from most recent SQL dump';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get variables from `.env`
        $dbName = env('DB_DATABASE');
        $dbUsername = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');
        $dbDumpPath = getcwd() . '/' . env('DB_DUMP_PATH');

        // Reset database.
        $this->callSilent('artevelde:db:reset');

        // Restore SQL dump.
        $command = "mysql --user=${dbUsername} --password=${dbPassword} ${dbName} < ${dbDumpPath}/latest.sql";
        if (windows_os()) {
            $command = str_replace('/', DIRECTORY_SEPARATOR, $command);
        }
        exec($command);

        $this->comment("Backup for database `${dbName}` restored!");
    }
}
