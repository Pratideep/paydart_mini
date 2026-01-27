<?php
namespace App\Controllers;
use App\Models\PspKeyModel;
use Config\Services;



class PspKeyController extends BaseController{
// Creates a model instance.
// Fetches all PSP keys belonging to the logged-in merchant.
// Passes the result to the psp_keys/index view.

    public function index(){
        $model = new PspKeyModel();
        $merchantId = session()->get('merchant_id');
        $data['psps']=$model->where('merchant_id',$merchantId)->findAll();
        // dd(session()->get('merchant_id'));
        return view('psp_keys/index',$data);
    }

    public function create(){
        return view('psp_keys/create');
    }

    public function store(){
        // $encrypter = Services::encrypter();

        $model = new PspKeyModel();
        // 'merchant_id' => session()->get('merchant_id'),
        // 'psp_name'    => $this->request->getPost('psp_name'),
        // 'api_key'     => base64_encode(
        //     $encrypter->encrypt($this->request->getPost('api_key'))
        // ),
        // 'api_secret'  => base64_encode(
        //     $encrypter->encrypt($this->request->getPost('api_secret'))
        // ),
        // 'status'      => 'active'
        $data = [
            'merchant_id' => session()->get('merchant_id'),
            'psp_name'    => $this->request->getPost('psp_name'),
            'api_key'     => $this->request->getPost('api_key'),
            'api_secret'  => $this->request->getPost('api_secret'),
            'priority'    => $this->request->getPost('priority'),
            'status'      => 'active'
        ];
        $model->save($data);
        return redirect()->to('/psp-keys')->with('success','PSP Key added successfully.');
        
    }

    public function toggle($id){
        $model = new PspKeyModel();
        $key = $model->find($id);
        
        $new_status = $key['status']==='active'?'inactive':'active';
        $model->update($id,['status'=>$new_status]);
        return redirect()->back();
    }




}