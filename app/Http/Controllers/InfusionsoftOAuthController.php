<?php

namespace App\Http\Controllers;

use App\Services\InfusionsoftService;
use Illuminate\Http\Request;

class InfusionsoftOAuthController extends Controller
{
    protected InfusionsoftService $infusionsoft;

    public function __construct(InfusionsoftService $infusionsoft)
    {
        $this->infusionsoft = $infusionsoft;
    }

    /**
     * Redirect user to Infusionsoft's OAuth2 authorization page.
     */
    public function redirectToAuthorization()
    {
        $authorizationUrl = $this->infusionsoft->getAuthorizationUrl();
        return redirect($authorizationUrl);
    }

    /**
     * Handle Infusionsoft OAuth2 callback and store tokens.
     */
    public function handleAuthorizationCallback(Request $request)
    {
        if (! $request->has('code')) {
            return response('Authorization failed: No code provided.', 400);
        }

        $this->infusionsoft->exchangeCodeForToken($request->input('code'));

        return response('Authorization successful. Tokens saved.', 200);
    }

    /**
     * Refresh token manually for testing.
     */
    public function refreshToken()
    {
        $token = $this->infusionsoft->refreshToken();
        return response('Token refreshed: ' . $token, 200);
    }

    /**
     * Fetch contacts using access token.
     */
    public function getContacts()
    {
        $contacts = $this->infusionsoft->getContacts();
        return view('infusionsoft.contacts', [
            'contacts' => $contacts
        ]);
    }
}
