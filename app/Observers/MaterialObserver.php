<?php

namespace App\Observers;

use App\Models\Material;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MaterialObserver
{
    /**
     * Handle the Material "created" event.
     */
    public function created(Material $material): void
    {
        Log::info('Material Created', [
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'title' => $material->title
        ]);
    }

    /**
     * Handle the Material "updating" event.
     */
    public function updating(Material $material): void
    {
        // Prevent accidental soft deletion during updates
        if ($material->isDirty('deleted_at') && $material->deleted_at !== null) {
            // Only allow soft deletion if it's an explicit delete operation
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
            $isExplicitDelete = false;
            
            foreach ($backtrace as $trace) {
                if (isset($trace['function']) && in_array($trace['function'], ['delete', 'destroy'])) {
                    $isExplicitDelete = true;
                    break;
                }
            }
            
            if (!$isExplicitDelete) {
                Log::warning('Prevented accidental soft deletion during update', [
                    'material_id' => $material->id,
                    'user_id' => Auth::id(),
                    'title' => $material->title
                ]);
                
                // Reset deleted_at to prevent accidental soft deletion
                $material->deleted_at = null;
            }
        }
    }

    /**
     * Handle the Material "updated" event.
     */
    public function updated(Material $material): void
    {
        Log::info('Material Updated', [
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'title' => $material->title,
            'is_active' => $material->deleted_at === null
        ]);
    }

    /**
     * Handle the Material "deleting" event.
     */
    public function deleting(Material $material): void
    {
        Log::info('Material Being Soft Deleted', [
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'title' => $material->title
        ]);
    }

    /**
     * Handle the Material "deleted" event.
     */
    public function deleted(Material $material): void
    {
        Log::info('Material Soft Deleted', [
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'title' => $material->title
        ]);
    }

    /**
     * Handle the Material "restored" event.
     */
    public function restored(Material $material): void
    {
        Log::info('Material Restored', [
            'material_id' => $material->id,
            'user_id' => Auth::id(),
            'title' => $material->title
        ]);
    }
}