<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class TenantsMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant?} {--fresh} {--seed}';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
   
    public function handle()
    {
        if ($this->argument('tenant')) {
            $this->migrate(
                Tenant::find($this->argument('tenant'))
            );

        } else {
            Tenant::all()->each(
                fn($tenant) => $this->migrate($tenant)
            );
        }
    }

    /**
     * @param \App\Tenant $tenant
     * @return int
     */
    public function migrate($tenant)
    {
        $tenant->configure()->use();
        if(!empty($tenant->database_name)){

            $this->line('');
            $this->line("-----------------------------------------");
            $this->info("Migrating Tenant #{$tenant->id} ({$tenant->name})");
            $this->line("-----------------------------------------");

            $options = ['--force' => true,'--path'=>'/database/migrations/tenant_migrations','--database'=> 'tenant'];

            if ($this->option('seed')) {
                $options['--seed'] = true;
            }

            $this->call(
                $this->option('fresh') ? 'migrate:fresh' : 'migrate',
                $options
            );
        }else{
            $this->line('');
            $this->line("-----------------------------------------");
            $this->info("No Database Name found for Tenant #{$tenant->id} ({$tenant->name})");
            $this->line("-----------------------------------------");
        }
    }
}
