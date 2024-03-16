<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plugin;
use DB;

class PluginsController extends Controller
{
    public function index()
    {
        $data = DB::table('plugins')->get();
        return response()->json($data);
    }
    public function getStatus()
    {
        // Fetch all rows from the Plugin table
        $plugins = Plugin::all();

        // Initialize an associative array to store the statuses
        $statuses = [];

        // Iterate over each plugin and store its status
        foreach ($plugins as $plugin) {
            $statuses[$plugin->name] = $plugin->active;
        }

        return response()->json(['isActive' => $statuses], 200);
    }

    public function toggleActive(Request $request, $resource)
    {
        $itemId = $request->input('itemId');

        // Determine the model based on the resource parameter
        switch ($resource) {
            case 'employee':
                $model = Plugin::findOrFail($itemId);
                break;
            case 'blogs':
                $model = Plugin::findOrFail($itemId);
                break;
            case 'pages':
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
