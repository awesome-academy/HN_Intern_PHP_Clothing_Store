<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepo;
    protected $notificationRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->notificationRepo = $notificationRepo;
        $notifications = $this->notificationRepo->getAll();
        $notificationNotClick = $this->notificationRepo->getNotificationNotClick();
        view()->share('notifications', $notifications);
        view()->share('notificationNotClick', $notificationNotClick);
    }

    public function showAddCategoryView()
    {
        $category = $this->categoryRepo->getAll();

        return view('admin.category.catadd', compact('category'));
    }

    public function showListCategoryView()
    {
        $category = $this->categoryRepo->getAll();

        return view('admin.category.catlist', compact('category'));
    }

    public function showEditCategoryView($id)
    {
        $cat = $this->categoryRepo->find($id);
        $category = $this->categoryRepo->getAll();
        if ($cat == null) {
            return redirect()->route('admindashboard');
        }

        return view('admin.category.catedit', compact('cat', 'category'));
    }

    public function deleteCategory($id)
    {
        $this->categoryRepo->delete($id);

        return redirect()->route('catlist');
    }

    public function addCategory(AddCategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryRepo->create($data);

        return redirect()->route('catadd');
    }

    public function editCategory(AddCategoryRequest $request)
    {
        $id = $request->id;
        $data = $request->all();
        $this->categoryRepo->update($id, $data);
        
        return redirect()->route('catedit', ['id' => $id]);
    }
}
