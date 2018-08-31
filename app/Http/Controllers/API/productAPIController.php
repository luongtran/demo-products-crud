<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateproductAPIRequest;
use App\Http\Requests\API\UpdateproductAPIRequest;
use App\Models\product;
use App\Repositories\productRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Criteria\SearchProductIdCriteria;
use App\Criteria\SearchProductNameCriteria;

/**
 * Class productController
 * @package App\Http\Controllers\API
 */

class productAPIController extends AppBaseController
{
    /** @var  productRepository */
    private $productRepository;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the product.
     * GET|HEAD /products
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $this->productRepository->pushCriteria(new LimitOffsetCriteria($request));
        $products = $this->productRepository->all();
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully');
    }

    /**
     * Store a newly created product in storage.
     * POST /products
     *
     * @param CreateproductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateproductAPIRequest $request)
    {
        $input = $request->all();
        $product = [];
        foreach($input['attributes'] as $key => $value) {
            $product['product_id'] = $this->getProductID();
            $product['name'] = $request->name;
            $product['category_id'] = $request->category_id;
            $product['website_id'] = $request->website_id;
            $product['attribute'] = $value['attribute'];
            $product['price'] = $value['price'];
            $product['stock'] = $value['stock'];
            $product['weight'] = $value['weight'];
            $products = $this->productRepository->create($product);     
        }

        return $this->sendResponse($products->toArray(), 'Product saved successfully');
    }

    /**
     * Display the specified product.
     * GET|HEAD /products/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully');
    }

    /**
     * Update the specified product in storage.
     * PUT/PATCH /products/{id}
     *
     * @param  int $id
     * @param UpdateproductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductAPIRequest $request)
    {
        $input = $request->all();
        /** @var product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product = $this->productRepository->update($input, $id);

        return $this->sendResponse($product->toArray(), 'product updated successfully');
    }

    /**
     * Remove the specified product from storage.
     * DELETE /products/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product->delete();

        return $this->sendResponse($id, 'Product deleted successfully');
    }

    public function fullSearch(Request $request)
    {
        $this->productRepository->pushCriteria(new SearchProductIdCriteria($request->id));
        $this->productRepository->pushCriteria(new SearchProductNameCriteria($request->name)); 
        $products = $this->productRepository->all();
        return $this->sendResponse($products->toArray(), 'Employee search successfully');
    }

    public function getProductID(){

        $count = count($this->productRepository->all());
        $dem = $count+1;
        if($dem < 100) {
            return "KM00".$dem;
        }
        elseif ($dem < 1000) {
            return "KM0".$dem;
        }
        return "KM".$dem;
    }

}
