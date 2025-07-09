<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\InfusionsoftToken;
use Carbon\Carbon;

class InfusionsoftService
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $redirectUri;
    protected string $tokenUrl = 'https://api.infusionsoft.com/token';
    protected string $authorizeUrl = 'https://accounts.infusionsoft.com/app/oauth/authorize';

    public function __construct()
    {
        $this->clientId = config('services.infusionsoft.client_id');
        $this->clientSecret = config('services.infusionsoft.client_secret');
        $this->redirectUri = config('services.infusionsoft.redirect');
    }

    public function getAuthorizationUrl(): string
    {
        return $this->authorizeUrl . '?' . http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'full'
        ]);
    }

    public function exchangeCodeForToken(string $code): array
    {
        $response = Http::asForm()->post($this->tokenUrl, [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ]);

        $data = $response->json();

        InfusionsoftToken::updateOrCreate(['id' => 1], [
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires_at' => Carbon::now()->addSeconds($data['expires_in'])
        ]);

        return $data;
    }

    public function refreshToken(): string
    {
        $record = InfusionsoftToken::first();

        $response = Http::asForm()->post($this->tokenUrl, [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $record->refresh_token,
        ]);

        $data = $response->json();

        $record->update([
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires_at' => Carbon::now()->addSeconds($data['expires_in'])
        ]);

        return $data['access_token'];
    }

    public function getAccessToken(): string
    {
        $token = InfusionsoftToken::first();

        if (!$token || Carbon::now()->gte($token->expires_at)) {
            return $this->refreshToken();
        }

        return $token->access_token;
    }

    public function getContacts(): array
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->get('https://api.infusionsoft.com/crm/rest/v1/contacts', [
                'limit' => 10
            ]);

        return $response->json();
    }
}
