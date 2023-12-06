<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index(){
        $data = Country::orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
             'message' => 'Data Ditemukan',
             'data' => $data
        ],200);
    
    }

    public function find(string $id){
        $country = Country::find($id)->get();
        if($country){
            return response()->json([
                'status' => true,
                'message' => 'Data Ditemukan',
                'data' => $country
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => null
            ],200);
        }
      
    }

    public function store(Request $request){
        $dataCountry = new Country();
        $rules = [
            'id' => 'required',
            'nama' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'failed',
                'data' => $validator->errors()
            ]);
        }

        $dataCountry->id = $request->id;
        $dataCountry->nama = $request->nama;
        $post = $dataCountry->save();
       
        return response()->json([
            'status' => true,
            'message' => 'insert country success'
        ],200);
        
    }

    public function update(Request $request, string $id){
        $country = Country::find($id);
        if(empty($country)){
            return response() -> json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan'
                
            ],404);

        }

        $rules = [
            'id' => 'required',
            'nama' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'failed',
                'data' => $validator->errors()
            ]);
        }

        $country->id = $request->input('id');
        $country->nama = $request->input('nama');
        $country->save();
       
        return response()->json([
            'status' => true,
            'message' => 'update country success'
        ],200);
        
    }

    public function destroy(string $id){
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
                'data' => null
            ],404);
        }

        $country->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete success'
        ],200);
    }


}
