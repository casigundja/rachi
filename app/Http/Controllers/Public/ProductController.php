<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): View
    {
        $query = Product::where('status', 'active')->with(['category', 'primaryImage']);

        if ($request->filled('categoria')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('sku', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

        if ($request->filled('ordenar')) {
            switch ($request->ordenar) {
                case 'preco_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'preco_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'nome_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'nome_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('featured', 'desc')->latest();
            }
        } else {
            $query->orderBy('featured', 'desc')->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::where('type', 'product')->get();

        return view('public.store.index', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->with(['category', 'images', 'businessUnit'])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('public.store.show', compact('product', 'relatedProducts'));
    }

    public function cart(): View
    {
        return view('public.cart');
    }

    public function checkout(): View
    {
        return view('public.checkout');
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        // Validar e processar pedido
        return redirect()->route('customer.dashboard')->with('success', 'Pedido efetuado com sucesso!');
    }
}
