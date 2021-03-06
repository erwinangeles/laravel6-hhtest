<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ExportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:user {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export user details and attributes to CSV';

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
         $arg =  $this->argument('user');
         $user = User::where('id', '=', $arg)->orWhere('email', '=', $arg)->first();

         if(!$user){return $this->error('No user found with those specifications');}
         
         $data = [
             [
             $user->name, 
             $user->email, 
             $user->attributes->birthday, 
             $user->attributes->gender, 
             $user->attributes->country
             ]
         ];
         
        $headers = ['Name', 'Email', 'Birthday', 'Gender', 'Country'];
        
        $file = fopen('export_single_user.csv', 'w');
        
        fputcsv($file, $headers);
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        
        fclose($file);
        return $this->info("Data was exported successfully for ". $user->name . '.');
    }
}
