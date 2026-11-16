@inject('headContent', 'BookStack\Theming\CustomHtmlHeadContentProvider')

@if(!request()->routeIs('settings.category'))
<!-- Start: custom user content -->
{!! $headContent->forWeb() !!}
<!-- End: custom user content -->
@endif

{{-- Verified theme: brand stylesheet served via BookStack's theme route --}}
<link rel="stylesheet" href="{{ url('/theme/verified/css/verified.css') }}">

{{--
    Verified theme: dismissible "Get yours on Verified Hostings" demo banner.
    Styles live in public/css/verified.css; the script below injects the
    markup on DOMContentLoaded and persists dismissal in localStorage.
    BookStack's CSP (strict-dynamic) requires the per-request nonce.
--}}
<script nonce="{{ $cspNonce }}">
(function () {
    'use strict';

    var STORAGE_KEY = 'vh-demo-banner-dismissed';
    var HREF = 'https://verifiedhostings.com/pricing';

    try {
        if (window.localStorage && localStorage.getItem(STORAGE_KEY) === '1') {
            return;
        }
    } catch (err) {
        /* storage blocked — show the banner anyway */
    }

    function mount() {
        if (document.getElementById('vh-demo-banner')) {
            return;
        }

        var bar = document.createElement('div');
        bar.id = 'vh-demo-banner';
        bar.setAttribute('role', 'note');
        bar.setAttribute('aria-label', 'Demo notice');
        bar.innerHTML =
            '<span>This is a live demo &mdash; ' +
            '<a href="' + HREF + '" target="_blank" rel="noopener">Get yours on Verified Hostings &rarr;</a>' +
            '</span>' +
            '<button type="button" class="vhb-close" aria-label="Dismiss">&times;</button>';
        document.body.appendChild(bar);

        var basePad = parseFloat(window.getComputedStyle(document.body).paddingBottom) || 0;

        function padBottom() {
            document.body.style.paddingBottom = (basePad + bar.offsetHeight) + 'px';
        }

        function dismiss() {
            window.removeEventListener('resize', padBottom);
            if (bar.parentNode) {
                bar.parentNode.removeChild(bar);
            }
            document.body.style.paddingBottom = basePad ? basePad + 'px' : '';
            try {
                localStorage.setItem(STORAGE_KEY, '1');
            } catch (err) {}
        }

        padBottom();
        window.addEventListener('resize', padBottom);
        bar.querySelector('.vhb-close').addEventListener('click', dismiss);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', mount);
    } else {
        mount();
    }
})();
</script>
