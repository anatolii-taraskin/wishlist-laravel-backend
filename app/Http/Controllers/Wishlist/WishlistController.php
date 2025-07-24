<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Wishlist::class, 'wishlist');
    }

    public function index(Request $request)
    {
        return WishlistResource::collection(
            $request->user()->wishlists()->latest()->get()
        );
    }

    public function store(StoreWishlistRequest $request)
    {
        $wishlist = Wishlist::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
            'public_token' => Str::uuid(),
        ]);

        return new WishlistResource($wishlist);
    }

    public function show(Request $request, Wishlist $wishlist)
    {
        $this->authorizeAccess($request, $wishlist);

        return new WishlistResource($wishlist);
    }

    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        $this->authorizeAccess($request, $wishlist);

        $wishlist->update($request->validated());

        return new WishlistResource($wishlist);
    }

    public function destroy(Request $request, Wishlist $wishlist)
    {
        $this->authorizeAccess($request, $wishlist);

        $wishlist->delete();

        return response()->noContent();
    }

    private function authorizeAccess(Request $request, Wishlist $wishlist): void
    {
        if ($wishlist->user_id !== $request->user()->id) {
            abort(403, 'Access denied.');
        }
    }
}
