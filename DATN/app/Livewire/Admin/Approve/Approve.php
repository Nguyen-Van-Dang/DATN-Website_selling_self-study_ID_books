<?php

namespace App\Livewire\Admin\Approve;

use Livewire\Component;
use App\Models\AuditLog;
class Approve extends Component
{
    public $logs;

    // public function mount($model, $id)
    // {
    //     $this->logs = AuditLog::where('model', $model)
    //         ->where('model_id', $id)
    //         ->with('admin')
    //         ->latest()
    //         ->get();
    // }

    public function render()
    {
        return view('livewire.admin.approve.approve', [
            // 'logs' => $this->logs,
        ]);
    }
}
