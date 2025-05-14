<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['parent_id', 'icon', 'name', 'url', 'permission', 'order', 'enabled'];

    public function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['parent_id']) {
                $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getChildren($data, $line1) ]) ]);
            }
        }
        return $children;
    }
    public function optionsMenu()
    {
        return $this->where('enabled', 1)
            ->orderby('parent_id')
            ->orderby('order')
            ->orderby('name')
            ->get()
            ->toArray();
    }

    public static function menus()
    {
        $menus = new Menu();
        $data = $menus->where('enabled', 1)
            ->where('parent_id', null)
            ->orderby('parent_id')
            ->orderby('order')
            ->orderby('name')
            ->get()
            ->toArray();
        $data2 = $menus->optionsMenu();
        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menus->getChildren($data2, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        //dd($menuAll);
        return $menus->menuAll = $menuAll;
    }

    public static function settings()
    {
        $menus = new Menu();
        $data = $menus->where('enabled', 1)
            ->where('permission', "setting")
            ->orderby('parent_id')
            ->orderby('order')
            ->orderby('name')
            ->get()
            ->toArray();
        //dd($data);
        $data2 = $menus->optionsMenu();
        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menus->getChildren($data2, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        //dd($menuAll);
        return $menus->menuAll = $menuAll;
    }
}
