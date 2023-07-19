<?php

namespace MichelJonkman\Director\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;
use MichelJonkman\Director\Exceptions\Settings\MissingSettingException;
use MichelJonkman\Director\Http\Requests\SettingsSaveRequest;

class SaveController extends Controller
{
    /**
     * @throws MissingSettingException
     * @throws BindingResolutionException
     * @throws MissingModificationException
     */
    public function __invoke(SettingsSaveRequest $request, Director $director)
    {
        $validated = $request->validated();

        foreach ($validated['settings'] as $setting => $value) {
            $director->settings()->set($setting, $value);
        }

        session()->flash('toast', ['success' => 'Successfully saved settings.']);

        return redirect()->route('director.settings.page');
    }
}
