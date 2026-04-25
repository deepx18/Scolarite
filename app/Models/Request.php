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
        'transfer' => 'Transfer Request',
        'withdrawal' => 'Course Withdrawal',
        'transcript' => 'Academic Transcript',
        'leave' => 'Leave of Absence',
        'appeal' => 'Grade Appeal',
        'extension' => 'Assignment Extension',
        'accommodation' => 'Academic Accommodation',
        'enrollment_certificate' => 'Enrollment Certificate',
        'diploma' => 'Diploma Request',
        'student_card' => 'Student ID Card',
        'financial_aid' => 'Financial Aid',
        'other' => 'Other Request',
    ];

    // Status constants
    public const STATUSES = [
        'pending' => 'Pending',
        'in_review' => 'In Review',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
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
            'transfer' => [
                'destination_program' => 'required|string|max:255',
                'reason' => 'required|string|max:1000',
            ],
            'withdrawal' => [
                'course_code' => 'required|string|max:20',
                'course_name' => 'required|string|max:255',
                'reason' => 'required|string|max:1000',
            ],
            'transcript' => [
                'number_of_copies' => 'required|integer|min:1|max:10',
                'delivery_method' => 'required|in:email,pickup,mail',
            ],
            'leave' => [
                'leave_type' => 'required|in:medical,personal,academic',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string|max:1000',
            ],
            'appeal' => [
                'course_code' => 'required|string|max:20',
                'grade_received' => 'required|string|max:5',
                'reason' => 'required|string|max:1000',
            ],
            'extension' => [
                'assignment_name' => 'required|string|max:255',
                'requested_days' => 'required|integer|min:1|max:14',
                'reason' => 'required|string|max:1000',
            ],
            'accommodation' => [
                'accommodation_type' => 'required|string|max:255',
                'supporting_documentation' => 'required|boolean',
                'description' => 'required|string|max:1000',
            ],
            'enrollment_certificate' => [
                'delivery_method' => 'required|in:email,pickup,mail',
                'number_of_copies' => 'required|integer|min:1|max:10',
            ],
            'diploma' => [
                'delivery_method' => 'required|in:email,pickup,mail',
                'number_of_copies' => 'required|integer|min:1|max:5',
            ],
            'student_card' => [
                'card_type' => 'required|in:new,replacement',
                'reason' => 'required|string|max:1000',
            ],
            'financial_aid' => [
                'aid_type' => 'required|in:scholarship,loan,bursary',
                'reason' => 'required|string|max:1000',
            ],
            'other' => [
                'subject' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ],
            default => [],
        };
    }
}
