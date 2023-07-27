<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Components\Recusive;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $product;
    private $category;
    private $productImage;
    private $productTag;
    private $tag;
    public function __construct(Product $product, Category $category, ProductImage $productImage, ProductTag $productTag, Tag $tag)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
        $this->productTag = $productTag;
        $this->tag = $tag;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);

        return $htmlOption;
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');

        return view('admin.products.add', [
            'htmlOption' => $htmlOption
        ]);
    }

    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product['category_id']);
        

       
        return view('admin.products.edit',[
            'htmlOption' => $htmlOption,
            'product' => $product
        ]);
    }

    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            //insert product 
            $dataProductUpdate = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'content' => $request->input('content'),
                'user_id' => Auth()->id(),
                'category_id' => $request->input('category_id'),
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            // insert detail images product
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id',$id)->delete();

                foreach ($request->file('image_path') as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);

                    // $this->productImage::create([
                    //     'product_id' => $product['id'],
                    //     'image_path' => $dataProductImageDetail['file_path'],
                    //     'image_name' => $dataProductImageDetail['file_name']
                    // ]);
                }
            }

            //insert tags for product
            if (!empty($request->input('tags'))) {
                foreach ($request->input('tags') as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    $tagIds[] = $tagInstance['id'];
                }
                $product->tags()->sync($tagIds);
            }
            
            DB::commit();

            return redirect()->route('products.index');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error("message: " . $ex->getMessage() . " line : " . $ex->getLine());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            //insert product 
            $dataProductCreate = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'content' => $request->input('content'),
                'user_id' => Auth()->id(),
                'category_id' => $request->input('category_id'),
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $product = $this->product::create($dataProductCreate);

            // insert detail images product
            if ($request->hasFile('image_path')) {
                foreach ($request->file('image_path') as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);

                    // $this->productImage::create([
                    //     'product_id' => $product['id'],
                    //     'image_path' => $dataProductImageDetail['file_path'],
                    //     'image_name' => $dataProductImageDetail['file_name']
                    // ]);
                }
            }

            //insert tags for product
            if (!empty($request->input('tags'))) {
                foreach ($request->input('tags') as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem
                    ]);
                    $tagIds[] = $tagInstance['id'];
                }
                $product->tags()->attach($tagIds);
            }
            
            DB::commit();

            return redirect()->route('products.index');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error("message: " . $ex->getMessage() . " line : " . $ex->getLine());
        }
    }


    // test

    public function searchGetProduct(Request $request){
        $productSearch = $this->product->where('name', 'LIKE', '%'.$request->input('query').'%')
        ->get();
        
        $html = '';
        foreach ($productSearch as $product) {
            $html .= '<div> san pham :' . $product['name'] . '</div><br>';
        }

        return $html;
        
    }
}
