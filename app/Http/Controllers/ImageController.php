<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use \Validator;
use App\Actions\Image\CreateNewImage;
use App\Actions\Image\CreateInstrumentHasImage;
use App\Actions\Product\CreateNewSell;
use App\Actions\Product\CreateNewProduct;


use Illuminate\Support\Facades\DB;

  
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('imageUpload');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $input_data = $request->all();
        $storageImage = new CreateNewImage();
        $storageSell = new CreateNewSell();
        $storageProduct = new CreateNewProduct();
        $instrumentHasImage = new CreateInstrumentHasImage();
        $userController = new UserController();
        $idUser = $userController->getIdUserConnected($request);

        $validator = Validator::make(
            $input_data['images'], [
            'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
            ],[
                'images.*.required' => 'Please upload an image',
                'images.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'images.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ) , 400);
        }

        $input = $request->input();
        $sell = $storageSell->create($input);
        $idsell = $sell->idSell;
        $idTypeInstrument = DB::table('typeInstrument')->where('type', $input['instrumentType'])->first()->idTypeInstrument;
        $idState  = DB::table('state')->where('state', $input['state'])->first()->idState;
        $idProduct = null;
        if($idTypeInstrument != null && $idState != null){
            $idProduct = $storageProduct ->create($input, $idTypeInstrument, $idState, $idUser, $idsell)->idInstrument;
        }

        $i = 0;
        foreach($request['images'] as $image){            
            $imageName = $i.time().'.'.$image->extension();  
            $image->move(public_path('images'), $imageName);
            $imageId = $storageImage->create($imageName, $idUser)->idImage;
            if($idProduct != null){
                $instrumentHasImage->create($idProduct, $imageId);
            }
            $i++;
        }
        
        return back()
                    ->with('success', 'You have successfully upload image.')
                    ->with('image', $imageName); 
    }
}