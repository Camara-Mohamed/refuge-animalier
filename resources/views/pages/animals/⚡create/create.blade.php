<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.animals'), 'url' => route('admin.animals.index', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.create_animal')],
    ]" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">Ajouter un animal</h2>
</div>
