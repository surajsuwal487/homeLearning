<?php

namespace Modules\InventoryManagement\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\InventoryManagement\Entities\Category;
use App\Repository\ImageRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Modules\InventoryManagement\Repository\CategoryRepository;
use Modules\InventoryManagement\Http\Requests\CategoryRequest;
use Modules\InventoryManagement\Repository\CategoryImagesRepository;
use App\Repository\PaginateRepository;
use Image;
use Modules\InventoryManagement\Entities\Tag;
use Modules\InventoryManagement\Entities\CategoryTag;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageRepository;
    private $categoryImageRepository;
    private $paginationRepository;

    public function __construct(CategoryRepository $categoryRepository, ImageRepository $imageRepository, CategoryImagesRepository $categoryImageRepository, PaginateRepository $paginationRepository )
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
        $this->categoryImageRepository = $categoryImageRepository;
        $this->paginationRepository = $paginationRepository;
    }

    public function index(Request $request)
    {
        try {
            // $data = $this->categoryRepository->all()->toArray();
            // $categories = $this->paginationRepository->paginateArray($data, $request);

            $categories = $this->categoryRepository->all();
            return view('inventorymanagement::backend.category.view-categories', compact('categories'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function viewTrash(Request $request)
    {
        try {
            // $data = $this->categoryRepository->all()->toArray();
            // $categories = $this->paginationRepository->paginateArray($data, $request);

            $categories = Category::onlyTrashed()->get();
            return view('inventorymanagement::backend.category.trash-categories', compact('categories'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function create()
    {
        try {
            $tags = Tag::all();
            return view('inventorymanagement::backend.category.create-category', compact('tags'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data['name'] = $request->name;
            $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
            $data['feature'] = $request->feature;
            if ($request->hasFile('image')) {
                $validatedData = $request->validate([
                    'image' => 'image|required|mimes:jpeg,png,jpg|max:5000',
                ]);
                $data["image"] = $this->imageRepository->saveImage($request, 'categories');
            }
            $category = $this->categoryRepository->create($data);

            //for multiple images
            if($category){
                if($request->hasFile('multipleImages')){
                    foreach ($request->multipleImages as $key => $file) {
                        $filename=$this->imageRepository->saveMultipleImage($file,'categories');
                        $data=[
                            'category_id'=> $category->id,
                            'image'=> $filename,
                        ];
                        $this->categoryImageRepository->create($data);
                    }
                }
             }
            //  dd($category->id);

             //for category tag
             foreach($request->tags as $tag)
             {
                 $newTag = new CategoryTag();
                 $newTag['tag_id'] = $tag;
                 $newTag['category_id'] = $category->id;
                 $newTag->save();
             }


            return redirect()->route('cd-admin.view_categories')->with('success', 'Category created Successfully');
        } catch (\Exception $e) {
            dd($e);
            // dd($e->getMessage());
            $exception = $e->getMessage();
            return redirect()->back()->with('error', $exception);
        }
    }

    public function edit(Request $request)
    {
        try {
            //tags

            // dd('hello');
            $tags = Tag::all();
            
            $selectTags = CategoryTag::where('category_id',$request->id)->get();
            $selectedTags= array();
            foreach($selectTags as $selectTag)
            {
                $selectedTags[] = $selectTag['tag_id']; 
            }

            $slug = $request->category;
            $category = $this->categoryRepository->findBySlug($slug);
            return view('inventorymanagement::backend.category.edit-category', compact('category', 'tags', 'selectedTags'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($exception);
            return redirect()->back()->with('error', $exception);
        }
    }

    public function update(CategoryRequest $request)
    {
        try {
            $data['name'] = $request->name;
            $data['feature'] = $request->feature;
            if ($request->hasFile('image')) {
                $validatedData = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:5000',
                ]);
                $category = $this->categoryRepository->find($request->id);
                if (isset($category->image)) {
                    $this->imageRepository->removeImage($category, 'categories');
                }
                $data["image"] = $this->imageRepository->saveImage($request, 'categories');
            }
            $category = $this->categoryRepository->update($data, $request->id);

            //for multiple images
            if($category){
                if($request->hasFile('multipleImages')){
                    foreach ($request->multipleImages as $key => $file) {
                        $filename=$this->imageRepository->saveMultipleImage($file,'categories');
                        $data=[
                            'category_id'=> $request->id,
                            'image'=> $filename,
                        ];
                        $this->categoryImageRepository->create($data);
                    }
                }
             }

             //for tags
             $categoryTags = CategoryTag::where('category_id',$request->id)->get();
             foreach($categoryTags as $categoryTag)
             {
                 $categoryTag->delete();
             }
             foreach($request->tags as $tag)
             {
                 CategoryTag::create([
                     'category_id' => $request->id,
                     'tag_id' => $tag
                 ]);
             }
            return redirect()->route('cd-admin.view_categories')->with('success', 'Category Updated Successfully');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function destroy($slug)
    {
        try {
            $category = $this->categoryRepository->findBySlug($slug);
            if (isset($category->image)) {
                $this->imageRepository->removeImage($category, 'categories');
            }
            $data = $this->categoryRepository->deleteBySlug($slug);
            return redirect()->route('cd-admin.view_categories')->with('success', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }
    public function restore($slug)
    {
        try {
            $category = Category::withTrashed()->where('slug', $slug)->first();
            // dd($category);
            if(!is_null($category)){
                $category->restore();
            }
            return redirect()->route('cd-admin.view_categories')->with('success', 'Category Restored Successfully');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function forceDelete($slug)
    {
        try {
            $category = Category::withTrashed()->where('slug', $slug)->first();
            // dd($category);
            if(!is_null($category)){
                $category->forceDelete();
            }
            return redirect()->back()->with('success', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function deleteMultipleImages(Request $request){
        try {
            $this->categoryImageRepository->delete($request->id);
            return back()->with('success','Image Removed Successfully');
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage);
        }
    }

    public function changestatus(Request $request)
    {
        try {
            // return $request->id;
            $id = base64_decode($request->id);
            $category = $this->CategoryRepository->find($id);
            if ($category->status == 'active') {
                $data['status'] = 'inactive';
                $category = $this->CategoryRepository->update($data, $id);

            } else {
                $data['status'] = 'active';
                $category = $this->CategoryRepository->update($data, $id);
            }
            return $category;

        } catch (\Exception$e) {

            $exception = $e->getMessage();
            return $exception;
        }

    }
}
