<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = ['id_company', 'id_client'];

    public static function all_relations($id, $field = 'id_company'): bool|array
    {
        $ids = [];
        $items = self::all()->where($field, $id);

        if (empty($items)) {
            return false;
        }

        foreach ($items as $item) {
            $ids[] = $field === 'id_company'? $item->id_client : $item->id_company;
        }

        return $ids;
    }

    public static function add_relation($id_company, $id_client): bool|object
    {
        if (self::all()->where('id_company', $id_company)->where('id_client', $id_client)) {
            return self::create(['id_company' => $id_company, 'id_client' => $id_client]);
        }

        return false;
    }

}
