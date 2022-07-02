<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\KelasModel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // the eloquent function to displays data
        // $student = Student::all(); // Mengambil semua isi tabel
        $student = Student::with('kelas')->get();
        // $student=DB::table('student')->paginate(3);
        $paginate = Student::orderBy('id_student', 'asc')->paginate(3);
        return view('student.index', ['student' => $student, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = KelasModel::all();
        return view('student.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Kelas' => 'required',
            'Major' => 'required',
            'Address' => 'required',
            'DateOfBirth' => 'required',
        ]);

        $student = new Student;
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->major= $request->get('Major');
        $student->address= $request->get('Address');
        $student->dateofbirth= $request->get('DateOfBirth');
        $student->save();

        $kelas = new KelasModel();
        $kelas->id = $request->get('Kelas');

        // eloquent function to add data using belongsTo relation
        // Student::create($request->all());
        $student->kelas()->associate('kelas');
        $student->save();

        return redirect()->route('student.index')
            ->with('success', 'Student Successfully Added');


        // if the data is added successfully, will return to the main page

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        // displays detailed data by finding / by Student Nim
        $Student = Student::with('kelas')->where('nim', $nim)->first();
        return view('student.detail', ['Student' => $Student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
         // displays detail data by finding based on Student Nim for editing
         $Student = Student::with('kelas')->where('nim', $nim)->first();
         $kelas = KelasModel::all();
         return view('student.edit', compact('Student', 'kelas'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //validate the data
        $request->validate([
            'Nim' => 'required',
            'Name' => 'required',
            'Kelas' => 'required',
            'Major' => 'required',
            'Address' => 'required',
            'DateOfBirth' => 'required',
        ]);

        $student = Student::with('kelas')->where('nim', $nim)->first();
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        // $student->kelas = $request->get('Kelas');
        $student->major = $request->get('Major');
        $student->address = $request->get('Address');
        $student->dateofbirth = $request->get('DateOfBirth');
        $student->save();

        $kelas = new KelasModel();
        $kelas->id = $request->get('Kelas');
        //Eloquent function to update the data
        // Student::where('nim', $nim)
        //     ->update([
        //         'nim' => $request->Nim,
        //         'name' => $request->Name,
        //         'kelas' => $request->Class,
        //         'major' => $request->Major,
        //         'address' => $request->Address,
        //         'DateOfBirth' => $request->DateOfBirth,
        //     ]);

        //if the data successfully updated, will return to main page
        return redirect()->route('student.index')
            ->with('success', 'Student Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //Eloquent function to delete the data
        Student::where('nim', $nim)->delete();
        return redirect()->route('student.index')
            ->with('success', 'Student Successfully Deleted');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $student = Student::where('name', 'like', "%" . $keyword . "%")
        ->orWhere('nim', 'like', "%" . $keyword . "%")
        ->orWhere('kelas', 'like', "%" . $keyword . "%")
        ->orWhere('major', 'like', "%" . $keyword . "%")
        ->orWhere('address', 'like', "%" . $keyword . "%")
        ->orWhere('dateofbirth', 'like', "%" . $keyword . "%")
        ->paginate(3);
        return view('student.search', compact('student'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }
}
