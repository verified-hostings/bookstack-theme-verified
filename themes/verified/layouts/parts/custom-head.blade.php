@inject('headContent', 'BookStack\Theming\CustomHtmlHeadContentProvider')

@if(!request()->routeIs('settings.category'))
<!-- Start: custom user content -->
{!! $headContent->forWeb() !!}
<!-- End: custom user content -->
@endif

{{-- Verified theme: brand stylesheet served via BookStack's theme route --}}
<link rel="stylesheet" href="{{ url('/theme/verified/css/verified.css') }}">
