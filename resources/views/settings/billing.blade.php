@extends('app')

@section('title', 'Dashboard')

@section('content') 
<div class="bg-gray-200 min-h-screen pb-24">
    @include('partials.dashboard-header')
    <div class="container mx-auto max-w-3xl mt-8">
        <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">Billing Settings</h1>
        
        @include('settings.nav')

        @if(auth()->user()->subscribed('main'))
            <div id="switch-plans-modal" class="fixed w-full h-full inset-0 z-50">
                <div class="fixed opacity-50 bg-black inset-0 w-full h-full"></div>
                <form method="POST" action="{{ route('billing.switch_plan') }}" class="absolute bg-white rounded-lg p-5" id="switch-plans">
                    @csrf
                    <div id="switch-plans-close" class="absolute right-0 top-0 -mt-4 -mr-4 w-8 h-8 rounded-full shadow bg-white flex justify-center align-center text-xl font-bold cursor-pointer">&times;</div>
                    <p class="text-sm text-gray-600 mb-4">Switch Your Plan</p>
                    @include('partials.plans')
                    <button class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer">
                        Switch Plan
                    </button>
                </form>
            </div>
        @endif

        <form action="{{ route('billing.save') }}" id="billing-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                    <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Billing Info</h2>
                    <p class="text-xs text-gray-500">Update your billing information.</p>
                </div>
                <div class="md:w-2/3 w-full">

                    @if(auth()->user()->subscribed('main'))
                        <div class="py-8 px-16">
                            <div class="flex">
                                <img src="/img/plans/{{ auth()->user()->plan->name }}.png" class="w-16 h-16 mr-3">
                                <div>
                                    <span class="block ">Subscribed to {{ ucfirst(auth()->user()->plan->name) }} Plan</span>
                                    <span class="text-xs text-gray-700">{{ auth()->user()->plan->description }}</span>
                                </div>
                            </div>
                            <div id="switch-plans-btn" class="bg-gray-300 text-gray-600 text-sm font-medium px-6 py-2 rounded uppercase cursor-pointer inline-block mt-4">
                                Switch My Plan
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        <div class="py-8 px-16">
                            <div class="text-xs text-blue-600">Your default payment method ends in {{ auth()->user()->card_last_four }}</div>
                            <div class="text-xs text-gray-500">To update your deafult payment method, add a new card below</div>
                        </div>
                        <hr class="border-gray-200">
                    @endif

                    @if(auth()->user()->onTrial())
                        <div class="py-8 px-16">
                            <div class="bg-blue-400 px-6 py-4 rounded-lg">
                                <div class="flex items-center">
                                    <svg version="1.1" class="fill-current text-white mr-4 w-10" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 50 50" xml:space="preserve"><style>.st0{fill:#fff}</style><path class="st0" d="M46.7 43.9c-.7 1-1.2 2.1-2 3-.9 1.1-2.2 1.3-3.6 1.3H14.3c-1.2 0-2.4-.1-3.6 0-2.3.2-4.9-2.5-5-4.3 0-.4-.1-.9-.1-1.3V27.9v-.6c1.1.7 2.2 1.4 3.2 2.2.2.1.2.6.2.9v12.1c0 1.8.5 2.2 2.3 2.2H41c1.7 0 2.3-.5 2.3-2V20.9c0-.1 0-.3-.1-.5H28.9c1.1-3.6.8-7.1-.7-10.5H33c0 1.3-.1 2.5 0 3.7.1 1.5 1 2.4 2.4 2.9 1.4.4 2.9-.1 3.6-1.2.4-.6.6-1.3.7-2.1.1-1.1 0-2.1 0-3.2 3-.8 5.7.6 6.6 3.3.1.2.2.3.2.5.2 10.1.2 20.1.2 30.1z"/><path class="st0" d="M16.7 2.8l2.1.6c5.2 1.7 8.2 5.5 9 10.7.8 5.3-1.3 9.6-5.8 12.7-3.4 2.4-7.1 3-10.9 1.5C4.3 25.7.6 18.9 3 11.6c.3-.8.7-1.6 1-2.5-.3-.5-.8-1-1.2-1.5-.5-.6-.4-1 .4-1.1 1.7-.1 3.4-.3 5.1-.3.3 0 .8.6.8.9 0 1.7-.1 3.3-.2 5-.1 1-.4 1.1-1.2.5-.3-.3-.7-.6-1.2-1-.4.8-.8 1.6-1 2.3-1 4 .1 7.3 3.2 9.9 3.1 2.6 6.8 3.1 10.5 1.5 3.7-1.7 5.7-4.7 6-8.8.2-3.2-1-5.9-3.3-8.1-3.3-3.2-7-3.4-10.9-2-.6-.7-1.3-1.4-2-2.2 1.4-.4 2.9-.9 4.4-1.4h3.3z"/><path class="st0" d="M13.1 16c0-1.1.5-1.6 1.4-1.9.6-.2 1.2-.5 1.7-.9 1.1-.9 2-1.9 3.1-2.8.3-.2.8-.2 1.2-.2-.1.4 0 .9-.2 1.2-.5.7-1 1.4-1.7 1.9-1.9 1.8-2.5 4-2.6 6.5 0 .7 0 1.4-.1 2-.1.3-.6.7-.9.8-.2 0-.7-.5-.8-.8-.2-.6-.2-1.3-.2-2-.1-1 0-2.1-.8-3-.1-.3-.1-.6-.1-.8zM34.8 10.6V7.9c0-1.1.7-1.7 1.6-1.7 1 0 1.7.6 1.7 1.7.1 1.8.1 3.6 0 5.3 0 1.1-.7 1.8-1.7 1.7-1 0-1.6-.7-1.7-1.8 0-.8 0-1.6.1-2.5zM28 27.1v-3.3h3.3v3.3H28zM38.1 23.8v3.3h-3.3v-3.3h3.3zM31.3 34.2H28v-3.3h3.3v3.3zM38.1 34.2h-3.3v-3.3h3.3v3.3zM28 37.9h3.3v3.3H28v-3.3zM38.1 38v3.3h-3.3V38h3.3zM17.6 34.2h-3.2v-3.3h3.2v3.3zM21.2 34.2v-3.3h3.3v3.3h-3.3zM17.6 38v3.2h-3.2V38h3.2zM21.2 38h3.3v3.3h-3.3V38z"/></svg>
                                    <div>
                                        <div class="text-xs text-white font-medium">You are on a Trial Period for the basic plan</div>
                                        <div class="text-xs text-gray-200">You have {{ auth()->user()->trial_ends_at->diffInDays(now()) }} days left on your trial.</div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Subscribe to a Plan Below:</p>
                        </div>
                        <hr class="border-gray-200">
                    @endif

                    <div class="py-8 px-16">
                        <label for="card-holder-name" class="text-sm text-gray-600">Name on Card</label>
                        <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" id="card-holder-name">
                    </div>
                    <hr class="border-gray-200">
                    <div class="py-8 px-16">
                        <label for="cc" class="text-sm text-gray-600">Credit Card</label>
                        <div id="card-element" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"></div>
                        <div id="card-errors" class="text-red-400 text-bold mt-2 text-sm font-medium"></div>
                    </div>
                    @if(!auth()->user()->subscribed('main'))
                    <hr class="border-gray-200">
                    <div class="py-8 px-16">
                        <p class="text-sm text-gray-600 mb-4">Select a Plan</p>
                        @include('partials.plans')
                    </div>
                    @endif
                </div>

            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                <p class="float-left text-xs text-gray-500 tracking-tight mt-2">Click on Save to update your Billing Info</p>
                <button id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer">
                    Update Payment Method
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('javascript')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // const stripe = Stripe('stripe-public-key');
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        const cardError = document.getElementById('card-errors');

        cardElement.addEventListener('change', function(event) {
            if (event.error) {
                cardError.textContent = event.error.message;
            } else {
                cardError.textContent = '';
            }
        });

        var form = document.getElementById('billing-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const { setupIntent, error } = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );
            if (error) {
                // Display "error.message" to the user...
                cardError.textContent = error.message;
                console.log(error);
            } else {
                // The card has been verified successfully...
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        });

    </script>
@endsection