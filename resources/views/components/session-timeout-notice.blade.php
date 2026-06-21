@php
$sessionLifetimeMinutes = max(1, (int) config('session.lifetime', 20));
@endphp

<div
    id="session-timeout-modal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm"
    role="dialog"
    aria-modal="true"
    aria-labelledby="session-timeout-title">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-zinc-900">
        <div class="flex items-start gap-4">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <h2 id="session-timeout-title" class="text-lg font-bold text-[#33333B] dark:text-white">
                    {{ __('Session inactive') }}
                </h2>
                <p id="session-timeout-message" class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-300">
                    {{ __('Your session is about to expire because no activity was detected.') }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button
                type="button"
                id="session-timeout-stay"
                class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                {{ __('I am still here') }}
            </button>
            <a
                href="{{ route('login') }}"
                id="session-timeout-login"
                class="rounded-lg bg-[#1D74E3] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#155ab2]">
                {{ __('Go to login') }}
            </a>
        </div>
    </div>
</div>

<script>
    (() => {
        if (window.__sessionTimeoutNoticeInitialized) {
            return;
        }

        window.__sessionTimeoutNoticeInitialized = true;

        const sessionLifetimeMs = Number(@json($sessionLifetimeMinutes * 60 * 1000));
        const warningDurationMs = Math.min(60_000, Math.max(10_000, Math.floor(sessionLifetimeMs / 10)));
        const warningDelayMs = Math.max(sessionLifetimeMs - warningDurationMs, 0);
        const keepAliveIntervalMs = Math.min(300_000, Math.max(60_000, Math.floor(sessionLifetimeMs / 3)));
        const loginUrl = @json(route('login'));
        const keepAliveUrl = @json(route('session.keep-alive'));
        const csrfToken = @json(csrf_token());
        const activityEvents = ['click', 'keydown', 'mousemove', 'scroll', 'touchstart'];

        let warningTimer = null;
        let expiredTimer = null;
        let redirectTimer = null;
        let lastResetAt = 0;
        let lastKeepAliveAt = Date.now();
        let hasExpired = false;

        const modal = () => document.getElementById('session-timeout-modal');
        const title = () => document.getElementById('session-timeout-title');
        const message = () => document.getElementById('session-timeout-message');
        const stayButton = () => document.getElementById('session-timeout-stay');

        const showModal = () => {
            const element = modal();

            if (!element) {
                return;
            }

            element.classList.remove('hidden');
            element.classList.add('flex');
        };

        const hideModal = () => {
            const element = modal();

            if (!element) {
                return;
            }

            element.classList.add('hidden');
            element.classList.remove('flex');
        };

        const clearTimers = () => {
            clearTimeout(warningTimer);
            clearTimeout(expiredTimer);
            clearTimeout(redirectTimer);
        };

        const showWarning = () => {
            if (hasExpired) {
                return;
            }

            if (title()) {
                title().textContent = 'Session inactive';
            }

            if (message()) {
                message().textContent = 'Your session is about to expire because no activity was detected.';
            }

            if (stayButton()) {
                stayButton().classList.remove('hidden');
            }

            showModal();
        };

        const expireSessionNotice = () => {
            hasExpired = true;
            clearTimers();

            if (title()) {
                title().textContent = 'Session expired';
            }

            if (message()) {
                message().textContent = 'Your session ended due to inactivity. Please log in again before continuing.';
            }

            if (stayButton()) {
                stayButton().classList.add('hidden');
            }

            showModal();

            redirectTimer = setTimeout(() => {
                window.location.href = loginUrl;
            }, 10_000);
        };

        const resetInactivityTimers = () => {
            if (hasExpired || !Number.isFinite(sessionLifetimeMs) || sessionLifetimeMs <= 0) {
                return;
            }

            clearTimers();
            hideModal();

            warningTimer = setTimeout(showWarning, warningDelayMs);
            expiredTimer = setTimeout(expireSessionNotice, sessionLifetimeMs);
        };

        const keepSessionAlive = async () => {
            const now = Date.now();

            if (now - lastKeepAliveAt < keepAliveIntervalMs) {
                return;
            }

            lastKeepAliveAt = now;

            try {
                const response = await fetch(keepAliveUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                if ([401, 419].includes(response.status) || response.redirected) {
                    expireSessionNotice();
                }
            } catch (error) {
                // Network errors should not interrupt the admin while they are active.
            }
        };

        const markActivity = () => {
            if (hasExpired) {
                return;
            }

            const now = Date.now();

            if (now - lastResetAt < 1000) {
                return;
            }

            lastResetAt = now;
            resetInactivityTimers();
            void keepSessionAlive();
        };

        activityEvents.forEach((eventName) => {
            window.addEventListener(eventName, markActivity, {
                passive: true
            });
        });

        document.addEventListener('livewire:navigated', resetInactivityTimers);

        document.addEventListener('click', (event) => {
            if (event.target?.id === 'session-timeout-stay') {
                lastKeepAliveAt = 0;
                resetInactivityTimers();
                void keepSessionAlive();
            }
        }, true);

        resetInactivityTimers();
    })();
</script>