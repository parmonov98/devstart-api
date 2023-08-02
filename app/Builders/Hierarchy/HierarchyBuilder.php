<?php

namespace App\Builders\Hierarchy;

class HierarchyBuilder {
    private $id;
    private $name;
    private $model;
    private $parentColumnName = 'parent_id';

    public function __construct(string $model) {
        $this->model = new $model();
    }

    public function SetParentColumn($parentColumnName) {
        $this->parentColumnName = $parentColumnName;

        return $this;
    }

    public function SetIdNamePair(string $id, string $name) {
        $this->id = $id;
        $this->name = $name;

        return $this;
    }

    protected function MakeHierarchicalOptions(array &$result = [], int $parent_id = null, int $level = 0) {
        $items = $this->model::query();

        if (is_null($parent_id)) {
            $items->whereNull($this->parentColumnName);
        } else {
            $items->where($this->parentColumnName, '=', $parent_id);
        }

        $items = $items->pluck($this->name, $this->id)->toArray();

        foreach ($items as $id => $value) {
            $result[$id] = ' ' . str_repeat('-', $level) . ' ' . $value;
            $this->MakeHierarchicalOptions($result, $id, $level + 1);
        }
    }

    public function Make(): array {
        $items = [];
        $this->MakeHierarchicalOptions($items);

        return $items;
    }
}
