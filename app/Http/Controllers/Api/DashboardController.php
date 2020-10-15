<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function searchConnection(Request $request)
    {
    	try
    	{
    		$connectionData=User::searchConnectionRecords($request->search);

    		if($request->request_call=='web')
    		{
    			return view('searched_connection_data',compact('connectionData'))->render();
    		}
    		else
    		{
    			return response()->json([
	                'message' => 'success',
	                'data'=>$connectionData,
	                'status'=>1,
	                'code'=>'201'
	            ], 201);
    		}

    	}catch (Exception $ex)
        {
            return response()->json([
                'message' => $ex->message,
                'status'=>0,
                'code'=>'404'
            ], 404);
        }
    }
}
