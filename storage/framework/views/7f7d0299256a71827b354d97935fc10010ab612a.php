<?php $__env->startSection('title'); ?>
    Rekening -
<?php $__env->stopSection(); ?>
<?php if (isset($component)) { $__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayouts::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('master-layouts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\MasterLayouts::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Rekening</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">Prosiding
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('prosiding.pembayaran')); ?>">Pembayaran</a>
                                    </li>
                                    <li class="breadcrumb-item active">Rekening
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-5 col-12">

                </div>
            </div>
            <div class="content-body">
                <div class="blog-list-wrapper">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('prosiding.rekening')->html();
} elseif ($_instance->childHasBeenRendered('iDG1tIx')) {
    $componentId = $_instance->getRenderedChildComponentId('iDG1tIx');
    $componentTag = $_instance->getRenderedChildComponentTagName('iDG1tIx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iDG1tIx');
} else {
    $response = \Livewire\Livewire::mount('prosiding.rekening');
    $html = $response->html();
    $_instance->logRenderedChild('iDG1tIx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e)): ?>
<?php $component = $__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e; ?>
<?php unset($__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e); ?>
<?php endif; ?>
<?php /**PATH /home/proh9171/public_html/prosiding.stpkat.ac.id/resources/views/admin/prosiding/rekening/index.blade.php ENDPATH**/ ?>