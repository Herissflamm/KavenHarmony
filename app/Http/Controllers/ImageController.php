<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::id();

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
        $idSell = $sell->id;
        $idTypeInstrument = DB::table('type_instrument')->where('type', $input['instrumentType'])->first()->id;
        $idState  = DB::table('state')->where('state', $input['state'])->first()->id;
        $idProduct = null;
        if($idTypeInstrument != null && $idState != null){
            $idProduct = $storageProduct ->create($input, $idTypeInstrument, $idState, $userId, $idSell)->id;
        }

        $i = 0;
        foreach($request['images'] as $image){            
            $imageName = $i.time().'.'.$image->extension();  
            $image->move(public_path('images'), $imageName);
            $imageVal = $storageImage->create($imageName, $userId);
            $imageId = $imageVal->id;
            if($imageId != null){
                $instrumentHasImage->create($idProduct, $imageId);
            }else{
            }
            $i++;
        }
        
        return back()
                    ->with('success', 'You have successfully upload image.')
                    ->with('image', $imageName); 
    }
}