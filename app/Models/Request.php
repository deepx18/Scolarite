<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'student_id',
        'type',
        'status',
        'comment',
        'admin_comment',
        'details',
        'submitted_at',
        'reviewed_at',
    ];

    // Request type constants
    public const TYPES = [
        'transcript' => 'Transcript Request',
        'enrollment_certificate' => 'Enrollment Certificate',
        'baccalaureate_withdrawal' => 'Baccalaureate Temporary Withdrawal',
        'internship_agreement' => 'Internship Agreement / Authorization',
        're_enrollment' => 'Re-enrollment',
        'personal_info_correction' => 'Personal Information Correction',
    ];

    // Status constants
    public const STATUSES = [
        'pending' => 'Pending',
        'in_review' => 'In Review',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ];

    public const CONSTRAINTS = [
        'transcript' => [
            'max_requests' => 1
        ],
        'enrollment_certificate' => [
            'max_requests' => 2
        ],
        // 'baccalaureate_withdrawal' => [],
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    protected $casts = [
        'submitted_at' => 'date',
        'reviewed_at' => 'datetime',
        'details' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the display label for request type
     */
    public function typeLabel(): string
    {
        // Use localization key first so labels are translated when locale changes
        $key = 'admin.request_types.' . $this->type;
        $translated = __($key);
        if ($translated === $key) {
            return self::TYPES[$this->type] ?? ucfirst(str_replace('_', ' ', $this->type));
        }
        return $translated;
    }

    /**
     * Get the display label for status
     */
    public function statusLabel(): string
    {
        $key = 'admin.statuses.' . $this->status;
        $translated = __($key);
        if ($translated === $key) {
            return self::STATUSES[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
        }
        return $translated;
    }

    /**
     * Type-specific validation rules
     */
    public static function typeRules(string $type): array
    {
        return match ($type) {

            'transcript' => [
                'number_of_copies' => 'required|integer|min:1|max:10',
                'delivery_method' => 'required|in:email,pickup,mail',
            ],

            'enrollment_certificate' => [
                'number_of_copies' => 'required|integer|min:1|max:10',
                'delivery_method' => 'required|in:email,pickup,mail',
            ],

            'baccalaureate_withdrawal' => [
                'reason' => 'required|string|max:1000',
                'expected_return_date' => 'required|date|after:today',
            ],

            'internship_agreement' => [
                'company_name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'description' => 'required|string|max:1000',
            ],

            're_enrollment' => [
                'academic_year' => 'required|string|max:20',
                'program' => 'required|string|max:255',
            ],

            'personal_info_correction' => [
                'field_to_correct' => 'required|string|max:255',
                'current_value' => 'required|string|max:255',
                'correct_value' => 'required|string|max:255',
                'justification' => 'required|string|max:1000',
            ],

            default => [],
        };
    }
}
