<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Closure;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use League\Flysystem\UnableToCheckFileExistence;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageUpload extends FileUpload
{
    protected ?string $optimize = null;

    public static function make(?string $name = null): static
    {
        return static::make($name)
            ->imageEditor()
            ->image()
            ->optimize('webp')
            ->openable(true)
            ->reorderable()
            ->imageEditorAspectRatios([
                '16:9',
                '4:3',
                '1:1',
            ])
            ->imageResizeUpscale(false)
            ->directory('images')
            ->disk('public')
            ->saveUploadedFileUsing(static function (BaseFileUpload $component, TemporaryUploadedFile $file): ?string {
                try {
                    if (! $file->exists()) {
                        return null;
                    }
                } catch (UnableToCheckFileExistence $exception) {
                    return null;
                }

                $compressedImage = null;
                $filename = $component->getUploadedFileNameForStorage($file);
                $optimize = 'webp';
                $resize = null;
                $maxImageWidth = 1200;
                $maxImageHeight = 1200;
                $shouldResize = false;
                $imageHeight = null;
                $imageWidth = null;
                // $originalBinaryFile = $file->get();

                if (
                    str_contains($file->getMimeType(), 'image') &&
                    ($optimize || $resize || $maxImageWidth || $maxImageHeight)
                ) {
                    $image = InterventionImage::make($file);

                    if ($optimize) {
                        $quality = $optimize === 'jpeg' ||
                            $optimize === 'jpg' ? 70 : null;
                    }

                    if ($maxImageWidth && $image->width() > $maxImageWidth) {
                        $shouldResize = true;
                        $imageWidth = $maxImageWidth;
                    }

                    if ($maxImageHeight && $image->height() > $maxImageHeight) {
                        $shouldResize = true;
                        $imageHeight = $maxImageHeight;
                    }

                    if ($resize) {
                        $shouldResize = true;

                        if ($image->height() > $image->width()) {
                            $imageHeight = $image->height() - ($image->height() * ($resize / 100));
                        } else {
                            $imageWidth = $image->width() - ($image->width() * ($resize / 100));
                        }
                    }

                    if ($shouldResize) {
                        $image->resize($imageWidth, $imageHeight, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    if ($optimize) {
                        $compressedImage = $image->encode($optimize, $quality);
                    } else {
                        $compressedImage = $image->encode();
                    }

                    $filename = self::formatFileName($filename, $optimize);
                }

                if ($compressedImage) {
                    Storage::disk($component->getDiskName())->put(
                        $component->getDirectory() . '/' . $filename,
                        $compressedImage->getEncoded()
                    );

                    return $component->getDirectory() . '/' . $filename;
                }

                if (
                    $component->shouldMoveFiles() &&
                    ($component->getDiskName() == (fn(): string => $this->disk)->call($file))
                ) {
                    $newPath = trim($component->getDirectory() . '/' . $component->getUploadedFileNameForStorage($file), '/');

                    $component->getDisk()->move((fn(): string => $this->path)->call($file), $newPath);

                    return $newPath;
                }

                $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';

                return $file->{$storeMethod}(
                    $component->getDirectory(),
                    $component->getUploadedFileNameForStorage($file),
                    $component->getDiskName()
                );
            });
    }

    public function optimize(string | Closure | null $optimize): static
    {
        $this->optimize = $optimize;
        $this->image();

        return $this;
    }

    public function getOptimization(): ?string
    {
        return $this->optimize;
    }

    public static function formatFilename(string $filename, ?string $format): string
    {
        if (! $format) {
            return $filename;
        }

        $extension = strrpos($filename, '.');

        if ($extension !== false) {
            return substr($filename, 0, $extension + 1) . $format;
        }

        return $filename;
    }
}
