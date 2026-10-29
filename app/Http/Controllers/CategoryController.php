<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\CategoryModal;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            [
                "success" => true,
                "message" => "This is a message from the category controller",
            ],
            200
        );
    }

    public function store(Request $request)
    {
        try {
            $category = CategoryModal::create($request->all());
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category stored successfully",
                    "data" => $request->all(),
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
        return response()->json(
            [
                "success" => false,
                "message" => "Category item not found",
                "data" => null,
            ],
            404
        );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "An exception occured",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function show(Request $request)
    {
        try {
            $results = CategoryModal::all();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Category fetched successfully",
                    "results" => $results,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category item not found",
                    "data" => null,
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "An exception occured",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
        $category = CategoryModal::findOrFail($id);
        $category->update($request->all());
        $category->refresh();
        return response()->json(
            [
                "success" => true,
                "message" => "Required Category updated successfully",
                "data" => $category,
                "request_data" => $request->all(),
                "after_refresh" => $category
            ],
            200
        );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category item not found",
                    "error" => $e->getMessage(),
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

    public function destroy($id)
    {
        try {
            $category = CategoryModal::findOrFail($id);
            $category->delete();
        return response()->json(
            [
                "success" => true,
                "message" => "Category item deleted successfully",
            ],
            200,
        );
        } catch (ModelNotFoundException $e){
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category not found",
                    "error" => $e->getMessage(),
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to delete required Category item",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function findById(Request $request, $id)
    {
        try {
            $result = CategoryModal::findOrFail($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Category item fetched successfully",
                    "data" => $result,
                ],
                200
            );
            
        } catch (ModelNotFoundException $e) {
        return response()->json(
            [
                "success" => false,
                "message" => "Category item not found",
                "error" => $e->getMessage(),
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

    public function deleteAll()
    {
        try {

        $deletedCount = CategoryModal::query()->delete();
        return response()->json(
            [
                "success" => true,
                "message" => "All gallery items deleted successfully",
                "delete_count" => $deletedCount,
            ]
        );

        } catch (ModelNotFoundException $e) {

        return response()->json(
            [
                "success" => false,
                "message" => "Category item not found",
                "error" => $e->getMessage(),
            ],
            404
        );


        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "An exception occured",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function deleteMultiple (Request $request)
    {
        try {

        $deletedCount = CategoryModal::whereIn("id", $ids)->delete();

        return response()->json(
            [
                "success" => true,
                "message" => "Selected ids deleted successfully",
                "deletedCount" => $deletedCount,
            ],
            200
        );

        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category item not found",
                    "error" => $e->getMessage(),
                ],
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category item not found",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function updateByStatus(Request $request, $id)
    {
        try {

        $result = CategoryModel::whereIn("id", $ids)->delete();
        $result->refresh();
        return response()->json(
            [
                "success" => true,
                "message" => "Selected ids deleted successfully",
                "deletedCount" => $result->all(),
            ],
            200
        );

        } catch (ModelNotFoundException $e) {

        return response()->json(
            [
                "success" => false,
                "message" => "Category item not found",
                "error" => $e->getMessage(),
            ],
            404
        );

        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Something went wrong!",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }

    }

    public function updateStatusByIds(Request $request)
    {
        try {
            $updated = CategoryModal::whereIn("id", $request->ids)->update(
                [
                    "status" => $request->status,
                ]
            );

            return response()->json(
                [
                    "success" => true,
                    "message" => "Status updated successfully",
                    "updated_count" => $updated,
                ],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category item not found",
                    "error" => $e->getMessage(),
                ],
                500
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



}
