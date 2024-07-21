<x-filament-panels::page>
    {{$this->getRecord()}}
    <livewire:assessment.assessment-questions :assessmentId='$this->getRecord()->id' />
</x-filament-panels::page>
