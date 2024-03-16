<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plugin;

class PluginController extends Controller
{
    public function toggleActive(Request $request, $resource)
    {
        $itemId = $request->input('itemId');

        // Determine the model based on the resource parameter
        switch ($resource) {
            case 'employee':
                $model = Plugin::findOrFail($itemId);
                break;
            case 'blog':
                $model = Plugin::findOrFail($itemId);
                break;
            case 'page':
                $model = Plugin::findOrFail($itemId);
                break;
            default:
                return response()->json(['message' => 'Invalid resource'], 404);
        }

        // Toggle the active state
        $model->active = !$model->active;
        $model->save();

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }
}
