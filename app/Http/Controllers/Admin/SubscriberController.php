<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriberRequest;
use App\Services\SubscriberService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class SubscriberController extends Controller
{
    protected $subscriberService;
    protected $userService;
    public function __construct(SubscriberService $subscriberService, UserService $userService)
    {
        $this->subscriberService   = $subscriberService;
        $this->userService      = $userService;

    }

    /**
     * Define middleware for the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('List Subscriber'), only: ['index']),
            new Middleware(PermissionMiddleware::using('Add Subscriber'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('Edit Subscriber'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('Delete Subscriber'), only: ['destroy']),
            new Middleware(PermissionMiddleware::using('Restore Subscriber'), only: ['restore']),
        ];
    }

    public function index(Request $request)
    {
        $data = $request->all();

        $dataTable = new SubscriberDataTable($data);
        setPageMeta(__('List Subscriber'));

        return $dataTable->render('common.datatable');
    }
    public function create()
    {
        setPageMeta(__('Add Subscriber'));
        return view('admin.subscribers.create');
    }

    public function store(SubscriberRequest $request) // Use Request class
    {
        try {
            $this->subscriberService->createOrUpdate($request);

            sendFlash(__('Successfully created'));
            return redirect()->route('subscribers.index');
        } catch (\Exception $e) {
            sendFlash(__($e->getMessage()), 'error');
            return back();
        }
    }
    public function edit($id)
    {
        setPageMeta(__('Edit Subscriber'));
        $user = $this->userService->getWithTrashed($id, ['userDetail'=>function($q){
            $q->withTrashed();
        }]);
        return view('admin.subscribers.edit', compact('user'));
    }

    public function update(SubscriberRequest $request, $id)
    {
        try {
            $this->subscriberService->createOrUpdate($request, $id);

            sendFlash(__('Successfully Updated'));
            return redirect()->route('subscribers.index');
        } catch (\Exception $e) {
            sendFlash(__($e->getMessage()), 'error');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->deleteForceDeleteModel($id);
            sendFlash(__('Successfully Deleted'));
            return back();
        } catch (\Exception $e) {
            sendFlash(__($e->getMessage()), 'error');
            return back();
        }
    }
    public function restore($id)
    {
        try {
            $user = $this->userService->getWithTrashed($id, ['userDetail'=>function($q){
                $q->withTrashed();
            }]);

            $this->userService->restore($id);
            $this->subscriberService->restore($user->userDetail->id);
            sendFlash(__('Successfully Restored'));
            return back();
        } catch (\Exception $e) {
            sendFlash(__($e->getMessage()), 'error');
            return back();
        }
    }

    public function show($id)
    {
        setPageMeta(__('Subscriber Details'));

        return view('admin.subscribers.show', compact('id'));
    }

    /**
     * API: Get subscriber details
     */
    public function showAPI($id)
    {
        try {
            $user = $this->userService->getWithTrashed($id, ['userDetail' => function($q) {
                $q->withTrashed();
            }]);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Subscriber not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }


}

