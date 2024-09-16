<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Skill;
use App\Models\Screen;
use App\Models\MenuItems;
use Illuminate\Http\Request;
use App\Models\RolePermissions;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function ProfileData()
    {
        $profile = About::first();
        $skills = Skill::all();
        $response = [
            'status' => 200,
            'message' => 'Details',
            'profile' => $profile,
            'skills' => $skills
        ];
        return response()->json($response);
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        $credentials = $request->only('password');
        // Check if the input contains an email
        if (filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->input('username');
        } else {
            $credentials['username'] = $request->input('username');
        }

        if (Auth::guard('admin')->attempt($credentials)) {

            $user = Auth::guard('admin')->user();
            if ($user->role == 1) {
                $roleName = 'Admin';
            } else if ($user->role == 2) {
                $roleName = 'Finance';
            } else {
                $roleName = 'Administrative';
            }

            $userData = array(
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role,
                'role_name' => $roleName
            );

            return response()->json(array('status' => 200, 'message' => 'Logged in successfully', 'userDetails' => $userData));
        } else {
            return response()->json(array('status' => 404, 'message' => 'Incorrect Username or Password', 'userDetails' => []));
        }
    }

    // public function menuData(Request $request)
    // {
    //     $roleId = $request->role_id;
    //     $parentId = $request->parent_id;
    //     $query = $this->getMenuQuery($roleId, $parentId);

    //     // Print the results
    //     $output1 = array();
    //     foreach ($query as $result) {

    //         $output = $this->getMenuData($result);
    //         $output["level2Menus"] = $this->getLevel2MenuData($roleId, $result->miID);
    //         $output1[] = $output;
    //     }

    //     return response()->json(array('status' => 200, 'level1Menus' => $output1));
    // }

    // function getLevel2MenuData($roleId, $id) {
    //     $query2 = $this->getMenuQuery($roleId, $id);
    //     // Print the results
    //     $output12 = array();
    //     foreach ($query2 as $result2) {

    //         $output2 = $this->getMenuData($result2);
    //         $output2["level3Menus"] = $this->getLevel3MenuData($roleId, $result2->miID);
    //         $output12[] = $output2;
    //     }

    //     return $output12;
    // }

    // function getLevel3MenuData($roleId, $id) {
    //     $query2 = $this->getMenuQuery($roleId, $id);
    //     // Print the results
    //     $output12 = array();
    //     foreach ($query2 as $result2) {

    //         $output2 = $this->getMenuData($result2);
    //         $output12[] = $output2;
    //     }

    //     return $output12;
    // }

    public function menuData(Request $request)
    {
        $roleId = $request->role_id;
        $parentId = $request->parent_id;

        $output1 = $this->getMenuDataWithSubmenus($roleId, $parentId, 'getLevel2MenuData');

        return response()->json(['status' => 200, 'mainMenus' => $output1]);
    }

    function getLevel2MenuData($roleId, $id)
    {
        return $this->getMenuDataWithSubmenus($roleId, $id, 'getLevel3MenuData');
    }

    function getLevel3MenuData($roleId, $id)
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
            'menu_items.menu_name',
            'menu_items.url',
            'menu_items.parent_id',
            'menu_items.level',
            'menu_items.id as miID',
            'role_permissions.can_read',
            'role_permissions.can_create',
            'role_permissions.can_update',
            'role_permissions.can_delete'
        )
            ->leftJoin('role_permissions', 'screen.id', '=', 'role_permissions.screen_id')
            ->leftJoin('menu_items', 'menu_items.screen_id', '=', 'screen.id')
            ->where('role_permissions.role_id', $roleId)
            ->where('menu_items.parent_id', $parentId)
            ->where('menu_items.is_active', 1)
            ->get();

        return $query;
    }

    function getMenuData($result)
    {
        $output = array(
            'id' => $result->id,
            'screen_name' => $result->screen_name,
            'menu_name' => $result->menu_name,
            'parent_id' => $result->parent_id,
            'level' => $result->level,
            'miID' => $result->miID,
            'url' => $result->url ? $result->url : "",
            'can_read' => $result->can_read,
            'can_create' => $result->can_create,
            'can_update' => $result->can_update,
            'can_delete' => $result->can_delete
        );

        return $output;
    }

    function screenData()
    {
        $query = DB::table('screen')
            ->select('id', 'screen_name')
            ->orderBy('id', 'DESC')
            ->get();

        $screens = array();

        foreach ($query as $row) {
            $output['id'] = $row->id;
            $output['name'] = $row->screen_name;
            $screens[] = $output;
        }

        return response()->json(['status' => 200, 'screens' => $screens]);
    }

    function createUpdateScreen(Request $request)
    {
        // OR using Query Builder

        // Data to be inserted or updated
        $data = [
            'id' => $request->screenID,
            'screen_name' => $request->screenName
        ];

        // Define the conditions to check for an existing record
        $condition = [
            'id' => $request->screenID
        ];

        // Perform the update or insert
        DB::table('screen')->updateOrInsert($condition, $data);

        $message = $request->screenID ? "Screen updated successfully." : "Screen saved successfully.";

        return response()->json(['status' => 200, 'message' => $message]);
    }

    function edit($id)
    {
        $screen = DB::table('screen')->where('id', $id)->first();
        return response()->json(['status' => 200, 'screen' => $screen]);
    }

    function destroy($id)
    {
        DB::table('screen')->where('id', $id)->delete();
        return response()->json(['status' => 200, 'message' => "Screen deleted successfully."]);
    }

    function roleList()
    {
        $query = DB::table('roles')->select('id', 'role_name')->get();

        $roles = array();

        foreach ($query as $key => $value) {
            $output['id'] = $value->id;
            $output['name'] = $value->role_name;
            $roles[] = $output;
        }

        return response()->json(['status' => 200, 'roles' => $roles]);
    }
    function screenPermissionData()
    {

        $query = DB::table('role_permissions as rp')
            ->select(
                'rp.id',
                'rp.role_id',
                'rp.screen_id',
                'r.role_name',
                's.screen_name',
                DB::raw("IF(rp.can_read = 1, 'TRUE', 'FALSE') AS canRead"),
                DB::raw("IF(rp.can_create = 1, 'TRUE', 'FALSE') AS canCreate"),
                DB::raw("IF(rp.can_update = 1, 'TRUE', 'FALSE') AS canUpdate"),
                DB::raw("IF(rp.can_delete = 1, 'TRUE', 'FALSE') AS canDelete")
            )
            ->leftJoin('roles as r', 'r.id', '=', 'rp.role_id')
            ->leftJoin('screen as s', 's.id', '=', 'rp.screen_id')
            ->orderBy('id', 'DESC')
            ->get();


        $permissions = array();

        foreach ($query as $key => $value) {
            $output['id'] = $value->id;
            $output['role_id'] = $value->role_id;
            $output['screen_id'] = $value->screen_id;
            $output['role_name'] = $value->role_name;
            $output['screen_name'] = $value->screen_name;
            $output['canRead'] = $value->canRead;
            $output['canCreate'] = $value->canCreate;
            $output['canUpdate'] = $value->canUpdate;
            $output['canDelete'] = $value->canDelete;
            $permissions[] = $output;
        }

        return response()->json(['status' => 200, 'permissions' => $permissions]);
    }

    function createUpdateScreenPermission(Request $request)
    {
        // OR using Query Builder

        // Data to be inserted or updated
        $data = [
            'id' => $request->permissionID,
            'role_id' => $request->roleId,
            'screen_id' => $request->screenId,
            'can_read' => $request->canRead,
            'can_create' => $request->canCreate,
            'can_update' => $request->canUpdate,
            'can_delete' => $request->canDelete
        ];

        // Define the conditions to check for an existing record
        $condition = [
            'id' => $request->permissionID
        ];

        // Perform the update or insert
        DB::table('role_permissions')->updateOrInsert($condition, $data);

        $message = $request->permissionID ? "Screen Permission updated successfully." : "Screen Permission added successfully.";

        return response()->json(['status' => 200, 'message' => $message]);
    }

    function editPermission($id)
    {
        $permission = DB::table('role_permissions')->where('id', $id)->first();

        return response()->json(['status' => 200, 'permission' => $permission]);
    }

    function deletePermission($id)
    {
        DB::table('role_permissions')->where('id', $id)->delete();
        return response()->json(['status' => 200, 'message' => "Permission deleted successfully."]);
    }

    function menuItems()
    {
        $query = DB::table('menu_items as mi')
            ->select(
                'mi.id',
                'mi.menu_name',
                'mi.screen_id',
                'mi.url',
                'mi.parent_id',
                's.screen_name',
            )
            ->leftJoin('screen as s', 's.id', '=', 'mi.screen_id')
            ->orderBy('mi.id', 'DESC')
            ->get();


        $menuItems = array();

        // Pre-fetch parent menu names
        $parentIds = $query->pluck('parent_id')->unique()->filter()->values();
        $parents = MenuItems::whereIn('id', $parentIds)->pluck('menu_name', 'id')->toArray();

        foreach ($query as $key => $value) {
            $output['id'] = $value->id;
            $output['menu_name'] = $value->menu_name;
            $output['screen_id'] = $value->screen_id;
            $output['url'] = $value->url;
            $output['screen_name'] = $value->screen_name;
            $output['parent'] = $parents[$value->parent_id] ?? null;
            $menuItems[] = $output;
        }

        return response()->json(['status' => 200, 'menuItems' => $menuItems]);
    }

    function createUpdateMenuItem(Request $request)
    {
        // OR using Query Builder

        // Data to be inserted or updated
        $data = [
            'id' => $request->menuItemID,
            'parent_id' => $request->parentID,
            'menu_name' => $request->menuName,
            'screen_id' => $request->screenID,
            'url' => $request->url,
            'level' => $request->level,
            'is_active' => $request->isActive
        ];

        // Define the conditions to check for an existing record
        $condition = [
            'id' => $request->menuItemID
        ];

        // Perform the update or insert
        DB::table('menu_items')->updateOrInsert($condition, $data);

        $message = $request->menuItemID ? "MenuItem updated successfully." : "MenuItem added successfully.";

        return response()->json(['status' => 200, 'message' => $message]);
    }

    function editMenuItem($id)
    {
        $menuItem = DB::table('menu_items')->where('id', $id)->first();

        return response()->json(['status' => 200, 'menuItem' => $menuItem]);
    }

    function deleteMenuItem($id)
    {
        DB::table('menu_items')->where('id', $id)->delete();
        return response()->json(['status' => 200, 'message' => "MenuItem deleted successfully."]);
    }

}
