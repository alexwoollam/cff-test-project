<?php

namespace CFF\Utilities\Core;

interface ImagesInterface
{

    public static function getImage( string $image_path, $args = [] ): ?string;

}