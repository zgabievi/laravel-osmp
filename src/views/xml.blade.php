<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<response>
    <result>{!! $result !!}</result>
    @if(count($info) > 0)
        <info>
            @foreach($info as $key => $value)
                <extra name="{!! $key !!}">{!! $value !!}</extra>
            @endforeach
        </info>
    @endif
    <comment>{!! $comment !!}</comment>
</response>
