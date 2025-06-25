<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Material;
use Illuminate\Support\Facades\Log;

class RestoreDeletedMaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materials:restore-deleted {--confirm : Confirm the restoration without prompting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore accidentally soft-deleted materials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedCount = Material::onlyTrashed()->count();
        
        if ($deletedCount === 0) {
            $this->info('No soft-deleted materials found.');
            return 0;
        }

        $this->info("Found {$deletedCount} soft-deleted materials.");
        
        if (!$this->option('confirm')) {
            if (!$this->confirm('Do you want to restore all soft-deleted materials?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        try {
            $deletedMaterials = Material::onlyTrashed()->get();
            
            // Log the materials being restored
            foreach ($deletedMaterials as $material) {
                Log::info('Restoring soft-deleted material', [
                    'material_id' => $material->id,
                    'title' => $material->title,
                    'deleted_at' => $material->deleted_at
                ]);
            }
            
            $restoredCount = Material::onlyTrashed()->restore();
            
            $this->info("Successfully restored {$deletedCount} materials.");
            
            Log::info('Bulk restore operation completed', [
                'restored_count' => $deletedCount,
                'command_run_by' => 'console'
            ]);
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Error restoring materials: ' . $e->getMessage());
            
            Log::error('Error during bulk restore operation', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return 1;
        }
    }
}