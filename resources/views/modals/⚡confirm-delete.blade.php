<?php

use Livewire\Component;

new class extends Component
{
    public string $model_id = '';

    public string $model_type = '';

    public string $model_label = '';

    public function close(): void
    {
        $this->dispatch('close_modal');
    }

    public function confirm(): void
    {
        $this->dispatch("{$this->model_type}_delete_confirmed", id: (int) $this->model_id);
        $this->dispatch('close_modal');
    }
};
?>

@php
    $rawMessage = __('modals.' . $model_type . '.message');
    [$messageBefore, $messageAfter] = str_contains($rawMessage, ':name')
        ? explode(':name', $rawMessage, 2)
        : [$rawMessage, ''];
@endphp

<x-modals.confirm-dialog
    :title="__('modals.' . $model_type . '.title')"
    :message-before="$messageBefore"
    :message-after="$messageAfter"
    :name="$model_label"
    :confirm-label="__('modals.' . $model_type . '.confirm')"
    :cancel-label="__('modals.' . $model_type . '.cancel')"
/>
