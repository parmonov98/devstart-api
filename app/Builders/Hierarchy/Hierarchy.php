<?php

namespace App\Builders\Hierarchy;

class Hierarchy
{
    private $id;
    private $name;
    private $model;
    private $parentColumnName = "parent_id";

    public function __construct(String $model)
    {
        $this->model = new $model();
    }

    public function SetParentColumn($parentColumnName)
    {
        $this->parentColumnName = $parentColumnName;
        return $this;
    }

    public function SetIdNamePair(array $idNameArray)
    {
        $this->id = $idNameArray[0];
        $this->name = $idNameArray[1];
        return $this;
    }

    protected function MakeHierarchicalOptions(&$result = [], $parent_id = null, $level = 0)
    {
        $items = $this->model::query();

        if(is_null($parent_id)) {
            $items->whereNull($this->parentColumnName);
        } else {
            $items->where($this->parentColumnName, '=', $parent_id);
        }

        $items = $items->pluck($this->name, $this->id)->toArray();

        foreach ($items as $id => $value) {
            $result[$id] = " " . str_repeat("-", $level) . " " . $value;
            $this->MakeHierarchicalOptions($result, $id, $level+1);
        }
    }

    public function Make()
    {
        $items = [];
        $this->MakeHierarchicalOptions($items);
        return $items;
    }
}
