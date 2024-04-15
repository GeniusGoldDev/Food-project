<?php

namespace App\Http\Controllers;

use App\Setting;
use Artisan;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;
use Zipper;

class ModuleController extends Controller
{

    public function modules()
    {
        $checkZipExtension = extension_loaded('zip');

        $modules = Module::all();
        return view('admin.modules', array(
            'checkZipExtension' => $checkZipExtension,
            'modules' => $modules,
        ));
    }

    /**
     * @param Request $request
     */
    public function uploadModuleZipFile(Request $request)
    {
        //take the zip file and save it inside the tmp folder
        $file = $request->file('file');

        try {
            $destinationPath = base_path('tmp');

            $originalFile = $file->getClientOriginalName();
            //moving file to /tmp folder for installation
            $file->move($destinationPath, $originalFile);
            $response = [
                'success' => true,
            ];
            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 401);
        }
    }

    /**
     * @param Request $request
     * @param Factory $cache
     */
    public function installModule(Request $request, Factory $cache)
    {

        try {
            $moduleFile = base_path('tmp/UPLOAD-THIS-MODULE.zip');
            $checkIfExists = File::get($moduleFile);
            //if it is present then continue, else error message exception

            //take the zip and extract to base folder
            $zipper = new Zipper;
            $zipper = Zipper::make($moduleFile);

            //extract to the Modules directory of the application (base path/Modules)
            $zipper->extractTo(base_path('Modules'));

            Artisan::call('migrate', [
                '--force' => true,
            ]);

            Artisan::call('module:migrate', [
                '--force' => true,
            ]);

            Artisan::call('module:seed', [
                '--force' => true,
            ]);

            Artisan::call('cache:clear');

            // return redirect()->route('admin.modules')->with(['success' => 'Module Uploaded Successfully']);
            return response()->json(['success' => true, 'message' => 'Module Installation Done'], 200);
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            //redirect with file not found
            return redirect()->route('admin.modules')->with(['message' => 'Module File Not Found']);

        }

    }

    /**
     * @param $name
     */
    public function enableModule($name)
    {
        $module = Module::find($name);

        if ($module) {
            try {
                $module->enable();
                Artisan::call('migrate', [
                    '--force' => true,
                ]);

                Artisan::call('module:migrate', [
                    '--force' => true,
                ]);

                Artisan::call('module:seed', [
                    '--force' => true,
                ]);

                Artisan::call('cache:clear');
                return redirect()->back()->with(['success' => $name . ' module enabled']);

            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            }
        } else {
            return redirect()->back()->with(['message', 'Something went wrong!!!']);
        }
    }

    /**
     * @param $name
     */
    public function disableModule($name)
    {
        $module = Module::find($name);

        if ($module) {
            try {
                $module->disable();
                Artisan::call('cache:clear');
                return redirect()->back()->with(['success' => $name . ' module disabled']);

            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            }
        } else {
            return redirect()->back()->with(['message', 'Something went wrong!!!']);
        }
    }

};
