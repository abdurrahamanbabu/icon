<style>
    :root {
        --icon-showcase-bg: {{ config('icon.showcase.background_color', '#e3e3e2') }};
        --icon-item-bg: {{ config('icon.icon_item.background_color', '#e6e8ea') }};
        --icon-item-color: {{ config('icon.icon_item.font_color', '#3c3737e0') }};
        --icon-item-border: {{ config('icon.border.color', '#f1f1f1') }};
        --icon-showcase-shadow: {{ config('icon.shadow.color', '#01010170') }};
    }

    .icon-showcase {
        background: var(--icon-showcase-bg);
        box-shadow: 1px 3px 4px 2px var(--icon-showcase-shadow);
    }

    .icon-showcase div {
        background: var(--icon-item-bg);
        color: var(--icon-item-color);
        border: 1px solid var(--icon-item-border);
    }
</style>
