<?php

namespace App\Traits;

trait HasHierarchyTrait {
    protected static function GetParentColumn() {
        return 'parent_id';
    }

    protected static function GetIdValuePair() {
        return ['name', 'id'];
    }

    protected static function MakeHierarchicalOptions(&$result = [], $parent_id = null, $level = 0) {
        $items = self::query();

        if (is_null($parent_id)) {
            $items->whereNull(self::GetParentColumn());
        } else {
            $items->where(self::GetParentColumn(), '=', $parent_id);
        }

        $items = $items->pluck(self::GetIdValuePair()[0], self::GetIdValuePair()[1])->toArray();

        foreach ($items as $id => $value) {
            $result[$id] = ' ' . str_repeat('-', $level) . ' ' . $value;
            self::MakeHierarchicalOptions($result, $id, $level + 1);
        }
    }

    public static function GetOptions() {
        $items = [];
        self::MakeHierarchicalOptions($items);

        return $items;
    }
}
