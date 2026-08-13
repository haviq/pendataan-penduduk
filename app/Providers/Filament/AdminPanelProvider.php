<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Blue,
                'gray'    => Color::Slate,
            ])
            ->brandName('SIDUKUH Gondang')
            ->font('Inter', provider: \Filament\FontProviders\GoogleFontProvider::class)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ── BASE ── */
*, *::before, *::after { font-family: "Inter", system-ui, sans-serif !important; }

/* ── SIDEBAR ── */
.fi-sidebar {
    background: #ffffff !important;
    border-right: 1px solid #e5e7eb !important;
}
.fi-sidebar-nav { padding: 8px !important; }

/* sidebar item */
.fi-sidebar-item-button {
    border-radius: 8px !important;
    font-size: .82rem !important;
    font-weight: 600 !important;
    color: #1f2937 !important;
    transition: background .15s, color .15s !important;
}
.fi-sidebar-item-button:hover {
    background: #f3f4f6 !important;
    color: #111827 !important;
}
.fi-sidebar-item-button.fi-active,
.fi-sidebar-item-button[aria-current] {
    background: #eff6ff !important;
    color: #2563eb !important;
    font-weight: 700 !important;
}
/* icon & label di dalam sidebar item */
.fi-sidebar-item-button span,
.fi-sidebar-item-button svg {
    color: inherit !important;
}
/* sub-item / nested nav */
.fi-sidebar-nav-item .fi-sidebar-item-label,
.fi-sidebar-group-items .fi-sidebar-item-button {
    color: #1f2937 !important;
    font-weight: 600 !important;
}

/* sidebar group label */
.fi-sidebar-group-label {
    font-size: .68rem !important;
    font-weight: 600 !important;
    color: #9ca3af !important;
    letter-spacing: .06em !important;
    text-transform: uppercase !important;
    padding: 0 8px !important;
    margin: 14px 0 4px !important;
}

/* sidebar brand */
.fi-sidebar-header {
    border-bottom: 1px solid #e5e7eb !important;
    padding: 14px 16px !important;
    background: #ffffff !important;
}
.fi-brand-name {
    font-size: .9rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
    letter-spacing: -.01em !important;
}
.fi-brand-logo { display: none !important; }

/* ── TOPBAR ── */
.fi-topbar {
    background: rgba(255,255,255,.92) !important;
    backdrop-filter: blur(12px) !important;
    border-bottom: 1px solid #e5e7eb !important;
    box-shadow: none !important;
}
.fi-topbar-breadcrumbs li,
.fi-topbar-breadcrumbs a {
    font-size: .82rem !important;
    font-weight: 500 !important;
    color: #6b7280 !important;
}
.fi-topbar-breadcrumbs li:last-child {
    color: #111827 !important;
    font-weight: 600 !important;
}

/* ── MAIN CONTENT ── */
.fi-main {
    background: #f9fafb !important;
}
.fi-page-header-heading {
    font-size: 1.3rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
    letter-spacing: -.02em !important;
}

/* ── CARDS / WIDGETS ── */
.fi-wi-stats-overview-stat,
.fi-wi,
.fi-card {
    background: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 2px rgba(0,0,0,.05) !important;
}
.fi-wi-stats-overview-stat-label {
    font-size: .75rem !important;
    font-weight: 600 !important;
    color: #6b7280 !important;
    text-transform: uppercase !important;
    letter-spacing: .04em !important;
}
.fi-wi-stats-overview-stat-value {
    font-size: 1.6rem !important;
    font-weight: 800 !important;
    color: #111827 !important;
    letter-spacing: -.03em !important;
}

/* ── TABLES ── */
.fi-ta-header-cell {
    font-size: .7rem !important;
    font-weight: 600 !important;
    color: #9ca3af !important;
    text-transform: uppercase !important;
    letter-spacing: .06em !important;
}
.fi-ta-cell {
    font-size: .82rem !important;
    color: #374151 !important;
    border-color: #f3f4f6 !important;
}
.fi-ta-row:hover .fi-ta-cell {
    background: #f9fafb !important;
}

/* ── BUTTONS ── */
.fi-btn-primary {
    background: #2563eb !important;
    border-color: #2563eb !important;
    border-radius: 8px !important;
    font-size: .82rem !important;
    font-weight: 600 !important;
    box-shadow: none !important;
}
.fi-btn-primary:hover {
    background: #1d4ed8 !important;
    border-color: #1d4ed8 !important;
}
.fi-btn {
    border-radius: 8px !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    box-shadow: none !important;
}

/* ── FORM INPUTS ── */
.fi-input,
.fi-select-input,
.fi-fo-select select {
    border-radius: 8px !important;
    border-color: #e5e7eb !important;
    font-size: .82rem !important;
    background: #ffffff !important;
    box-shadow: none !important;
}
.fi-input:focus,
.fi-select-input:focus {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 2px rgba(59,130,246,.15) !important;
}
.fi-fo-field-wrp-label label {
    font-size: .8rem !important;
    font-weight: 600 !important;
    color: #374151 !important;
}

/* ── BADGES ── */
.fi-badge {
    border-radius: 99px !important;
    font-size: .68rem !important;
    font-weight: 600 !important;
}

/* ── DROPDOWN ── */
.fi-dropdown-panel {
    max-height: 24rem;
    overflow-y: auto;
    border-radius: 10px !important;
    border: 1px solid #e5e7eb !important;
    box-shadow: 0 4px 6px rgba(0,0,0,.06), 0 2px 4px rgba(0,0,0,.04) !important;
    background: #ffffff !important;
}
.fi-dropdown-list-item-label {
    font-size: .82rem !important;
    color: #374151 !important;
}

/* ── LOGIN PAGE ── */
.fi-simple-main {
    background: #f9fafb !important;
}
.fi-simple-page {
    background: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 14px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,.08) !important;
}
.fi-simple-page .fi-logo .fi-brand-name {
    font-size: 1.1rem !important;
    font-weight: 800 !important;
}

/* ── PAGINATION ── */
.fi-pagination-item button,
.fi-pagination-previous-btn,
.fi-pagination-next-btn {
    border-radius: 6px !important;
    font-size: .75rem !important;
    font-weight: 500 !important;
    border-color: #e5e7eb !important;
}
.fi-pagination-item--active button {
    background: #2563eb !important;
    border-color: #2563eb !important;
    color: #ffffff !important;
}

/* ── SECTION HEADINGS ── */
.fi-section-header-heading {
    font-size: .9rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
}
.fi-section {
    background: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 2px rgba(0,0,0,.04) !important;
}
</style>
'
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                //
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
