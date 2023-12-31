@extends('main')
@section('content')
<!-- top tiles -->
<div class="row tile_count" onclick="document.location = 'streams.php?running=1'" style="cursor:pointer">
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fas fa-volume-up"></i></i> Online streams</span>
            <div class="count">{{ $online }}</div>
        </div>
    </div>
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count" onclick="document.location = 'streams.php?running=2'" style="cursor:pointer">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fas fa-volume-mute"></i> Offline streams</span>
            <div class="count">{{ $offline }}</div>
        </div>
    </div>
    <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count" onclick="document.location = 'streams.php'" style="cursor:pointer">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fas fa-rss"></i> Total streams</span>
            <div class="count green">{{ $all }}</div>
        </div>
    </div>


</div>
<!-- /top tiles -->



<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h3>SYSTEM INFORMATIONS</h3>
            </div>
            <div class="x_content">
                <h4>Hardware Resources:</h4>
                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>STORAGE</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-{{ barColor($space['pr']) }}" role="progressbar" aria-valuenow="{{ $space['pr'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $space['pr'] }}%;">

                            </div>
                        </div>
                    </div>
                    <div class="w_left w_20">
                        <span>{{ round(( $space['count'] / 1024 ),2) }} / {{ round(( $space['total'] / 1024 ),2) }}GB</span>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>CPU LOAD</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-{{ barColor($cpu['pr']) }}" role="progressbar" aria-valuenow="{{ $cpu['pr'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $cpu['pr'] }}%;">

                            </div>
                        </div>
                    </div>
                    <div class="w_left w_20">
                        <span>{{ $cpu['pr'] }} %</span>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                    <div class="w_left w_25">
                        <span>MEMORY USAGE</span>
                    </div>
                    <div class="w_center w_55">
                        <div class="progress">
                            <div class="progress-bar bg-{{ barColor($mem['pr']) }}" role="progressbar" aria-valuenow="{{ $mem['pr'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $mem['pr'] }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="w_left w_20">
                        <span>{{ round(( $mem['count'] / 1024 /1024 ),2) }} / {{ round(( $mem['total'] / 1024 /1024 ),2) }}GB</span>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
            @php
            if ( $gpupresent ) {
            echo '
            <div class="x_title">
                <h3>GPUs INFORMATIONS</h3>
            </div>';
            for ($i = 0; $i < count($gpuinfos); $i++){ echo '<div class="x_content">
                    <h4>GPU ' . $i . ' - ' . $gpuinfos[$i]['cardname'] .':</h4> <div class="widget_summary">
                <div class="w_left w_25">
                    <span>GPU LOAD</span>
                </div>
                <div class="w_center w_55">
                    <div class="progress">
                        <div class="progress-bar bg-'. barColor($gpuinfos[$i]['gpuutil']) . '" role="progressbar" aria-valuenow="' . $gpuinfos[$i]['gpuutil'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $gpuinfos[$i]['gpuutil'] . '%;"></div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                <div class="w_left w_20">
                    <span>' . $gpuinfos[$i]['gpuutil'].'%</span>
                </div>
                <div class="w_left w_25">
                    <span>GPU MEMORY</span>
                </div>
                <div class="w_center w_55">
                    <div class="progress">
                        <div class="progress-bar bg-'. barColor($gpuinfos[$i]['memutil']) . '" role="progressbar" aria-valuenow="' . $gpuinfos[$i]['memutil'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $gpuinfos[$i]['memutil'] . '%;"></div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                <div class="w_left w_20">
                    <span>' . $gpuinfos[$i]['memutil'].'%</span>
                </div>
        </div>
        <div class="widget_summary">
            <div class="w_left w_25">
                <span>GPU TEMP</span>
            </div>
            <div class="w_center w_55">
                <div class="progress">
                    <div class="progress-bar bg-'. barColor(round($gpuinfos[$i]['temp'] / 86 * 100)) . '" role="progressbar" aria-valuenow="' . $gpuinfos[$i]['temp'] . '" aria-valuemin="0" aria-valuemax="86" style="width: ' . ($gpuinfos[$i]['temp'] / 86 * 100) . '%;"></div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="w_left w_20">
                <span>' . $gpuinfos[$i]['temp'].'°C (~ '. round(($gpuinfos[$i]['temp'] / 86 * 100)) .'%)</span>
            </div>
            <div class="w_left w_25">
                <span>ENCODER USE</span>
            </div>
            <div class="w_center w_55">
                <div class="progress">
                    <div class="progress-bar bg-'. barColor($gpuinfos[$i]['encodutil']) . '" role="progressbar" aria-valuenow="' . $gpuinfos[$i]['encodutil'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $gpuinfos[$i]['encodutil'] . '%;"></div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            <div class="w_left w_20">
                <span>' . $gpuinfos[$i]['encodutil'].'%</span>
            </div>
        </div>
    </div>
</div>';
}
}
@endphp

</div>
</div>
</div>
@endsection
