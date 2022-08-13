<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User ;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{
      
    public function index(Request $request)
    {

        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'));

    }// end of index

    public function create()
    {

        $roles = Role::pluck('name','name')->all();
        return view('users.add',compact('roles'));

    }// end of create

    public function store(Request $request)
    {

        $this->validate($request, [

        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'role_name' => 'required',
        'status'=>'required'
        ]);
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','User created successfully');

    }// end of store
 
    public function show($id)
    {

        $user = User::find($id);
        return view('users.show',compact('user'));

    }// end of show
  
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.update',compact('user','roles','userRole'));

    }// end of edit
    
    public function update(Request $request, $id)
    {

        $this->validate($request, [

        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'role_name' => 'required',
        'status'=>'required'
        
        ]);
       
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
            }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('role_name'));
            return redirect()->route('users.index')
            ->with('success','User updated successfully');
        return $request;

    }// end of update
   
    public function destroy(Request $request)
    {

        User::find($request->user_id)->delete();
        return redirect()->route('users.index')
        ->with('danger','User deleted successfully');

    }// end of destroy
}