<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class VerifyController extends Controller
{
    /**
     * Show the verification form.
     *
     * @return View
     */
    public function index(): View
    {
        return view('verify.index');
    }

    /**
     * Validate the verification data.
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|View
     */
    public function check(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->route('verify.index')
                ->withErrors($validator)
                ->withInput();
        }

        $vote = Vote::find($request->get('uuid'));

        if ($vote) {
            $hashedValue = $vote->checksum;
            $vote->checksum = $request->get('password');
            // Decode and re-encode JSON to make sure it is PHP JSON, not MySQL JSON.
            $vote->details = $vote->details;
            $data = $vote->getAttributes();
            ksort($data);
            $value = hash('sha512', (json_encode($data)).$vote->checksum);

            if (Hash::check($value, $hashedValue)) {
                return view('verify.success');
            } else {
                return view('verify.warning');
            }
        } else {
            return redirect()
                ->route('verify.index')
                ->withInput();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return \Validator::make($data, [
            'uuid' => 'required|string|regex:/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}$/|exists:votes',
            'password' => 'required|string|min:6',
        ]);
    }
}
