<?php

namespace App\Http\Controllers;

use App\Models\dataModel;
use Illuminate\Http\Request;

class dataController extends Controller
{
    public function index(){

      return view('test');
   }

   // Fetch DataTable data
   public function getData(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column alamat
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Custom search filter 
        $searchCity = $request->get('searchCity');
        $searchGender = $request->get('searchGender');
        $searchName = $request->get('searchnama');

        // Total records
        $records = dataModel::select('count(*) as allcount');

        $totalRecords = $records->count();

        // Total records with filter
        $records = dataModel::select('count(*) as allcount')->where('nama', 'like', '%' . $searchValue . '%');

        $totalRecordswithFilter = $records->count();

        // Fetch records
        $records = dataModel::orderBy($columnName, $columnSortOrder)
            ->select('tektest.*')
            ->where('tektest.nama', 'like', '%' . $searchValue . '%');
        ## Add custom filter conditions
        if (!empty($searchName)) {
            $records->where('nama', 'like', '%' . $searchName . '%');
        }
        $datas = $records->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($datas as $data) {

            $nama = $data->nama;
            $alamat = $data->alamat;
            $jenis_kelamin = $data->jenis_kelamin;

            $data_arr[] = array(
                "nama" => $nama,
                "alamat" => $alamat,
                "jenis_kelamin" => $jenis_kelamin
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response); 
   }

}
