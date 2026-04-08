# Requests Module Architecture Implementation

## Overview
The Requests module has been refactored to follow the same solid relational architecture as the Demandes module, featuring:

- **Relational database design** with normalized core tables
- **Type-specific JSON payload** for flexible accommodation of different request types
- **Type-specific validation** at the controller level
- **Reference-based tracking** (REQ-YYYY-XXXX format)
- **Comprehensive views** with type-specific form fields

---

## 1. Database Design

### Requests Table
Updated in `database/migrations/2026_04_03_145503_create_requests_table.php`

**Fields:**
- `id` (PK) - Primary key
- `reference` (UNIQUE) - REQ-2026-0001 format for tracking
- `student_id` (FK) - Foreign key to students table, cascade delete
- `type` - Request type (transfer, withdrawal, transcript, etc.)
- `status` - Request status (pending, in_review, approved, rejected, archived)
- `comment` - Optional general comments
- `details` (JSON) - Type-specific fields
- `submitted_at` - Business date of submission
- `reviewed_at` - Admin review timestamp
- `created_at/updated_at` - System timestamps

**Why JSON Details:**
Each request type has different required fields. The JSON `details` field stores:
- Flexible per-type schema
- Same table for cross-cutting concerns (status, timeline, reporting)
- Clean validation at controller level
- Easy to refactor into per-type tables in future if needed

---

## 2. Eloquent Models

### Request Model (`app/Models/Request.php`)
**Type Constants:**
```php
const TYPES = [
    'transfer' => 'Transfer Request',
    'withdrawal' => 'Course Withdrawal',
    'transcript' => 'Academic Transcript',
    'leave' => 'Leave of Absence',
    'appeal' => 'Grade Appeal',
    'extension' => 'Assignment Extension',
    'accommodation' => 'Academic Accommodation',
];
```

**Status Constants:**
```php
const STATUSES = [
    'pending' => 'Pending',
    'in_review' => 'In Review',
    'approved' => 'Approved',
    'rejected' => 'Rejected',
    'archived' => 'Archived',
];
```

**Key Methods:**
- `typeLabel()` - Returns display label for request type
- `statusLabel()` - Returns display label for status
- `typeRules($type)` - Static method returning validation rules for specific type
- `student()` - BelongsTo relationship

**Fillable Fields:**
- reference, student_id, type, status, comment, details, submitted_at, reviewed_at

**Casts:**
- submitted_at → date
- reviewed_at → datetime
- details → array (auto JSON conversion)

### Student Model (`app/Models/Student.php`)
**Relationship:**
- `requests()` - HasMany relationship to Request

---

## 3. Request Types & Type-Specific Fields

Each type has its own validation rules and field requirements:

### Transfer Request
- `destination_program` (required) - Target program
- `reason` (required) - Reason for transfer

### Course Withdrawal
- `course_code` (required) - e.g., CS101
- `course_name` (required) - Full course name
- `reason` (required) - Reason for withdrawal

### Academic Transcript
- `number_of_copies` (required) - 1-10 copies
- `delivery_method` (required) - email, pickup, or mail

### Leave of Absence
- `leave_type` (required) - medical, personal, academic
- `start_date` (required) - ISO date
- `end_date` (required) - ISO date, >= start_date
- `reason` (required) - Description

### Grade Appeal
- `course_code` (required) - e.g., ENG201
- `grade_received` (required) - e.g., C-, D+
- `reason` (required) - Appeal justification

### Assignment Extension
- `assignment_name` (required) - Assignment title
- `requested_days` (required) - 1-14 days
- `reason` (required) - Extension reason

### Academic Accommodation
- `accommodation_type` (required) - e.g., "Extended time for exams"
- `supporting_documentation` (required) - Boolean
- `description` (required) - Details and context

---

## 4. Controller Implementation (`app/Http/Controllers/FORequestsController.php`)

### Key Methods:

**index()**
- Lists paginated requests (5 per page)
- Supports search by reference and type
- Supports filtering by status
- Orders by submitted_at descending

**create($request)**
- Displays form with type selection
- Pre-selects type if passed via query string

**store($request)**
- Validates base fields (type validation)
- Validates type-specific fields via `Request::typeRules($type)`
- Generates unique reference via `nextReference()`
- Stores type-specific data in `details` JSON field
- Sets status to 'pending' and submitted_at to current date
- Redirects with success message including reference number

**show($request)**
- Displays full request details with type-specific information
- Shows student information
- Shows timeline of events

**nextReference()**
- Generates unique references in REQ-YYYY-XXXX format
- Example: REQ-2026-0001, REQ-2026-0002, etc.
- Handles year changes correctly

---

## 5. Seed Data (`database/seeders/RequestSeeder.php`)

**Seeded Data:**
- 7 realistic requests with varied types and statuses
- Type-specific details for each request
- Various submission and review dates
- 15 additional random requests via factory

**Example Request:**
```php
[
    'reference' => 'REQ-2026-0001',
    'student_id' => $students->first()->id,
    'type' => 'transcript',
    'status' => 'approved',
    'comment' => 'Urgent request for transcript submission',
    'details' => [
        'number_of_copies' => 2,
        'delivery_method' => 'email',
    ],
    'submitted_at' => Carbon::now()->subDays(10),
    'reviewed_at' => Carbon::now()->subDays(8),
]
```

---

## 6. Factory Implementation (`database/factories/RequestFactory.php`)

**Features:**
- Generates unique references in REQ-YYYY-XXXX format
- Randomly selects from defined types and statuses
- Generates appropriate type-specific `details` for each type
- Creates realistic data with dates, delivery methods, course info, etc.

---

## 7. View Layer

### Create View (`resources/views/fo_requests/create.blade.php`)
**Features:**
- Type selection dropdown from Request::TYPES
- Dynamic form fields per type using JavaScript
- Shows/hides type-specific field sections based on selection
- Form sections:
  1. Request type selection
  2. Type-specific fields (dynamically shown)
  3. Optional comments
- Success/error message display
- Cancel and Submit buttons

### Index View (`resources/views/fo_requests/index.blade.php`)
**Features:**
- Search by reference or type (ilike search)
- Filter by status (dropdown)
- Search, Clear, and New Request buttons
- Displays flash success messages
- Shows paginated request list
- Enhanced pagination component

### Show View (`resources/views/fo_requests/show.blade.php`)
**Features:**
- Back navigation link
- Core request details card:
  - Type, Status, Submitted date, Reviewed date
  - Optional comments
- Type-specific details card showing all JSON details
- Student information sidebar:
  - Name, APOGEE number, Email, Department
- Timeline sidebar showing:
  - Submission date
  - Review date (if applicable)
  - Review status

### Components Updated:

**request-table-row.blade.php**
- Uses `reference` field instead of ID-based format
- Calls `typeLabel()` and `statusLabel()` for formatted display
- Uses `submitted_at` for date instead of created_at
- Links to detail view via route('requests.show')
- Updated status/type color configs for new types

**request-data-table.blade.php**
- No changes needed, works with updated row component

---

## 8. Routes (`routes/web.php`)

**Updated Resource Route:**
```php
Route::resource('requests', FORequestsController::class)
    ->only(['index', 'create', 'store', 'show'])
    ->middleware('auth.student');
```

**Available Routes:**
- GET `/requests` - List all requests (index)
- GET `/requests/create` - Show create form
- POST `/requests` - Store new request
- GET `/requests/{request}` - Show request details

---

## 9. Key Architectural Advantages

✅ **Normalized Core** - Single requests table with relational integrity
✅ **Flexible Schema** - JSON details field accommodates 7+ request types
✅ **Type-Safe Validation** - Server-side validation per type
✅ **Reference Tracking** - Human-readable REQ-YYYY-XXXX format
✅ **Searchable** - Filter by reference, type, or status
✅ **Scalable** - Easy to refactor into per-type tables if needed
✅ **User-Friendly** - Dynamic forms show only relevant fields
✅ **Admin-Ready** - Structure ready for admin review workflows

---

## 10. Next Evolution Paths

1. **File Uploads** - Add attachments to details or separate table
2. **Per-Type Workflows** - Different approval processes per request type
3. **Notifications** - Email updates on status changes
4. **Admin Dashboard** - Summary stats and bulk actions
5. **Type-Specific Tables** - Normalize into dedicated tables if complexity grows
6. **Real Authentication** - Replace hardcoded student_id with auth()->student()
7. **Messaging System** - Two-way communication for request clarification

---

## 11. Data Dictionary

### Request Model Fields

| Field | Type | Validation | Storage | Display |
|-------|------|-----------|---------|---------|
| reference | String | Unique | DB | REQ-2026-0001 |
| type | String | In TYPES keys | DB | Via typeLabel() |
| status | String | In STATUSES keys | DB | Via statusLabel() |
| details | JSON | Type-specific rules | DB (JSON) | Iterated display |
| submitted_at | Date | Date | DB (date) | M d, Y format |
| reviewed_at | DateTime | DateTime | DB (datetime) | M d, Y h:i A format |
| comment | Text | max:1000 | DB | Shown in detail view |

### Request Type Fields

| Type | Required Fields | Validation Rules |
|------|-----------------|------------------|
| transfer | destination_program, reason | string, max:255/1000 |
| withdrawal | course_code, course_name, reason | string, max:20/255/1000 |
| transcript | number_of_copies, delivery_method | integer 1-10, in: email/pickup/mail |
| leave | leave_type, start_date, end_date, reason | in: medical/personal/academic, date, after_or_equal |
| appeal | course_code, grade_received, reason | string, max:20/5/1000 |
| extension | assignment_name, requested_days, reason | string, integer 1-14, string |
| accommodation | accommodation_type, supporting_documentation, description | string, boolean, max:1000 |

---

## Summary

The Requests module now follows enterprise-grade architecture with:
- **Relational database** design for data integrity
- **Flexible JSON storage** for heterogeneous request types
- **Type-specific validation** at application layer
- **User-friendly interface** with dynamic forms
- **Comprehensive views** showing all relevant details
- **Scalable structure** ready for future enhancements

This mirrors the Demandes module architecture exactly, providing consistency across the application.
