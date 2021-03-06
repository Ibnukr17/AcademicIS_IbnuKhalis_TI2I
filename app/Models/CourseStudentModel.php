<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\CourseModel;

class CourseStudentModel extends Model
{
    use HasFactory;
    protected $table='course_student';
    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'course_id',
        'value',
    ];

}
