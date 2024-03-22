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
        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string|max:255',
                'nisn' => 'required|unique:students',
                'gender' => 'required|string',
                'password' => 'required|confirmed',
                'classroom_id' => 'required'
            ];
        } elseif ($this->isMethod('put')) {
            $rules = [
                'name' => 'required|string|max:255',
                'nisn' => 'required|unique:students,nisn,' . $this->student->id,
                'gender' => 'required|string',
                'classroom_id' => 'required',
                'password' => 'confirmed'
            ];
        }

        return $rules;
    }
}
