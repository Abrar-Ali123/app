<div class="bg-light p-1 d-flex align-items-center" style="border-width: 1px;border-radius: 1px">
    @foreach($item['product_item_features'] as $productFeature)
        @switch($productFeature['feature'])
            @case('Color')
            <div class="rounded-circle d-inline-block"
                 style="width: 15px;height: 15px;background: {{$productFeature['value']}}"></div>
            @break
            @case('Size')
            <div class="border d-inline-block px-1"><span style="font-size: 12px"
                                                          class="font-weight-semibold">{{$productFeature['value']}}</span>
            </div>
            @break
            @case('Gram')
            <div class="border d-inline-block px-1"><span style="font-size: 12px" class="font-weight-semibold">{{$productFeature['value']}} <i
                        class="mdi mdi-weight-gram"></i></span></div>
            @break
            @default
            <div class="d-inline-block"><span style="font-size: 13px">{{$productFeature['value']}}</span></div>
        @endswitch
        <div class="pr-1"></div>
    @endforeach
</div>
