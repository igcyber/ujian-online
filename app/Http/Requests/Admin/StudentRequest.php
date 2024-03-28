<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Student;

class StudentRequest extends FormRequest
{
    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nisn' => 'required|unique:students',
            'gender' => 'required|string',
            'password' => 'required|confirmed',
            'classroom_id' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Siswa Wajib Terisi',
            'name.max' => 'Maksimal Karakter 255',
            'nisn.required' => 'NISN Wajib Terisi',
            'nisn.unique' => 'NISN Sudah Digunakan',
            'gender.required' => 'Jenis Kelamin Wajib Dipilih',
            'password.required' => 'Password Wajib Terisi',
            'password.confirmed' => 'Konfirmasi Password Tidak Sesuai',
            'classroom_id.required' => 'Kelas Wajib Dipilih'
        ];
    }
}
