<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKGO8SPm\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKGO8SPm/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKGO8SPm.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKGO8SPm\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerKGO8SPm\App_KernelDevDebugContainer([
    'container.build_hash' => 'KGO8SPm',
    'container.build_id' => 'c2baa8ca',
    'container.build_time' => 1731925174,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKGO8SPm');
