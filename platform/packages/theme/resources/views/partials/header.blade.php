{!! SeoHelper::render() !!}

@if ($favicon = theme_option('favicon'))
    <link rel="shortcut icon" href="{{ RvMedia::getImageUrl($favicon) }}">
@endif

@if (Theme::has('headerMeta'))
    {!! Theme::get('headerMeta') !!}
@endif

{!! Theme::asset()->styles() !!}
{!! Theme::asset()->container('after_header')->styles() !!}
{!! Theme::asset()->container('header')->scripts() !!}

{!! apply_filters(THEME_FRONT_HEADER, null) !!}

<script>
    window.siteUrl = "{{ route('public.index') }}";
</script>
