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
                <div class="content-header-left col-md-7 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Articles Categories</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Categories
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-5 col-12">
                    <div class="form-group">
                        <a href="#" class="btn-icon btn btn-primary btn-round" data-toggle="modal" data-target="#create-modal"><i data-feather="edit"></i> Create New Category</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card p-1">
                            <div class="row" id="table-hover-row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('article-categories-table', [])->html();
} elseif ($_instance->childHasBeenRendered('wFdSFRe')) {
    $componentId = $_instance->getRenderedChildComponentId('wFdSFRe');
    $componentTag = $_instance->getRenderedChildComponentTagName('wFdSFRe');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('wFdSFRe');
} else {
    $response = \Livewire\Livewire::mount('article-categories-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('wFdSFRe', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?></livewire:article-categories-tab>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php echo $__env->make('admin.article.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.modals.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
    <?php $__env->startPush('custom-scripts'); ?>
    <script>
        window.addEventListener('success', event => {
            $("#successAlert").modal('show');
            $("#message").html(event.detail.message);

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            Livewire.hook('message.processed', (message, component) => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        });

        window.addEventListener('openModalCreate', event => {
            $("#create-modal").modal('show');
        });

        window.addEventListener('closeModalCreate', event => {
            $("#create-modal").modal('hide');
        });

        window.addEventListener('openModalEdit', event => {
            $("#edit-modal").modal('show');
        });
        window.addEventListener('closeModalEdit', event => {
            $("#edit-modal").modal('hide');
        });

        window.addEventListener('loadModalCreate', event => {
            document.location.reload(true);
        });

        window.addEventListener('openModalDetail', event => {
            $("#detail-modal").modal('show');
        });

        window.addEventListener('openModalDelete', event => {
            $("#delete-modal").modal('show');
        });

        window.addEventListener('closeModalDelete', event => {
            $("#delete-modal").modal('hide');
        });
    </script>
    <?php $__env->stopPush(); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e)): ?>
<?php $component = $__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e; ?>
<?php unset($__componentOriginal6d37cff2410bd73b1917b54c645d2cccbed85e3e); ?>
<?php endif; ?>
<?php /**PATH /home/proh9171/public_html/prosiding.stpkat.ac.id/resources/views/admin/article/category/index.blade.php ENDPATH**/ ?>