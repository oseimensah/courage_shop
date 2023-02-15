<section>
    <?php $setting = \App\Models\Setting::findOrFail(1); ?>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Rate') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update the currency rate per local dollar rate. Current rate: (' . $setting->dollar_value . ').') }}
        </p>
    </header>

    <form method="post" action="{{ route('rate.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="currency-convert" :value="__('Currency Rate')" />
            <x-text-input id="currency-convert" name="rate" type="number" min="0" value="0" step=".01" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'currency-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-blue-800 dark:text-blue-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
