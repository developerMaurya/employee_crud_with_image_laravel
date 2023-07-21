<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(){
        // $employees=Employee::orderBy('id','DESC')->get();  // working 
        $employees=Employee::orderBy('id','DESC')->paginate(5);
        return view('employee.list',['employees'=>$employees]);
    }
    // create
    public function create(){
        return view('employee.create');
    }
    // method for add employee
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'image'=>'sometimes|image:gif,png,jpeg,jpg',
        ]);
        if($validator->passes()){
            // new is use to create a new data
            $employee=new Employee();
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->address=$request->address;
            $employee->save();

            // upload image here
            if($request->image){
                $ext=$request->image->getClientOriginalExtension();
                $newFileName=time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);  // save file in folder
                // update in db as image in image filed
                $employee->image=$newFileName;
                $employee->save();
            }   

            $request->session()->flash('success','Employee added successfully.');

            return redirect()->route('employees.index');
        }else{
            // return with error
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }
    // Edit 

    public function edit($id){
        $employee=Employee::findORFail($id);
        
        return view('employee.edit',['employee'=>$employee]);
    }
    // update 

    public function update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'image'=>'sometimes|image:gif,png,jpeg,jpg',
        ]);
        if($validator->passes()){
            // check there is not use new becuse we update , not a create 
            $employee=Employee::find($id);
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->address=$request->address;
            $employee->save();

            // upload image here
            if($request->image){
                $oldImage=$employee->image;
                $ext=$request->image->getClientOriginalExtension();
                $newFileName=time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);  // save file in folder
                // update in db as image in image filed
                $employee->image=$newFileName;
                $employee->save();

                File::delete(public_path().'/uploads/employees/',$oldImage);
            }   

            $request->session()->flash('success','Employee updated successfully.');

            return redirect()->route('employees.index');
        }else{
            // return with error
            return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
        }
    }
    // delete
    public function destroy($id,Request $request){
        $employee=Employee::findOrFail($id);
        File::delete(public_path().'uploads/employees/'.$employee->image);
        $employee->delete();
        $request->session()->flash('success','Employee Deleted Successfully');
        return redirect()->route('employees.index');
    }
    // end
}
