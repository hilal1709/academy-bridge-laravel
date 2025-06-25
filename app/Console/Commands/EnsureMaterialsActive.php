<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnsureMaterialsActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materials:ensure-active {--fix : Actually fix the materials}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure all materials are active and not soft deleted';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking materials status...');

        // Check for materials with deleted_at not null
        $deletedMaterials = DB::table('materials')
            ->whereNotNull('deleted_at')
            ->get();

        if ($deletedMaterials->isEmpty()) {
            $this->info('✅ All materials are active. No issues found.');
            return 0;
        }

        $this->warn("Found {$deletedMaterials->count()} materials with deleted_at set:");
        
        foreach ($deletedMaterials as $material) {
            $this->line("- ID: {$material->id}, Title: {$material->title}, Deleted: {$material->deleted_at}");
        }

        if ($this->option('fix')) {
            $this->info('Fixing materials...');
            
            $fixed = DB::table('materials')
                ->whereNotNull('deleted_at')
                ->update(['deleted_at' => null]);

            $this->info("✅ Fixed {$fixed} materials.");
            
            Log::info('Materials Fixed', [
                'fixed_count' => $fixed,
                'fixed_materials' => $deletedMaterials->pluck('id')->toArray()
            ]);
        } else {
            $this->info('Run with --fix option to restore these materials.');
        }

        // Show current status
        $totalMaterials = DB::table('materials')->count();
        $activeMaterials = DB::table('materials')->whereNull('deleted_at')->count();
        
        $this->info("Total materials: {$totalMaterials}");
        $this->info("Active materials: {$activeMaterials}");

        return 0;
    }
}