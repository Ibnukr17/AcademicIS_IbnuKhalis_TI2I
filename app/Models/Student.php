<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\KelasModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CourseModel;
use App\Models\CourseStudentModel;

class Student extends Model
{
    // use HasFactory;
    protected $table = 'student'; // Eloquent will create a student model to store records in the student table     protected  $primaryKey = 'id_student'; // Calling DB contents with primary key
    public $timestamps = false;
    protected $primaryKey = 'nim'; //calling DB contents with primary key
    /**
     *	The attributes that are mass assignable.
     *
     *	@var array
     */
    protected $fillable = [
        'Nim',
        'Name',
        'Kelas',
        'Major',
        'Address',
        'DateOfBirth',
    ];

    public function kelas(){
        return $this->belongsTo(KelasModel::class);
    }

    public function course()
    {
        return $this->belongsToMany(CourseModel::class,'course_student','student_id','course_id')->withPivot('value');
    }
}
