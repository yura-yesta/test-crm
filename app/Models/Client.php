<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'description'];


    #[ArrayShape(['name' => "string[]", 'email' => "array", 'phone' => "string[]", 'description' => "string[]"])] public static function validation_rules($id = null): array
    {

        $unique = $id ? Rule::unique('clients')->ignore($id) : Rule::unique('clients');

        return array(
            'name' => ['required', 'string', 'max:20', 'min:5'],
            'email' => ['required', 'email', 'string', $unique],
            'phone' => ['required'],
            'description' => ['required', 'min:5']
        );
    }

}
