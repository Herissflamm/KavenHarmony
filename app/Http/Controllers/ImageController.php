<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Actions\Image\CreateNewImage;
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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
         
        $request->image->move(public_path('images'), $imageName);
      
        $storageImage = new CreateNewImage();
        $userController = new UserController();
        $storageProduct = new CreateNewProduct();

        $idUser = $userController->getIdUserConnected($request);
        
        $image = $storageImage->create($imageName, $idUser);

        $input = $request->input();
        $idImage = $image -> idImage;
        $idTypeInstrument = DB::table('typeInstrument')->where('type', $input['instrumentType'])->first()->idTypeInstrument;
        $idState  = DB::table('state')->where('state', $input['state'])->first()->idState;
        if($idTypeInstrument != null && $idState != null){
            $storageProduct ->create($input, $idImage, $idTypeInstrument, $idState, $idUser);
        }

        if($image==null){
            if(file_exists(public_path('upload/bio.png'))){
                unlink(public_path('upload/bio.png'));
            }
        }
        
        return back()
                    ->with('success', 'You have successfully upload image.')
                    ->with('image', $imageName); 
    }
}