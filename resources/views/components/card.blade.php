<!-- CARD COMPONENT USED TO WRAP THE LISTING CARD -->

<div {{$attributes->merge(['class'=>'bg-gray-50 border border-gray-200 rounded p-6'])}}">
    {{$slot}}
</div>