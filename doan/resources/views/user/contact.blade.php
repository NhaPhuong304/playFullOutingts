@extends('layouts.user.user')

@section('content')

<main class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
    <div class="flex flex-col gap-8">
        <div class="flex flex-col gap-3 text-center">
            <h1 class="text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em]">Get in Touch</h1>
            <p class="text-base font-normal leading-normal text-gray-500 dark:text-gray-400">Fill out the form below, and we'll get back to you as soon as possible.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">
            <div class="w-full flex flex-col gap-6 p-6 md:p-8 bg-card-light dark:bg-card-dark rounded-xl shadow-sm">
                <form id="contactForm" method="POST" action="{{ route('user.contact.send') }}" class="flex flex-col gap-6">
                    @csrf

                    @if(session('success'))
                        <div class="text-sm text-green-600">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="text-sm text-red-600">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Name</p>
                        <input name="name" value="{{ old('name') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="Enter your full name" type="text" />
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Email</p>
                        <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="you@example.com" type="email" />
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Message</p>
                        <textarea name="message" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark min-h-36 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="Write your message here...">{{ old('message') }}</textarea>
                    </label>

                    <input type="hidden" name="captcha_id" id="captcha_id" />
                    <input type="hidden" name="captcha_answer" id="captcha_answer" />

                    <button type="submit" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-blue-600 transition-colors">
                        <span class="truncate">Send Message</span>
                    </button>
                </form>
            </div>
            <div class="w-full flex flex-col gap-6">
                <div class="relative w-full h-80 md:h-full rounded-xl overflow-hidden shadow-sm">
                    <img class="w-full h-full object-cover" data-alt="A stylized map showing streets and a pinned location in a park." data-location="Central Park, New York" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIPTGhk_h79XgaO26elemPqGIEiDTnWPAyzkmFnn2bgXOugQqWeUWuwP3HmZ8_KE60THzpfdKGcfIRSHzX_LoacUvj8K20BEjQEa7KLXnBIz9A6Wqq0iaxyKtQIhzwsnztOA33IV2mjsqz60xAh_pAhChF7wRcKI5YOFDrs18izRS3P0DNYrqYfqcZtirUZEGBDATWvxW3Bt5jA_6OjrA16KUV01nRHAkWPnWq3VT2v4VSJif4IRGg_Vu9tlsiJIYXUqeZ8KV0yko" />
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="p-6 bg-card-light dark:bg-card-dark rounded-xl shadow-sm flex flex-col gap-4">
                    <h3 class="text-lg font-bold">Or Contact Us Directly</h3>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">location_on</span>
                            <p class="text-sm">Central Park Meeting Point, New York, NY</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">mail</span>
                            <p class="text-sm">hello@picnicperfect.com</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">call</span>
                            <p class="text-sm">(555) 123-4567</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Captcha modal -->
    <div id="captchaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-[360px]">
            <h4 class="text-lg font-semibold mb-3">Verify you're human</h4>
            <div class="mb-3">
                <div id="puzzleContainer" class="relative w-full h-32 border rounded overflow-hidden bg-white">
                    <!-- base image will be inserted here -->
                    <img id="puzzleBase" src="" alt="captcha base" class="w-full h-full object-cover" />
                    <img id="puzzlePiece" src="" alt="captcha piece" class="absolute top-0 left-0 cursor-grab shadow-lg" style="user-select:none; touch-action:none;" />
                </div>
            </div>
            <div class="flex items-center gap-3 mb-2">
                <input id="puzzleSlider" type="range" min="0" max="100" value="0" class="flex-1 h-2" />
                <button id="refreshCaptcha" type="button" class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">Refresh</button>
            </div>
            <div class="flex justify-end gap-2">
                <button id="captchaCancel" type="button" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded">Cancel</button>
                <button id="captchaSubmitBtn" type="button" class="px-3 py-2 bg-primary text-white rounded">Verify & Send</button>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const form = document.getElementById('contactForm');
            const modal = document.getElementById('captchaModal');
            const baseImg = document.getElementById('puzzleBase');
            const pieceImg = document.getElementById('puzzlePiece');
            const container = document.getElementById('puzzleContainer');
            const refreshBtn = document.getElementById('refreshCaptcha');
            const cancelBtn = document.getElementById('captchaCancel');
            const submitBtn = document.getElementById('captchaSubmitBtn');

            if (!form || !modal) return;

            let dragState = { dragging: false, startX: 0, origLeft: 0 };
            let isSubmitting = false;
            let puzzleData = null;

            async function loadCaptcha() {
                try {
                    const res = await fetch("{{ url('captcha/generate') }}", { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (!res.ok) throw new Error('Captcha endpoint error');
                    const data = await res.json();
                    document.getElementById('captcha_id').value = data.id;
                    puzzleData = data;
                    baseImg.src = data.image;
                    pieceImg.src = data.piece;
                    // set fixed container size to generated base size to avoid scaling
                    container.style.width = (data.baseW || 300) + 'px';
                    container.style.height = (data.baseH || 120) + 'px';
                    baseImg.style.width = '100%';
                    baseImg.style.height = '100%';
                    // reset piece position to leftmost inside container and sync slider
                    const maxLeft = (data.baseW || 300) - data.w;
                    const slider = document.getElementById('puzzleSlider');
                    slider.min = 0;
                    slider.max = maxLeft;
                    slider.value = 0;
                    // place piece at left = 0
                    pieceImg.style.left = '0px';
                    pieceImg.style.top = (data.y) + 'px';
                    pieceImg.style.width = data.w + 'px';
                    pieceImg.style.height = data.h + 'px';
                    pieceImg.style.zIndex = 9999;
                    pieceImg.setAttribute('draggable', 'false');
                    pieceImg.style.touchAction = 'none';
                    pieceImg.style.pointerEvents = 'auto';
                    pieceImg.style.position = 'absolute';
                    pieceImg.style.display = 'block';
                    pieceImg.style.transform = 'translateZ(0)';
                    // ensure piece is draggable only horizontally
                    dragState = { dragging: false, startX: 0, origLeft: parseFloat(pieceImg.style.left) || 0 };

                    // hide manual Verify button because we auto-submit when slider reaches target
                    try { submitBtn.style.display = 'none'; } catch (err) {}
                } catch (err) {
                    console.error(err);
                    alert('Unable to load captcha. Please try again later.');
                }
            }

            form.addEventListener('submit', function(e){
                e.preventDefault();
                if (isSubmitting) return; // prevent double open/submit
                // open captcha modal and generate puzzle
                loadCaptcha().then(() => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            refreshBtn.addEventListener('click', function(){ loadCaptcha(); });

            cancelBtn.addEventListener('click', function(){
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            // Drag handlers for pieceImg (mouse + touch)
            function getContainerRect() { return container.getBoundingClientRect(); }

            function startDrag(clientX) {
                console.log('startDrag', clientX);
                dragState.dragging = true;
                dragState.startX = clientX;
                dragState.origLeft = parseFloat(pieceImg.style.left) || 0;
                pieceImg.style.cursor = 'grabbing';
            }

            function moveDrag(clientX) {
                if (!dragState.dragging) return;
                const dx = clientX - dragState.startX;
                let newLeft = dragState.origLeft + dx;
                const rect = getContainerRect();
                // limit movement: from -pieceWidth to container.width - pieceWidth + some padding
                const minLeft = -Math.max(70, puzzleData.w + 10);
                const maxLeft = rect.width - puzzleData.w;
                if (newLeft < minLeft) newLeft = minLeft;
                if (newLeft > maxLeft) newLeft = maxLeft;
                pieceImg.style.left = newLeft + 'px';
                console.log('moveDrag', clientX, 'dx', dx, 'left', newLeft, 'min', minLeft, 'max', maxLeft);
            }

            function endDrag() {
                if (!dragState.dragging) return;
                dragState.dragging = false;
                pieceImg.style.cursor = 'grab';
                console.log('endDrag');
            }

            // pointer events (unified for mouse & touch) - still available, but also sync with slider
            pieceImg.addEventListener('pointerdown', function(e){
                pieceImg.setPointerCapture(e.pointerId);
                startDrag(e.clientX);
                e.preventDefault();
            });
            window.addEventListener('pointermove', function(e){ moveDrag(e.clientX); });
            window.addEventListener('pointerup', function(e){
                try { pieceImg.releasePointerCapture(e.pointerId); } catch (err) {}
                endDrag();
            });

            // slider control (reliable in Chrome). Move piece when slider changes
            const sliderEl = document.getElementById('puzzleSlider');
            sliderEl.addEventListener('input', function(e){
                const v = Number(this.value);
                pieceImg.style.left = v + 'px';

                // check auto-verify condition
                try {
                    const tol = (puzzleData && puzzleData.tolerance) ? Number(puzzleData.tolerance) : 8;
                    const targetX = (puzzleData && typeof puzzleData.x !== 'undefined') ? Number(puzzleData.x) : null;
                    if (targetX !== null && Math.abs(v - targetX) <= tol) {
                        // visual feedback
                        pieceImg.style.boxShadow = '0 0 0 3px rgba(34,197,94,0.35)';
                        // small delay to show feedback then submit
                        setTimeout(() => {
                            document.getElementById('captcha_answer').value = Math.round(v);
                            // disable further submits to avoid duplicates
                            isSubmitting = true;
                            Array.from(form.querySelectorAll('button[type="submit"]')).forEach(b=>b.disabled=true);
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                            form.submit();
                        }, 220);
                    } else {
                        pieceImg.style.boxShadow = '';
                    }
                } catch (err) {
                    console.error('auto-verify check failed', err);
                }
            });

            submitBtn.addEventListener('click', function(){
                // use slider value as final X (more reliable than bounding rect scaling issues)
                const sliderVal = Number(document.getElementById('puzzleSlider').value || 0);
                document.getElementById('captcha_answer').value = Math.round(sliderVal);
                // prevent duplicate submissions
                isSubmitting = true;
                Array.from(form.querySelectorAll('button[type="submit"]')).forEach(b=>b.disabled=true);
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.submit();
            });
        })();
    </script>

</main>

@endsection