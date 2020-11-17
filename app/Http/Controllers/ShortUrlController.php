<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddShortUrl;
use App\ShortUrl\Service\ShortUrlServiceInterface;

class ShortUrlController extends Controller
{
    /**
     * @var ShortUrlServiceInterface
     */
    public ShortUrlServiceInterface $service;

    /**
     * ShortUrlController constructor.
     * @param ShortUrlServiceInterface $service
     */
    public function __construct(ShortUrlServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($url)
    {
        $redirect_url = $this->service->redirectUrl($url);
        if (!empty($redirect_url)) {
            return redirect($redirect_url);
        } else {
            abort(404);
        }
    }

    /**
     * @param AddShortUrl $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(AddShortUrl $request)
    {
        $short_url = $this->service->add($request->post('source_url'), $request->post('ttl'));
        return back()->with(
            [
                'status' => !empty($short_url) ? 'success' : 'error',
                'short_url' => !empty($short_url) ? $request->getSchemeAndHttpHost() . '/' . $short_url : null
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function stat()
    {
        return view('stat')->with('rows', $this->service->all());
    }
}
