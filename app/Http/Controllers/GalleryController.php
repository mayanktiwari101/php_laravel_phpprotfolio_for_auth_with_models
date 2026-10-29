<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\GalleryModel;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            [
                "success" => true,
                "message" => "This is a message from gallery controller",
                "data" => $request->all(),
            ],
            200
        );
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "src" => "required | string | max:255",
                "alt" => "required | string | max:255",
                "price" => "required | numeric | min:0",
            ]);
            $gallery = GalleryModel::create($validated);
            return response()->json([
                "success" => true,
                "message" => "Gallery item created successfully",
                "data" => $gallery,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Failed to fetch gallery data",
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function show()
    {
        try {

            $results = GalleryModel::query()
                ->leftJoin(
                    "categories",
                    "galleries.category_id",
                    "=",
                    "categories.id"
                )
                ->select(
                    "galleries.*",
                    "categories.category_name as category_name"
                )
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'image' => $item->src,
                        'title' => $item->alt,
                        'category' => $item->category_name,
                        'price' => $item->price,
                    ];
                });

                return response()->json(
                    [
                        "success" => true,
                        "message" => "Gallery items fetched successfully",
                        "data" => $results->all(),
                    ],
                    200
                );

        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to fetch gallery data",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function findById($id)
    {
        try {
            $result = GalleryModel::findOrFail($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Gallery item found successfully",
                    "data" => $result,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Something went wrong",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                "src" => "required|string|max:255",
                "alt" => "required|string|max:255",
                "price" => "required|numeric|min:0",
            ]);

            $gallery = GalleryModel::findOrFail($id);

            $gallery->update($validated);

            $gallery->refresh();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Gallery item updated successfully",
                    "data" => $gallery,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to update gallery item",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function destroy($id)
    {
        try {
            $gallery = GalleryModel::findOrFail($id);

            $gallery->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Gallery item deleted successfully",
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery item not found",
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to delete gallery item",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function deleteMulitple(Request $request)
    {
        try {
            $validated = $request->validate([
                "ids" => "required | array | min:1",
                "ids.*" => "required | integer |exists:gallery,id",
            ]);
            $ids = $validated["ids"];
            $deletedCount = GalleryModel::whereIn("id", $ids)->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Required id deleted successfully",
                    "deleteCount" => $deletedCount,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery Controller not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to delete gallery items",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function deleteAll()
    {
        try {
            $deletedCount = GalleryModel::query()->delete();

            return response()->json([
                "success" => true,
                "message" => "All gallery items deleted successfully",
                "delete_count" => $deletedCount,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to delete all gallery items",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function updateByStatus(Request $request, $id)
    {
        try {
            $result = GalleryModel::findOrFail($id);

            $result->update([
                "status" => $request->input("status"),
            ]);
            $result->refresh();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Gallery item updated successfully",
                    "data" => $result,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Gallery Item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Something went wrong",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function updateStatusByIds(Request $request)
    {
        try {
            $request->validate([
                "ids" => "required|array|min:1",
                "ids.*" => "integer",
                "status" => "required|integer",
            ]);

            $updated = GalleryModel::whereIn("id", $request->ids)->update([
                "status" => $request->status,
            ]);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Status updated successfully",
                    "updated_count" => $updated,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Something went wrong",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    // public function dummytest()
    // {
    // }
}
