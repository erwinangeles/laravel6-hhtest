<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ExportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export ALL users and their attributes into a CSV';

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
        //
        $users = User::all();
        if(!$users){return $this->error('No users found to export.');}
        
        $file = fopen('export_all_users.csv', 'w');
        $headers = ['Name', 'Email', 'Birthday', 'Gender', 'Country'];
        fputcsv($file, $headers);

        foreach($users as $user){
            $row['Name'] = $user->name;
            $row['Email'] = $user->email;
            $row['Birthday'] = $user->attributes->birthday;
            $row['Gender'] = $user->attributes->gender;
            $row['Country'] = $user->attributes->country;
            fputcsv($file, array($row['Name'], $row['Email'], $row['Birthday'], $row['Gender'], $row['Country']));
        }
        fclose($file);
        return $this->info("Data was exported successfully for ". $users->count() . ' users.');
    }
}
