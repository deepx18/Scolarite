<div>
    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.delivery_method') }}</label>
    <select name="delivery_method"
        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
        disabled>
        <option value="">{{ __('portal.requests.create.specifications.placeholders.delivery_method') }}</option>
        <option value="email" @selected(old('delivery_method') === 'email')>{{ __('portal.requests.create.specifications.options.delivery_method.email') }}</option>
        <option value="pickup" @selected(old('delivery_method') === 'pickup')>{{ __('portal.requests.create.specifications.options.delivery_method.pickup') }}</option>
        <option value="mail" @selected(old('delivery_method') === 'mail')>{{ __('portal.requests.create.specifications.options.delivery_method.mail') }}</option>
    </select>
</div>

<div>
    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.number_of_copies') }}</label>
    <input type="number" name="number_of_copies" min="1" max="10" value="{{ old('number_of_copies', 1) }}"
        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
        disabled />
</div>
