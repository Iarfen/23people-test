<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function users()
    {
        $users = DB::select("select * from users");
        $result = json_encode($users);
        return response($result, 200)
                  ->header('Content-Type', 'application/json');
    }

    public function get($id_user)
    {
        $user = DB::select("select * from users where id = ?",[$id_user]);
        $result = json_encode($user[0]);
        if ($user)
        {
            return response($result, 200)
            ->header('Content-Type', 'application/json');
        }
        else
        {
            return response($result, 404)
            ->header('Content-Type', 'application/json');
        }
    }

    public function insert(Request $request)
    {
        $name = $request->input('name');
        $last_name = $request->input('last_name');
        $rut = $request->input('rut');
        $age = $request->input('age');
        $course = $request->input('course');
        if ($name == "" || $last_name == "" || $rut == "" || $age == "" || $course == "")
        {
            return response('',404);
        }
        else
        {
            $insert_user = DB::insert("insert into users (name,last_name,rut,age,course) values (?,?,?,?,?)",[$name,$last_name,$rut,$age,$course]);
            if ($insert_user > 0)
            {
                return response('',201);
            }
            else
            {
                return response('',400);
            }
        }
    }

    public function update(Request $request,$id_user)
    {
        $name = $request->input('name');
        $last_name = $request->input('last_name');
        $rut = $request->input('rut');
        $age = $request->input('age');
        $course = $request->input('course');
        $update_user = DB::update("update users set name=?,last_name=?,rut=?,age=?,course=? where id = ?",[$name,$last_name,$rut,$age,$course,$id_user]);
        if ($update_user > 0)
        {
            return response('',200);
        }
        else
        {
            return response('',100);
        }
    }

    public function delete(Request $request,$id_user)
    {
        $delete_user = DB::delete("delete from users where id = ?",[$id_user]);
        if ($delete_user > 0)
        {
            return response('',200);
        }
        else
        {
            return response('',404);
        }
    }
}
