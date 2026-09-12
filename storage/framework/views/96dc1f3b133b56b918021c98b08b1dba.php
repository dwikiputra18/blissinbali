<?php if (isset($component)) { $__componentOriginalb525200bfa976483b4eaa0b7685c6e24 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb525200bfa976483b4eaa0b7685c6e24 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-widgets::components.widget','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-widgets::widget'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if (isset($component)) { $__componentOriginalee08b1367eba38734199cf7829b1d1e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee08b1367eba38734199cf7829b1d1e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.section.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div
            x-data="{
                isSupported: ('serviceWorker' in navigator) && ('PushManager' in window),
                isSubscribed: false,
                isLoading: false,
                permission: Notification.permission,
                statusMessage: '',
                vapidPublicKey: '<?php echo e(config('webpush.vapid.public_key')); ?>',
                csrfToken: '<?php echo e(csrf_token()); ?>',
                audioCtx: null,
                isAudioUnlocked: false,

                async init() {
                    if (!this.isSupported) {
                        this.statusMessage = 'Browser tidak mendukung Web Push.';
                        return;
                    }

                    try {
                        const reg = await navigator.serviceWorker.register('/sw.js');
                        console.log('Push Alert: Service Worker registered on origin ' + window.location.origin);
                        
                        const sub = await reg.pushManager.getSubscription();
                        if (sub) {
                            this.isSubscribed = true;
                        }
                    } catch (e) {
                        console.error('Push Alert: SW registration failed:', e);
                    }

                    navigator.serviceWorker.addEventListener('message', (event) => {
                        if (event.data && event.data.type === 'PLAY_NOTIFICATION_SOUND') {
                            console.log('Push Alert: Sound trigger received via postMessage');
                            this.playSound();
                        }
                    });

                    try {
                        const bc = new BroadcastChannel('push_notification_channel');
                        bc.onmessage = (event) => {
                            if (event.data && event.data.type === 'PLAY_NOTIFICATION_SOUND') {
                                console.log('Push Alert: Sound trigger received via BroadcastChannel');
                                this.playSound();
                            }
                        };
                    } catch (e) {
                        console.warn('Push Alert: BroadcastChannel failed:', e);
                    }

                    window.testNotificationSound = () => {
                        console.log('Push Alert: Running manual sound test...');
                        this.playSound(true);
                    };

                    window.simulateServiceWorkerMessage = () => {
                        console.log('Push Alert: Simulating SW message...');
                        window.postMessage({ type: 'PLAY_NOTIFICATION_SOUND' }, '*');
                        const bc = new BroadcastChannel('push_notification_channel');
                        bc.postMessage({ type: 'PLAY_NOTIFICATION_SOUND' });
                    };
                    
                    window.addEventListener('message', (event) => {
                        if (event.data && event.data.type === 'PLAY_NOTIFICATION_SOUND') {
                            console.log('Push Alert: Sound trigger received via Window Message (Simulation)');
                            this.playSound();
                        }
                    });
                    
                    setInterval(() => {
                        this.permission = Notification.permission;
                    }, 2000);
                },

                async subscribe() {
                    if (!this.isSupported) return;
                    if (Notification.permission === 'denied') {
                        this.statusMessage = '❌ Notifikasi diblokir. Silakan aktifkan di pengaturan browser.';
                        return;
                    }

                    this.isLoading = true;
                    this.statusMessage = 'Menghubungkan ke server push...';

                    try {
                        const reg = await navigator.serviceWorker.ready;
                        const sub = await reg.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: this.urlBase64ToUint8Array(this.vapidPublicKey),
                        });

                        const res = await fetch('/subscriptions', {
                            method: 'POST',
                            body: JSON.stringify(sub),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrfToken,
                            },
                        });

                        if (res.ok || res.status === 201) {
                            this.isSubscribed = true;
                            this.statusMessage = '✅ Notifikasi aktif!';
                            this.playSound(true);
                        } else {
                            const errorText = await res.text();
                            console.error('Push Alert: Subscription error:', errorText);
                            this.statusMessage = '❌ Gagal menyimpan subscription.';
                        }
                    } catch (e) {
                        console.error('Push Alert:', e);
                        this.statusMessage = '❌ Gagal: ' + e.message;
                    } finally {
                        this.isLoading = false;
                        this.permission = Notification.permission;
                    }
                },

                async unsubscribe() {
                    this.isLoading = true;
                    try {
                        const reg = await navigator.serviceWorker.ready;
                        const sub = await reg.pushManager.getSubscription();
                        if (sub) {
                            await fetch('/subscriptions/delete', {
                                method: 'POST',
                                body: JSON.stringify({ endpoint: sub.endpoint }),
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': this.csrfToken,
                                },
                            });
                            await sub.unsubscribe();
                        }
                        this.isSubscribed = false;
                        this.statusMessage = 'Notifikasi telah dinonaktifkan.';
                    } catch (e) {
                        this.statusMessage = '❌ Gagal: ' + e.message;
                    } finally {
                        this.isLoading = false;
                    }
                },

                async playSound(isTest = false) {
    console.log('Push Alert: Attempting to play sound...');
    try {
        if (!this.audioCtx) {
            this.audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        }
        if (this.audioCtx.state === 'suspended') {
            await this.audioCtx.resume();
        }

        // --- Coba load MP3 eksternal dulu ---
        const response = await fetch('/notification.mp3');
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const contentType = response.headers.get('content-type');
        console.log('Audio content-type:', contentType);
        
        const arrayBuffer = await response.arrayBuffer();
        console.log('Audio buffer size:', arrayBuffer.byteLength, 'bytes');
        
        if (arrayBuffer.byteLength < 1000) {
            throw new Error(`Audio file too small (${arrayBuffer.byteLength} bytes). Fallback to beep.`);
        }
        
        const audioBuffer = await this.audioCtx.decodeAudioData(arrayBuffer);
        const source = this.audioCtx.createBufferSource();
        source.buffer = audioBuffer;
        source.connect(this.audioCtx.destination);
        source.start(0);

        this.isAudioUnlocked = true;
        console.log('Push Alert: MP3 playback started correctly');
        
    } catch (e) {
        console.warn('Push Alert: MP3 failed, using fallback beep:', e.message);
        
        // --- Fallback: Generate beep keras & stabil ---
        try {
            const osc = this.audioCtx.createOscillator();
            const gain = this.audioCtx.createGain();
            
            osc.type = 'square'; // Lebih keras & tajam
            osc.frequency.value = 1000; // Nada 1000Hz jelas
            
            gain.gain.setValueAtTime(0.8, this.audioCtx.currentTime); // Volume keras
            gain.gain.exponentialRampToValueAtTime(0.001, this.audioCtx.currentTime + 0.25); // Fade out halus
            
            osc.connect(gain);
            gain.connect(this.audioCtx.destination);
            
            osc.start();
            osc.stop(this.audioCtx.currentTime + 0.25); // Durasi 250ms, sekali bunyi
            
            console.log('Push Alert: Fallback beep played');
            this.isAudioUnlocked = true;
        } catch (fallbackErr) {
            console.error('Push Alert: Fallback beep also failed:', fallbackErr);
            if (isTest) {
                alert('Audio Error: ' + e.message + '\n\nFallback juga gagal. Cek console.');
            }
        }
    }
},
                urlBase64ToUint8Array(base64String) {
                    const padding = '='.repeat((4 - base64String.length % 4) % 4);
                    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
                    const rawData = window.atob(base64);
                    const arr = new Uint8Array(rawData.length);
                    for (let i = 0; i < rawData.length; i++) arr[i] = rawData.charCodeAt(i);
                    return arr;
                },
            }"
            x-init="init()"
        >
            <div class="flex items-center justify-between gap-6 flex-wrap">
                <div class="flex items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight">Real-time Booking Alerts</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <template x-if="isSubscribed">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900/30 dark:text-success-400">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-success-600"></span>
                                    Active
                                </span>
                            </template>
                            <template x-if="!isSubscribed">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-400">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-gray-400"></span>
                                    Inactive
                                </span>
                            </template>
                            <span class="text-sm text-gray-500" x-text="statusMessage"></span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['color' => 'gray','icon' => 'heroicon-m-speaker-wave','@click' => 'playSound(true)','size' => 'sm','outlined' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => 'heroicon-m-speaker-wave','@click' => 'playSound(true)','size' => 'sm','outlined' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        Test Sound
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>

                    <div x-show="!isSubscribed">
                        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['@click' => 'subscribe()','icon' => 'heroicon-m-bell','xBind:disabled' => 'isLoading || !isSupported']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'subscribe()','icon' => 'heroicon-m-bell','x-bind:disabled' => 'isLoading || !isSupported']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            <span x-text="isLoading ? 'Enabling...' : 'Enable Notifications'"></span>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                    </div>

                    <div x-show="isSubscribed">
                        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['@click' => 'unsubscribe()','icon' => 'heroicon-m-bell-slash','color' => 'danger','xBind:disabled' => 'isLoading']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'unsubscribe()','icon' => 'heroicon-m-bell-slash','color' => 'danger','x-bind:disabled' => 'isLoading']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            <span x-text="isLoading ? 'Disabling...' : 'Disable'"></span>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>

            <template x-if="permission === 'denied'">
                <div class="mt-4 p-3 rounded-lg bg-danger-50 dark:bg-danger-900/20 text-danger-700 dark:text-danger-400 text-sm flex items-start gap-2">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-m-exclamation-triangle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mt-0.5 shrink-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                    <p>
                        <strong>Notifications are blocked.</strong> Please check browser settings to "Allow" notifications.
                    </p>
                </div>
            </template>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $attributes = $__attributesOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__attributesOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee08b1367eba38734199cf7829b1d1e9)): ?>
<?php $component = $__componentOriginalee08b1367eba38734199cf7829b1d1e9; ?>
<?php unset($__componentOriginalee08b1367eba38734199cf7829b1d1e9); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb525200bfa976483b4eaa0b7685c6e24)): ?>
<?php $attributes = $__attributesOriginalb525200bfa976483b4eaa0b7685c6e24; ?>
<?php unset($__attributesOriginalb525200bfa976483b4eaa0b7685c6e24); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb525200bfa976483b4eaa0b7685c6e24)): ?>
<?php $component = $__componentOriginalb525200bfa976483b4eaa0b7685c6e24; ?>
<?php unset($__componentOriginalb525200bfa976483b4eaa0b7685c6e24); ?>
<?php endif; ?><?php /**PATH /home/dwiki/Documents/website/blissinbali/resources/views/filament/widgets/push-notification-toggler.blade.php ENDPATH**/ ?>