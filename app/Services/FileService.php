<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class FileService
{
    protected array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'docx', 'zip', 'ai', 'psd'];
    protected int $maxSize = 25 * 1024 * 1024; // 25 MB

    /**
     * Valida e salva arquivo em anexo polimórfico (RN012).
     */
    public function upload(UploadedFile $uploadedFile, $fileable, ?int $userId = null, string $disk = 'public'): File
    {
        $ext = strtolower($uploadedFile->getClientOriginalExtension());
        if (!in_array($ext, $this->allowedExtensions)) {
            throw new Exception("Extensão '{$ext}' não é permitida. Extensões válidas: " . implode(', ', $this->allowedExtensions));
        }

        if ($uploadedFile->getSize() > $this->maxSize) {
            throw new Exception("O arquivo excede o limite máximo permitido de 25MB.");
        }

        $folder = 'uploads/' . strtolower(class_basename($fileable));
        $path = $uploadedFile->store($folder, $disk);

        return File::create([
            'user_id' => $userId,
            'fileable_type' => get_class($fileable),
            'fileable_id' => $fileable->id,
            'name' => basename($path),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'disk' => $disk,
            'created_at' => now(),
        ]);
    }
}
