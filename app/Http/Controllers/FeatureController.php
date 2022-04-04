<?php

namespace App\Http\Controllers;

use App\HttpRequest;
use Illuminate\Http\Request;
use Session;
use Redirect;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->HttpRequest = new HttpRequest;
	}

    public function mainFeature(Request $request)
    {
        $postParam = $request->post();
        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 5;

        $data_feature = $this->HttpRequest("GET", "/feature?page=".$page."&take=".$take, null)->json();


        if(isset($postParam['addFeature']))
        {
            $param = [
                'feature_id'    => $postParam['featureName'],
                'description'   => $postParam['description']
            ];
            
            $add_feature = $this->HttpRequest("POST","/feature/main",$param);

            if(!empty($add_feature)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/main-feature');
        }

        if(isset($postParam['editFeature']))
        {
            $idFeature = $postParam['idFeature'];

            $param = [
                'feature_id'    => $postParam['featureName'],
                'description'   => $postParam['description']
            ];
            
            $add_feature = $this->HttpRequest("PUT","/feature/".$idFeature ,$param);

            if(!empty($add_feature)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
            return Redirect::to('/main-feature');
        }

        $data = [
            'data_feature'  => $data_feature['data'],
            'meta'          => (object) $data_feature['meta'],
            'page'          => $page,
            'take'          => $take,
            "number"        => (int) ($page * $take)-($take -1),
            'prevPage'      => (int) $page - 1,
            'nextPage'      => (int) $page + 1,
        ];

        return view('feature.main-feature-list')->with($data);
    }

    public function subFeature(Request $request)
    {
        $postParam = $request->post();
        $idmain =  $request->get('id');
        $page = $request->get('page') ? $request->get('page') : 1;
        $take = $request->get('take') ? $request->get('take') : 5;

        // Add Sub Feature
        if(isset($postParam['addsubFeature'])){
            $params = [
                'id'         => $postParam['idmainFeature'],
                'feature_id' => $postParam['subfeatureName'],
                'fee'        => (int) $postParam['subfeatureFee'],
                'description'=> $postParam['description']

            ];


            $add_subfeature = $this->HttpRequest("POST","/feature/sub",$params);


            if(!empty($add_subfeature)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/main-feature');
        }

        //Edit Sub Feature
        if(isset($postParam['editsubFeature'])){
            $id = $postParam['idFeatureEdit'];
            $params = [
                'feature_id' => $postParam['featureNameEdit'],
                'fee'        => (int) $postParam['featureFeeEdit'],
                'description'=> $postParam['descriptionEdit']
            ];

            $edit_subfeature = $this->HttpRequest("PUT","/feature/".$id, $params);

            if(!empty($edit_subfeature)){
                Session::flash('success','action success');
            }else{
                Session::flash('failed','action failed');
            }
    
            return Redirect::to('/main-feature');

        }
   
        $data_subfeature = $this->HttpRequest("GET","/feature/".$request->get('id')."/sub",null)->json();


        $data = [
            'main_featureid'    => $idmain ? $idmain : $param['id'],
            'data_subfeature'   => $data_subfeature,
        ];

        return view('feature.sub-feature-list')->with($data);
    }

    public function getFeatureById(Request $request)
    {
        $id = $request->get("id");
        $view_url = $this->HttpRequest("GET","/feature/".$id, null)->json();

        return $view_url;
    }

    public function deleteFeature(Request $request)
    {
        $id = $request->get('idFeature');
        $delete_url = $this->HttpRequest("DELETE","/feature/".$id, null);

        return $delete_url;
    }
}
