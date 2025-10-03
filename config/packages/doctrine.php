<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('doctrine', [
        'orm' => [
            'enable_native_lazy_objects' => \PHP_VERSION_ID >= 80400,
        ],
    ]);
};
