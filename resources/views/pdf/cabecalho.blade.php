<div style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
    <hr style="height:1px;border-width:0;color:rgb(50, 50, 50);background-color:black">
    <div>
        <span style="font-size: large">{{ $obra->proprietario }}</span>
        <span style="float: right; font-size: small">Data: {{ date('d/m/Y') }}</span>
        <br>
        <span>{{ $obra->endereco }}</span>
        <span style="float: right; font-size: small">Hora: {{ date('H:i') }}</span>
    </div>
    <hr style="height:1px;border-width:0;color:rgb(50, 50, 50);background-color:black">
    @yield('conteudo')
</div>
