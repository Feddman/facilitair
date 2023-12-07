<div>
<div class="grid md:grid-cols-2">

    <x-search-filter />
    <div class="p-4 m-4 hidden sm:block">
        <img style="width: 200px" class="mb-4" src="{{asset('img/logo.svg')}}" alt="">
        <p>Welkom bij onze inspiratiehub 'Spaces', waar de creatieve inzet van ruimtes in het onderwijs centraal staat.
            Verken inspirerende indelingen, efficiënte planningen en vernieuwende ideeën van collega's door het land.
            Deze hub biedt een unieke kans om te leren van elkaar en samen onze ruimtes optimaal in te zetten.</p>
            <p><b>Instructie video</b></p>
            <iframe allowfullscreen src="https://feddmanspace.ams3.digitaloceanspaces.com/Facilitair/instructie_facilitair_app.mp4" frameborder="0"></iframe>
    </div>
</div>
@if(count($pins) > 2)
 <div class="m-4 columns-2 md:columns-3 lg:columns-4">
@else
 <div class="m-4 flex w-2/3 items-start gap-4">
@endif
    @forelse($pins as $pin)
        @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
    @empty
    <div class="bg-indigo-500  text-white p-4 rounded-lg">
      <p class="font-medium">Helaas!</p>
      <p class="text-sm">Geen pins gevonden...</p>
    </div>
    @endforelse


</div>
<div class="m-4">
    {{$pins->links()}}
</div>
</div>
