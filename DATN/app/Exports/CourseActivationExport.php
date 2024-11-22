<?php

namespace App\Exports;

use App\Models\CourseActivationCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourseActivationExport implements FromCollection, WithHeadings
{
    protected $courseActivationId;

    public function __construct($courseActivationId)
    {
        $this->courseActivationId = $courseActivationId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CourseActivationCode::where('course_activation_id', $this->courseActivationId)
            ->select('activation_code', 'user_id', 'activation_date')
            ->orderByRaw('user_id IS NOT NULL DESC')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Activation Code',
            'User Activate',
            'Activation Date'
        ];
    }
}
