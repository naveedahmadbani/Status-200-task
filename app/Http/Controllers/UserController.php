<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserTree;
use Illuminate\Support\Facades\Hash;
use DB;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }
    public function show()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }
    public function create()
    {
        $users = User::all();
        return view('user.create1',compact('users'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['parrent'][0][0] = $data['grand_parent'];

        $user = new User();
        $user->parent_id = json_encode($data['parrent'],true);
        // $user->id = json_encode($data['id'],true);
        $user->name = json_encode($data['name'],true);
        $user->age = json_encode($data['age'],true);
        $user->veteran = json_encode($data['veteran'],true);
        $user->save();
        return redirect()->route('user.index')->with('message', 'User Created Successfully!');

    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit',compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($request->id);

        $data = $request->all();
        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;

        if ($request->hasFile('image'))
            $data['image'] = $this->saveFile($request->image, 'images/user');

        $user->update($data);

        return redirect()->route('user.index')->with('message','User Edited Successfully!');
    }
    public function  destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('user.index')->with('message','User Deleted Successfully!');
    }
    public function  addChildsHtml(Request $request)
    {
        $id = $request->id + 1;
        $scnd=$request->index_count;

        $parentDataId = $request->parentDataId;

        $html=
        '<div class="row margin-wrap" data-id="'.$scnd.'" id="'.$scnd.'">
                <div class="col-sm-2">
                    <label for="Id" class="form-label">ID</label>
                    <input type="text" class="form-control" required value="'.$id.'" name="id[]" placeholder="Enter ID">
                </div>
                <div class="col-sm-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" required value="'.$parentDataId.'" name="name[]" placeholder="Enter Name">
                </div>
                <div class="col-sm-2">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" required name="age[]" placeholder="Enter Age">
                </div>
                <div class="col-sm-2">
                    <label for="veteran" class="form-label">Veteran</label>
                    <input type="text" class="form-control" required name="veteran[]" placeholder="Enter Yes/No">
                </div>
                <div class="col-sm-2 buttons">
                    <button type="submit" class="btn btn-default btn-primary">Save</button>
                    <button type="button" class="btn btn-default btn-dark add-childs" id="'.$parentDataId.'" data-id="'.$parentDataId.'" onclick="addChildsOnClick(this)">Add Childrens</button>

                </div>
                <div class="child-html child-html-'.$id.$parentDataId.'" data-parent-id="'.$id.$parentDataId.'" data-row_id="'.$scnd.'"></div>

            </div>';

        $data['html'] = $html;
        $data['id'] = (int)$request->id;
        $data['data_id'] = (int)$request->parentDataId;
        return $data;
    }
}
