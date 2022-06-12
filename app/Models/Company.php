<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'description'];


    #[ArrayShape(['name' => "string[]", 'email' => "array", 'phone' => "string[]", 'description' => "string[]"])] public static function validation_rules($id = false): array
    {

        $unique = $id ? Rule::unique('companies')->ignore($id) : Rule::unique('companies');

        return array(
            'name' => ['required', 'string', 'max:20', 'min:5'],
            'email' => ['required', 'email', 'string', $unique],
            'phone' => ['required', 'int'],
            'description' => ['required', 'min:20']
        );
    }

    public static function paginateEntries($obj): string
    {

        if($obj->total() < 1) return '';

        $total = ($obj->currentPage()*$obj->perPage()) > $obj->total() ? $obj->total() : $obj->currentPage()*$obj->perPage();

        return 'Showing '.$obj->currentPage()*$obj->perPage() - ($obj->perPage() - 1).' to '.($total).' of '.$obj->total().' entries...' ;
    }

}
