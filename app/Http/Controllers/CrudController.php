<?php

namespace App\Http\Controllers;
use App\Models\Crud;
use Illuminate\Http\Request;
//use File;
use Illuminate\Support\Facades\File;


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
            'name'  => 'required',
            'email' => 'required',
            'image' =>'required'
        ]);
        $imageName= '';
        if($image = $request->file('image')){
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('image/products',$imageName);
        }

      Crud::create([
     'name'=>$request->name,
     'email'=>$request->email,
     'image'=>$imageName,

    ]);
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
        $crud  = Crud::findOrFail($id);
        $imageName = '';
        $deleteOldImage = 'image/products/'.$crud->image;

        if ($image = $request->file('image')) {
            if (file_exists($deleteOldImage)) {
                File::delete($deleteOldImage);
            }
            $imageName = time().'_'.uniqid().'_'.$image->getClientOriginalName();
            $image->move('image/products',$imageName);
        } else {
            $imageName = $crud->image;
        }
        Crud::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'image'=>$imageName,
        ]);
        return redirect()->back()->with('upDate', 'Data Updated!');
    }
        //delete data

        public function deleteData($id){

            $deleteData = Crud::findOrFail($id);
            $deleteOldImage = 'image/products/'.$deleteData->image;
            if (file_exists($deleteOldImage)) {
                File::delete($deleteOldImage);
            }
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
