@extends('layouts.user.user')

@section('content')

<!-- 🌄 HERO SECTION -->
<section class="w-full pt-32 pb-16 bg-gradient-to-b from-primary/10 to-background-light dark:from-primary/20 dark:to-background-dark">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-4xl font-bold tracking-tight">Product Details</h1>
        <p class="text-text-light/70 dark:text-text-dark/70 mt-2">
            <a href="{{url('user/dashboard')}}">Home</a>
            <span class="px-1">•</span>
            Details
        </p>
    </div>
</section>

<!-- 🌟 PRODUCT DETAIL -->
<div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-2 gap-10">

    <!-- LEFT IMAGE -->
    <div class="flex justify-center">
        <img src="{{ asset('storage/images/' . $product->photo) }}"
            class="w-full max-w-lg rounded-2xl shadow-lg object-cover">
    </div>

    <!-- RIGHT INFO -->
    <div class="space-y-6">

        <h2 class="text-3xl font-bold">{{ $product->name }}</h2>

        <p class="text-3xl font-bold text-primary">${{ number_format($product->price, 2) }}</p>

        <p class="text-text-light/80 dark:text-text-dark/70 leading-relaxed">
            {{ $product->description }}
        </p>

        <!-- QUANTITY + ADD TO CART -->
        <div class="flex items-center gap-4 pt-4">

            <form method="POST" class="add-detail-cart-form flex items-center gap-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}" />

                <!-- QUANTITY -->
                <div class="flex items-center bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark rounded-full overflow-hidden">

                    <button type="button" class="qty-minus px-4 py-2 text-lg font-bold">−</button>

                    <input type="text" name="quantity"
                        value="1"
                        class="qty-input w-12 py-2 text-center bg-transparent border-none focus:ring-0">

                    <button type="button" class="qty-plus px-4 py-2 text-lg font-bold">+</button>
                </div>

                <!-- Add to Cart -->
                <button type="button"
                    class="add-detail-btn px-6 py-3 rounded-full bg-primary text-white font-semibold hover:bg-primary/80 flex items-center gap-2">
                    <span class="material-symbols-outlined">add_shopping_cart</span>
                    Add to Cart
                </button>
            </form>

        </div>
    </div>
</div>

<!-- 🌈 Toast Notification -->
<div id="toast"
    class="fixed left-1/2 top-20 -translate-x-1/2 z-[500] bg-primary text-white font-semibold px-6 py-3 rounded-xl shadow-lg opacity-0 pointer-events-none transition-all duration-500">
    Added to cart ✔
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ⭐ Quantity controls
        const qtyInput = document.querySelector(".qty-input");
        document.querySelector(".qty-plus").onclick = () => qtyInput.value = parseInt(qtyInput.value) + 1;
        document.querySelector(".qty-minus").onclick = () => {
            if (qtyInput.value > 1) qtyInput.value--;
        };

        // ⭐ Add to cart AJAX
        document.querySelector(".add-detail-btn").addEventListener("click", function() {

            let form = document.querySelector(".add-detail-cart-form");
            let formData = new FormData(form);

            fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {

                    if (data.error === "not_enough_stock") {
                        showToast("⚠ Not enough stock! Only " + data.available + " left", true);
                        return;
                    }

                    if (data.error) {
                        showToast("⚠ " + data.error, true);
                        return;
                    }

                    if (data.success) {
                        showToast("Added to cart ✔", false);
                        updateHeaderCartBadge(data.total);
                    }
                })
                .catch(err => console.error(err));
        });

        function updateHeaderCartBadge(totalQty) {
            let badge = document.querySelector("#cart-count-badge");
            const cartIcon = document.getElementById("header-cart-icon");

            if (!badge) {
                badge = document.createElement("span");
                badge.id = "cart-count-badge";
                badge.className =
                    "absolute -top-1 -right-1 bg-primary text-white text-[12px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow";
                cartIcon.appendChild(badge);
            }

            badge.textContent = totalQty;
        }

        function showToast(message, isError = false) {
            const toast = document.getElementById("toast");

            toast.textContent = message;

            if (isError) {
                toast.style.backgroundColor = "#e11d48"; // red
            } else {
                toast.style.backgroundColor = "#10b981"; // green
            }


            toast.classList.remove("opacity-0");
            toast.classList.add("opacity-100");

            setTimeout(() => {
                toast.classList.remove("opacity-100");
                toast.classList.add("opacity-0");
            }, 1600);
        }

    });
</script>


@endsection