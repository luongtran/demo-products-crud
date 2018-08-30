<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatewebsiteAPIRequest;
use App\Http\Requests\API\UpdatewebsiteAPIRequest;
use App\Models\website;
use App\Repositories\websiteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class websiteController
 * @package App\Http\Controllers\API
 */

class websiteAPIController extends AppBaseController
{
    /** @var  websiteRepository */
    private $websiteRepository;

    public function __construct(websiteRepository $websiteRepo)
    {
        $this->websiteRepository = $websiteRepo;
    }

    /**
     * Display a listing of the website.
     * GET|HEAD /websites
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->websiteRepository->pushCriteria(new RequestCriteria($request));
        $this->websiteRepository->pushCriteria(new LimitOffsetCriteria($request));
        $websites = $this->websiteRepository->all();

        return $this->sendResponse($websites->toArray(), 'Websites retrieved successfully');
    }

    /**
     * Store a newly created website in storage.
     * POST /websites
     *
     * @param CreatewebsiteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatewebsiteAPIRequest $request)
    {
        $input = $request->all();

        $websites = $this->websiteRepository->create($input);

        return $this->sendResponse($websites->toArray(), 'Website saved successfully');
    }

    /**
     * Display the specified website.
     * GET|HEAD /websites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var website $website */
        $website = $this->websiteRepository->findWithoutFail($id);

        if (empty($website)) {
            return $this->sendError('Website not found');
        }

        return $this->sendResponse($website->toArray(), 'Website retrieved successfully');
    }

    /**
     * Update the specified website in storage.
     * PUT/PATCH /websites/{id}
     *
     * @param  int $id
     * @param UpdatewebsiteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatewebsiteAPIRequest $request)
    {
        $input = $request->all();

        /** @var website $website */
        $website = $this->websiteRepository->findWithoutFail($id);

        if (empty($website)) {
            return $this->sendError('Website not found');
        }

        $website = $this->websiteRepository->update($input, $id);

        return $this->sendResponse($website->toArray(), 'website updated successfully');
    }

    /**
     * Remove the specified website from storage.
     * DELETE /websites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var website $website */
        $website = $this->websiteRepository->findWithoutFail($id);

        if (empty($website)) {
            return $this->sendError('Website not found');
        }

        $website->delete();

        return $this->sendResponse($id, 'Website deleted successfully');
    }
}
