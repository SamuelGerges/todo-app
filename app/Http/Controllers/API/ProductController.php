<?php

namespace App\Http\Controllers\API;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Request\Product\CreateProductValidation;
use App\Request\Product\ImportProductValidation;
use App\Request\Product\UpdateProductValidation;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends BaseController
{
    protected ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index()
    {
        $products = $this->productService->getProducts();
        return $this->sendResponse($products);
    }

    public function store(CreateProductValidation $createProductValidation)
    {
        if(!empty($createProductValidation->getErrors())){
            return response()->json($createProductValidation->getErrors(),404);
        }
        $data = $createProductValidation->getRequest()->all();
        $data['user_id'] = Auth::user()->id;
        $product = $this->productService->createProduct($data);
        return $this->sendResponse($product);
    }



    public function update(UpdateProductValidation $updateProductValidation,$id)
    {
        if(!empty($updateProductValidation->getErrors())){
            return response()->json($updateProductValidation->getErrors(),404);
        }
        $data = $updateProductValidation->getRequest()->all();
        $product = $this->productService->updateProduct($id,$data);
        return $this->sendResponse($product);
    }

    public function destroy($id)
    {
         $this->productService->deleteProduct($id);
        return $this->sendResponse('Deleted Successfully');
    }


    public function export()
    {
        return Excel::download(new ProductExport(),'export1.xlsx');
    }


    public function import(ImportProductValidation $importProductValidation)
    {
        if(!empty($importProductValidation->getErrors())){
            return response()->json($importProductValidation->getErrors(),404);
        }
        Excel::import(new ProductImport(),$importProductValidation->getRequest()->file('file')->store('files'));
        return $this->sendResponse('File is Saved');
    }

}
