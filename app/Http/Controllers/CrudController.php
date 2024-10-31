<?php

namespace App\Http\Controllers;
use App\Models\Crud;
use Illuminate\Http\Request;


class CrudController extends Controller
{
    public function showData(){
        $showData = Crud::all();
        return view('show_data',compact('showData'));
    }
    public function addData(){
        return view('add_data');
    }
    public function storeData(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $crud  = new Crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();
        return redirect()->back()->with('message', 'Data Inserted!');

    }
    //edit data start here

    public function editData($id){
        $editData = Crud::find($id);
        return view ('edit_data',compact('editData'));
    }
    public function updateData(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $crud  = Crud::find($id);
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();
        return redirect()->back()->with('upDate', 'Data Updated!');
    }
        //delete data

        public function deleteData($id){
            $deleteData = Crud::find($id);
            $deleteData->delete();
            return redirect()->back()->with('DeleteData', 'Data Deleted!');
        }
        //search data
            public function searchData(Request $request)
        {
            $search = $request->input('search');
            $showData = Crud::where('name', 'like', "%$search%")->get();

            return view('show_data',compact('showData'));
        }

}
