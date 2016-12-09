<pre>
    BackEnd: {{ $a->info->pxname }}
    Servers: {{ $a->info->svname }}
    Status:  {{ $a->info->status }}
    Status:  {{ $a->health->status }}

    TimeStatus(Segundos): {{ floor($a->health->status_change%60) }} Segundos
    TimeStatus(Minuto): {{ intval(floor($a->health->status_change%3600)/60) }} Minutos
    TimeStatus(Horas): {{ intval(floor($a->health->status_change%86400)/3600) }} Horas
    TimeStatus(Dias): {{ intval(floor($a->health->status_change%2592000)/86400) }} Dias
    TimeStatus(Meses): {{ intval(floor($a->health->status_change/2592000)) }} Meses

    ServerActive: {{ $a->health->active }}
    CheckStatus: {{ $a->health->check_status }}
    CheckStatus: {{ $a->health->check_duration }} ms

    BytesIN: {{ floor($a->bytes->bin/1000)/1000 }} MBytes
    BytesOUT: {{ floor($a->bytes->bout/1000)/1000 }} MBytes

    SessionCurrent: {{ $a->session->scur }}
    SessionMax: {{ $a->session->smax }}
    SessionLimit: {{ $a->session->slim }}

</pre>

<pre>
    <?php// print_r($a);?>
</pre>
