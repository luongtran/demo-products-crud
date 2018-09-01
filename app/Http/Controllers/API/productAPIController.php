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
        $products = $this->productRepository->orderBy('product_id', 'asc')->all();
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
        $productId = $this->getProductID();
        $product = [];
        foreach($input['attributes'] as $key => $value) {
            $product['product_id'] = $productId;
            $product['name'] = $request->name;
            $product['category_id'] = $request->categoryId;
            $product['website_id'] = $request->websiteId;
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
        //dd($input);
        /** @var product $product */
        // $product = $this->productRepository->findWithoutFail($id);

        // if (empty($product)) {
        //     return $this->sendError('Product not found');
        // }
        foreach($input['attributes'] as $key => $value) {
            $product = array(
                'name'          => $request->name,
                'category_id'   => $request->categoryId,
                'website_id'    => $request->websiteId,
                'attribute'     => $value['attribute'], 
                'price'         => $value['price'],
                'stock'         => $value['stock'],
                'weight'        => $value['weight']
            );
            if(!isset($value['id'])) {
                $product['product_id'] = $request->productId;
                $product = $this->productRepository->create($product);
            } else {
                $product = $this->productRepository->update($product, $value['id']);  
            }      
        }
        //dd($product);
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
        return $this->sendResponse($products->toArray(), 'Product search successfully');
    }

    public function getProductID()
    {
        $product = $this->productRepository->all()->last()->toArray();
        $key = substr($product['product_id'], 2, strlen($product['product_id']));
        $count = (int)($key + 1); 
        if((int)$key < 9) {
            return "KM000".$count;
        }
        if((int)$key < 99) {
            return "KM00".$count;
        }
        if ((int)$key < 999) {
            return "KM0".$count;
        }
        return "KM".$count;
    }

    public function showMoreProduct(Request $request)
    { 
        $data = $this->productRepository->findWithoutFail($request->id)->toArray();
        $product = $this->productRepository->findWhere(['product_id' => $data['product_id']]);
        return $this->sendResponse($product->toArray(), 'Product show successfully');
    }

}
