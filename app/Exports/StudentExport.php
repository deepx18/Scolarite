<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StudentExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
        public function collection()
        {
                // Export all students with their request information
                return Student::with('requests')->get()->map(function ($student) {
                        $latestRequest = $student->requests->sortByDesc('created_at')->first();

                        return [
                                'apogee_number' => $student->apogee_number,
                                'full_name' => $student->first_name . ' ' . $student->last_name,
                                'cne' => $student->cne,
                                'cin' => $student->cin,
                                'email' => $student->email,
                                'status' => $student->status,
                                'study_level' => $student->study_level,
                                'specialization' => $student->specialization,
                                'academic_track' => $student->academic_track,
                                'department' => $student->department,
                                'request_type' => $latestRequest ? $latestRequest->type : 'No Request',
                                'request_status' => $latestRequest ? $latestRequest->status : 'N/A',
                                'request_submitted' => $latestRequest ? $latestRequest->submitted_at : 'N/A',
                        ];
                });
        }

        public function headings(): array
        {
                return [
                        'Apogee Number',
                        'Full Name',
                        'CNE',
                        'CIN',
                        'Email',
                        'Status',
                        'Study Level',
                        'Specialization',
                        'Academic Track',
                        'Department',
                        'Request Type',
                        'Request Status',
                        'Request Submitted',
                ];
        }

        public function columnWidths(): array
        {
                return [
                        'A' => 15,
                        'B' => 25,
                        'C' => 15,
                        'D' => 15,
                        'E' => 30,
                        'F' => 12,
                        'G' => 15,
                        'H' => 20,
                        'I' => 20,
                        'J' => 20,
                        'K' => 20,
                        'L' => 15,
                        'M' => 20,
                ];
        }

        public function styles($sheet)
        {
                return [
                        1 => [
                                'font' => [
                                        'bold' => true,
                                        'color' => ['rgb' => 'FFFFFF'],
                                ],
                                'fill' => [
                                        'fillType' => Fill::FILL_SOLID,
                                        'startColor' => ['rgb' => '1E3A8A'],
                                ],
                        ],
                ];
        }
}
