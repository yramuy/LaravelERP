<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menuList(Request $request)
    {
        $roleId = $request->role_id;
        $parentId = $request->parent_id;

        $output = $this->getMenuDataWithSubmenus($roleId, $parentId, 'getLevel2MenuData');

        return response()->json(['status' => 200, 'mainMenus' => $output]);
    }

    function getLevel2MenuData($roleId, $id)
    {
        return $this->getMenuDataWithSubmenus($roleId, $id);
    }

    function getMenuDataWithSubmenus($roleId, $parentId, $submenuFunction = null)
    {
        $query = $this->getMenuQuery($roleId, $parentId);
        $output = [];

        foreach ($query as $result) {
            $menuData = $this->getMenuData($result);
            if ($submenuFunction) {
                $menuData["subMenus"] = $this->$submenuFunction($roleId, $result->miID);
            }
            $output[] = $menuData;
        }

        return $output;
    }

    function getMenuQuery($roleId, $parentId)
    {
        $query = Screen::select(
            'screen.id',
            'screen.screen_name',
            'menu_item.menu_title',
            'menu_item.url',
            'menu_item.icon',
            'menu_item.parent_id',
            'menu_item.level',
            'menu_item.id as miID',
            'user_role_screen.can_read',
            'user_role_screen.can_create',
            'user_role_screen.can_update',
            'user_role_screen.can_delete'
        )
            ->leftJoin('user_role_screen', 'screen.id', '=', 'user_role_screen.screen_id')
            ->leftJoin('menu_item', 'menu_item.screen_id', '=', 'screen.id')
            ->where('user_role_screen.user_role_id', $roleId)
            ->where('menu_item.parent_id', $parentId)
            ->where('menu_item.status', 1)
            ->get();

        return $query;
    }

    function getMenuData($result)
    {
        $output = array(
            'id' => $result->id,
            'screen_name' => $result->screen_name,
            'menu_name' => $result->menu_title,
            'parent_id' => $result->parent_id,
            'level' => $result->level,
            'miID' => $result->miID,
            'url' => $result->url ? $result->url : "",
            'icon' => $result->icon ? $result->icon : "",
            'can_read' => $result->can_read,
            'can_create' => $result->can_create,
            'can_update' => $result->can_update,
            'can_delete' => $result->can_delete
        );

        return $output;
    }
}
