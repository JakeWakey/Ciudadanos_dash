<x-mail::message>
    Reporte Diario
    @foreach ($reportData as $line)
    <p>{{$line }}</p>
    @endforeach
{{ config('app.name') }}
</x-mail::message>
