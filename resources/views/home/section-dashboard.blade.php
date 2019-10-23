<div class="hbox text-center b-b b-light text-sm">          
    <a href="{{ url('dashboard/posisi-kas') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-random block m-b-xs fa-2x"></i>
        <span>Posisi Kas Siap Edar</span>
    </a>
    <a href="{{ url('dashboard/kecukupan-kas') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-circle-o-notch block m-b-xs fa-2x"></i>
        <span>Kecukupan Kas</span>
    </a>
    <a href="{{ url('dashboard/kas-titipan') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-cubes block m-b-xs fa-2x"></i>
        <span>Posisi Kas Titipan</span>
    </a>   
    <a href="{{ url('dashboard/outflow') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-upload block m-b-xs fa-2x"></i>
        <span>Outflow</span>
    </a>
    <a href="{{ url('dashboard/inflow') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-download block m-b-xs fa-2x"></i>
        <span>Inflow</span>
    </a>
    <a href="{{ url('dashboard/pemusnahan') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-fire block m-b-xs fa-2x"></i>
        <span>Pemusnahan</span>
    </a>      
    <a href="{{ url('dashboard/khazanah') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-archive block m-b-xs fa-2x"></i>
        <span>Kepadatan Khazanah</span>
    </a>
    <a href="{{ url('dashboard/backlog') }}" class="col padder-v text-muted">
        <i class="fa fa-code-fork block m-b-xs fa-2x"></i>
        <span>Backlog</span>
    </a>
</div>
<div class="hbox text-center text-sm">             
    <a href="{{ url('dashboard/remise') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-plane block m-b-xs fa-2x"></i>
        <span>Remise</span>
    </a>   
    <a href="{{ url('dashboard/kas-keliling') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-exchange block m-b-xs fa-2x"></i>
        <span>Kas Keliling</span>
    </a>
    <a href="#" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-dashboard block m-b-xs fa-2x"></i>
        <span>Kinerja MSUK</span>
    </a>
    {{-- <a href="{{ url('dashboard/uyd') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-money block m-b-xs fa-2x"></i>
        <span>UYD</span>
    </a>  --}}
    <a href="{{ url('dashboard/survei') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-list block m-b-xs fa-2x"></i>
        <span>Survey</span>
    </a>
    <a href="{{ url('dashboard/upal') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-money block m-b-xs fa-2x"></i>
        <span>Uang Palsu</span>
    </a>
    <a href="{{ url('dashboard/eku') }}" class="col padder-v text-muted b-r b-light">
        <i class="fa fa-cube block m-b-xs fa-2x"></i>
        <span>EKU vs Realisasi</span>
    </a>
    <a href="javascript:void(0)" class="col padder-v text-muted">
    </a>
    <a href="#" class="col padder-v text-muted b-r b-light">
        {{-- <i class="fa fa-money block m-b-xs fa-2x"></i>
        <span>UYD</span> --}}
    </a>    
</div>