<?php

namespace App\Services\Telegram\BaseTelegramClass;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;

abstract class AbstractTelegram {
    /**
     * @return PendingRequest
     */
    private function baseRequest(): PendingRequest {
        return Http::baseUrl('https://api.telegram.org/');
    }

    /**
     * @param array $data
     * @return array
     * @throws RequestException
     */
    public function sendMessage(array $data): array {
        return $this->baseRequest()->post(  $this->getBot() . '/sendMessage', $data)->throw()->json();
    }

    /**
     * @param string $file_id
     * @return array|mixed
     * @throws RequestException
     */
    public function getFile(string $file_id): mixed {
        return $this->baseRequest()->post(  $this->getBot() . '/getFile', [
            'file_id' => $file_id,
        ])->throw()->json();
    }

    /**
     * @param string $file_id
     * @return string
     * @throws RequestException
     */
    public function downloadFile(string $file_id = 'BQACAgIAAxkBAAPLZKBMhPg3tya4xn34pJiJuGjM_lIAAqMvAALJDAABSQpR9KiWURH2LwQ'): string {
        $file_path = $this->getFile($file_id);
        $downloadPath = 'https://api.telegram.org/file/' . $this->getBot() . '/' . $file_path['result']['file_path'];

        $contents = file_get_contents($downloadPath);
        $name = Carbon::now()->unix() . substr($downloadPath, strrpos($downloadPath, '/') + 1);
        Storage::put('/public/' . $name, $contents);

        return $name;
    }

    public function sendDocument(array $data, string $file_path): array {
        return $this->baseRequest()
             ->attach('document', Storage::get($file_path), 'document.png')
             ->post($this->getBot() . '/sendDocument', $data)->json();
    }

    /**
     * @param array $data
     * @return array
     * @throws RequestException
     */
    public function sendButtons(array $data): array {
        return $this->baseRequest()->post(  $this->getBot() . '/sendMessage', $data)->throw()->json();
    }

    protected abstract function getBot(): string;

    public abstract function setWebHook(): array;
}
